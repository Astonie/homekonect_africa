<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VirtualTourService
{
    protected $matterportKey;
    protected $enabled;

    public function __construct()
    {
        $this->matterportKey = config('gis.virtual_tours.matterport_key');
        $this->enabled = config('gis.virtual_tours.matterport_enabled');
    }

    /**
     * Generate embed code for virtual tour
     */
    public function getEmbedCode($tourUrl, $options = [])
    {
        $height = $options['height'] ?? config('gis.virtual_tours.embed_height', '600px');
        $autoplay = $options['autoplay'] ?? config('gis.virtual_tours.autoplay', false);
        
        // Detect tour type
        if (str_contains($tourUrl, 'matterport')) {
            return $this->getMatterportEmbed($tourUrl, $height, $autoplay);
        } elseif (str_contains($tourUrl, 'kuula')) {
            return $this->getKuulaEmbed($tourUrl, $height);
        } elseif (str_contains($tourUrl, 'youtube') || str_contains($tourUrl, 'youtu.be')) {
            return $this->getYoutubeEmbed($tourUrl, $height);
        }
        
        // Generic iframe
        return $this->getGenericEmbed($tourUrl, $height);
    }

    protected function getMatterportEmbed($url, $height, $autoplay)
    {
        $autoplayParam = $autoplay ? '&play=1' : '';
        return [
            'html' => "<iframe width='100%' height='{$height}' src='{$url}{$autoplayParam}' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>",
            'type' => 'matterport',
            'url' => $url
        ];
    }

    protected function getKuulaEmbed($url, $height)
    {
        return [
            'html' => "<iframe width='100%' height='{$height}' src='{$url}' frameborder='0' allowfullscreen></iframe>",
            'type' => 'kuula',
            'url' => $url
        ];
    }

    protected function getYoutubeEmbed($url, $height)
    {
        // Extract video ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\?\/]+)/', $url, $matches);
        $videoId = $matches[1] ?? null;
        
        if ($videoId) {
            $embedUrl = "https://www.youtube.com/embed/{$videoId}";
            return [
                'html' => "<iframe width='100%' height='{$height}' src='{$embedUrl}' frameborder='0' allowfullscreen></iframe>",
                'type' => 'youtube',
                'url' => $embedUrl
            ];
        }
        
        return $this->getGenericEmbed($url, $height);
    }

    protected function getGenericEmbed($url, $height)
    {
        return [
            'html' => "<iframe width='100%' height='{$height}' src='{$url}' frameborder='0' allowfullscreen></iframe>",
            'type' => 'generic',
            'url' => $url
        ];
    }

    /**
     * Validate virtual tour URL
     */
    public function validateTourUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $supportedDomains = [
            'matterport.com',
            'my.matterport.com',
            'kuula.co',
            'youtube.com',
            'youtu.be',
            'vimeo.com'
        ];

        $host = parse_url($url, PHP_URL_HOST);
        foreach ($supportedDomains as $domain) {
            if (str_contains($host, $domain)) {
                return true;
            }
        }

        return false;
    }
}

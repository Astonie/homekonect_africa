<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PropertyMediaController extends Controller
{
    /**
     * Upload media files for a property
     */
    public function upload(Request $request, Property $property)
    {
        // Authorize: only property owner or admin can upload
        $this->authorize('update', $property);

        $validator = Validator::make($request->all(), [
            'files.*' => 'required|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,webm|max:102400', // 100MB max
            'type' => 'required|in:image,video,drone_image,drone_video,floor_plan,360_photo,photo,drone,panorama',
            'media_type' => 'nullable|string|in:photo,video,drone,panorama',
            'room_type' => 'nullable|string',
            'view_type' => 'nullable|string',
            'is_360' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $uploadedMedia = [];
        $files = $request->file('files');
        
        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $index => $file) {
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '-' . $index . '.' . $extension;
            
            // Determine storage path
            $path = $file->storeAs("properties/{$property->id}/media", $fileName, 'public');
            
            // Get file metadata
            $mimeType = $file->getMimeType();
            $fileSize = $file->getSize();
            $width = null;
            $height = null;
            $thumbnailPath = null;

            // Process images
            if (str_starts_with($mimeType, 'image/')) {
                try {
                    $image = Image::make($file);
                    $width = $image->width();
                    $height = $image->height();

                    // Create thumbnail
                    $thumbnailName = 'thumb-' . $fileName;
                    $thumbnailPath = "properties/{$property->id}/media/thumbnails/{$thumbnailName}";
                    
                    $thumbnail = $image->fit(400, 300);
                    Storage::disk('public')->put($thumbnailPath, (string) $thumbnail->encode());
                } catch (\Exception $e) {
                    \Log::error('Error processing image: ' . $e->getMessage());
                }
            }

            // Get next display order
            $maxOrder = PropertyMedia::where('property_id', $property->id)->max('display_order');
            
            // Create media record
            $media = PropertyMedia::create([
                'property_id' => $property->id,
                'type' => $request->input('type', 'image'),
                'file_path' => $path,
                'file_name' => $fileName,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
                'width' => $width,
                'height' => $height,
                'thumbnail_path' => $thumbnailPath,
                'display_order' => ($maxOrder ?? 0) + 1,
                'room_type' => $request->input('room_type'),
                'view_type' => $request->input('view_type'),
                'is_360' => $request->input('is_360', false),
                'processing_status' => 'completed',
            ]);

            $uploadedMedia[] = $media;
        }

        // Update property flags
        $this->updatePropertyMediaFlags($property);

        return response()->json([
            'message' => 'Media uploaded successfully',
            'media' => $uploadedMedia,
        ], 201);
    }

    /**
     * Get all media for a property
     */
    public function index(Property $property)
    {
        $media = $property->media()->with('property')->get();
        
        return response()->json($media);
    }

    /**
     * Update media details
     */
    public function update(Request $request, PropertyMedia $media)
    {
        $this->authorize('update', $media->property);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'caption' => 'nullable|string',
            'tags' => 'nullable|array',
            'room_type' => 'nullable|string',
            'view_type' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_cover' => 'nullable|boolean',
            'display_order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // If setting as cover, unset other cover images
        if ($request->input('is_cover')) {
            PropertyMedia::where('property_id', $media->property_id)
                ->where('id', '!=', $media->id)
                ->update(['is_cover' => false]);
        }

        $media->update($request->only([
            'title',
            'description',
            'caption',
            'tags',
            'room_type',
            'view_type',
            'is_featured',
            'is_cover',
            'display_order',
        ]));

        return response()->json([
            'message' => 'Media updated successfully',
            'media' => $media,
        ]);
    }

    /**
     * Reorder media items
     */
    public function reorder(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $validator = Validator::make($request->all(), [
            'order' => 'required|array',
            'order.*' => 'required|integer|exists:property_media,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        foreach ($request->input('order') as $index => $mediaId) {
            PropertyMedia::where('id', $mediaId)
                ->where('property_id', $property->id)
                ->update(['display_order' => $index + 1]);
        }

        return response()->json(['message' => 'Media reordered successfully']);
    }

    /**
     * Delete media
     */
    public function destroy(PropertyMedia $media)
    {
        $this->authorize('update', $media->property);

        $property = $media->property;
        $media->delete(); // Files are deleted in model boot method

        // Update property flags
        $this->updatePropertyMediaFlags($property);

        return response()->json(['message' => 'Media deleted successfully']);
    }

    /**
     * Bulk delete media
     */
    public function bulkDelete(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $validator = Validator::make($request->all(), [
            'media_ids' => 'required|array',
            'media_ids.*' => 'required|integer|exists:property_media,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        PropertyMedia::whereIn('id', $request->input('media_ids'))
            ->where('property_id', $property->id)
            ->delete();

        // Update property flags
        $this->updatePropertyMediaFlags($property);

        return response()->json(['message' => 'Media deleted successfully']);
    }

    /**
     * Update property media availability flags
     */
    protected function updatePropertyMediaFlags(Property $property)
    {
        $property->update([
            'has_video_tour' => $property->allVideos()->exists(),
            'has_drone_footage' => PropertyMedia::where('property_id', $property->id)
                ->whereIn('type', ['drone_image', 'drone_video'])
                ->exists(),
        ]);
    }
}

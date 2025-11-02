# Bulk Navigation Update Script
$baseDir = "c:\Users\THINKPAD -T15\Documents\konnectHome\home-konnect"

$updates = @(
    @{File="resources/views/landlord/documents/edit.blade.php"; Component='<x-navigation.landlord active="documents" />'},
    @{File="resources/views/landlord/dashboard.blade.php"; Component='<x-navigation.landlord active="dashboard" />'},
    @{File="resources/views/landlord/properties/index.blade.php"; Component='<x-navigation.landlord active="properties" />'},
    @{File="resources/views/landlord/properties/create.blade.php"; Component='<x-navigation.landlord active="properties" />'},
    @{File="resources/views/landlord/properties/edit.blade.php"; Component='<x-navigation.landlord active="properties" />'},
    @{File="resources/views/agent/dashboard.blade.php"; Component='<x-navigation.agent active="dashboard" />'},
    @{File="resources/views/agent/properties/index.blade.php"; Component='<x-navigation.agent active="properties" />'},
    @{File="resources/views/agent/properties/create.blade.php"; Component='<x-navigation.agent active="properties" />'},
    @{File="resources/views/agent/properties/edit.blade.php"; Component='<x-navigation.agent active="properties" />'},
    @{File="resources/views/tenant/dashboard.blade.php"; Component='<x-navigation.tenant active="dashboard" />'}
)

Write-Host "`n=== STARTING BULK UPDATE ===" -ForegroundColor Cyan
$successCount = 0
$errorCount = 0

foreach ($update in $updates) {
    $filePath = Join-Path $baseDir $update.File
    
    if (-not (Test-Path $filePath)) {
        Write-Host " SKIP: $($update.File) (not found)" -ForegroundColor Red
        $errorCount++
        continue
    }
    
    try {
        $content = Get-Content $filePath -Raw -Encoding UTF8
        
        # Check if already updated
        if ($content -match '<x-navigation\.') {
            Write-Host " SKIP: $($update.File) (already updated)" -ForegroundColor Gray
            continue
        }
        
        # Replace the navigation slot
        $newNav = "    {{-- Navigation Slot --}}`n    <x-slot name=`"navigation`">`n        $($update.Component)`n    </x-slot>"
        
        $pattern = '(?s)    {{-- Navigation Slot --}}.*?</x-slot>'
        
        if ($content -match $pattern) {
            $newContent = $content -replace $pattern, $newNav
            Set-Content -Path $filePath -Value $newContent -Encoding UTF8 -NoNewline
            Write-Host " UPDATED: $($update.File)" -ForegroundColor Green
            $successCount++
        } else {
            Write-Host "? WARNING: $($update.File) (pattern not found)" -ForegroundColor Yellow
        }
    }
    catch {
        Write-Host " ERROR: $($update.File) - $($_.Exception.Message)" -ForegroundColor Red
        $errorCount++
    }
}

Write-Host "`n=== UPDATE COMPLETE ===" -ForegroundColor Cyan
Write-Host "Successfully updated: $successCount files" -ForegroundColor Green
Write-Host "Errors/Skipped: $errorCount files" -ForegroundColor $(if ($errorCount -gt 0) { "Red" } else { "Gray" })

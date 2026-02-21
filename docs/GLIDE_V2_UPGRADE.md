# Upgrading to Glide v2

## Overview

This document outlines the changes needed to upgrade from Glide v1 to Glide v2 in the yii2-starter-kit project.

## Main Changes in Glide v2

Glide v2's main breaking change is the migration from Flysystem v1 to Flysystem v2. This affects:

1. **Namespace changes**: Flysystem adapters moved to different namespaces
   - `League\Flysystem\Adapter\Local` → `League\Flysystem\Local\LocalFilesystemAdapter`
   - Constructor signatures may have changed

2. **API changes**: Some Flysystem methods have changed signatures or return types

## Changes Made

### 1. LocalFlysystemBuilder Updated

The `common/components/filesystem/LocalFlysystemBuilder.php` has been updated to support both Flysystem 1.x and 2.x:

```php
public function build()
{
    $resolvedPath = \Yii::getAlias($this->path);
    
    // Check if we're using Flysystem 2.x or 1.x
    if (class_exists('League\Flysystem\Local\LocalFilesystemAdapter')) {
        // Flysystem 2.x
        $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter($resolvedPath);
    } else {
        // Flysystem 1.x
        $adapter = new \League\Flysystem\Adapter\Local($resolvedPath);
    }
    
    return new Filesystem($adapter);
}
```

### 2. Composer Dependencies

The `composer.json` has been updated to explicitly require:
- `league/glide: ^2.0`
- `league/flysystem: ^2.0`

## Dependencies That Need Updating

The following dependencies currently do not support Glide v2/Flysystem v2:

### 1. trntv/yii2-glide

Current version: `^1.2` (requires `league/glide: ^1.1`)

**Required changes in trntv/yii2-glide**:
- Update `composer.json` to require `league/glide: ^2.0`
- No code changes should be needed as yii2-glide is just a thin wrapper

**Recommended approach**:
- Fork `trntv/yii2-glide` to `yii-starter-kit/yii2-glide`
- Update the composer.json
- Publish and use the forked version

### 2. yii2-starter-kit/yii2-file-kit

Current version: `^2.1.0` (requires `league/flysystem: ^1.0`)

**Required changes in yii2-file-kit**:
- Update `composer.json` to require `league/flysystem: ^2.0 | ^3.0`
- Update any Flysystem adapter usage to support both v1 and v2/v3 APIs (similar to LocalFlysystemBuilder)
- Test with various Flysystem adapters (Local, S3, etc.)

**Recommended approach**:
- Since yii2-starter-kit already maintains this package, update it directly
- Create a new major version (v3.0.0) that supports Flysystem v2+
- Ensure backward compatibility or provide a clear migration guide

## Testing

After making the changes, test the following:

1. **Image upload**: Verify files can be uploaded through the file-kit widget
2. **Image display**: Verify images are displayed correctly with Glide transformations
3. **Image cache**: Verify Glide caching works properly
4. **Signed URLs**: Verify signed URL generation works if enabled
5. **Different storage adapters**: Test with local storage and any other adapters in use

## Migration Path

### Option 1: Fork and Update Dependencies (Recommended)

1. Fork `trntv/yii2-glide` to `yii-starter-kit/yii2-glide`
2. Update it to support Glide v2
3. Update `yii2-starter-kit/yii2-file-kit` to v3.0 with Flysystem v2 support
4. Update `composer.json` in yii2-starter-kit to use the forked versions

### Option 2: Wait for Upstream Updates

1. Keep current changes that make the codebase compatible with both versions
2. Wait for upstream packages to update
3. Once updated, simply run `composer update`

### Option 3: Use Composer Patches

1. Use `cweagans/composer-patches` plugin
2. Create patches for the dependency composer.json files
3. Apply patches during composer install

## Files Changed in This PR

- `common/components/filesystem/LocalFlysystemBuilder.php` - Updated to support both Flysystem versions
- `composer.json` - Added explicit requirements for Glide v2 and Flysystem v2
- `docs/GLIDE_V2_UPGRADE.md` - This documentation

## Next Steps

1. Decide on the migration path (Option 1, 2, or 3)
2. If Option 1: Fork and update trntv/yii2-glide
3. Update yii2-file-kit to v3.0 with Flysystem v2 support
4. Test thoroughly with actual image uploads and transformations
5. Update documentation and CHANGELOG

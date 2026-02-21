# Glide v2 Support - Implementation Plan

## Current Status

The yii2-starter-kit currently uses:
- `trntv/yii2-glide: ^1.2` which requires `league/glide: ^1.1`  
- `yii2-starter-kit/yii2-file-kit: ^2.1.0` which requires `league/flysystem: ^1.0`

## Changes Made in This PR

### 1. LocalFlysystemBuilder - Backward Compatible Update ✅

File: `common/components/filesystem/LocalFlysystemBuilder.php`

Updated to detect and support both Flysystem 1.x and 2.x APIs:

```php
if (class_exists('League\Flysystem\Local\LocalFilesystemAdapter')) {
    // Flysystem 2.x
    $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter($resolvedPath);
} else {
    // Flysystem 1.x
    $adapter = new \League\Flysystem\Adapter\Local($resolvedPath);
}
```

This change is **backward compatible** - the code works with both versions.

## What Still Needs to be Done

To fully support Glide v2, the following packages need to be updated:

### Option A: Fork and Maintain (Recommended for yii2-starter-kit)

Since yii2-starter-kit already maintains its own fork of `yii2-file-kit`, the recommended approach is:

1. **Fork trntv/yii2-glide**
   - Create `yii-starter-kit/yii2-glide` repository
   - Update `composer.json` to require `league/glide: ^2.0`
   - The code itself should work without changes (it's just a thin wrapper)
   - Tag as version `2.0.0`

2. **Update yii2-file-kit**
   - Update `yii2-starter-kit/yii2-file-kit` to support Flysystem v2
   - Similar backward-compatible approach as LocalFlysystemBuilder
   - Tag as version `3.0.0`

3. **Update yii2-starter-kit**
   - Change `composer.json` to require:
     ```json
     "yii-starter-kit/yii2-glide": "^2.0",
     "yii2-starter-kit/yii2-file-kit": "^3.0"
     ```

### Option B: Composer Patches

Use the `cweagans/composer-patches` plugin to patch the dependencies:

1. Add to `composer.json`:
```json
"require": {
  "cweagans/composer-patches": "^1.7"
},
"extra": {
  "patches": {
    "trntv/yii2-glide": {
      "Support Glide v2": "patches/yii2-glide-v2.patch"
    },
    "yii2-starter-kit/yii2-file-kit": {
      "Support Flysystem v2": "patches/yii2-file-kit-v2.patch"
    }
  }
}
```

2. Create patch files that update the version constraints

### Option C: Wait for Upstream

Wait for the upstream packages to be updated. The changes made in this PR (LocalFlysystemBuilder) ensure that when the dependencies are updated, the yii2-starter-kit code will be compatible.

## Testing After Full Implementation

Once all dependencies are updated, test:

1. Image uploads via file-kit
2. Image transformations via Glide (resize, crop, filters, etc.)
3. Glide URL generation and signing
4. Cache functionality
5. Different storage adapters if used (S3, etc.)

## Detailed Changes Needed in Dependencies

### trntv/yii2-glide

File: `composer.json`
```json
{
  "require": {
    "league/glide": "^2.0"
  }
}
```

No code changes needed - the package is a thin wrapper and should work with Glide v2.

### yii2-file-kit

File: `src/filesystem/FilesystemBuilderInterface.php` - no changes needed

Files using Flysystem adapters need to be updated similar to LocalFlysystemBuilder to support both v1 and v2 APIs.

## Breaking Changes in Glide v2

The main breaking change is Flysystem v1 → v2:

1. **Namespace changes**:
   - `League\Flysystem\Adapter\Local` → `League\Flysystem\Local\LocalFilesystemAdapter`
   - Other adapters have similar namespace changes

2. **Constructor changes**: Some adapters have different constructor signatures

3. **No functional API changes**: The public API of Glide itself remains compatible

## Conclusion

This PR provides:
- ✅ Backward-compatible code changes
- ✅ Documentation of the upgrade path
- ✅ Implementation examples

The final step of actually updating to Glide v2 requires forking/updating the dependency packages, which is a decision for the yii2-starter-kit maintainers.

# Local Package: yii2-file-kit (Flysystem v2/v3 Compatible)

This is a locally maintained version of `yii2-starter-kit/yii2-file-kit` that supports both Flysystem v1, v2, and v3.

## Origin

Based on: https://github.com/yii-starter-kit/yii2-file-kit (master branch)

## Changes Made

### 1. Composer Dependencies
- Updated `league/flysystem` requirement from `^1.0` to `^2.0 || ^3.0`

### 2. Flysystem Interface Compatibility
The main code change is in `src/Storage.php`:

Added a class alias to handle the interface rename from Flysystem 1.x to 2.x/3.x:
- Flysystem 1.x: `League\Flysystem\FilesystemInterface`
- Flysystem 2.x/3.x: `League\Flysystem\FilesystemOperator`

```php
if (interface_exists('League\Flysystem\FilesystemOperator')) {
    // Flysystem 2.x/3.x
    class_alias('League\Flysystem\FilesystemOperator', 'trntv\filekit\FilesystemInterface');
} else {
    // Flysystem 1.x
    class_alias('League\Flysystem\FilesystemInterface', 'trntv\filekit\FilesystemInterface');
}
```

The Storage class then uses the aliased `FilesystemInterface` name internally, which points to the correct interface for the installed Flysystem version.

## Backward Compatibility

This package is **fully backward compatible** with Flysystem v1. The runtime detection ensures the correct interface is used based on which version is installed.

## FilesystemBuilderInterface

The `FilesystemBuilderInterface` remains unchanged. All builders (like `LocalFlysystemBuilder`) are responsible for creating filesystem instances compatible with their respective Flysystem versions.

## Adapter Compatibility

All Flysystem adapters need to be updated individually to work with Flysystem v2/v3:
- Local adapter (updated in `common/components/filesystem/LocalFlysystemBuilder.php`)
- S3 adapter (if used, needs similar updates)
- Other adapters (if used, need similar updates)

## Future

Once the official `yii2-starter-kit/yii2-file-kit` package is updated to support Flysystem v2/v3, this local package can be removed.

## Version

v3.0.0 - Major version bump to indicate Flysystem v2/v3 support

## License

Same as the original package

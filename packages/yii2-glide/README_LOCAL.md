# Local Package: yii2-glide (Glide v2 Compatible)

This is a locally maintained fork of `trntv/yii2-glide` that supports both Glide v1 and Glide v2 (with Flysystem v2).

## Origin

Forked from: https://github.com/trntv/yii2-glide (master branch)
Original License: BSD-3-Clause

## Changes Made

### 1. Composer Dependencies
- Updated `league/glide` requirement from `^1.1` to `^2.0`
- Updated `league/uri` to support newer versions
- Updated `symfony/http-foundation` to support newer versions

### 2. Flysystem Compatibility
The main code change is in `src/components/Glide.php`:

#### Class Alias for Interface Compatibility
Added a class alias to handle the interface rename from Flysystem 1.x to 2.x:
- Flysystem 1.x: `League\Flysystem\FilesystemInterface`
- Flysystem 2.x: `League\Flysystem\FilesystemOperator`

```php
if (interface_exists('League\Flysystem\FilesystemOperator')) {
    // Flysystem 2.x
    class_alias('League\Flysystem\FilesystemOperator', 'trntv\glide\components\FilesystemInterface');
} else {
    // Flysystem 1.x
    class_alias('League\Flysystem\FilesystemInterface', 'trntv\glide\components\FilesystemInterface');
}
```

#### Adapter Initialization
Updated `getFilesystemProperty()` method to support both Flysystem 1.x and 2.x adapters:

```php
if (class_exists('League\Flysystem\Local\LocalFilesystemAdapter')) {
    // Flysystem 2.x
    $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter($resolvedPath);
} else {
    // Flysystem 1.x
    $adapter = new Local($resolvedPath);
}
```

## Backward Compatibility

This package is **fully backward compatible** with Glide v1 and Flysystem v1. The runtime detection ensures the correct code path is used based on which version is installed.

## Future

Once the upstream `trntv/yii2-glide` package is updated to support Glide v2, this local package can be removed, and the project can revert to using the official package.

## Installation

This package is automatically used when it's present in the `packages/yii2-glide` directory and composer.json includes it as a path repository. No special installation steps are required.

## Testing

Test the following after updating:
1. Image uploads via file-kit widget
2. Image display with Glide transformations (resize, crop, etc.)
3. Signed URL generation
4. Image caching

## License

BSD-3-Clause (same as the original package)

<?php
namespace common\components;

use League\Glide\Http\UrlBuilderFactory;
use Yii;

/**
 * Simple helper needed to create signed url to image in storage
 * @author Eugene Terentev <eugene@terentev.net>
 */
class GlideHelper
{
    /**
     * @param string $path image path
     * @param array $options
     * @link http://glide.thephpleague.com/
     * @return string
     */
    public static function generateImageUrl($path, array $options)
    {
        $basePath = Yii::getAlias('@storageUrl') . '/cache';
        $urlBuilder = UrlBuilderFactory::create($basePath, getenv('GLIDE_SIGN_KEY'));
        return $urlBuilder->getUrl($path, $options);
    }
}

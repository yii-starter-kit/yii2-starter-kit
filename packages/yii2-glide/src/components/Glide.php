<?php
namespace trntv\glide\components;

use League\Uri\Http;
use League\Uri\QueryParser;
use League\Uri\Uri;
use Yii;
use Intervention\Image\ImageManager;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
// Support both Flysystem 1.x and 2.x
if (interface_exists('League\Flysystem\FilesystemOperator')) {
    // Flysystem 2.x
    class_alias('League\Flysystem\FilesystemOperator', 'trntv\glide\components\FilesystemInterface');
} else {
    // Flysystem 1.x
    class_alias('League\Flysystem\FilesystemInterface', 'trntv\glide\components\FilesystemInterface');
}
use League\Glide\Api\Api;
use League\Glide\Manipulators\Blur;
use League\Glide\Manipulators\Brightness;
use League\Glide\Manipulators\Contrast;
use League\Glide\Manipulators\Crop;
use League\Glide\Manipulators\Filter;
use League\Glide\Manipulators\Flip;
use League\Glide\Manipulators\Gamma;
use League\Glide\Manipulators\Orientation;
use League\Glide\Manipulators\Pixelate;
use League\Glide\Manipulators\Sharpen;
use League\Glide\Manipulators\Size;
use League\Glide\Manipulators\Background;
use League\Glide\Manipulators\Border;
use League\Glide\Manipulators\Encode;
use League\Glide\Manipulators\Watermark;
use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureFactory;
use League\Glide\Urls\UrlBuilder;
use League\Glide\Urls\UrlBuilderFactory;
use League\Glide\Server;
use League\Uri\Components\Query;
use Symfony\Component\HttpFoundation\Request;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use League\Glide\Responses\ResponseFactoryInterface;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @param $source FilesystemInterface
 * @param $cache FilesystemInterface
 * @param $server \League\Glide\Server
 * @param $httpSignature \League\Glide\Signatures\Signature
 * @param $urlBuilder \League\Glide\Urls\UrlBuilderFactory
 */
class Glide extends Component
{
    /**
     * @var string
     */
    public $sourcePath;
    /**
     * @var string
     */
    public $sourcePathPrefix;
    /**
     * @var string
     */
    public $cachePath;
    /**
     * @var string
     */
    public $cachePathPrefix;
    /**
     * @var string
     */
    public $watermarksPath;
    /**
     * @var string
     */
    public $watermarksPathPrefix;
    /**
     * Sign key. false if you do not want to use HTTP signatures
     * @var string|bool|null
     */
    public $signKey;
    /**
     * @var string
     */
    public $maxImageSize;
    /**
     * @var string
     */
    public $baseUrl;
    /**
     * @var string
     */
    public $urlManager = 'urlManager';
    /**
     * @var bool
     */
    public $groupCacheInFolders = true;
    /**
     * @var ResponseFactoryInterface|null
     */
    public $responseFactory;
    /**
     * Default image manipulations.
     * @var array
     */
    public $defaults = [];
    /**
     * Preset image manipulations.
     * @var array
     */
    public $presets = [];
    /**
     * @var
     */
    protected $source;
    /**
     * @var
     */
    protected $cache;
    /**
     * @var
     */
    protected $watermarks;
    /**
     * @var
     */
    protected $server;
    /**
     * @var
     */
    protected $httpSignature;
    /**
     * @var
     */
    protected $urlBuilder;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (YII_ENV_PROD && !$this->signKey && !$this->maxImageSize) {
            Yii::warning(
                'It is highly recommended to use secure url or set "maxImageSize" on production environments',
                'glide'
            );
        }
        parent::init();
    }

    /**
     * @param $path
     * @param array $params
     */
    public function outputImage($path, $params = [])
    {
        $this->getServer()->outputImage($path, $params);
    }


    /**
     * Generate manipulated image.
     * @param  string $path Image path.
     * @param  array $params Image manipulation params.
     * @return string                Cache path.
     * @throws \League\Glide\Filesystem\FileNotFoundException
     * @throws \League\Glide\Filesystem\FilesystemException
     */
    public function makeImage($path, $params = [])
    {
       return $this->getServer()->makeImage($path, $params);
    }

    /**
     * Get configured server.
     * @return Server
     */
    public function getServer()
    {
        if (!$this->server) {
            $server = new Server(
                $this->getSource(),
                $this->getCache(),
                $this->getApi()
            );

            $server->setSourcePathPrefix($this->sourcePathPrefix);
            $server->setCachePathPrefix($this->cachePathPrefix);
            $server->setGroupCacheInFolders($this->groupCacheInFolders);
            $server->setDefaults($this->defaults);
            $server->setPresets($this->presets);
            $server->setBaseUrl($this->baseUrl);
            $server->setResponseFactory($this->responseFactory);

            $this->server = $server;
        }

        return $this->server;
    }

    /**
     * Get source file system.
     * @return FilesystemInterface
     */
    public function getSource()
    {
        return $this->getFilesystemProperty('source');
    }

    /**
     * Set source file system.
     * @param FilesystemInterface $source
     */
    public function setSource(FilesystemInterface $source)
    {
        $this->source = $source;
    }

    /**
     * Get file system for property.
     * @var string $property
     * @return FilesystemInterface The filesystem object
     */
    protected function getFilesystemProperty($property)
    {
        $path = $property . 'Path';

        if (!$this->$property && $this->$path) {
            $resolvedPath = Yii::getAlias($this->$path);
            
            // Support both Flysystem 1.x and 2.x
            if (class_exists('League\Flysystem\Local\LocalFilesystemAdapter')) {
                // Flysystem 2.x
                $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter($resolvedPath);
            } else {
                // Flysystem 1.x
                $adapter = new Local($resolvedPath);
            }
            
            $this->$property = new Filesystem($adapter);
        }
        return $this->$property;
    }

    /**
     * Get cache file system.
     * @return FilesystemInterface
     */
    public function getCache()
    {
        return $this->getFilesystemProperty('cache');
    }

    /**
     * Set cache file system.
     * @param FilesystemInterface $cache
     */
    public function setCache(FilesystemInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Get image manipulation API.
     * @return Api
     */
    public function getApi()
    {
        $imageManager = new ImageManager([
            'driver' => extension_loaded('imagick') ? 'imagick' : 'gd'
        ]);
        $manipulators = [
            new Orientation(),
            new Crop(),
            new Size($this->maxImageSize),
            new Brightness(),
            new Contrast(),
            new Gamma(),
            new Sharpen(),
            new Filter(),
            new Flip(),
            new Blur(),
            new Pixelate(),
            new Background(),
            new Border(),
            new Watermark($this->getWatermarks(), $this->watermarksPathPrefix),
            new Encode(),
        ];

        return new Api($imageManager, $manipulators);
    }

    /**
     * Get watermarks file system.
     * @return FilesystemInterface
     */
    public function getWatermarks()
    {
        return $this->getFilesystemProperty('watermarks');
    }

    /**
     * Set watermarks file system.
     * @param FilesystemInterface $watermarks
     */
    public function setWatermarks(FilesystemInterface $watermarks)
    {
        $this->watermarks = $watermarks;
    }

    /**
     * @param array $params
     * @param bool $scheme
     * @return bool|string
     * @throws InvalidConfigException
     */
    public function createSignedUrl(array $params, $scheme = false)
    {
        $route = ArrayHelper::getValue($params, 0);
        if ($this->getUrlManager()->enablePrettyUrl) {
            $showScriptName = $this->getUrlManager()->showScriptName;
            if ($showScriptName) {
                $this->getUrlManager()->showScriptName = false;
            }
            $resultUrl = $this->getUrlManager()->createAbsoluteUrl($params);
            $this->getUrlManager()->showScriptName = $showScriptName;
            $uri = Http::createFromString($resultUrl);
            $path = $uri->getPath();
            $urlParams = (array) (new QueryParser)->parse($uri->getQuery());
        } else {
            $path = '/index.php';
            $route = array_shift($params);
            $urlParams = $params;
            $urlParams['r'] = $route;
        }

        if ($this->signKey) {
            $signature = $this->getHttpSignature()->generateSignature($path, $urlParams);
            $params['s'] = $signature;
        }

        $params[0] = $route;
        return $scheme
            ? $this->getUrlManager()->createAbsoluteUrl($params, $scheme)
            : $this->getUrlManager()->createUrl($params);
    }

    /**
     * @return null|\yii\web\UrlManager
     * @throws InvalidConfigException
     */
    public function getUrlManager()
    {
        return Yii::$app->get($this->urlManager);
    }

    /**
     * @return \League\Glide\Signatures\Signature
     * @throws InvalidConfigException
     */
    public function getHttpSignature()
    {
        if ($this->httpSignature === null) {
            if ($this->signKey === null) {
                throw new InvalidConfigException;
            }
            $this->httpSignature = SignatureFactory::create($this->signKey);
        }
        return $this->httpSignature;

    }

    /**
     * @param $url
     * @param array $params
     * @return string
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws InvalidConfigException
     */
    public function signUrl($url, array $params = [])
    {
        $uri = Uri::createFromString($url);
        $query = \array_merge($params, (new QueryParser)->parse($uri->getQuery()));
        $signature = $this->getHttpSignature()->generateSignature($uri->getPath(), $query);
        $query['s'] = $signature;
        $uri = $uri->withQuery((string) Query::createFromParams($query));
        return (string) $uri;
    }

    /**
     * @param $path
     * @param $params
     */
    public function signPath($path, array $params = [])
    {
        $this->getUrlBuilder()->getUrl($path, $params);
    }

    /**
     * @return UrlBuilder
     */
    public function getUrlBuilder()
    {
        if (!$this->urlBuilder) {
            $this->urlBuilder = UrlBuilderFactory::create($this->baseUrl, $this->signKey);
        }
        return $this->urlBuilder;
    }

    /**
     * @param UrlBuilder $urlBuilder
     */
    public function setUrlBuilder(UrlBuilder $urlBuilder)
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param Request $request
     * @return bool
     * @throws InvalidConfigException
     */
    public function validateRequest(Request $request)
    {
        if ($this->signKey !== null) {
            $httpSignature = $this->getHttpSignature();
            try {
                $httpSignature->validateRequest($request->getPathInfo(), $request->query->all());
            } catch (SignatureException $e) {
                return false;
            }
        }
        return true;
    }
}

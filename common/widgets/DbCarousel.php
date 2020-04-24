<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\widgets;

use cheatsheet\Time;
use common\models\WidgetCarousel;
use common\models\WidgetCarouselItem;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap4\Carousel;
use yii\di\Instance;
use yii\helpers\Html;
use yii\web\AssetManager;

/**
 * Class DbCarousel
 * @package common\widgets
 */
class DbCarousel extends Carousel
{
    /**
     * @var
     */
    public $key;

    /**
     * The options passed to all the carousel images.
     *
     * @var array
     */
    public $imageOptions = ['class' => ['d-block', 'w-100']];

    /**
     * @var string|array|callable|AssetManager
     */
    public $assetManager;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->key) {
            throw new InvalidConfigException("key should be set");
        }
        $this->assetManager = Instance::ensure($this->assetManager, AssetManager::class);
        $cacheKey = [
            WidgetCarousel::class,
            $this->key
        ];
        $items = Yii::$app->cache->get($cacheKey);
        if ($items === false) {
            $items = [];
            $query = WidgetCarouselItem::find()
                ->joinWith('carousel')
                ->where([
                    '{{%widget_carousel_item}}.status' => 1,
                    '{{%widget_carousel}}.status' => WidgetCarousel::STATUS_ACTIVE,
                    '{{%widget_carousel}}.key' => $this->key,
                ])
                ->orderBy(['order' => SORT_ASC]);
            foreach ($query->all() as $k => $item) {
                /** @var $item \common\models\WidgetCarouselItem */
                if ($item->path) {
                    $url = $this->publishItem($item);
                    $items[$k]['content'] = Html::img($url, $this->imageOptions);
                }

                if ($item->url) {
                    $items[$k]['content'] = Html::a($items[$k]['content'], $item->url, ['target' => '_blank']);
                }

                if ($item->caption) {
                    $items[$k]['caption'] = $item->caption;
                }
            }
            Yii::$app->cache->set($cacheKey, $items, Time::SECONDS_IN_A_YEAR);
        }
        $this->items = $items;
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerPlugin('carousel');
        $content = '';
        if (!empty($this->items)) {
            $content = implode("\n", [
                $this->renderIndicators(),
                $this->renderItems(),
                $this->renderControls()
            ]);
        }
        return Html::tag('div', $content, $this->options);
    }

    /**
     * @param WidgetCarouselItem $item
     *
     * @return string
     */
    protected function publishItem($item)
    {
        if (!$item->asset_url) {
            $url = \sprintf('%s/%s', $item->base_url,  $item->path);
            $item->updateAttributes([
                'asset_url' => $url
            ]);
        }

        return $item->asset_url;
    }
}

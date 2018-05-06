<?php declare(strict_types=1);

namespace common\sitemap;

use common\models\Article;
use common\models\Page;
use Sitemaped\Element\Urlset\Url;

class UrlsIterator extends \AppendIterator
{
    /**
     * UrlsIterator constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->append($this->createPageLinksGenerator());
        $this->append($this->createArticleLinksGenerator());
    }

    /**
     * @return \Generator
     */
    protected function createPageLinksGenerator()
    {
        $models = Page::find()->published()->each(1000);
        foreach ($models as $model) {
            /** @var Page $model */
            $url = new Url(
                \yii\helpers\Url::to(['/page/view', 'slug' => $model->slug], true),
                (new \DateTime())->setTimestamp($model->updated_at),
                Url::CHANGEFREQ_MONTHLY
            );
            yield $url;
        }
    }

    /**
     * @return \Generator
     */
    protected function createArticleLinksGenerator(): \Generator
    {
        $models = Article::find()->published()->each(1000);
        foreach ($models as $model) {
            /** @var Article $model */
            $url = new Url(
                \yii\helpers\Url::to(['/article/view', 'slug' => $model->slug], true),
                (new \DateTime())->setTimestamp($model->updated_at),
                Url::CHANGEFREQ_WEEKLY
            );
            yield $url;
        }
    }
}

<?php

namespace frontend\modules\api\v1\resources;

use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\Link;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Article extends \common\models\Article implements Linkable
{
    public function fields()
    {
        return ['id', 'slug', 'category_id', 'title', 'body', 'published_at'];
    }

    public function extraFields()
    {
        return ['category'];
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['article/view', 'id' => $this->id], true)
        ];
    }
}

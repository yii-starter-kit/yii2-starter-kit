<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Article extends \common\models\Article implements Linkable
{
    public function fields()
    {
        return ['id', 'slug', 'thumbnail_base_url', 'thumbnail_path', 'title', 'body', 'status',
            'published_at', 'created_by', 'updated_by', 'created_at', 'updated_at', 'category', 'articleAttachments'];
    }

    public function extraFields()
    {
        return ['category', 'articleAttachments'];
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

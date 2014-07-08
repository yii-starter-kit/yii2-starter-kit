<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace app\models\query;

use app\models\Article;
use yii\db\ActiveQuery;

class ArticleQuery extends ActiveQuery {
    public function published()
    {
        $this->andWhere(['status' => Article::STATUS_PUBLISHED]);
        $this->andWhere('article.published_at < NOW()');
        return $this;
    }
} 
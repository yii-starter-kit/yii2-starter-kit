<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Article;
use common\models\ArticleCategory;
use yii\db\ActiveQuery;

class ArticleQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['{{%article}}.[[status]]' => Article::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%article}}.[[published_at]]', time()]);
        return $this;
    }

    public function getFullArchive()
    {
        $this->innerJoin('{{%article_category}}', '{{%article_category}}.[[id]] = {{%article}}.[[category_id]]');
        $this->select([
            'YEAR(FROM_UNIXTIME({{%article}}.[[published_at]])) AS [[year]]',
            'MONTH(FROM_UNIXTIME({{%article}}.[[published_at]])) AS [[month]]',
            'COUNT(*) AS [[count]]'
        ]);
        $this->published();
        $this->andWhere(['{{%article_category}}.[[status]]' => ArticleCategory::STATUS_ACTIVE]);
        $this->groupBy('[[year]], [[month]]');
        $this->orderBy('[[year]] DESC, [[month]] DESC');
        return $this;
    }
}

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
        $db = \Yii::$app->db;
        $driverName = $db->driverName;
        
        // Use database-specific date extraction functions
        if ($driverName === 'pgsql') {
            $yearExpr = "EXTRACT(YEAR FROM TO_TIMESTAMP({{%article}}.[[published_at]])) AS [[year]]";
            $monthExpr = "EXTRACT(MONTH FROM TO_TIMESTAMP({{%article}}.[[published_at]])) AS [[month]]";
        } else {
            // Default to MySQL syntax
            $yearExpr = 'YEAR(FROM_UNIXTIME({{%article}}.[[published_at]])) AS [[year]]';
            $monthExpr = 'MONTH(FROM_UNIXTIME({{%article}}.[[published_at]])) AS [[month]]';
        }
        
        $this->innerJoin('{{%article_category}}', '{{%article_category}}.[[id]] = {{%article}}.[[category_id]]');
        $this->select([
            $yearExpr,
            $monthExpr,
            'COUNT(*) AS [[count]]'
        ]);
        $this->published();
        $this->andWhere(['{{%article_category}}.[[status]]' => ArticleCategory::STATUS_ACTIVE]);
        $this->groupBy('[[year]], [[month]]');
        $this->orderBy('[[year]] DESC, [[month]] DESC');
        return $this;
    }
}

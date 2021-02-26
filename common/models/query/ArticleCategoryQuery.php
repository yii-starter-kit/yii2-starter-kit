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
use yii\db\Expression;

class ArticleCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['{{%article_category}}.[[status]]' => ArticleCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%article_category}}.[[parent_id]] IS NULL');

        return $this;
    }

    public function getCategoriesUsage()
    {
        $this->joinWith('articles');
        $this->select([
            '{{%article_category}}.*',
            new Expression('COUNT(*) AS [[articlesCount]]')
        ]);
        $this->andWhere(['{{%article}}.[[status]]' => Article::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%article}}.[[published_at]]', time()]);
        $this->active();
        $this->groupBy('{{%article}}.[[category_id]]');
        $this->orderBy('{{%article_category}}.[[title]] ASC');
        return $this;
    }
}

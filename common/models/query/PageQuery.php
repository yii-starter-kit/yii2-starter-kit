<?php declare(strict_types=1);


namespace common\models\query;

use common\models\Page;
use yii\db\ActiveQuery;

class PageQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status' => Page::STATUS_PUBLISHED]);
        return $this;
    }
}

<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */
namespace common\components\grid;

use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;

/**
 * Class EnumColumn
 * [
 *      'class'=>'\common\components\grid\EnumColumn',
 *      'attribute'=>'role',
 *      'enum'=>User::getRoles()
 * ]
 * @package common\components\grid
 */
class EnumColumn extends DataColumn
{
    /**
     * @var array List of value => name pairs
     */
    public $enum = [];

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return mixed
     */
    public function getDataCellValue($model, $key, $index)
    {
        $value = parent::getDataCellValue($model, $key, $index);
        return ArrayHelper::getValue($this->enum, $value, $value);
    }
} 
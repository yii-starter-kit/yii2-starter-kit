<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\rbac;
use yii\rbac\Item;
use yii\rbac\Rule;

class OwnModelRule extends Rule
{
    /** @var string */
    public $name = 'ownItemRule';

    /**
     * @param int $user
     * @param Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        $attribute = isset($params['attribute']) ? $params['attribute'] : 'author_id';
        return isset($params['model']) && $user &&  $user === $params['model']->getAttribute($attribute);
    }
}
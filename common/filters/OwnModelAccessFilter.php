<?php

namespace common\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

/**
 * Class OwnModelAccessFilter
 * @author Eugene Terentev <eugene@terentev.net>
 */
class OwnModelAccessFilter extends ActionFilter
{
    /**
     * @var string Model class name
     */
    public $modelClass;
    /**
     * @var string Primary key param name
     */
    public $modelPkParam = 'id';
    /**
     * @var string Created by attribute name
     */
    public $modelCreatedByAttribute;

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        $modelPk = Yii::$app->request->getQueryParam($this->modelPkParam);
        if ($modelPk) {
            $model = call_user_func($this->modelClass . '::findOne', $modelPk);
            if ($model) {
                $isAllowed = Yii::$app->user->can('editOwnModel', [
                    'model' => $model,
                    'attribute' => $this->modelCreatedByAttribute
                ]);
                if (!$isAllowed) {
                    throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
                }
            }
        }
        return true;
    }
}

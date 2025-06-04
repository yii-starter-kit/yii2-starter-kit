<?php

namespace backend\modules\system\controllers;

use common\components\keyStorage\FormModel;
use Yii;
use yii\web\Controller;

class SettingsController extends Controller
{

    public function actionIndex()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled'),
                    ],
                ],
                'adminlte.body-small-text' => [
                    'label' => Yii::t('backend', 'Body small text'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.no-navbar-border' => [
                    'label' => Yii::t('backend', 'No navbar border'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.navbar-small-text' => [
                    'label' => Yii::t('backend', 'Navbar small text'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.navbar-fixed' => [
                    'label' => Yii::t('backend', 'Fixed navbar'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.footer-small-text' => [
                    'label' => Yii::t('backend', 'Footer small text'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.footer-fixed' => [
                    'label' => Yii::t('backend', 'Fixed footer'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-small-text' => [
                    'label' => Yii::t('backend', 'Sidebar small text'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-flat' => [
                    'label' => Yii::t('backend', 'Sidebar flat style'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-legacy' => [
                    'label' => Yii::t('backend', 'Sidebar legacy style'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-compact' => [
                    'label' => Yii::t('backend', 'Sidebar compact style'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-fixed' => [
                    'label' => Yii::t('backend', 'Fixed sidebar'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-collapsed' => [
                    'label' => Yii::t('backend', 'Collapsed sidebar'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-mini' => [
                    'label' => Yii::t('backend', 'Mini sidebar'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-child-indent' => [
                    'label' => Yii::t('backend', 'Indent sidebar child menu items'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.sidebar-no-expand' => [
                    'label' => Yii::t('backend', 'Disable sidebar hover/focus auto expand'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'adminlte.brand-small-text' => [
                    'label' => Yii::t('backend', 'Brand small text'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
            ],
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success'],
            ]);
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
}

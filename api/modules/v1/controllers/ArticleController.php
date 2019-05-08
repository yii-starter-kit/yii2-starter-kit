<?php

namespace api\modules\v1\controllers;

use api\modules\v1\resources\Article;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;
use yii\rest\CreateAction;
use yii\rest\UpdateAction;
use yii\rest\DeleteAction;
use yii\rest\Serializer;
use yii\rest\ViewAction;
use yii\web\HttpException;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Yii2-Starter-Kit API Documentation",
 *         description="API description...",
 *         termsOfService="",
 *         @SWG\License(
 *             name="BSD License",
 *             url="https://raw.githubusercontent.com/yii2-starter-kit/yii2-starter-kit/master/LICENSE.md"
 *         )
 *     ),
 * )
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\Article';

    /**
     * @SWG\Get(path="/v1/article/index",
     *     tags={"article", "index"},
     *     summary="Retrieves the collection of Articles.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Article collection response",
     *         @SWG\Schema(ref = "#/definitions/Article")
     *     ),
     * )
     *
     * @SWG\Get(path="/v1/article/view",
     *     tags={"Article"},
     *     summary="Displays data of one article only",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Used to fetch information of a specific article.",
     *         @SWG\Schema(ref = "#/definitions/Article")
     *     ),
     * )
     *
     * @SWG\Options(path="/v1/article/options",
     *     tags={"Article"},
     *     summary="Displays the options for the article resource.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Displays the options available for the Article resource",
     *         @SWG\Schema(ref = "#/definitions/Article")
     *     ),
     * )
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => OptionsAction::class,

            ]
        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider(array(
            'query' => Article::find()->with('category', 'articleAttachments')->published()
        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = Article::find()
            ->published()
            ->andWhere(['id' => (int)$id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}

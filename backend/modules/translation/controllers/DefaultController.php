<?php

namespace backend\modules\translation\controllers;

use backend\modules\translation\models\search\SourceSearch;
use backend\modules\translation\models\Source;
use backend\modules\translation\models\Translation;
use backend\modules\translation\traits\ModuleTrait;
use common\base\MultiModel;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ConflictHttpException;

class DefaultController extends Controller
{
    use ModuleTrait;

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Check if the DbMessageSource component is enabled.
     *
     * @param string $action The action to be executed.
     * @return bool Whether the action should continue to run.
     */
    public function beforeAction($action)
    {
        // inherited for overriding
        if (!parent::beforeAction($action)) {
            return false;
        }

        $translationComponent = Yii::$app->components["i18n"]["translations"]['*']['class'];

        // check if component is enabled
        if ($translationComponent !== \yii\i18n\DbMessageSource::class) {
            throw new ConflictHttpException('The translation module cannot be displayed since the translation
            component is not using the "DbMessageSource" component.');
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $source = new Source();

        $model = new MultiModel(['models' => ['source' => $source]]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->getModel('source')->id]);
        } else {
            $searchModel = new SourceSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            Url::remember(Yii::$app->request->getUrl(), 'translation-filter');

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'languages' => $this->getPrefixedLanguages(),
            ]);
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $source = $this->findModel($id);

        $translationModels = [];
        foreach ($this->getLanguages() as $language => $name) {
            $translationModels[$language] = ($translation = $source->getTranslation($language)) != null
                ? $translation
                : new Translation(['id' => $source->id, 'language' => $language]);
        }

        $model = new MultiModel(['models' => ArrayHelper::merge([
            'source' => $source,
        ], $translationModels)]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous('translation-filter') ?: ['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'languages' => $this->getLanguages(),
            ]);
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Url::previous('translation-filter') ?: ['index']);
    }

    /**
     * @param integer $id
     *
     * @return Source the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Source::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
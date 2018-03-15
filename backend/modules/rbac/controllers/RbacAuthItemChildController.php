<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\modules\rbac\models\RbacAuthItemChild;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacAuthItemChildController implements the CRUD actions for RbacAuthItemChild model.
 */
class RbacAuthItemChildController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RbacAuthItemChild models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RbacAuthItemChild::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RbacAuthItemChild model.
     * @param string $parent
     * @param string $child
     * @return mixed
     */
    public function actionView($parent, $child)
    {
        return $this->render('view', [
            'model' => $this->findModel($parent, $child),
        ]);
    }

    /**
     * Creates a new RbacAuthItemChild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RbacAuthItemChild();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RbacAuthItemChild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $parent
     * @param string $child
     * @return mixed
     */
    public function actionUpdate($parent, $child)
    {
        $model = $this->findModel($parent, $child);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RbacAuthItemChild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $parent
     * @param string $child
     * @return mixed
     */
    public function actionDelete($parent, $child)
    {
        $this->findModel($parent, $child)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RbacAuthItemChild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $parent
     * @param string $child
     * @return RbacAuthItemChild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($parent, $child)
    {
        if (($model = RbacAuthItemChild::findOne(['parent' => $parent, 'child' => $child])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

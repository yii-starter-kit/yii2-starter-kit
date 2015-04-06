<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace backend\controllers;

use Yii;
use yii\caching\Cache;
use yii\caching\TagDependency;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Class CacheController
 * @package backend\controllers
 */
class CacheController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ArrayDataProvider(['allModels'=>$this->findCaches()]);
        return $this->render('index', ['dataProvider'=>$dataProvider]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionFlushCache($id)
    {
        if ($this->getCache($id)->flush()) {
            Yii::$app->session->setFlash('alert', [
                'body'=>\Yii::t('backend', 'Cache has been successfully flushed'),
                'options'=>['class'=>'alert-success']
            ]);
        };
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @param $key
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionFlushCacheKey($id, $key)
    {
        if ($this->getCache($id)->delete($key)) {
            Yii::$app->session->setFlash('alert', [
                'body'=>\Yii::t('backend', 'Cache entry has been successfully deleted'),
                'options'=>['class'=>'alert-success']
            ]);
        };
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @param $tag
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionFlushCacheTag($id, $tag)
    {
        TagDependency::invalidate($this->getCache($id), $tag);
        Yii::$app->session->setFlash('alert', [
            'body'=>\Yii::t('backend', 'TagDependency was invalidated'),
            'options'=>['class'=>'alert-success']
        ]);
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return \yii\caching\Cache|null
     * @throws HttpException
     * @throws \yii\base\InvalidConfigException
     */
    protected function getCache($id)
    {
        if (!in_array($id, array_keys($this->findCaches()))) {
            throw new HttpException(400, 'Given cache name is not a name of cache component');
        }
        return Yii::$app->get($id);
    }

    /**
     * Returns array of caches in the system, keys are cache components names, values are class names.
     * @param array $cachesNames caches to be found
     * @return array
     */
    private function findCaches(array $cachesNames = [])
    {
        $caches = [];
        $components = Yii::$app->getComponents();
        $findAll = ($cachesNames == []);

        foreach ($components as $name => $component) {
            if (!$findAll && !in_array($name, $cachesNames)) {
                continue;
            }

            if ($component instanceof Cache) {
                $caches[$name] = ['name'=>$name, 'class'=>get_class($component)];
            } elseif (is_array($component) && isset($component['class']) && $this->isCacheClass($component['class'])) {
                $caches[$name] = ['name'=>$name, 'class'=>$component['class']];
            } elseif (is_string($component) && $this->isCacheClass($component)) {
                $caches[$name] = ['name'=>$name, 'class'=>$component];
            }
        }

        return $caches;
    }

    /**
     * Checks if given class is a Cache class.
     * @param string $className class name.
     * @return boolean
     */
    private function isCacheClass($className)
    {
        return is_subclass_of($className, Cache::className());
    }
}

<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;

/**
 * CacheInvalidateBehavior automatically invalidates cache by specified keys or tags
 *  public function behaviors()
 * {
 *     return [
 *         [
 *             'class' => CacheInvalidateBehavior::class,
 *             'tags' => [
 *                  'awesomeTag',
 *                   function($model){
 *                      return "tag-{$model->id}"
 *                  }
 *              ],
 *             'keys' => [
 *                  'awesomeKey',
 *                  function($model){
 *                      return "key-{$model->id}"
 *                  }
 *              ]
 *         ],
 *     ];
 * }
 * ```
 * @package common\behaviors
 */
class CacheInvalidateBehavior extends Behavior
{
    /**
     * @var string Name of cache componentj
     */
    public $cacheComponent = 'cache';
    /**
     * @var array List of tags to invalidate
     */
    public $tags = [];
    /**
     * @var array List of keys to invalidate
     */
    public $keys = [];

    /**
     * @var
     */
    private $cache;


    /**
     * Get events list.
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'invalidateCache',
            ActiveRecord::EVENT_AFTER_INSERT => 'invalidateCache',
            ActiveRecord::EVENT_AFTER_UPDATE => 'invalidateCache',
        ];
    }

    /**
     * Invalidate cache connected to model.
     * @return bool
     */
    public function invalidateCache()
    {
        if (!empty($this->keys)) {
            $this->invalidateKeys();
        }
        if (!empty($this->tags)) {
            $this->invalidateTags();
        }
        return true;
    }

    /**
     * Invalidates
     */
    protected function invalidateKeys()
    {
        foreach ($this->keys as $key) {
            if (is_callable($key)) {
                $key = call_user_func($key, $this->owner);
            }
            $this->getCache()->delete($key);
        }
    }

    /**
     * @return \yii\caching\Cache
     */
    protected function getCache()
    {
        return $this->cache ?: Yii::$app->{$this->cacheComponent};
    }

    /**
     *
     */
    protected function invalidateTags()
    {
        TagDependency::invalidate(
            $this->getCache(),
            array_map(function ($tag) {
                if (is_callable($tag)) {
                    $tag = call_user_func($tag, $this->owner);
                }
                return $tag;
            }, $this->tags)
        );
    }
}

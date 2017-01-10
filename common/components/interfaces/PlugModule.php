<?php

namespace common\components\interfaces;


/**
 *
 * @author Fkhateeb
 * this interface to ensure that any pluggable  modules can have dynamic menu for it in the common menu of backend.
 */
interface PlugModule
{


  /**
   * using
   *  public function getMenu() {
   * return [
   * [
   * 'label' => 'Redirections',
   * 'icon' => '<i class="fa fa-link"></i>',
   * 'url' => ['/redirection'],
   * 'visible' => \Yii::$app->user->can('administrator')
   * ],
   * ];
   * }
   * Returns the list of all menues needed.
   *
   * @return array .
   */
  public function getMenu();

}

<?php

namespace common\components\interfaces;

/**
 *
 * @author Fkhateeb
 */
interface LstwModule {
   
    
     /**
      * using 
      *  public function getMenu() {
        return [
            [
                'label' => 'Redirections',
                'icon' => '<i class="fa fa-link"></i>',
                'url' => ['/redirection'],
                'visible' => \Yii::$app->user->can('administrator')
            ],
        ];
    }
     * Returns the list of all menues needed.
     * @return array .
     */
    public function getMenu();

}

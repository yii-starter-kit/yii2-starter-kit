Yii2 framework  with template for portal Framework
================================

this  framework will  be  developed independently than the modules, so  every module will  be in  separated repository.

to  add  module  to  this Kit it need to implement PlugModule interface for full  integration to view the menu of this module.

then you need  to  do  like this  in the module class

```
public function getMenu() {
        return [
            [
                'label' => 'Redirections',
                'icon' => '<i class="fa fa-link"></i>',
                'url' => ['/redirection'],
                'visible' => \Yii::$app->user->can('administrator')
            ],
        ];
    }
```
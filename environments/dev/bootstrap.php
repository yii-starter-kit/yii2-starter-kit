<?php
// Path aliases
Yii::setAlias('@base',      __DIR__.'/../../');
Yii::setAlias('@common',    __DIR__.'/../../common');
Yii::setAlias('@frontend',  __DIR__.'/../../frontend');
Yii::setAlias('@backend',   __DIR__.'/../../backend');
Yii::setAlias('@console',   __DIR__.'/../../console');
Yii::setAlias('@storage',   __DIR__.'/../../storage');
Yii::setAlias('@tests',     __DIR__.'/../../tests');


// Url Aliases
\Yii::setAlias('@frontendUrl', 'http://yii2-starter-kit.localhost');
\Yii::setAlias('@backendUrl', 'http://backend.yii2-starter-kit.localhost');
\Yii::setAlias('@storageUrl', 'http://storage.yii2-starter-kit.localhost');
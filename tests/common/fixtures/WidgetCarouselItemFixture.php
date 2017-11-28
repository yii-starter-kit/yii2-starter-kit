<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;


class WidgetCarouselItemFixture extends ActiveFixture
{
    public $tableName = 'widget_carousel_item';
    public $depends = [
        WidgetCarouselFixture::class,
    ];
}

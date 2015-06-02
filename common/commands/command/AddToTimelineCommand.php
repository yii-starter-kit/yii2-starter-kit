<?php

namespace common\commands\command;

use trntv\tactician\base\BaseCommand;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AddToTimelineCommand extends BaseCommand
{
    /**
     * @var string
     */
    public $category;
    /**
     * @var string
     */
    public $event;
    /**
     * @var mixed
     */
    public $data;
}

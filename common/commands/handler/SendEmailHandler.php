<?php

namespace common\commands\handler;
use trntv\tactician\base\BaseHandler;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class SendEmailHandler extends BaseHandler
{
    /**
     * @param \common\commands\command\SendEmailCommand $command
     * @return bool
     */
    public function handle($command)
    {
        $message = \Yii::$app->mailer->compose($command->view, $command->params);
        $message->setFrom($command->from);
        $message->setTo($command->to);
        $message->setSubject($command->subject);
        return $message->send();
    }
}

<?php

namespace common\commands\handler;

use trntv\tactician\base\BaseHandler;
use yii\swiftmailer\Message;

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
        if (!$command->body) {
            $message = \Yii::$app->mailer->compose($command->view, $command->params);
        } else {
            $message = new Message();
            if ($command->isHtml) {
                $message->setHtmlBody($command->body);
            } else {
                $message->setTextBody($command->body);
            }
        }
        $message->setFrom($command->from);
        $message->setTo($command->to ?: \Yii::$app->params['robotEmail']);
        $message->setSubject($command->subject);
        return $message->send();
    }
}

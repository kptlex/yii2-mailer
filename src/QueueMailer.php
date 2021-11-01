<?php

declare(strict_types=1);

namespace Lex\Yii2\Mailer;

use Lex\Yii2\Mailer\Job\SendEmailJob;
use Yii;
use yii\swiftmailer\Mailer;

final class QueueMailer extends Mailer
{
    /**
     * Add job for send message to queue.
     * @param MessageInterface $message
     * @return bool
     */
    protected function sendMessage($message): bool
    {
        $job = new SendEmailJob();
        $job->message = $message;
        Yii::$app->queue->push($job);
        return true;
    }

    /**
     * Real send of the message.
     * @param $message
     * @return bool
     */
    public function process($message): bool
    {
        return parent::sendMessage($message);
    }
}

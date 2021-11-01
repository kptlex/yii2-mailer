<?php

declare(strict_types=1);

namespace Lex\Yii2\Mailer\Job;

use Lex\Yii2\Mailer\QueueMailer;
use Yii;
use yii\di\NotInstantiableException;
use yii\mail\MessageInterface;
use yii\queue\JobInterface;

final class SendEmailJob implements JobInterface
{
    /** @var MessageInterface */
    public $message;

    public function execute($queue)
    {
        /** @var QueueMailer $mailer */
        $mailer = Yii::$app->mailer;
        if (!($mailer instanceof QueueMailer)) {
            throw new NotInstantiableException('Mailer is not QueueMailer.');
        }
        $mailer->process($this->message);
    }

}

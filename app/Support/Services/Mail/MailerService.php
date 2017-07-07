<?php

namespace Saf\Support\Services\Mail;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Saf\Support\Services\Mail\Contracts\MailService as MailServiceContract;
use Saf\Support\Services\Mail\Traits\Acl as AclTrait;
use Saf\Support\Services\Mail\Traits\General as GeneralTrait;

class MailerService implements MailServiceContract
{
    use GeneralTrait, AclTrait;

    protected $mailer;

    public function __construct(MailerContract $mailer)
    {
        $this->mailer = $mailer;
    }
}
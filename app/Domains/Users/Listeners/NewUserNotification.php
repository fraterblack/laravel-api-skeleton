<?php

namespace Saf\Domains\Users\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Saf\Domains\Users\Contracts\ContactRepository;
use Saf\Domains\Users\Events\NewUserEvent;
use Saf\Support\Services\Mail\Contracts\MailService;

class NewUserNotification /*implements ShouldQueue*/
{
    protected $mailService;

    /**
     * Create the event handler.
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Handle the event.
     *
     * @param  NewUserEvent $event
     * @return void
     */
    public function handle(NewUserEvent $event)
    {
        $this->mailService->newUserNotification($event->user, $event->password);
    }
}

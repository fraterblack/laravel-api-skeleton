<?php

namespace Saf\Domains\Users\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Saf\Domains\Users\Contracts\ContactRepository;
use Saf\Domains\Users\Events\UpdatedUserEvent;
use Saf\Support\Services\Mail\Contracts\MailService;

class UpdatedUserNotification /*implements ShouldQueue*/
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
     * @param  UpdatedUserEvent $event
     * @return void
     */
    public function handle(UpdatedUserEvent $event)
    {
        $this->mailService->updatedUserNotification($event->user, $event->password);
    }
}

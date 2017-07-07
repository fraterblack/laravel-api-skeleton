<?php

namespace Saf\Support\Services\Mail\Traits;

use Closure;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait Acl
{
    public function newUserNotification(Model $user, $password, Closure $callback = null)
    {
        try {
            $this->mailer->send('emails.acl.newUserNotification', [
                'user' => $user,
                'password' => $password,
                'panel_url' => config('app.admin.url')
            ], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject("Você foi cadastrado como administrador do site " . config('app.admin.contractor.name'));
            });
        } catch (ClientException $e) {
            Log::critical($e->getMessage(), [
                'event' => 'Sends new user notification'
            ]);

            return false;
        }

        return true;
    }

    public function updatedUserNotification(Model $user, $password = null, Closure $callback = null)
    {
        try {
            $this->mailer->send('emails.acl.updatedUserNotification', [
                'user' => $user,
                'password' => $password,
                'panel_url' => config('app.admin.url')
            ], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject("Seu cadastro como administrador do site " . config('app.admin.contractor.name') . ' foi alterado');
            });
        } catch (ClientException $e) {
            Log::critical($e->getMessage(), [
                'event' => 'Sends updated user notification'
            ]);

            return false;
        }

        return true;
    }
}
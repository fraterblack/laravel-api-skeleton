<?php

namespace Saf\Domains\Users;

use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Saf\Domains\Users\Notifications\ResetPassword as ResetPasswordNotification;
use Saf\Domains\Users\Presenters\UserPresenter;
use Saf\Support\Domain\Model\DeletableTrait;
use Saf\Support\ViewPresenter\PresentableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, PresentableTrait, Notifiable, HasDefender, DeletableTrait;

    protected $presenter = UserPresenter::class;

    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
    ];

    protected $table = 'users';

    protected $hidden = ['password', 'remember_token'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $protectedIds = [1];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this));
    }
}

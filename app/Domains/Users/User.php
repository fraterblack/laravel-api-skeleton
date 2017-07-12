<?php

namespace Saf\Domains\Users;

use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Saf\Domains\Users\Notifications\ResetPassword as ResetPasswordNotification;
use Saf\Domains\Users\Presenters\UserPresenter;
use Saf\Support\Domain\Model\DeletableTrait;
use Saf\Support\ViewPresenter\PresentableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasDefender, PresentableTrait, DeletableTrait;

    public static $resetPasswordRoute;

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

    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $link = str_replace('{token}', $token, self::$resetPasswordRoute);

        $this->notify(new ResetPasswordNotification($link, $this));
    }
}

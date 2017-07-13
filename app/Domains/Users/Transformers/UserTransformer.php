<?php

namespace Saf\Domains\Users\Transformers;

use League\Fractal\TransformerAbstract;
use Saf\Domains\Users\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'active' => $user->active,
            'created_at' => $user->created_at->toIso8601String(),
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/me',
                ]
            ]
        ];
    }
}
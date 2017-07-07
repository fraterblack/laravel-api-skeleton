<?php

namespace Saf\Domains\Users\Contracts;

use Saf\Domains\Users\User;
use Saf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Saf\Support\Domain\Repository\Contracts\Repository;
use Saf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;

interface UserRepository extends Repository, RetrieveExtendedRepository, AdvancedIndexRepository
{
    public function softDelete(User $userModel);

    public function search($keyWord, array $columns = ['*']);

    public function attachRole(User $user, $role);

    public function detachRole(User $user, $role);
}

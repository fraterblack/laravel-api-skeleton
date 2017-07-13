<?php

namespace Saf\Domains\Users\Contracts;

use Saf\Domains\Users\User;
use Saf\Support\Domain\Repository\Contracts\Repository;
use Saf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;
use Artesaos\Warehouse\Contracts\Operations\TransformRecords;

interface UserRepository extends Repository, RetrieveExtendedRepository, TransformRecords
{
    public function softDelete(User $userModel);

    public function search($keyWord, array $columns = ['*']);

    public function attachRole(User $user, $role);

    public function detachRole(User $user, $role);
}

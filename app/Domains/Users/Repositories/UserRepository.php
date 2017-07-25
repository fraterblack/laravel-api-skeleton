<?php

namespace Saf\Domains\Users\Repositories;

use Saf\Domains\Users\Contracts\UserRepository as UserRepositoryContract;
use Saf\Domains\Users\Transformers\UserTransformer;
use Saf\Domains\Users\User;
use Saf\Support\Domain\Repository\Repository;
use Artesaos\Warehouse\Operations\TransformRecords;

class UserRepository extends Repository implements UserRepositoryContract
{
    use TransformRecords;

    /**
     * Model class for repo.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelClass = User::class;

    protected $transformerClass = UserTransformer::class;

    public function search($keyWord, array $columns = ['*'])
    {
        $query = $this->newQuery();

        $query->select($columns);
        $query->orWhere('name', 'like', '%' . $keyWord . '%');

        return $query->get();
    }

    public function attachRole(User $user, $role)
    {
        $user->attachRole($role);
    }

    public function detachRole(User $user, $role)
    {
        return $user->detachRole($role);
    }
}
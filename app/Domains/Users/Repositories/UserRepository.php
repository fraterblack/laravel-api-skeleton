<?php

namespace Saf\Domains\Users\Repositories;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\DatabaseManager;
use Saf\Domains\Users\Contracts\UserRepository as UserRepositoryContract;
use Saf\Domains\Users\Transformers\UserTransformer;
use Saf\Domains\Users\User;
use Saf\Support\Domain\Repository\Repository;
use Saf\Support\Domain\Repository\Traits\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;
use Artesaos\Warehouse\Operations\TransformRecords;

class UserRepository extends Repository implements UserRepositoryContract
{
    use RetrieveExtendedRepository, TransformRecords;

    /**
     * Model class for repo.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelClass = User::class;

    protected $transformerClass = UserTransformer::class;

    protected $fieldSearchable = [
        'name' => 'like',
        'email' => 'like',
    ];

    protected $orderingDefault = [
        'created_at' => 'desc'
    ];

    protected $db;

    public function __construct(Application $app)
    {
        $this->db = $app->make(DatabaseManager::class);
    }

    public function softDelete(User $user)
    {
        //Modifica as credenciais de acesso antes do SoftDelete
        $user->name = date("Ymd_His") . "_" . $user->name;
        $user->email = date("Ymd_His") . "_" . $user->email;
        $user->save();

        if ($this->delete($user)) {
            return true;
        }
    }

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
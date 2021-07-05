<?php


namespace Latus\Plugins\Repositories\Eloquent;


use Latus\Latus\Models\User;
use Latus\Latus\Repositories\Contracts\UserRepository as UserRepositoryContract;
use Latus\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository implements UserRepositoryContract
{

    public function __construct(User $plugin)
    {
        parent::__construct($plugin);
    }

    public function delete()
    {
        $this->model->delete();
    }
}
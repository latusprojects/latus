<?php


namespace Latus\Latus\Repositories\Contracts;


use Latus\Repositories\Contracts\Repository;

interface UserRepository extends Repository
{
    public function delete();
}
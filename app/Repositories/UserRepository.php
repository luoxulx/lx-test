<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/18
 * Time: 下午11:47
 */

namespace App\Repositories;


use App\Models\User;

class UserRepository
{

    use BaseRepository;

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}

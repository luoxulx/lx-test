<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/18
 * Time: 下午11:47
 */

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function changePassword($user, $password)
    {
        return $user->update(['password' => bcrypt($password)]);
    }

}

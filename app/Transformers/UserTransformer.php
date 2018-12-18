<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/18
 * Time: 下午11:38
 */

namespace App\Transformers;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        $res = $user->attributesToArray();
        $res['github_info'] = $user->githubInfo()->first();
        $res['facebook_info'] = $user->facebookInfo()->first();
        $res['google_info'] = $user->googleInfo()->first();
        $res['twitter_info'] = $user->twitterInfo()->first();
        $res['linkedin_info'] = $user->linkedinInfo()->first();
        return $res;
    }
}

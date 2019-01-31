<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserGithub
 *
 * @property int $id  i
 * @property int $user_id user_id
 * @property string|null $name name
 * @property string|null $email email
 * @property string|null $location location
 * @property string|null $avatar_url avatar_url
 * @property string|null $login login
 * @property string|null $type type
 * @property string|null $bio bio
 * @property string|null $node_id node_id
 * @property string|null $gravatar_id gravatar_id
 * @property string|null $url url
 * @property string|null $html_url html_url
 * @property string|null $followers_url followers_url
 * @property string|null $following_url following_url
 * @property string|null $gists_url gists_url
 * @property string|null $starred_url starred_url
 * @property string|null $subscriptions_url subscriptions_url
 * @property string|null $organizations_url organizations_url
 * @property string|null $repos_url repos_url
 * @property string|null $events_url events_url
 * @property string|null $received_events_url received_events_url
 * @property int $site_admin site_admin
 * @property string|null $company company
 * @property string|null $blog blog
 * @property string|null $hireable hireable
 * @property int|null $public_repos public_repos
 * @property int|null $public_gists public_gists
 * @property int|null $followers followers
 * @property int|null $following following
 * @property \Illuminate\Support\Carbon|null $created_at created_at
 * @property \Illuminate\Support\Carbon|null $updated_at updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereBlog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereEventsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereFollowers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereFollowersUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereFollowingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereGistsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereGravatarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereHireable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereHtmlUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereOrganizationsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub wherePublicGists($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub wherePublicRepos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereReceivedEventsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereReposUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereSiteAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereStarredUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereSubscriptionsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGithub whereUserId($value)
 * @mixin \Eloquent
 */
class UserGithub extends Model
{

    protected $table = 'user_github';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

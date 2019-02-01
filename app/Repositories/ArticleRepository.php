<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:38
 */

namespace App\Repositories;


use App\Models\Article;
use App\Scopes\DraftScope;

class ArticleRepository extends BaseRepository
{

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    // 仅后台 api,含草稿
    public function getById(int $id)
    {
        return $this->model->withoutGlobalScope(DraftScope::class)->findOrFail($id);
    }

    public function destroy(int $id)
    {
        return $this->getById($id)->delete();
    }

    // 仅供 后台 api 使用，含草稿
    public function paginate(int $per_page = 10, array $sort = ['created_at', 'desc'])
    {
        return $this->model->withoutGlobalScope(DraftScope::class)->orderBy($sort[0], $sort[1])->paginate($per_page);
    }

    // blade 页面使用，不含草稿
    public function page(int $per_page = 10, array $sort = ['created_at', 'desc'])
    {
        return $this->model->orderBy($sort[0], $sort[1])->paginate($per_page);
    }

    public function create($input)
    {
        $article = $this->model->fill($input);

        $this->model->save();

        if (! isset($input['tags'])) {
            $input['tags'] = [1];
        }
        $this->syncTag($article, $input['tags']);

        return $article;
    }

    /**
     * Update a record by id.
     *
     * @param  int $id
     * @param  array $data
     * @return boolean
     */
    public function update(int $id, $data)
    {
        $article = $this->model->withoutGlobalScope(DraftScope::class)->findOrFail($id);

        if (isset($data['tags'])) {
            $this->syncTag($article, $data['tags']);
        }

        return $article->update($data);
    }

    /**
     * Sync the tags for the article
     * @param Article $article
     * @param array $tags
     * @return mixed
     */
    public function syncTag(Article $article, array $tags)
    {
        return $article->tags()->sync($tags);
    }

    public function getBySlug($slug)
    {
        $article = $this->model->where('slug', $slug)->firstOrFail();

        $article->increment('view_count');

        return $article;
    }


    /**
     * Get a list of tag ids that are associated with the given discussion.
     *
     * @param \App\Models\Article $article
     *
     * @return array
     */
    public function listTagsIdsForDiscussion(Article $article)
    {
        return $article->tags->pluck('id')->toArray();
    }
}

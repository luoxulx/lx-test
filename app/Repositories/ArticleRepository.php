<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:38
 */

namespace App\Repositories;


use App\Models\Article;

class ArticleRepository
{

    use BaseRepository;

    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function store(array $input)
    {
        $article = $this->model->create($input);

        if (is_array($input['tags']) && current($input['tags'])) {
            $this->syncTag($article, $input['tags']);
        }
        else{
            $this->syncTag($article, json_decode($input['tags'], true));
        }

        return $article;
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

    /**
     * Update a record by id.
     *
     * @param  int $id
     * @param  array $data
     * @return boolean
     */
    public function update(int $id, array $data)
    {
        $article = $this->model->findOrFail($id);

        if (is_array($data['tags']) && current($data['tags'])) {
            $this->syncTag($article, $data['tags']);
        } else {
            $this->syncTag($article, json_decode($data['tags'], true));
        }

        return $article->update($data);
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

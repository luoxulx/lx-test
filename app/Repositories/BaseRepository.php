<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:37
 */

namespace App\Repositories;

use App\Models\Models;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{

    /**
     * @var Models $model
     */
    protected $model;

    /**
     * @param int $id
     * @return Collection
     */
    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function paginate(int $per_page = 10, array $sort = ['created_at', 'desc'])
    {
        return $this->model->orderBy($sort[0], $sort[1])->paginate($per_page);
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function getFieldValue(int $id, string $column)
    {
        // TODO: Implement getFieldValue() method.
    }

    public function create($input)
    {
        $this->model->fill($input);

        $this->model->save();

        return $this->model;
    }

    public function updateColumn(int $id, $input) :bool
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    public function update(int $id, $input)
    {
        $this->model = $this->getById($id);

        $this->model->fill($input);

        return $this->model->save();
    }

    public function destroy(int $id)
    {
        return $this->getById($id)->delete();
    }

    public function getCount()
    {
        return $this->model->count();
    }

    public function setDecrement(string $column, int $val = 1)
    {
        return $this->model->decrement($column, $val);
    }

    public function setIncrement(string $column, int $val = 1)
    {
        return $this->model->increment($column, $val);
    }

    /**
     * @param string $field  eg: facebook_id
     * @param int $value     eg: facebook_id value
     * @return mixed
     */
    public function getColumnByIdField(string $field, int $value)
    {
        return $this->model->where($field, $value)->first();
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 23:55
 */

namespace App\Repositories;


interface BaseRepositoryInterface
{

    public function getById(int $id);

    public function paginate(int $per_page, array $sort = ['created_at', 'desc']);

    public function all($columns = array('*'));

    public function getFieldValue(int $id, string $column);

    public function create($input);

    public function updateColumn(int $id, $input);

    public function update(int $id, $input);

    public function destroy(int $id);

    public function getCount();

    public function setIncrement(int $id, string $column, int $val = 0);

    public function setDecrement(int $id, string $column, int $val = 0);

    public function getColumnByIdField(string $field, int $value);

}

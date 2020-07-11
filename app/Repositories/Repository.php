<?php


namespace App\Repositories;


use App\Helpers\General\CollectionHelper;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    /**
     * @var Model
     */
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($per_page = 0)
    {
        $all =  $this->model->all();
        return CollectionHelper::paginate($all,$per_page);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where($id)->update(
            $data
        );
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $model = $this->model->find($id)) {
            return null;
        }
        return $model;
    }
}

<?php
namespace Src\Shared\Infraestructure\AccessDatas;

use Illuminate\Database\Eloquent\Model;

class BaseEloquentRepositories implements BaseRepoContract
{
    
    protected $model;
    protected $relations = [];

    public function __construct( Model $model, array $relations = [] ) {
        $this->model = $model;
        $this->relations = $relations;
    }

    public function setRelations( array $relations = [] ) {
        $this->relations = $relations;
    }

    public function all(): array
    {
        if (!empty($this->relations))
            return $this->model->with($this->relations);
        return $this->model::all()->toArray();
    }

    public function get( string $id ): mixed
    {
        if (!empty($this->relations))
            return $this->model::where([ 'id' => $id ])->with($this->relations);
        return $this->model::where([ 'id' => $id ]);
    }
    
    public function persist( mixed $datas): void 
    {
        $datas->save();
    }

    public function delete( mixed $datas): mixed 
    {
        $datas->delete();
        return $datas;        
    }

}


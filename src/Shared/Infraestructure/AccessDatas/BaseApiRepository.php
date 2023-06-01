<?php
namespace Src\Shared\Infraestructure\AccessDatas;


use Illuminate\Support\Facades\Http;

class BaseApiRepository implements BaseRepoContract
{
    private $endpoint = 'https://jsonplaceholder.typicode.com';

    protected $model;
    protected $relations = '';

    public function __construct( string $resource, array $relations = [] ) 
    {
        $this->model = $this->endpoint . '/' . $resource;
        if ( !empty($relations) )
        {
            $this->setRelations( $relations );
        }
    }

    public function setRelations( array $relations = [] ): void
    {
        foreach( $relations as $r )
        {
            $this->relations .= '_expand=' . $r;
            if ($r !== end($relations)) $this->relations .= '&';
        }
    }

    public function get( string $id): mixed
    {
        if ($this->relations !== '')
            return Http::get($this->model . '/' . $id . '?' . $this->relations);
        return Http::get($this->model . '/' . $id);
    }

    public function all(): array
    {
        return [];
    }
    

    

    
    public function persist( mixed $datas): void
    {
        echo 'Presistencia OK!';
    }
//    public function delete( mixed $datas): void
//    {
//
//    } 



}
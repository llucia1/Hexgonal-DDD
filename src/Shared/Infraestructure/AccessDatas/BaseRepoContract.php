<?php
namespace Src\Shared\Infraestructure\AccessDatas;


interface BaseRepoContract
{
    public function all(): array;
    public function get( string $id ): mixed;
    public function persist( mixed $datas): void;
    public function delete( mixed $datas): mixed; 
}
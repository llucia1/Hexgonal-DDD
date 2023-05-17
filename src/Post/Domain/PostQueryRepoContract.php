<?php
namespace Src\Post\Domain;


interface PostQueryRepoContract
{
    public function findOrFail(string $id): ?Post;// El parametro puede ser tambien un Value Objet de id
    public function all(): array;
}
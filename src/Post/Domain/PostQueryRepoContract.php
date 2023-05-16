<?php
namespace Src\Post\Domain;


interface PostQueryRepoContract
{
    public function findOrFail(string $id): ?Post;
    public function all(): array;
}
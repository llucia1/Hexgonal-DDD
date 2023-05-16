<?php
namespace Src\Post\Domain;


interface PostRepoContract
{
    public function save(Post $post): void;
}
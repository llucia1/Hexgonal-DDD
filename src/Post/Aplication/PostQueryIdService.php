<?php
namespace Src\Post\Aplication;

use Src\Post\Domain\Post;
use Src\Post\Domain\PostQueryRepoContract;


final class PostQueryIdService
{

    public function __construct(private readonly PostQueryRepoContract $postRepository)
    {
    }

    public function execute(string $id = null): ?Post
    {
        $post = $this->postRepository->findOrFail($id);

        if($post === null)
            return null;

        return $post;
    }
}


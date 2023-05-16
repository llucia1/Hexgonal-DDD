<?php
namespace Src\Post\Domain;

class PostCollection
{
    private ?array $Posts;
    public function __construct( array $Posts  )
    {
        $this->setPostFromArray($Posts);
    }

    public function gets(): array
    {
        return $this->Posts;
    }

    public function setPostFromArray(array $all): void
    {
        foreach ($all as $post)
            $this->Posts[] = Post::create($post);
    }

}


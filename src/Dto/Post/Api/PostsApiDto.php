<?php
namespace Src\Dto\Post\Api;

use Src\Post\Domain\Post;

class PostsApiDto {

    public static function toArray( ?Post $post ): mixed
    {
        $result = [
                    'data' => [],
                    'code' => 404,
        ];        

        if (!empty($post))
        {
            $result['data'] = $post->toArray();
            $result['code'] = 200;
        }

        return $result;
    }

    public static function collectionToArray( ?array $collection ): mixed
    {
        $result = [
                    'data' => [],
                    'code' => 404,
        ];

        if (!empty($collection))
        {
            foreach ($collection as $post)
            {
                $result['data'][] = $post->toArray();
            }
            $result['code'] = 200;
        }

        return $result;
    }
}

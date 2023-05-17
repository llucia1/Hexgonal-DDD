<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;
use Src\Post\Aplication\PostQueryIdService;
use Src\Post\Domain\Post;
use Src\Post\Domain\PostQueryRepoContract;

class youCanGetOnePostTest extends TestCase
{

    protected function tearDown(): void
    {
        Mockery::close();
    }


    public function testGetOnePostsByIdService(): void
    {

        $postId = '1';

        $PostArray = [
                'body' => "Body test id 1",
                'id' => 1,
                'title' => "Title test id 1",
                'userId' => 1,
                'user' => [
                    'id' => '1',
                    'name' => 'user1',
                    'username' => 'Bret',
                    'email' => 'Sincere@april.biz',
                    'address' => [],
                    'phone' => '1-7788',
                    'website' => 'hildegard.org',
                    'company' => []
                    ]
            ];
        $postMock = Post::create($PostArray);



        $postRepositoryMock = Mockery::mock(PostQueryRepoContract::class);
        $postRepositoryMock->shouldReceive('findOrFail')->with($postId)->andReturn($postMock);
        $service = new PostQueryIdService($postRepositoryMock);

        $result = $service->execute($postId);

        $this->assertSame($postMock, $result);
        $this->assertInstanceOf(Post::class, $result);

    }    

}

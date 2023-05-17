<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;
use Src\Post\Aplication\PostsService;

use Src\Post\Domain\PostCollection;
use Src\Post\Domain\PostQueryRepoContract;

class youCanGetAllPostTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }


    public function testGetAllPostsService(): void
    {
        $ArrayPost = [
            [
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
            ],
            [
                'body' => "Body test id 2",
                'id' => 2,
                'title' => "Title test id 2",
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
            ],
        ];
        $postsMock = new PostCollection($ArrayPost);


        $postRepositoryMock = Mockery::mock(PostQueryRepoContract::class);
        $service = new PostsService($postRepositoryMock);

        $postRepositoryMock->shouldReceive('all')->andReturn($postsMock->gets());


    
        $result = $service->execute();
    
        $this->assertIsArray($result);
        $this->assertCount(2, $result); 
        $this->assertSame($postsMock->gets(), $result);
        
    }
}

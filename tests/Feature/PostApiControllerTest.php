<?php

namespace Tests\Feature;

use App\Http\Controllers\postController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Src\Dto\Post\Api\PostsApiDto;
use Src\Post\Aplication\PostsService;
use Src\Post\Domain\Post;
use Src\Post\Domain\PostCollection;
use Tests\TestCase;

class PostApiControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }   



    public function test_all_post(): void
    {


        $mockController = new class extends PostController {
            public function all()
            {
                $postsMock = new PostCollection([
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
                ]);
        
                $result = PostsApiDto::collectionToArray( $postsMock->gets() );

                return response()->json($result['data'], $result['code']);
             }
         };


         $this->app->instance(PostController::class, $mockController);


        $response = $this->get('/api/posts');

        $response->assertStatus(200);
        $response->assertJson([
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
        ]);


    }

    public function testGetPostWithNonExistentId()
    {
        $response = $this->get('/api/posts/a8s');
    
        $response->assertStatus(404);
        $this->assertEmpty($response->json());
    }


    public function test_get_post(): void
    {

        
        $mockController = new class extends postController {
            public function get($id)
            {
                $postMock = Post::create([
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
                ]);
        
                $result = PostsApiDto::toArray( $postMock );
                return response()->json($result['data'], $result['code']);
             }
         };


         $this->app->instance(PostController::class, $mockController);


        $response = $this->get('/api/posts/1');

        
        $response->assertStatus(200);
        $response->assertJson([
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
        ]);


    }






    public function test_post(): void
    {

        
        $mockController = new class extends postController {
            public function post($request = [
                'body' => "Body test id 1",
                'userId' => 1,
                'title' => "Title test id 1",
            ])
            {
                $uuid = '456';
                return response()->json($uuid, 201);
             }
         };


         $this->app->instance(PostController::class, $mockController);


        $response = $this->post('/api/posts', [
            'body' => "Body test id 1",
            'userId' => 1,
            'title' => "Title test id 1",
        ]);

        
        $response->assertStatus(201);


    }    

}

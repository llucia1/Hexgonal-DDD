<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Post\Domain\Post;
use Src\Post\Domain\PostCollection;
use Src\User\Domain\User;

class youCanCreatePostsAndUsersTest extends TestCase
{

    
    public function test_you_can_create_a_posts_collections(): void
    {

        $resutlsArrayPost = [
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
        $collectionPosts = new PostCollection($resutlsArrayPost);
        $this->assertNotNull($collectionPosts);

        $collectionPostsArray = $collectionPosts->gets();
        $this->assertIsArray($collectionPostsArray);
        $this->assertNotEmpty($collectionPostsArray);
        

        $this->assertCount(2, $collectionPostsArray);
        $this->assertInstanceOf(Post::class, $collectionPostsArray[0]);
        $this->assertInstanceOf(Post::class, $collectionPostsArray[1]);

        $post1 = $collectionPostsArray[0];
        $post2 = $collectionPostsArray[1];

        $user1 = $post1->user();
        $user2 = $post2->user();
        $this->assertInstanceOf(User::class, $user1);
        $this->assertInstanceOf(User::class, $user2);



    }


    public function test_you_can_create_a_post(): void
    {
        $postFake = [
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
            $user = Post::create([]);

        $post = Post::create($postFake);
        $this->assertInstanceOf(Post::class, $post);
        $this->assertNotNull($post);

        $this->assertObjectHasProperty('user', $post);
        $this->assertObjectHasProperty('userId', $post);
        $this->assertObjectHasProperty('title', $post);
        $this->assertObjectHasProperty('body', $post);
        $this->assertObjectHasProperty('id', $post);

        $this->assertEquals('1', $post->id());
        $this->assertEquals("Title test id 1", $post->title());
        $this->assertEquals("Body test id 1", $post->body());
        $this->assertEquals('1', $post->userId());
        $this->assertInstanceOf(user::class, $post->user());

        $user = $post->user();
        $this->assertEquals($user->id(), $post->userId());
    }

    public function test_you_can_create_a_user(): void
    {
        $userFake = [
                'id' => '1',
                'name' => 'user1',
                'username' => 'Bret',
                'email' => 'Sincere@april.biz',
                'address' => [],
                'phone' => '1-7788',
                'website' => 'hildegard.org',
                'company' => []
            ];


        $user = User::create($userFake);
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user);
        
        $this->assertObjectHasProperty('name', $user);
        $this->assertObjectHasProperty('username', $user);
        $this->assertObjectHasProperty('email', $user);
        $this->assertObjectHasProperty('address', $user);
        $this->assertObjectHasProperty('phone', $user);
        $this->assertObjectHasProperty('website', $user);
        $this->assertObjectHasProperty('company', $user);



        $this->assertEquals('1', $user->id());
        $this->assertEquals("user1", $user->name());
        $this->assertEquals("Bret", $user->username());
        $this->assertEquals('Sincere@april.biz', $user->email());
        $this->assertEquals('1-7788', $user->phone());
        $this->assertEquals('hildegard.org', $user->website());

        $this->assertIsArray($user->address());
        $this->assertIsArray($user->company());


    }


    public function test_return_null_if_the_array_is_empty_when_a_post_is_created(): void
    {
            $user = Post::create([]);
            $this->assertNull($user);
    }

    public function test_return_null_if_the_array_is_empty_when_a_user_is_created(): void
    {
            $user = User::create([]);
            $this->assertNull($user);
    }

}

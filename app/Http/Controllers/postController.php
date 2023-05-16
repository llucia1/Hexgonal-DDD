<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Src\Utils\Validator\Post\ValidatorIdRequest;


use Src\Post\Infraestructure\PostQueryRepository;
use Src\Post\Infraestructure\PostRepository;

use Src\Dto\Post\Api\PostsApiDto;

use Src\Post\Aplication\PostQueryIdService;
use Src\Post\Aplication\PostsService;
use Src\Post\Aplication\PostCreateService;

use Src\User\Infrestructure\UserRepository;

class postController extends Controller
{
    public function __construct()
    {
      //  app()->bind(PostRepoContract::class, function() {  return new PostRepository(); });
      //  app()->bind(UserRepoContract::class, function() {  return new UserRepository(); });
    } 

    public function get(string $id)
    {
        ValidatorIdRequest::ValidIdRequest($id);
        
        $post = new PostQueryIdService( new PostQueryRepository(['user']) );
        $result = PostsApiDto::toArray($post->execute( $id ));
        return $this->responseJson($result['data'], $result['code']);
    }

//    curl -d '{userId: 1, title: Test title, body: Test body }' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/posts
// Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/posts" -Method POST -Body '{userId: 1, title: Test title, body: Test body }' -Headers $headers
    
    public function post(PostRequest $request)
    {

        $post = new PostCreateService( new PostRepository(), new UserRepository(['user']) );
        $result = $post->execute( $request->all() );

        return $this->responseJson($result, 201);
    }

    public function all()
    {
        
        $post = new PostsService( new PostQueryRepository(['user']) );
        $result = PostsApiDto::collectionToArray( $post->execute() );

        return $this->responseJson($result['data'], $result['code']);
    }




}

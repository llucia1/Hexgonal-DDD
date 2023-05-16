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

/**
 * @OA\Tag(
 *     name="post",
 *     description="Posts Resource"
 * )
 * @OA\Info(
 *     title="API - Posts",
 *     version="1.0.0",
 *     description="API for the consumption of the Post with User resources relations"
 * )
 * @OA\Server(
 *     url="https://localhost:8000",
 *     description="API server - Local"
 * )
 * 
 */
class postController extends Controller
{
    public function __construct()
    {
      //  app()->bind(PostRepoContract::class, function() {  return new PostRepository(); });
      //  app()->bind(UserRepoContract::class, function() {  return new UserRepository(); });
    } 
    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"posts"},
     *     summary="Get one post by id",
     *     operationId="getPostById",
     *     @OA\Response( response="200", description="Successful response" ),
     * )
     */
    public function get(string $id)
    {
        ValidatorIdRequest::ValidIdRequest($id);
        
        $post = new PostQueryIdService( new PostQueryRepository(['user']) );
        $result = PostsApiDto::toArray($post->execute( $id ));
        return $this->responseJson($result['data'], $result['code']);
    }

//    curl -d '{userId: 1, title: Test title, body: Test body }' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/posts
// Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/posts" -Method POST -Body '{userId: 1, title: Test title, body: Test body }' -Headers $headers



    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"posts"},
     *     summary="Post one posts",
     *     operationId="createPosts",
     *     @OA\Response( response="201", description="Successful response" ),
     * )
     */
    public function post(PostRequest $request)
    {

        $post = new PostCreateService( new PostRepository(), new UserRepository(['user']) );
        $result = $post->execute( $request->all() );

        return $this->responseJson($result, 201);
    }


    /**
     * @OA\Get(
     *     path="/posts",
     *     tags={"posts"},
     *     summary="Get all posts",
     *     operationId="getAllPosts",
     *     @OA\Response( response="200", description="Successful response" ),
     * )
     */
    public function all()
    {
        
        $post = new PostsService( new PostQueryRepository(['user']) );
        $result = PostsApiDto::collectionToArray( $post->execute() );

        return $this->responseJson($result['data'], $result['code']);
    }




}

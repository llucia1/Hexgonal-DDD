<?php

namespace Tests\Unit;


use Mockery;
use PHPUnit\Framework\TestCase;
use Src\Post\Aplication\PostCreateService;
use Src\Post\Domain\PostRepoContract;
use Src\Shared\Domain\Exception\crearPostInBDException;
use Src\User\Domain\User;
use Src\User\Domain\UserQueryRepoContract;

class youCanCreateOnePostTest extends TestCase
{


    protected function tearDown(): void
    {
        Mockery::close();
    }


    public function testCreatePostService(): void
    {

        $datas = [
            'userId' => '1',
            'title' => 'Test Title',
            'body' => 'Test Body'
        ];

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
        $userMock = User::fromArray($userFake);
        $userQueryRepositoryMock = Mockery::mock(UserQueryRepoContract::class);
        $userQueryRepositoryMock->shouldReceive('findOrFail')->with($datas['userId'])->andReturn($userMock);

        $postRepositoryMock = Mockery::mock(PostRepoContract::class);
        $postRepositoryMock->shouldReceive('save')->once();
        $service = new PostCreateService($postRepositoryMock, $userQueryRepositoryMock);


        try {
            $result = $service->execute($datas);
            $this->assertIsString($result);
            $this->assertTrue(true); // todo Ok
        } catch (crearPostInBDException $exception) {
            $this->fail('Se lanzo excepción crearPostInBDException entonces falla la peticion post crear Post');
        }        

    }
}

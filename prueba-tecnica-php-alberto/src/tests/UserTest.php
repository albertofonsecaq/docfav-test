<?php
namespace tests;

use database\migrations\UserMigration;
use entities\User;
use exceptions\UserDoesNotExistException;
use exceptions\UserExistException;
use PHPUnit\Framework\TestCase;
use repositories\UserRepository;

class UserTest extends TestCase
{
    public function __construct(string $name)
    {
        parent::__construct($name);
        $userMigration = new UserMigration();
        $userMigration->up();
    }

    public function testCreateInstanceUser()
    {
        $user =  new User('Pepe','pepe@gmail.com','1234');
        $this->assertObjectHasProperty('email',$user);
        $this->assertObjectHasProperty('name',$user);
        $this->assertObjectHasProperty('password',$user);
    }
    public function testRegisterUser()
    {
        $repository = new UserRepository();
        $user = new User('holaaa','hollsssssssssdafffa@gmail.com','1234');
        $response = $repository->registerUser($user);
        $this->assertSame('User registered', $response);
    }
    public function testWhenUserIsNotFoundByIdErrorIsThrown()
    {
        $this->expectException(UserDoesNotExistException::class);
        $repository = new UserRepository();
        //user_id that not exist
        $user_id = -1;
        $repository->getByIdOrFail($user_id);
    }
}
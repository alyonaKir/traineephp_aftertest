<?php
namespace tests;
include 'vendor/autoload.php';

use DataBase\RestDBClass;
use Models\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RestTest extends TestCase
{
    private RestDBClass $obj;

    /**
     * @var MockObject/User
     */
    private MockObject $user;

    protected function setUp(): void
    {
        $this->user = $this->createMock(User::class);
        $this->obj = RestDBClass::getInstance();
    }

    /**
     * @covers \DataBase\RestDBClass::getUserById
     */
    public function testGetUserById()
    {
        $result = $this->obj->getUserById(200);
        $this->assertInstanceOf(User::class, $result);
    }

    /**
     * @covers \DataBase\RestDBClass::editUserById
     */
    public function testEditUserById()
    {
        $result = $this->obj->editUserById($this->user);
        $this->assertTrue($result);
    }

    /**
     * @covers \DataBase\RestDBClass::countPages
     */
    public function testCountPage(){
        $result = $this->obj->countPages();
        $this->assertNotNull($result);
    }
}
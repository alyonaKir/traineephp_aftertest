<?php
namespace tests;
include 'vendor/autoload.php';

use DataBase\RestDBClass;
use Models\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DataBase\RestDBClass
 */
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

    public function testGetUserById()
    {
        $result = $this->obj->getUserById(5200);
        $this->assertInstanceOf(User::class, $result);
    }

    public function testEditUserById()
    {
        $result = $this->obj->editUserById($this->user);
        $this->assertTrue($result);
    }

    public function testCountPage(){
        $result = $this->obj->countPages();
        $this->assertNotNull($result);
    }
}
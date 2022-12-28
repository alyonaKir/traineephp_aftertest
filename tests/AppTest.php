<?php
namespace tests;
include 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

/**
 * @covers \System\App
 */
class AppTest extends TestCase
{
    /** @test */
    public function isViewsExist()
    {
        $this->assertDirectoryExists('/var/www/task/app/views');
    }

}
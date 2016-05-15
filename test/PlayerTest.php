<?php

/**
 * Created by PhpStorm.
 * User: Zebrah
 * Date: 15/05/2016
 * Time: 10:16
 */
class PlayerTest extends PHPUnit_Framework_TestCase
{
    /** @var  \PacMan\Player */
    private $player;

    public function setUp()
    {
        $this->player = new \PacMan\Player(5, 5);
    }

    /**
     * @test
     */
    public function testMoveRight()
    {
        $this->player->moveHorizontal(1);
        $this->player->updateModel();
        $this->assertEquals([1, 0], $this->player->getDirection());
        $this->assertSame(6, $this->player->getX());
        $this->assertSame('<', $this->player->getModel());
    }

    /**
     * @test
     */
    public function testMoveLeft()
    {
        $this->player->moveHorizontal(-1);
        $this->player->updateModel();
        $this->assertEquals([-1, 0], $this->player->getDirection());
        $this->assertSame(4, $this->player->getX());
        $this->assertSame('>', $this->player->getModel());
    }

    /**
     * @test
     */
    public function testMoveDown()
    {
        $this->player->moveVertical(1);
        $this->player->updateModel();
        $this->assertEquals([0, 1], $this->player->getDirection());
        $this->assertSame(6, $this->player->getY());
        $this->assertSame('^', $this->player->getModel());
    }

    /**
     * @test
     */
    public function testMoveUp()
    {
        $this->player->moveVertical(-1);
        $this->player->updateModel();
        $this->assertEquals([0, -1], $this->player->getDirection());
        $this->assertSame(4, $this->player->getY());
        $this->assertSame('V', $this->player->getModel());
    }

    /**
     * @test
     */
    public function testEat()
    {
        $this->player->eat();
        $this->assertSame('-', $this->player->getModel());
    }
}

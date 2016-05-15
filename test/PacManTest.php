<?php

/**
 * Created by PhpStorm.
 * User: Zebrah
 * Date: 15/05/2016
 * Time: 9:58
 */
class PacManTest extends PHPUnit_Framework_TestCase
{
    private $board;
    /** @var  \PacMan\Player */
    private $player;

    /**
     * @test
     */
    public function testGame()
    {
        $this->createSimpleBoard();
        $this->printBoard();
        for ($i = 0; $i < 50; $i++) {
            do {
                $roll = $this->roll();
            } while (!$this->isRollValid($roll));

            $actualPos = [$this->player->getX(), $this->player->getY()];
            $this->board[$actualPos[1]][$actualPos[0]] = ' ';

            $this->player->move($roll);
            $actualPos = [$this->player->getX(), $this->player->getY()];

            if ($this->board[$actualPos[1]][$actualPos[0]] === '·') {
                $this->player->eat();
            }
            $this->board[$actualPos[1]][$actualPos[0]] = $this->player;
            $this->player->updateModel();
            $this->printBoard();
        }
    }

    public function createSimpleBoard()
    {
        $this->board = array();
        $this->player = new \PacMan\Player(5, 5);
        for ($i = 0; $i < 11; $i++) {
            for ($j = 0; $j < 11; $j++) {
                $this->board[$i][$j] = '·';
            }
        }

        $this->board[5][5] = $this->player;
    }

    public function printBoard()
    {
        echo PHP_EOL;
        echo 'POS: ' . $this->player->getX() . ' , ' . $this->player->getY();
        echo PHP_EOL;
        echo 'DIRECTION: ' . implode(',', $this->player->getDirection());
        echo PHP_EOL;
        for ($i = 0; $i < 11; $i++) {
            for ($j = 0; $j < 11; $j++) {
                echo $this->board[$i][$j];
            }
            echo PHP_EOL;
        }
    }

    public function roll()
    {
        $roll = 10 * rand(0, 1);

        if ($roll < 5) {
            $roll = 10 * rand(0, 1);
            if ($roll < 5) {
                return [-1, 0];
            } else {
                return [1, 0];
            }
        } else {
            $roll = 10 * rand(0, 1);
            if ($roll < 5) {
                return [0, -1];
            } else {
                return [0, 1];
            }
        }
    }

    private function isRollValid($roll)
    {
        if ($this->player->getX() + $roll[0] >= 11 || $this->player->getX() + $roll[0] < 0) {
            return false;
        } elseif ($this->player->getY() + $roll[1] >= 11 || $this->player->getY() + $roll[1] < 0) {
            return false;
        } else {
            return true;
        }
    }
}

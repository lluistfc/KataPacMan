<?php
/**
 * Created by PhpStorm.
 * User: Zebrah
 * Date: 15/05/2016
 * Time: 9:59
 */

namespace PacMan;


class Player
{

    const MODEL_LEFT_MOUTH_OPEN = '>';
    const MODEL_RIGHT_MOUTH_OPEN = '<';
    const MODEL_DOWN_MOUTH_OPEN = '^';
    const MODEL_UP_MOUTH_OPEN = 'V';

    const MODEL_VERTICAL_MOUTH_CLOSED = '|';
    const MODEL_HORIZONTAL_MOUTH_CLOSED = '-';

    const MODEL_HORIZONTAL = 'h';
    const MODEL_VERTICAL = 'v';

    private $model;
    private $x;
    private $y;
    private $direction;

    public function __construct($x, $y)
    {
        $this->model = self::MODEL_RIGHT_MOUTH_OPEN;
        $this->x = $x;
        $this->y = $y;
        $this->direction = [1, 0];
    }

    public function move($roll)
    {
        if ($roll[0] !== 0) {
            $this->moveHorizontal($roll[0]);
        }
        if ($roll[1] !== 0) {
            $this->moveVertical($roll[1]);
        }
    }

    public function moveHorizontal($x)
    {
        $this->direction = [$x, 0];
        $this->x += $x;
    }

    public function moveVertical($y)
    {
        $this->direction = [0, $y];
        $this->y += $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function updateModel()
    {
        if ($this->direction[0] === -1) {
            $this->model = self::MODEL_LEFT_MOUTH_OPEN;
        } elseif ($this->direction[0] === 1) {
            $this->model = self::MODEL_RIGHT_MOUTH_OPEN;
        } elseif ($this->direction[1] === -1) {
            $this->model = self::MODEL_UP_MOUTH_OPEN;
        } else {
            $this->model = self::MODEL_DOWN_MOUTH_OPEN;
        }
    }

    public function getModel()
    {
        return $this->model;
    }

    public function __toString()
    {
        return $this->model;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function eat()
    {
        if ($this->direction[0] === 0) {
            $this->model = self::MODEL_VERTICAL_MOUTH_CLOSED;
        } else {
            $this->model = self::MODEL_HORIZONTAL_MOUTH_CLOSED;
        }
    }
}
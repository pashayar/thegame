<?php

namespace app;

class Game
{
    /**
     * @var int
     */
    public $position;

    /**
     * @var int
     */
    public $roll;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        echo "Start of new game \n";
        $this->position = 0;
        $this->roll = 0;
    }

    /**
     * Начало новой игры
     */
    public function startGame()
    {
        for ($this->getPosition(); $this->getPosition() < 100;) {
            $this->setRoll();
            $this->setPosition();
            if ($this->getPosition() % 9 == 0 && $this->getPosition() <= 97) { // если место кратно 9
                $this->setPositionBack(3);
                $this->getMessage("snake");
            } elseif (in_array($this->getPosition(), [25, 55])) { // если место 25 или 55
                $this->setPositionForward(10);
                $this->getMessage("ladder");
            } elseif ($this->getPosition() > 100) { // если место больше 100, откатываемся на ход
                $this->setPositionBack($this->getRoll());
                $this->getMessage();
            } else {
                $this->getMessage();
            }
            $this->coffeeBrake();
        }
    }

    /**
     * Кидаем кости
     */
    private function setRoll()
    {
        $this->roll = rand(1, 6);
    }

    /**
     * Устанавливаем текущую позицию
     * @return int
     */
    private function getRoll()
    {
        return $this->roll;
    }

    /**
     * Устанавливаем текущую позицию
     */
    private function setPosition()
    {
        $this->position += $this->getRoll();
    }

    /**
     * @return int
     */
    private function getPosition()
    {
        return $this->position;
    }

    /**
     * Устанавливаем текущую позицию
     * @param $extra
     */
    private function setPositionBack($extra)
    {
        $this->position = $this->position - $extra;
    }

    /**
     * Устанавливаем текущую позицию
     * @param $extra
     */
    private function setPositionForward($extra)
    {
        $this->position = $this->position + $extra;
    }

    /**
     * @param string $message
     */
    private function getMessage($message = "")
    {
        echo $this->getRoll() . "-" . $message . "" . $this->getPosition() . "\n";
    }

    /**
     * Делаем паузу на 1 секунду
     */
    private function coffeeBrake()
    {
        sleep(1);
    }
}

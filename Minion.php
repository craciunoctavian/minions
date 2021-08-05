<?php


class Minion extends Player
{

    public function bananaStrike()
    {
        $chance = rand(0, 100);
        if ($chance < 10) {
            echo "<p style='font-style: italic; color: gold; font-weight: bold'>
                Banana strike skill activated!<br></p>";
            return true;
        }
        return false;
    }

    public function umbrellaShield()
    {
        $chance = rand(0, 100);
        if ($chance < 20) {
            echo "<p style='font-style: italic; color: gold; font-weight: bold'>
                Umbrella shield skill activated!<br></p>";
            return true;
        }
        return false;
    }


    public function setAttributes()
    {
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defense = rand(45, 55);
        $this->speed = rand(40, 50);
        $this->luck = rand(10, 30);
    }

    public function getAttributes()
    {
        return
            "TIM powers:<br>" .
            $this->getHealth() . " health<br>" .
            $this->getDefense() . " defense<br>" .
            $this->getSpeed() . " speed<br>" .
            $this->getStrength() . " strength<br>" .
            $this->getLuck() . "% luck<br>";
    }

    public function getDamage($strength)
    {
        $damage = $strength - $this->defense;
        if ($damage < 0) return 0;
        if ($this->umbrellaShield()) {
            $damage /= 2;
        }
        if ($this->health > $damage) {
            $this->health -= $damage;
        } else {
            $this->health = 0;
        }
        return $damage;
    }
}
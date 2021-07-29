<?php


class Minion extends Player
{

    public function bananaStrike()
    {
        $chance = rand(0, 100);
        if ($chance < 10) {
            echo "Banana strike skill activated!\n";
            return true;
        }
        return false;
    }

    public function umbrellaShield()
    {
        $chance = rand(0, 100);
        if ($chance < 20) {
            echo "Umbrella shield skill activated!\n";
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
        echo "TIM powers:\n";
        echo $this->getHealth() . " health\n";
        echo $this->getDefense() . " defense\n";
        echo $this->getSpeed() . " speed\n";
        echo $this->getStrength() . " strength\n";
        echo $this->getLuck() . "% luck\n";

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
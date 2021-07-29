<?php

class Evil extends Player
{
    public function setAttributes()
    {
        $this->health = rand(60, 90);
        $this->strength = rand(60, 90);
        $this->defense = rand(40, 60);
        $this->speed = rand(40, 60);
        $this->luck = rand(25, 40);
    }

    public function getAttributes(){
        echo "Evil powers:\n";
        echo  $this->getHealth() . " health\n";
        echo  $this->getDefense() . " defense\n";
        echo  $this->getSpeed() . " speed\n";
        echo  $this->getStrength() . " strength\n";
        echo  $this->getLuck() . "% luck\n";

    }
}
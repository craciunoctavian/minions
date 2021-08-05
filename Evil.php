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
        return
            "EVIL powers:<br>".
            $this->getHealth() . " health<br>" .
            $this->getDefense() . " defense<br>" .
            $this->getSpeed() . " speed<br>" .
            $this->getStrength() . " strength<br>" .
            $this->getLuck() . "% luck<br>";
    }
}
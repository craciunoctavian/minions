<?php

class Player
{
    protected $health;
    protected $strength;
    protected $defense;
    protected $speed;
    protected $luck;

    public function getHealth()
    {
        return $this->health;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function getSpeed()
    {
        return $this->speed;
    }


    public function getLuck()
    {
        return $this->luck;
    }

    public function setAttributes()
    {
        $this->health = 0;
        $this->strength = 0;
        $this->defense = 0;
        $this->speed = 0;
        $this->luck = 0;
    }


    // apply the damage taken to the player
    public function getDamage($strength)
    {
        $damage = $strength - $this->defense;
        if($damage < 0) return 0;
        if($this->health > $damage){
            $this->health -= $damage;
        } else {
            $this->health = 0;
        }
        return $damage;
    }

    // check if player is lucky
    public function isLucky()
    {
        $chance = rand(0, 100);
        if ($chance < $this->luck) {
            return true;
        }
        return false;
    }


}
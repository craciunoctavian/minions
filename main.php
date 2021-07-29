<?php

require "Player.php";
require "Minion.php";
require "Evil.php";

function gameplay($tim, $evil)
{
    $minionTurn = false;
    $gameOver = false;

    if ($tim->getSpeed() > $evil->getSpeed()) {
        $minionTurn = true;
    } else if ($tim->getLuck() > $evil->getLuck()) {
        $minionTurn = true;
    }

    $tim->getAttributes();
    echo "\n";
    $evil->getAttributes();
    echo "\n";

    for ($i = 0; $i < 20; $i++) {
        echo "ROUND " . ($i + 1) . ":\n";
        // tim turn to attack
        if ($minionTurn) {
            $noOfAttacks = 1;
            if ($tim->bananaStrike()) {
                $noOfAttacks = 2;
            }
            for ($att = 0; $att < $noOfAttacks; $att++) {
                if (!$evil->isLucky()) {
                    $damage = $evil->getDamage($tim->getStrength());
                    echo "Evil took " . $damage . " damage. Health remaining " . $evil->getHealth() . "\n";
                    if ($evil->getHealth() == 0) {
                        echo "\nGAME OVER!\n";
                        echo "TIM Won!\n";
                        $gameOver = true;
                        break;
                    }

                } else {
                    echo "Evil was lucky this turn\n";
                }
            }
            if ($gameOver) break;

        } // evil turn to attack
        else {
            if (!$tim->isLucky()) {
                $damage = $tim->getDamage($evil->getStrength());
                echo "Tim took " . $damage . " damage. Health remaining " . $tim->getHealth() . "\n";
                if ($tim->getHealth() == 0) {
                    echo "\nGAME OVER!\n";
                    echo "Evil Won!\n";
                    $gameOver = true;
                    break;
                }
            } else {
                echo "Tim was lucky this turn\n";
            }
        }
        $minionTurn = !$minionTurn;
    }
    if ($i == 20) {
        echo "GAME OVER! NO WINNER!\n";
    }
}

$tim = new Minion();
$tim->setAttributes();
$evil = new Evil();
$evil->setAttributes();
gameplay($tim, $evil);


<?php

require "Player.php";
require "Minion.php";
require "Evil.php";

function gameplay($tim, $evil)
{
    $minionTurn = false;
    $gameOver = false;
    $winner = "";
    $timHealth = $tim->getHealth();
    $timStrength = $tim->getStrength();
    $timDefense = $tim->getDefense();
    $evilHealth = $evil->getHealth();
    $evilStrength = $evil->getStrength();
    $evilDefense = $evil->getDefense();

    if ($tim->getSpeed() > $evil->getSpeed()) {
        $minionTurn = true;
    } else if ($tim->getLuck() > $evil->getLuck()) {
        $minionTurn = true;
    }

    echo '<div style=" border: 15px solid green; padding: 50px; margin: 20px; font-size: 30px; text-align: center">';
    for ($i = 1; $i <= 20; $i++) {
        echo "<p style='font-size: 40px; font-weight: bold'>ROUND " . $i . ":<br></p>";
        // tim turn to attack
        if ($minionTurn) {
            $noOfAttacks = 1;
            if ($tim->bananaStrike()) {
                $noOfAttacks = 2;
            }
            for ($att = 0; $att < $noOfAttacks; $att++) {
                if (!$evil->isLucky()) {
                    $damage = $evil->getDamage($tim->getStrength());
                    echo "Evil took " . $damage . " damage. Health remaining " . $evil->getHealth() . "<br>";
                    if ($evil->getHealth() == 0) {
                        echo "<p style='font-size: 40px; color: green; font-weight: bold'>
                            <br>GAME OVER!<br>TIM Won!<br></p>";
                        $winner = "TIM";
                        $gameOver = true;
                        break;
                    }

                } else {
                    echo "<p style='font-style: italic; color: rebeccapurple; font-weight: bold'>
                        Evil was lucky this turn<br></p>";
                }
            }
            if ($gameOver) break;

        } // evil turn to attack
        else {
            if (!$tim->isLucky()) {
                $damage = $tim->getDamage($evil->getStrength());
                echo "Tim took " . $damage . " damage. Health remaining " . $tim->getHealth() . "<br>";
                if ($tim->getHealth() == 0) {
                    echo "<p style='font-size: 40px; color: red; font-weight: bold'>
                       <br>GAME OVER!<br>Evil Won!<br></p>";
                    $winner = "Evil";
                    $gameOver = true;
                    break;
                }
            } else {
                echo "<p style='font-style: italic; color: rebeccapurple; font-weight: bold'>
                        Tim was lucky this turn<br></p>";
            }
        }
        $minionTurn = !$minionTurn;
    }
    echo '</div>';
    if ($i == 20) {
        echo "<p style='font-size: 40px; color: black; font-weight: bold'>
                       <br>GAME OVER! NO WINNER!<br></p>";
    }

    $sql = "INSERT INTO fights (rounds, winner, timHealth, timStrength, timDefense,
      evilHealth, evilStrength, evilDefense, regDate) 
      VALUES ($i, '$winner', $timHealth, $timStrength, $timDefense, 
      $evilHealth, $evilStrength, $evilDefense, now())";
    global $database;
    $database->query($sql);
}

// setup the names, images and button
function setup()
{

    echo "<body style='background-color:lightgoldenrodyellow'>";

    echo '<p style="text-align:left; font-size: 30px; padding-left: 100px; font-family: Comic Sans MS,serif">
        TIM
        <span style="float:right; padding-right: 150px">
            EVIL
        </span>
    </p>';

    echo ' 
        <html>
        <img src="minion.png" width="300" height="350" title="Tim" style="float: left"/>
        </html>
    ';

    echo '<form method="post">
        <input type="submit" name="fight" value="FIGHT" style="color:black; 
        float: left; font-size:50px; border-radius: 25px; padding: 10px;margin-left: 20%;margin-top: 50px; background: red "/>
        </form>
    ';
    echo '<form method="post" action="fights.php">
        <input type="submit" name="fight" value="HISTORY" style="color:black; 
        float: left; font-size:50px; border-radius: 25px; padding: 10px;margin-left: 10%;margin-top: 50px; background: red "/>
        </form>
    ';

    echo ' <div class="right"><img src="evil.png" width="400" height="400" style="float: right" ></div>';

    echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
}

// align left and right two strings
function getRow($string1, $string2)
{
    return '<p style="text-align:left; font-size: 20px; padding-left: 100px; font-family: Comic Sans MS">
        ' . $string1 . '
        <span style="float:right; padding-right: 180px">
            ' . $string2 . '
        </span>
    </p>';
}

// print attributes of the two characters
function getAttributes($tim, $evil)
{
    echo '<div>'
        . getRow('Tim powers', 'Evil powers<br>')
        . getRow($tim->getHealth() . " health", $evil->getHealth() . " health<br>")
        . getRow($tim->getDefense() . " defense", $evil->getDefense() . " defense<br>")
        . getRow($tim->getSpeed() . " speed", $evil->getSpeed() . " speed<br>")
        . getRow($tim->getStrength() . " strength", $evil->getStrength() . " strength<br>")
        . getRow($tim->getLuck() . "% luck", $evil->getLuck() . "% luck<br>")
        . '</div>';
}

// connect to database
$conn = $database = mysqli_connect('localhost', 'root', '') or die('Database Error');
$sql = " CREATE DATABASE IF NOT EXISTS fights";
$res = $database->query($sql);
$database->select_db("fights");

setup();
$tim = new Minion();
$evil = new Evil();

if (isset($_POST['fight'])) {
    $tim->setAttributes();
    $evil->setAttributes();
    getAttributes($tim, $evil);
    gameplay($tim, $evil);
}

// create table in database
$sql = "CREATE TABLE IF NOT EXISTS fights(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
rounds INT(6) NOT NULL,
winner VARCHAR(30) NOT NULL,
timHealth INT(6) NOT NULL,
timStrength INT(6) NOT NULL,
timDefense INT(6) NOT NULL,
evilHealth INT(6) NOT NULL,
evilStrength INT(6) NOT NULL,
evilDefense INT(6) NOT NULL,
regDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$res = $database->query($sql);




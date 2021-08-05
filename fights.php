<?php

echo "<body style='background-color:lightgoldenrodyellow'>";

echo '<h1 style="text-align: center"> FIGHTS HISTORY <br></h1>';

// gather the fights from the databse
$database = mysqli_connect('localhost', 'root', '', "fights") or die('Database Error');

$sql = 'SELECT * FROM fights';
$result = $database->query($sql);

if(!$result) return;

if ($result->num_rows > 0) {

    $str =  '<table class="tdata">';

    $str .= '

<col span="10" style="background-color: lightblue; text-align: center">
<tr style="font-size: 30px; text-align: center;text-indent: 30px;">
<td >ID</td>
<td>ROUNDS</td>
<td >WINNER</td>
<td >TIM Health</td>
<td>TIM Strength</td>
<td>TIM Defense</td>
<td>Evil Health</td>
<td>Evil Strength</td>
<td>Evil Defense</td>
<td>Data</td>
</tr>

';


    while ($d = mysqli_fetch_assoc($result)) {
        $str .= '
<tr style="font-size: 20px; text-align: center; text-indent: 40px">
<td>'.$d["id"].'</td>
<td>'.$d["rounds"].'</td>
<td>'.$d["winner"].'</td>
<td>'.$d["timHealth"].'</td>
<td>'.$d["timStrength"].'</td>
<td>'.$d["timDefense"].'</td>
<td>'.$d["evilHealth"].'</td>
<td>'.$d["evilStrength"].'</td>
<td>'.nl2br($d["evilDefense"]).'</td>
<td>'.$d["regDate"].'</td>
</tr>
';
    }

    $str .= '</table>';

} else {
    $str = 'No figths';
}

echo $str;


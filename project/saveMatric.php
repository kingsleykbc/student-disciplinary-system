<?php
require_once('_php/connect.php'); 

$val = $_POST['val'];
$sid = $_POST['sid'];

if ($val > 60) $val = 60;

$query = 'UPDATE t_students SET s_MeritPoints = "'.$val.'" WHERE s_ID = '.$sid;
$saveMatric = mysqli_query($dbc,$query);

if ($saveMatric){
    echo $val;
}else{
    echo 993;
}
?>

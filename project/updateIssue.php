<?php
require_once('_php/connect.php');
require('_php/getIssues.php');

$sid = trim($_POST['sid']);
$iid = trim($_POST['iid']);
$offense = trim($_POST['offenseT']);
$details = trim($_POST['offense']);
$recommendation = trim($_POST['punishment']);
$category = trim($_POST['category']);
$severity = trim($_POST['severity']);

$query = 'UPDATE t_issues SET i_Offense = "'.$offense.'", i_Category = "'.$category.'", i_Details = "'.$details.'", 
i_Recommendation = "'.$recommendation.'" WHERE i_ID = '.$iid;

$updateIssue = mysqli_query($dbc,$query);

if ($updateIssue){
    showIssues($dbc,$sid);
}else{
    echo "Something Went wrong";
}
?>

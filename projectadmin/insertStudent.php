<?php
require_once('connect.php');

if (isset($_POST["image"])){
    $file = addslashes(file_get_contents($_POST["image"]["tmp_name"]));
}else{
    //echo "No file uploaded";
}
$title = trim($_POST["title"]);
$firstname = trim($_POST["firstname"]);
$middlename = trim($_POST["middlename"]);
$lastname = trim($_POST["lastname"]);
$dob = trim($_POST["dob"]);
$matric = trim($_POST["matric"]);
$merit = trim($_POST["merit"]);
$cos = trim($_POST["cos"]);
$gender = trim($_POST["gender"]);
$level = trim($_POST["level"]);
$hall = trim($_POST["hall"]);
$room = trim($_POST["room"]);
$state = trim($_POST["state"]);
$address = trim($_POST["address"]);
$nextOfKin = trim($_POST["nextOfKin"]);
$phoneNo = trim($_POST["phoneNo"]);
$g_title = trim($_POST["g_title"]);
$g_firstname = trim($_POST["g_firstname"]);
$g_lastname = trim($_POST["g_lastname"]);
$g_phoneNo = trim($_POST["g_phoneNo"]);
$g_address = trim($_POST["g_address"]);
$g_occupation = trim($_POST["g_occupation"]);
$gid = 0;

$query = "
    INSERT INTO t_guardians (g_ID,g_Title, g_FirstName, g_LastName, 
    g_PhoneNumber, g_Address, g_Occupation)
    VALUES (NULL,?,?,?,?,?,?)";

$statement = mysqli_prepare($dbc,$query);
mysqli_stmt_bind_param($statement,"ssssss",$g_title,$g_firstname,$g_lastname,$g_phoneNo,$g_address,$g_occupation);
mysqli_stmt_execute($statement);


$affectedRows = mysqli_stmt_affected_rows($statement);

if($affectedRows ==1){
    $query = "SELECT * FROM t_guardians WHERE g_firstName ='".$g_firstname."'";
    $guardian = @mysqli_query($dbc,$query);
    if($guardian){
        while($row =  mysqli_fetch_array($guardian)){
            $gid = $row['g_ID'];
        }
    }else{
        echo "could not get db id".mysqli_error($dbc);
    }
}

$query2 = "
    INSERT INTO t_students (s_Picture,s_Title, s_FirstName, s_MiddleName, 
    s_LastName, s_DOB,s_Matric, s_MeritPoints, s_CourseOfStudy, s_Level,
    h_ID, s_Room, s_Gender,s_StateOrigin, s_Address, s_NextOfKin, g_ID, 
    s_PhoneNumber,s_DateAdded,s_ID)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NULL)";



$stmt = mysqli_prepare($dbc,$query2);

if ($stmt){
    mysqli_stmt_bind_param($stmt,"bssssssisiisssssis",$file,$title,$firstname,
    $middlename,$lastname,$dob,$matric,$merit,$cos,$level,$hall,$room,$gender,  
    $state,$address,$nextOfKin,$gid,$phoneNo);

    mysqli_stmt_execute($stmt);

    $affectedRows2 = mysqli_stmt_affected_rows($stmt);
    if($affectedRows2 == 1){
        echo '<div class="succ">
                   <div>'.$firstname.' was successfully Added </div>
                   <a href="students.php">VIEW STUDENTS </a>
              </div>';

        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
    }else{
        echo 'There were some issues';
        mysqli_close($dbc);
    }
    }else{
        echo "somthing went wrong";
    }  
?>
<?php require_once('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/add.css">
    <title>Add Student</title>
</head>
<body>
    <nav>
       <div>
           DBA Panel
       </div>
       <div>
            <a href="admins.php">Admins</a>
            <a href="guardians.php">Guradians</a>
            <a href="halls.php">Halls</a>
            <a href="logs.php">Logs</a>
            <a href="students.php">Students</a>
       </div>
       <div class="add">
            <a href="addStudent.php">Add Student </a>
            <a class="on2" href="addAdmin.php">Add Admin </a>
       <div>
    </nav>
    <div id="content">
    <div class="form">
    <form method="POST" id="adminForm" action="insertAdmin.php" enctype="multipart/form-data">
        <div>
            <div id="head">Admin Information</div>
        <input type="file" name="image" id="image">
        <div class="micro" style="opacity: 0.5; font-size: smaller;">Please upload a square shaped image not more than 5mb </div>
        <div class="sLabel">Title</div>
        <select placeholder="Title" name="title" id="title">
            <option value="Mister">Mister</option>
            <option value="Master">Master</option>
            <option value="Mr.">Mr.</option>
            <option value="Miss.">Miss.</option>
            <option value="Madam">Madam.</option>
            <option value="Mrs.">Mrs.</option>
        </select>
        <input type="text" placeholder="First Name" name="firstname" id="firstname">
        <input type="text" placeholder="Last Name" name="lastname" id="lastname">
         
        <div class="sLabel">Assigned Hall</div>
        <select name="hall" id="hall">
        <?php
             $halls = @mysqli_query($dbc,"SELECT h_ID, h_Name FROM t_halls");
                if($halls){
                    while($row =  mysqli_fetch_array($halls)){
                        echo '<option value = "'.$row['h_ID'].'">'.$row['h_Name'].'</option>';
                    }
                }else{
                    echo"cannot get list of halls right now";
                }
        ?>
        <select>
        <input type="text" name="role" id="role" placeholder="Role">
        <input type="text" name="phoneNo" id="g_phoneNo" maxlength="11" placeholder="Phone Number">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="password" name="password" id="passwordRe" placeholder="Re-enter Password">
        </div>
        <input type="submit" value="SUBMIT QUERY" name="submitA" id="submitA">
    </form>
    </div>
    <div id="errors">
    </div>
    
    </div>
    <script src="jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>


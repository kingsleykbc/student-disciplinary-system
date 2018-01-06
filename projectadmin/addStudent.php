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
            <a class="on2" href="addStudent.php">Add Student </a>
            <a href="addAdmin.php">Add Admin </a>
       <div>
    </nav>
    <div id="content">
    <div class="form">
    <form method="POST" id="studentForm" action="insertStudent.php" enctype="multipart/form-data">
        <div>
            <div id="head">Student Information</div>
        <input type="file" name="image" id="image">
        <div class="micro" style="opacity: 0.5; font-size: smaller;">Please upload a square shaped image not more than 5mb </div>
        <div class="sLabel"> Title </div>
        <select placeholder="Title" name="title" id="title">
            <option value="Mister">Mister</option>
            <option value="Master">Master</option>
            <option value="Mr.">Mr.</option>
            <option value="Miss.">Miss.</option>
            <option value="Madam">Madam.</option>
            <option value="Mrs.">Mrs.</option>
        </select>
        <input type="text" placeholder="First Name" name="firstname" id="firstname">
        <input type="text" placeholder="Middle Name (Optional)" name="middlename" id="middlename">
        <input type="text" placeholder="Last Name" name="lastname" id="lastname">
        <br>Date of Birth <br>
        <input type="date" name="dob" id="dob">
        <div class="micro">
            <input type="text" placeholder="Matric Number" name="matric" id="matric" maxlength="7">
            <input type="text" placeholder="Merit Points"  name="merit" id="merit" maxlength="2">
        </div>
        <div class="sLabel"> Course of Study </div>
        <select name="cos" id="cos">
            <option value="Accounting">Accounting</option>
            <option value="Anatomy">Anatomy</option>
            <option value="Business Admin">Business Admin</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Computer Tech">Computer Tech</option>
            <option value="Economics">Economics</option>
            <option value="English">English</option>
            <option value="Fishrey">Fishrey</option>
            <option value="History">History</option>
            <option value="Madam">International Law and diplomacy</option>
            <option value="Law">Law</option>
            <option value="Medicine">Medicine</option>
            <option value="Micro biology">Micro biology</option>
            <option value="Mass Communication">Mass Communication</option>
            <option value="Project Management">Project Management</option>
            <option value="Software engineering">Software engineering</option>
            <option value="Statistics">Statistics</option>
            <option value="Theology">Theology</option>
        </select>
        <div class="radio">
             <label>
                <input type="radio" name="gender" id="genderM" value="M" checked="checked">
                Male
             </label>
             <label>
                <input type="radio" name="gender" id="genderF" value="F">
                Female
             </label>
        </div>
        <div class="sLabel"> Study Level </div>
        <select placeholder="level" name="level" id="level">
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
            <option value="500">500</option>
            <option value="600">600</option>
            <option value="700">700</option>
        </select>
        <select name="hall" id="hall">
            <option value="hallofres">Hall of Residence</option>
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
        <input type="text" name="room" placeholder="Room Number" id="room">
        <div class="sLabel"> State of Origin </div>
        <select placeholder="State"  name="state" id="state">
            <option value="Accounting">Abia</option>
            <option value="Anatomy">Adawama</option>
            <option value="Business Admin">Akwa Ibom</option>
            <option value="Business Admin">Anambra</option>
            <option value="Computer Science">Bauchi</option>
            <option value="Computer Tech">Bayelsa</option>
            <option value="Economics">Benue</option>
            <option value="English">Boronu</option>
            <option value="Fishrey">Cross River</option>
            <option value="History">Delta</option>
            <option value="Madam">Edo</option>
            <option value="Mrs.">Ekiti</option>
            <option value="Mrs.">Ebonyi</option>
            <option value="Miss.">Enugu</option>
            <option value="Mrs.">Imo</option>
            <option value="Mrs.">Lagos</option>
            <option value="Mrs.">Maduguri</option>
            <option value="Mrs.">Ogun</option>
            <option value="Mrs.">Ondo</option>
            <option value="Madam">Plateau</option>
            <option value="Mrs.">Rivers</option>
            <option value="Mrs.">Sokoto</option>
        </select>
        <input type="text" name="address" id="address" placeholder="Residential Address">
        <input type="text" name="nextOfKin" id="nextOfKin" placeholder="Next of Kin">
        <input type="text" name="phoneNo" id="phoneNo" maxlength="11" placeholder="Phone Number (optional)">
        </div>
        <div>
            <div id="head">Guardian Information</div>
            <div class="sLabel">Title</div>
            <select placeholder="Title" name="g_title" id="g_title">
                <option value="Mister">Mister</option>
                <option value="Master">Master</option>
                <option value="Mr.">Mr.</option>
                <option value="Miss.">Miss.</option>
                <option value="Madam">Madam.</option>
                <option value="Mrs.">Mrs.</option>
            </select>
            <input type="text" placeholder="First Name" name="g_firstname" id="g_firstname">
            <input type="text" placeholder="Last Name" name="g_lastname" id="g_lastname">
            <input type="text" placeholder="Phone Number" maxlength="11" name="g_phoneNo" id="g_phoneNo">
            <input type="text" placeholder="Residential Address" name="g_address" id="g_address">
            <input type="text" placeholder="Occupation (Optional)" name="g_occupation" id="g_occupation">
           
        </div>
        <input type="submit" value="SUBMIT QUERY" name="submit" id="submit">
    </form>
    </div>
    <div id="errors">
    </div>
    
    </div>
    <script src="jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>


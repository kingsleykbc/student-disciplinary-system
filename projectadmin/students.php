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
            <a href="issues.php">Issues</a>
            <a href="logs.php">Logs</a>
            <a class="on" href="students.php">Students</a>
       </div>
       <div class="add">
            <a href="addStudent.php">Add Student </a>
            <a href="addAdmin.php">Add Admin </a>
       <div>
    </nav>
    <div class="table">
    <?php
        require_once('connect.php');
        $counter = 1;
        $query = "SELECT * FROM t_students";

        $response = @mysqli_query($dbc,$query);

        if($response){
            echo '
                <table class="students">
                    <thead>
                        <td>SN</td>
                        <td>Picture</td>
                        <td>First Name</td>
                        <td>Middle Name </td>
                        <td>Last Name </td>
                        <td>Matric No.</td>
                        <td>Hall</td>
                        <td>Room</td>
                        <td>Course</td>
                        <td>Level</td>
                        <td>Phone Number</td>
                        <td>Points</td>
                        <td>Guardian</td>
                    </thead>';
            while($row = mysqli_fetch_array($response)){

                echo '<tr>';
                echo '<td>'.$counter.'</td>';
                if ($row['s_Picture'] == NULL){
                     echo '<td> <img src="_images/icon_edit.png"></td>';
                }else{
                     echo '<td>'.$row['a_Picture'].'</td>';
                }
                echo '<td>'.$row['s_Firstname'].'</td>'.
                     '<td>'.$row['s_Middlename'].'</td>'.
                     '<td>'.$row['s_Lastname'].'</td>'.
                     '<td>'.$row['s_Matric'].'</td>';
                
                $hall = @mysqli_query($dbc,"SELECT h_Name FROM t_halls WHERE h_ID =".$row['h_ID']);
                if($hall){
                    while($row1 =  mysqli_fetch_array($hall)){
                         echo '<td>'.$row1['h_Name'].'</td>';  
                    }
                }

                echo '<td>'.$row['s_Room'].'</td>';
                echo '<td>'.$row['s_CourseOfStudy'].'</td>';
                echo '<td>'.$row['s_Level'].'</td>';
                if ($row['s_PhoneNumber'] !="" && $row['s_PhoneNumber'] != " "){
                    echo '<td>(+234) '.$row['s_PhoneNumber'].'</td>'; 
                }else{
                    echo '<td> </td>';
                }
                echo '<td>'.$row['s_MeritPoints'].'</td>';

                $guardian = @mysqli_query($dbc,"SELECT g_Title,g_LastName,g_FirstName FROM t_guardians WHERE g_ID =".$row['g_ID']);
                if($guardian){
                    while($row2 =  mysqli_fetch_array($guardian)){
                        echo '<td>'.$row2['g_Title']."  ".$row2['g_FirstName']."  ".$row2['g_LastName'].'</td>';
                    }
                }    
                echo '</tr>';
                $counter++;
            }
            echo "</table>";
        }else{
            echo "Error retrieving data";
            echo mysqli_error($dbc);
        }
        mysqli_close($dbc);

    ?>
    </div>
</body>
</html>
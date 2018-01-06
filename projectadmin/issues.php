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
            <a class="on" href="issues.php">Issues</a>
            <a href="logs.php">Logs</a>
            <a href="students.php">Students</a>
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
        $query = "SELECT * FROM t_issues";

        $response = @mysqli_query($dbc,$query);

        if($response){
            echo '
                <table class="halls">
                    <thead>
                        <td>SN</td>
                        <td>Student</td>
                        <td>Offense</td>
                        <td>Category</td>
                        <td>Details </td>
                        <td>Severity </td>
                        <td>Reccommendation </td>
                        <td>Reported By</td>
                    </thead>';

            while($row = mysqli_fetch_array($response)){
                echo '<tr>';
                echo '<td>'.$counter.'</td>';

                $student = @mysqli_query($dbc,"SELECT s_Lastname, s_Firstname FROM t_students WHERE s_ID =".$row['s_ID']);
                if($student){
                    while($row1 =  mysqli_fetch_array($student)){
                         echo '<td>'.$row1['s_Lastname']." ".$row1['s_Firstname'].'</td>';  
                    }
                }

                echo '<td>'.$row['i_Offense'].'</td>'.
                     '<td>'.$row['i_Category'].'</td>'.
                     '<td>'.$row['i_Details'].'</td>'.
                     '<td>'.$row['i_Severity'].'</td>'.
                     '<td>'.$row['i_Recommendation'].'</td>';

                $admin = @mysqli_query($dbc,"SELECT a_Lastname, a_Firstname FROM t_admins WHERE a_ID =".$row['a_ID']);
                if($admin){
                    while($row2 =  mysqli_fetch_array($admin)){
                         echo '<td>'.$row2['a_Lastname']." ".$row2['a_Firstname'].'</td>';  
                    }
                }

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
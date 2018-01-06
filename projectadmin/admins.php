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
            <a class="on" href="admins.php">Admins</a>
            <a href="guardians.php">Guradians</a>
            <a href="halls.php">Halls</a>
            <a href="issues.php">Issues</a>
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
        $query = "SELECT * FROM t_admins";

        $response = @mysqli_query($dbc,$query);

        if($response){
            echo '
                <table class="admins">
                    <thead>
                        <td>SN</td>
                        <td>Picture</td>
                        <td>Title</td>
                        <td>First Name </td>
                        <td>Last Name </td>
                        <td>Role</td>
                        <td>Phone Number</td>
                        <td>Hall</td>
                        <td>Username</td>
                        <td>Password</td>
                    </thead>';
            while($row = mysqli_fetch_array($response)){
                echo '<tr>';
                echo '<td>'.$counter.'</td>';
                if ($row['a_Picture'] == NULL){
                     echo '<td> <img src="_images/icon_edit.png"></td>';
                }else{
                     echo '<td>'.$row['a_Picture'].'</td>';
                }
                echo '<td>'.$row['a_Title'].'</td>'.
                     '<td>'.$row['a_Firstname'].'</td>'.
                     '<td>'.$row['a_Lastname'].'</td>'.
                     '<td>'.$row['a_Role'].'</td>'.
                     '<td> (+234) '.$row['a_PhoneNumber'].'</td>';
                     
                $hall = @mysqli_query($dbc,"SELECT h_Name FROM t_halls WHERE h_ID =".$row['h_ID']);
                if($hall){
                    while($row2 =  mysqli_fetch_array($hall)){
                        echo '<td>'.$row2['h_Name'].'</td>';
                    }
                }
                     
                echo '<td>'.$row['a_username'].'</td>'.
                     '<td>'.$row['a_password'].'</td>';
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
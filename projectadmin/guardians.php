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
            <a class="on" href="guardians.php">Guradians</a>
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
        $query = "SELECT * FROM t_guardians";

        $response = @mysqli_query($dbc,$query);

        if($response){
            echo '
                <table class="gurards">
                    <thead>
                        <td>SN</td>
                        <td>Title</td>
                        <td>First Name </td>
                        <td>Last Name </td>
                        <td>Phone Number</td>
                        <td>Residential Address</td>
                        <td>Occupation</td>
                    </thead>';
            while($row = mysqli_fetch_array($response)){
                echo '<tr>';
                echo '<td>'.$counter.'</td>';
                echo '<td>'.$row['g_Title'].'</td>'.
                     '<td>'.$row['g_FirstName'].'</td>'.
                     '<td>'.$row['g_LastName'].'</td>'.
                     '<td> (+234) '.$row['g_PhoneNumber'].'</td>'.
                     '<td>'.$row['g_Address'].'</td>'.
                     '<td>'.$row['g_Occupation'].'</td>';
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
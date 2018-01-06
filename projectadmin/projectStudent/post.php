<?php 
require_once('connect.php'); 

session_start();
echo $_SESSION['matric'];
if(empty($_SESSION['matric'])){
    header("Location: login.php");
}
if(isset($_SESSION['matric'])){
    $matric = $_SESSION['matric'];
    $stmt = "SELECT * FROM t_Students WHERE s_matric ='$matric'";
    $res = mysqli_query($dbc, $stmt);
    if ($res){
        while($row = mysqli_fetch_array($res)){
            $id = $row['s_ID'];
            $name = $row['s_Firstname']." ".$row['s_Lastname'];
            $matric = $row['s_Matric'];
            if ($row['s_MeritPoints'] > 30){
                $merit = '<span class="himerit">'.$row['s_MeritPoints'].' Merit Points</span>';
            }else{
                $merit = '<span class="lowmerit">'.$row['s_MeritPoints'].' Merit Points Left</span>';
            }
        }
    }else{
        $name = "Not working".mysqli_error($db);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <a href="view.php">View Issues</a>
        <a class="on" href="post.php">Appeal</a>
        
    </header>
    
    <div class="page">

        <div id="errors">

        </div>
        <form id="newsForm" method="POST" action="insertPlea.php" enctype="multipart/form-data">
            <input type="text" name="sid" id="sid" value="<?php echo $id; ?>">
            <section>
                <p>Title</p>
                <input type="text" name="headline" id="headline" placeholder="News Headline">
            </section>
            <section>
                <p>Content</p>
                <textarea placeholder="The body of your appeal" name="content" id="content"></textarea>
            </section>

            <input type="submit" value="Appeal" id="submit">
        </form>
        
    </div>
    <script src="_js/jquery.min.js"></script>
    <script src="_js/script.js"></script>
</body>
</html>
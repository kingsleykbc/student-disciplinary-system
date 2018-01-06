<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="test.php">
        <input type="file" name="image">
        <input type="submit" name="submit">
    </form>

    <?php
        if(isset($_FILES["image"])){
            echo "uplad succesful";
            $file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            echo $file;
        }else{
            echo "still not working";
        }
    ?>
</body>
</html>
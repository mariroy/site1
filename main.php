<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    if (isset($_SESSION['login']) && isset($_SESSION['password']))
    {

    }
    if (isset($_REQUEST['Exit']))
    {
        session_destroy();
        header("Location: auth.php");
    }
?>
<body>
    <form action="main.php" method="POST">
        <input type="submit" name = "Exit" value="Exit" style="position: relative; left: 90%;">
    </form>
</body>
</html>
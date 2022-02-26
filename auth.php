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
    require("bd.php");
    $l = "";
    if  (isset($_REQUEST['login']) && isset($_REQUEST['password']))
    {
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `login` = ? and `password` = ?");
        $stmt->execute([$_REQUEST['login'], $_REQUEST['password']]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if($category != null)
        {
            $_SESSION['login']=$_REQUEST['login'];
            $_SESSION['password']=$_REQUEST['password'];
            header("Location: main.php");
        }
        else
        {
            $l = "Invalid login or password";
        }
    }
?>
<body>
    <main>
        <form action="auth.php" method="POST">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Вход">
            <a href="reg.php">Зарегистрироваться</a>
            <?php
                print("<p>".$l."</p>");
            ?>
        </form>
    </main>
</body>
</html>
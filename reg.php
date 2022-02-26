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
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `login` = ?");
        $stmt->execute([$_REQUEST['login']]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if($category == null)
        {
            $query = "INSERT INTO `users` (`login`, `password`) VALUES (:login, :password);";
            $params = [
                ':login' => $_REQUEST['login'],
                ':password' => $_REQUEST['password']
            ];
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            $_SESSION['login']=$_REQUEST['login'];
            $_SESSION['password']=$_REQUEST['password'];
            header("Location: main.php");
        }
        else
        {
            $l = "Login is registered";
        }
    }
?>
<body>
    <main>
        <form action="reg.php" method="POST">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Зарегистрироваться">
            <a href="auth.php">Sing in</a>
            <?php
                print("<p>".$l."</p>");
            ?>
        </form>
    </main>
</body>
</html>
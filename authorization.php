<?php
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка " . mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "Ошибка при загрузке набора символов cp1251";
        mysqli_error($link);
        exit();
    }
    $query = "select * from users where users.login = '$login'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    $row = mysqli_fetch_row($result);
    if (empty($row[0])) {
        //если пользователя с введенным логином не существует
        mysqli_close($link);
        echo "<script>alert('Введенный логин неверный')</script>";
        exit();
    } else {
        //если существует, то сверяем пароли
        if ($row[3] == $password) {
            //если пароли совпадают, то запускаем пользователю сессию
            $_SESSION['login'] = $row[1];
            $_SESSION['e-mail'] = $row[2];
            $_SESSION['session'] = $row[0];
        } else {
            //если пароли не сошлись
            mysqli_close($link);
            echo "<script>alert('Введенный пароль неверный')</script>";
            exit();
        }
    }
}

if (isset($_SESSION['session'])) {
    echo "<script>
    document.getElementById('sign-in').style.visibility = 'hidden';
    document.getElementById('user').style.visibility = 'visible';
    document.getElementById('sign-out-icon').style.visibility = 'visible';
    document.getElementById('sign-in-icon').style.visibility = 'hidden';
    document.getElementById('user-name').value = '".$_SESSION['login']."';
    if (document.getElementById('favorite') != null)
        document.getElementById('favorite').style.display = 'block';
    if (document.getElementById('add-comment') != null)
        document.getElementById('add-comment').style.display = 'block';
    </script>";
}

if (isset($_GET['action']) && $_GET['action'] == "logout") {
    echo "<script>window.location.assign('index.php')</script>";
    $_SESSION['login'] = "";
    $_SESSION['e-mail'] = "";
    $_SESSION['session'] = "";
    session_destroy();
    echo "<script>
    document.getElementById('sign-in').style.visibility = 'visible';
    document.getElementById('user').style.visibility = 'hidden';
    document.getElementById('sign-out-icon').style.visibility = 'hidden';
    document.getElementById('sign-in-icon').style.visibility = 'visible';
    if (document.getElementById('favorite') != null)
        document.getElementById('favorite').style.display = 'none';
    if (document.getElementById('add-comment') != null)
        document.getElementById('add-comment').style.display = 'none';
    </script>";
    exit();
}

?>
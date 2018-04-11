<html>
<head>
    <meta charset="windows-1251">
    <title>MyLibrary</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/animate.css/animate.min.css">

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>

<?php
session_start();
$page = "genres";
include "background/background.html";
include "panel/panel.html";
include "modal_box/modal_box.html";
include "menu/menu.php";
include "menu-genres/menu-genres.php";
?>
<div class="content">
    <?php
    if ($_GET) {
        $menu = $_GET['id'];
    }
    else $menu = 4;
    $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "Ошибка при загрузке набора символов cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select * from books where books.id_genre = '$menu'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result) //проверяем, получены ли данные из БД
    {
        $rows = mysqli_num_rows($result); // количество полученных строк (записей)
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
            $id = $row[0];
            echo "<div class='cover-book' style=\"background-image: url('img/cover/".$row[4]."')\">"
                ."<a href='description.php?id=$id' class='name-book'>".$row[1]."</a>"
                ."</div>";
        }
    }
    mysqli_close($link);
    echo "<script>
        elemList = document.getElementsByClassName('section-genre');
        elemList.className = 'section section-genre';
        elem = document.getElementById('".$menu."');
        elem.className = 'section section-genre active';
    </script>";
    ?>
</div>
<?php
include "register.php";
include "authorization.php";
include "footer/footer.html";
?>

</body>
</html>
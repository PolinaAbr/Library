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
$page = "authors";
include "background/background.html";
include "panel/panel.html";
include "modal_box/modal_box.html";
include "menu/menu.php";
?>
<div class="body" style="display: flex">
    <?php
    include "authors-list/authors-list.php";
    ?>
    <div class="content content-author">
        <?php
        if ($_GET) {
            $author = $_GET['id'];
        }
        else $author = 10;
        $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка ".mysqli_error($link));
        if (!mysqli_set_charset($link, "cp1251")) {
            echo "Ошибка при загрузке набора символов cp1251";
            mysqli_error($link);
            exit();
        }
        $query ="select * from books where books.id_auth = '$author'";
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
            elemList = document.getElementsByClassName('authors-list');
            elemList.className = 'authors-list';
            elem = document.getElementById('".$author."');
            elem.className = 'authors-list active-author';
        </script>";
        ?>
    </div>
</div>
<?php
include "register.php";
include "authorization.php";
include "footer/footer.html";
?>

</body>
</html>
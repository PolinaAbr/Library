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
$page = "search";
include "background/background.html";
include "panel/panel.html";
include "menu/menu.php";
include "modal_box/modal_box.html";
include "register.php";
include "authorization.php";
?>
<div class="content">
    <?php
    $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка " . mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "Ошибка при загрузке набора символов cp1251";
        mysqli_error($link);
        exit();
    }
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        
        $query ="select b.id_book, b.name, b.image  
                     from books as b 
                     inner join authors as a on b.id_auth = a.id_author
                     inner join genres as g on b.id_genre = g.id_genre
                     where b.name like '%".$search."%'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $rows1 = mysqli_num_rows($result); // количество полученных строк (записей)
        if ($rows1 > 0) {
            echo "<div class='search-result'><p class='search-text'>Результаты поиска по названию книги \"".$search."\"</p></div>";
            for ($i = 0; $i < $rows1; ++$i) {
                $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
                $id = $row[0];
                echo "<div class='cover-book' style=\"background-image: url('img/cover/".$row[2]."')\">"
                    ."<a href='description.php?id=$id' class='name-book'>".$row[1]."</a>"
                    ."</div>";
            }
        }

        $query ="select b.id_book, b.name, b.image  
                     from books as b 
                     inner join authors as a on b.id_auth = a.id_author
                     inner join genres as g on b.id_genre = g.id_genre
                     where a.name like '%".$search."%'
                     or a.middle_name like '%".$search."%'
                     or a.surname like '%".$search."%'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $rows2 = mysqli_num_rows($result); // количество полученных строк (записей)
        if ($rows2 > 0) {
            echo "<div class='search-result'><p class='search-text'>Результаты поиска по автору \"".$search."\"</p></div>";
            for ($i = 0; $i < $rows2; ++$i) {
                $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
                $id = $row[0];
                echo "<div class='cover-book' style=\"background-image: url('img/cover/".$row[2]."')\">"
                    ."<a href='description.php?id=$id' class='name-book'>".$row[1]."</a>"
                    ."</div>";
            }
        }


        $query ="select b.id_book, b.name, b.image  
                     from books as b 
                     inner join authors as a on b.id_auth = a.id_author
                     inner join genres as g on b.id_genre = g.id_genre
                     where g.genre like '%".$search."%'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $rows3 = mysqli_num_rows($result); // количество полученных строк (записей)
        if ($rows3 > 0) {
            echo "<div class='search-result'><p class='search-text'>Результаты поиска по жанру \"".$search."\"</p></div>";
            for ($i = 0; $i < $rows3; ++$i) {
                $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
                $id = $row[0];
                echo "<div class='cover-book' style=\"background-image: url('img/cover/".$row[2]."')\">"
                    ."<a href='description.php?id=$id' class='name-book'>".$row[1]."</a>"
                    ."</div>";
            }
        }

        if ($rows1 == 0 && $rows2 == 0 && $rows3 == 0) {
            echo "<div class='search-result'><p class='search-text'>Результатов по запросу \"".$search."\" не найдено</p></div>";
            echo "<div style='min-height: 100%; margin-top: -214px'></div>";
        }
    }
    ?>
</div>
<?php
include "footer/footer.html";
?>

</body>
</html>
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
$page = "user";
include "background/background.html";
include "panel/panel.html";
include "menu/menu.php";
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
    if (isset($_SESSION['session'])) {
        $id = $_SESSION['session'];
        $query ="select b.id_book, b.name, b.image  
                     from books as b 
                     inner join favorite as f on b.id_book = f.id_book
                     where f.id_user = '$id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $rows = mysqli_num_rows($result); // количество полученных строк (записей)
        if ($rows > 0) {
            echo "<div class='search-result'><p class='search-text'>Ваши избранные книги</p></div>";
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
                $id = $row[0];
                echo "<div class='cover-book' style=\"background-image: url('img/cover/".$row[2]."')\">"
                    ."<a href='description.php?id=$id' class='name-book'>".$row[1]."</a>"
                    ."</div>";
            }
        }
        if ($rows == 0) {
            echo "<div class='search-result'><p class='search-text'>У вас пока нет избранных книг</p></div>";
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
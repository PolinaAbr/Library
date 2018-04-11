<div class="menu menu-genres">
    <?php
    $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "Ошибка при загрузке набора символов cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select * from genres order by genres.genre";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result) //проверяем, получены ли данные из БД
    {
        $rows = mysqli_num_rows($result); // количество полученных строк (записей)
        for ($i = 1; $i <= $rows; ++$i) {
            $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
            $id = $row[0];
            echo "<a href='genres.php?id=$id' class='section section-genre' id='$id'>".$row[1]."</a>";
        }
    }
    mysqli_close($link);
    ?>
</div>
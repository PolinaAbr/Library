<div class="content">
    <?php
    $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "Ошибка при загрузке набора символов cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select * from books";
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
    ?>
</div>
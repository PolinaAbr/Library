<div id="favorite">
    <a id="add"><i class="fa fa-star-o fa-3x favorite" id="favorite-icon" aria-hidden="true"></i></a>
    <a id="del"><i class="fa fa-star fa-3x favorite" id="favorite-check-icon" aria-hidden="true"></i></a>
</div>
<div class="content">
    <?php
    $book = $_GET['id'];
    $link = mysqli_connect("localhost", "root", "", "books") or die("Ошибка ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "Ошибка при загрузке набора символов cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select b.name, b.image, b.date, b.description, b.comment, a.name, a.middle_name, a.surname, g.genre  
                                 from books as b 
                                 inner join authors as a on b.id_auth = a.id_author
                                 inner join genres as g on b.id_genre = g.id_genre
                                 where b.id_book = '$book'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result) //проверяем, получены ли данные из БД
    {
        $rows = mysqli_num_rows($result); // количество полученных строк (записей)
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
            echo "<div class='cover-book big-cover' style=\"background-image: url('img/cover/".$row[1]."')\"></div>"
                ."<div class='description'>"
                ."<article class='book-name'>".$row[0]."</article>"
                ."<article><b>Автор:</b> ".$row[5]." ".$row[6]." ".$row[7]."</article>"
                ."<article><b>Год написания:</b> ".$row[2]."</article>"
                ."<article><b>Жанр:</b> ".$row[8]."</article>"
                ."<article><b>Описание:</b> ".$row[3]."</article>"
                ."</div><div class='review'>"
                ."<article><b>Рецензия:</b></article>"
                ."<article>".$row[4]."</article>"
                ."</div>";
        }
    }
    if (isset($_SESSION['session'])) {
        $id = $_SESSION['session'];
        $query = "select * from favorite where favorite.id_user = '".$id."'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $rows = mysqli_num_rows($result); // количество полученных строк (записей)
        if ($rows > 0) {
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result); //Получение строки результирующей таблицы в виде массива
                if ($row[2] == $book) {
                    echo "<script>
                         document.getElementById('favorite-icon').style.visibility = 'hidden';
                         document.getElementById('favorite-check-icon').style.visibility = 'visible';
                         </script>";
                }
            }
        }
        $url = $_SERVER['PHP_SELF']."?id=".$book;
        echo "<script>
             document.getElementById('add').setAttribute('href', '".$url."&action=add');
             document.getElementById('del').setAttribute('href', '".$url."&action=del');
             document.getElementById('favorite-icon').onclick = function() {
                 document.getElementById('favorite-icon').style.visibility = 'hidden';
                 document.getElementById('favorite-check-icon').style.visibility = 'visible';
             };
             document.getElementById('favorite-check-icon').onclick = function() {
                 document.getElementById('favorite-icon').style.visibility = 'visible';
                 document.getElementById('favorite-check-icon').style.visibility = 'hidden';
             };
             </script>";
        if (isset($_GET['action'])) {
            $act = $_GET['action'];
            if ($act == 'add') {
                $query = "insert into favorite (id_user, id_book) values('$id', '$book')";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                echo "<script>window.location.assign('".$url."')</script>";
            }
            if ($act == 'del') {
                $query = "delete from favorite where favorite.id_user = '$id' and favorite.id_book = '$book'";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                echo "<script>window.location.assign('".$url."')</script>";
            }
        }
    }
    mysqli_close($link);
    ?>
</div>
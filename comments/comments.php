<div class="content">
    <?php
    $book = $_GET['id'];
    $link = mysqli_connect("localhost", "root", "", "books") or die("������ ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "������ ��� �������� ������ �������� cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select c.id_comment, u.login, c.comment, c.date, c.time  
                                 from books as b 
                                 inner join comments as c on b.id_book = c.id_book
                                 inner join users as u on u.id_user = c.id_user
                                 where b.id_book = '$book'";
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    if($result) //���������, �������� �� ������ �� ��
    {
        $rows = mysqli_num_rows($result); // ���������� ���������� ����� (�������)
        if ($rows > 0) {
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result); //��������� ������ �������������� ������� � ���� �������
                echo "<div class='user-comment'>"
                    . "<div class='user-info'>"
                    . "<span>����������� ������������ " . $row[1] . "</span>"
                    . "<span class='datetime'>" . $row[3] . " | " . $row[4] . "</span>"
                    . "</div>"
                    . "<article class='comment-text'>" . $row[2] . "</article>"
                    . "</div>";
            }
        } else {
            echo "<div class='user-comment'><p class='comments-none'>������������ � ������ ����� ���� ���</p></div>";
        }
    }
    ?>

    <form class="add-comment" id="add-comment" name="add-comment" method="post" onsubmit="return validateCom()">
        <textarea name="comment" class="comment" placeholder="�������� ���� �����������..."></textarea>
        <input type="button" class="btn-comment" value="���������" onclick="submitCom()">
    </form>
</div>

<?php
if (isset($_POST['comment']) && isset($_SESSION['session'])) {
    $comment = $_POST['comment'];
    $book = $_GET['id'];
    $user = $_SESSION['session'];
    $day = date('d');
    $month = date('m');
    if ($month == '01') {
        $month = '������';
    } else if ($month == '02') {
        $month = '�������';
    } else if ($month == '03') {
        $month = '�����';
    } else if ($month == '04') {
        $month = '������';
    } else if ($month == '05') {
        $month = '���';
    } else if ($month == '06') {
        $month = '����';
    } else if ($month == '07') {
        $month = '����';
    } else if ($month == '08') {
        $month = '�������';
    } else if ($month == '09') {
        $month = '�������';
    } else if ($month == '10') {
        $month = '�������';
    } else if ($month == '11') {
        $month = '������';
    } else if ($month == '12') {
        $month = '�������';
    }
    $year = date('Y');
    $date = $day . " " . $month . " " . $year;
    $hour = date('H');
    $minute = date('i');
    $time = $hour . ":" . $minute;
    $url = $_SERVER['PHP_SELF']."?id=".$book;
    $link = mysqli_connect("localhost", "root", "", "books") or die("������ " . mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "������ ��� �������� ������ �������� cp1251";
        mysqli_error($link);
        exit();
    }
    $query = "insert into comments (id_book, id_user, comment, date, time) values('$book','$user','$comment','$date','$time')";
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    if ($result == 'true') {
        echo "<script>window.location.assign('".$url."')</script>";
    } else {
        echo "<script>alert('��������� ������. ��������� �������� ��� ���')";
        mysqli_close($link);
        exit();
    }
}
?>
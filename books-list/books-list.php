<div class="content">
    <?php
    $link = mysqli_connect("localhost", "root", "", "books") or die("������ ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "������ ��� �������� ������ �������� cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select * from books";
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    if($result) //���������, �������� �� ������ �� ��
    {
        $rows = mysqli_num_rows($result); // ���������� ���������� ����� (�������)
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_row($result); //��������� ������ �������������� ������� � ���� �������
            $id = $row[0];
            echo "<div class='cover-book' style=\"background-image: url('img/cover/".$row[4]."')\">"
                ."<a href='description.php?id=$id' class='name-book'>".$row[1]."</a>"
                ."</div>";
        }
    }
    mysqli_close($link);
    ?>
</div>
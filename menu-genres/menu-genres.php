<div class="menu menu-genres">
    <?php
    $link = mysqli_connect("localhost", "root", "", "books") or die("������ ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "������ ��� �������� ������ �������� cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select * from genres order by genres.genre";
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    if($result) //���������, �������� �� ������ �� ��
    {
        $rows = mysqli_num_rows($result); // ���������� ���������� ����� (�������)
        for ($i = 1; $i <= $rows; ++$i) {
            $row = mysqli_fetch_row($result); //��������� ������ �������������� ������� � ���� �������
            $id = $row[0];
            echo "<a href='genres.php?id=$id' class='section section-genre' id='$id'>".$row[1]."</a>";
        }
    }
    mysqli_close($link);
    ?>
</div>
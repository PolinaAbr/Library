<div class="content authors-block">
    <?php
    $link = mysqli_connect("localhost", "root", "", "books") or die("������ ".mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "������ ��� �������� ������ �������� cp1251";
        mysqli_error($link);
        exit();
    }
    $query ="select * from authors order by authors.surname";
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    if($result) //���������, �������� �� ������ �� ��
    {
        $rows = mysqli_num_rows($result); // ���������� ���������� ����� (�������)
        for ($i = 1; $i <= $rows; ++$i) {
            $row = mysqli_fetch_row($result); //��������� ������ �������������� ������� � ���� �������
            $id = $row[0];
            echo "<a href='authors.php?id=$id' class='authors-list' id='$id'>".$row[1]." ".$row[3]."</a>";
        }
    }
    mysqli_close($link);
    ?>
    
</div>
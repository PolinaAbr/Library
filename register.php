<?php
if (isset($_POST['e-mail-reg']) && isset($_POST['login-reg']) && isset($_POST['password-reg']) && isset($_POST['confirm-password-reg'])) {
    $email = $_POST['e-mail-reg'];
    $loginReg = $_POST['login-reg'];
    $passwordReg = $_POST['password-reg'];
    $confirmReg = $_POST['confirm-password-reg'];
    $link = mysqli_connect("localhost", "root", "", "books") or die("������ " . mysqli_error($link));
    if (!mysqli_set_charset($link, "cp1251")) {
        echo "������ ��� �������� ������ �������� cp1251";
        mysqli_error($link);
        exit();
    }
    $query = "select users.id_user from users where users.login = '$loginReg'";
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    $row = mysqli_fetch_row($result);
    if (!empty($row[0])) {
        //���� ������������ � ��������� ������� ��� ����������
        mysqli_close($link);
        echo "<script>alert('��������� ���� ����� ��� ����������. �������� ������ �����');
            document.getElementById('modal').style.display = 'flex'</script>";
        unset($email);
        unset($loginReg);
        unset($passwordReg);
        unset($confirmReg);
        exit();
    } else {
        $query = "insert into users (login, email, password) values('$loginReg','$email','$passwordReg')";
        $result2 = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
    }
    if ($result2 == 'true') {
        echo "<script>alert('�� ������� ����������������')</script>";
        $query = "select * from users where users.login = '$loginReg'";
        $result3 = mysqli_query($link, $query) or die("������ " . mysqli_error($link));
        $row = mysqli_fetch_row($result3);
        $_SESSION['login'] = $row[1];
        $_SESSION['e-mail'] = $row[2];
        $_SESSION['session'] = $row[0];
    } else {
        echo "<script>alert('��������� ������. ��������� ����������� ��� ���');
            document.getElementById('modal').style.display = 'flex'</script>";
        mysqli_close($link);
        exit();
    }
}
?>
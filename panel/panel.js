function validateLogin() {
    var login = document.forms["form-auth"]["login"].value;
    var password = document.forms["form-auth"]["password"].value;
    if (login == "" || password == "") {
        return false;
    }
}

function submitLogin() {
    var login = document.forms["form-auth"]["login"].value;
    var password = document.forms["form-auth"]["password"].value;
    if (login == "") {
        alert("������� �����");
    } else if (password == "") {
        alert("������� ������");
    } else {
        document.getElementById('form-auth').submit();
    }
}

function submitSearch() {
    var search = document.forms["form-search"]["search"].value;
    if (search == "") {
        alert("�� �� ����� ��������� ������");
    } else {
        document.getElementById('form-search').submit()
    }
}
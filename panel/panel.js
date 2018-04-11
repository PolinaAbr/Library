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
        alert("Введите логин");
    } else if (password == "") {
        alert("Введите пароль");
    } else {
        document.getElementById('form-auth').submit();
    }
}

function submitSearch() {
    var search = document.forms["form-search"]["search"].value;
    if (search == "") {
        alert("Вы не ввели параметры поиска");
    } else {
        document.getElementById('form-search').submit()
    }
}
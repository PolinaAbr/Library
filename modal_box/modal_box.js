window.onload = function(){
    var register = document.getElementById("register");
    var modal = document.getElementById('modal');
    var close = document.getElementById("close");
    // var btn = document.getElementById("regBtn");
    register.onclick = function() {
        modal.style.display = "flex";
    };
    close.onclick = function() {
        modal.style.display = "none";
    };
    // btn.onclick = function() {
    //     modal.style.display = "none";
    // };
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
};

function validateReg() {
    var email = document.forms["form-reg"]["e-mail-reg"].value;
    var login = document.forms["form-reg"]["login-reg"].value;
    var password = document.forms["form-reg"]["password-reg"].value;
    var confirm = document.forms["form-reg"]["confirm-password-reg"].value;
    if (email == "" || login == "" || password == "" || confirm == "") {
        return false;
    }
}

function submitReg() {
    var email = document.forms["form-reg"]["e-mail-reg"].value;
    var login = document.forms["form-reg"]["login-reg"].value;
    var password = document.forms["form-reg"]["password-reg"].value;
    var confirm = document.forms["form-reg"]["confirm-password-reg"].value;
    // var modal = document.getElementById('modal');
    if (email == "") {
        alert("Введите e-mail");
    } else if (login == "") {
        alert("Введите логин");
    } else if (password == "") {
        alert("Введите пароль");
    } else if (confirm == "") {
        alert("Повторите введенный пароль");
    } else if (password != confirm) {
        alert("Введенные пароли не совпадают");
    } else {
        document.getElementById('form-reg').submit();
        // modal.style.display = "flex";
    }
}
function validateCom() {
    var comment = document.forms["add-comment"]["comment"].value;
    if (comment == "") {
        return false;
    }
}

function submitCom() {
    var comment = document.forms["add-comment"]["comment"].value;
    if (comment == "") {
        alert("¬ведите свой комментарий дл€ отправки");
    } else {
        document.getElementById('add-comment').submit();
    }
}

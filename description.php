<html>
<head>
    <meta charset="windows-1251">
    <title>MyLibrary</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/animate.css/animate.min.css">

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>

<?php
session_start();
$page = 'description';
include "background/background.html";
include "panel/panel.html";
include "menu/menu.php";
include "modal_box/modal_box.html";
include "book-description/book-description.php";
include "comments/comments.php";
include "register.php";
include "authorization.php";
include "footer/footer.html";
?>

</body>
</html>
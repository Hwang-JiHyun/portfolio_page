<?php
session_start();
if (isset($_COOKIE['id'])) {
    $cookie_id = $_COOKIE['id'];
} else {
    $cookie_id = "";
}

if (isset($_SESSION['id'])) {
    $logout = "로그아웃";
} else {
    $logout = "";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>JIHYUN's portfolio</title>
    <link href="mainStyle.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="nav">
    <div class="webPageName" onclick="location.href='page_main.php'">
        JIHYUN's Portfolio
    </div>

    <div class="navigationRightItems">
        <div class="navigationItem"><?= $_SESSION['name'] ?></div>
        <div class="navigationItem">
            <a href="/login/logout.php">
                <button><?= $logout ?></button>
            </a>
        </div>
        <Button class="navigationItem" onclick="location.href='page_about.php'" type="button">
            about
        </Button>
        <Button class="navigationItem" onclick="location.href='page_bulletin_board.php'" type="button">
            board
        </Button>
        <Button class="navigationItem" onclick="location.href='page_guest_book.php'" type="button">
            Visitor's
        </Button>
        <Button class="navigationItem" type="button">준비중</Button>

    </div>
</div>

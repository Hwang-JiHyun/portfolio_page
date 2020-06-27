<?php
/*session_start();
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


*/?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>JIHYUN's portfolio</title>
    <link href="mainStyle.css" rel="stylesheet" type="text/css"/>
    <?php include_once '../setting/header.php';?>
</head>

<body>

<div class="main">
    <div class="title">
        flow: move easily for one direction
    </div>
    <div class="subTitle">
    </div>
</div>

<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<script>-->
<!--    let page = 10;-->
<!--    $(window).scroll(function() {-->
<!--        console.log( Math.ceil($(window).scrollTop()) + " >= " + ($(document).height() - $(window).height()) );-->
<!--        if ( Math.ceil($(window).scrollTop()) >= ($(document).height() - $(window).height()) ) {-->
<!--            $("body").append('<div class="big-box"><h1>Page ' + ++page + '</h1></div>');-->
<!--        }-->
<!--    });-->
<!--</script>-->

<div class="container">
</div>

<script>
    'use strict'
    const container = document.querySelector('.container');
    const URL = "http://api.adorable.io/avatars/"

    //  part1
    // get a batch of images and append to the container div

    function getRandNum() {
        return Math.floor(Math.random() * 100);
    }

    function loadImages(numImages = 10) {
        let i = 0;
        while (i < numImages) {
            const img = document.createElement('img');
            img.src = `${URL}${getRandNum()}`
            container.appendChild(img);
            i++;
        }
    }

    loadImages()

    // part2
    // listen for a scroll event and load more images if we reach the bottom of the window

    window.addEventListener('scroll', () => {
        if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
            loadImages()
        }
    })

</script>


</body>
</html>


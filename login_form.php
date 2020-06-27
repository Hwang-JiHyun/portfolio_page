<?php
session_start();
if (isset($_COOKIE['id'])) {
    $cookie_id = $_COOKIE['id'];
} else {
    $cookie_id = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>로그인 페이지</title>
    <link href="loginStyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="loginBox">
    <form id="login" method="post" action="login_result.php">
        <b>로그인 페이지</b>
        <input id="id" placeholder="아이디" type="text" name="id" value="<?= $cookie_id ?>" required>
        <input id="password" placeholder="비밀번호" type="password" name="password" required>

        <div><input class="save_id" type="checkbox" name="save_id">ID저장 <input id="btn_login" type="submit" value="로그인"></div>
    </form>
</div>

</body>
</html>
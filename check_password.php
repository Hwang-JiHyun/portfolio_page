<?php
include 'db_info.php';

/*var_dump($_POST);
print_r($_POST);*/
settype($_POST['id'], 'integer');
$filtered = array(
    'id' => mysqli_real_escape_string($conn, $_POST['id']),
    'password' => mysqli_real_escape_string($conn, $_POST['password'])
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>방명록 - 비밀번호 확인</title>
    <link href="style_guest_book.css" rel="stylesheet" type="text/css"/>
    <?php include_once '../setting/header.php';?>
</head>
<body>
<form action=delete_guest_book.php?id=<?= $filtered['id'] ?> method="post">
    <table class="check-password" >
        <tr>
            <td>
                <a>비 밀 번 호 확 인</a>
            </td>
        </tr>
        <tr>
            <td>
                <a>비밀번호 : </a>
                    <input type="hidden" name="id" value="<?= $filtered['id'] ?>">
                    <input type=password name="password" size=8 maxlength=8>
                    <input type=submit value="확 인">
                    <input type=button value="취 소" onclick="history.back(-1)">
            </td>
        </tr>
    </table>
</form>





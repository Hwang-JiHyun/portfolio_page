<?php
include "db_info.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>방명록</title>
    <link href="style_guest_book.css" rel="stylesheet" type="text/css"/>
    <?php include_once '../setting/header.php';?>
</head>
<body>

<!--방명록 입력칸 -->

<form action="create_guest_book.php" method="post">
    <table class="input-table">
        <tr>
            <th>작성자</th>
            <td><input type="text" name="writer" required></td>
            <th>비밀번호</th>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="4"><textarea placeholder="방명록을 남겨주세요" name="content" required></textarea></td>
        </tr>
        <tr>
            <!-- <td> <input type="checkbox" value="1" name="lock" />비밀글</td>-->
            <td colspan="4"><input type="submit" value="확인"></td>
        </tr>
    </table>
</form>

<!--방명록 확인칸-->
<?php
$sql = "select * from guest_book order by id desc ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $filtered = array(
        'id' => htmlspecialchars($row['id']),
        'writer' => htmlspecialchars($row['writer']),
        'content' => htmlspecialchars($row['content']),
        'password' => htmlspecialchars($row['password']),
        'date' => htmlspecialchars($row['date'])
    );
    ?>
        <table class="show-table">
            <tr>
                <th>작성자</th>
                <td><?= $filtered['writer'] ?></td>
                <th>작성일</th>
                <td><?= $filtered['date'] ?></td>
            </tr>

            <tr>
                <td colspan="4"><div id="show-content-table"><?= $filtered['content'] ?></div></td>
            </tr>

            <tr align="right">
                <td colspan="4">
                    <form action="check_password.php" method="post">
                        <input type="hidden" name="id" value="<?= $filtered['id'] ?>">
                        <input type="submit" id="btn-delete" value="삭제">
                    </form>
                </td>
            </tr>
        </table>
    <?php
}
?>

</body>

</html>

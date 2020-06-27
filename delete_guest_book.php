<?php
include 'db_info.php';
//print_r($_POST);
//var_dump($_POST);
settype($_POST['id'], 'integer');
$filtered = array(
    'id' => mysqli_real_escape_string($conn, $_POST['id']),
    'password' => mysqli_real_escape_string($conn, $_POST['password'])
);

//$sql = "
//delete from guest_book
//where id='{$filtered['id']}'
//";

//$result = mysqli_query($conn, $sql);
//if ($result === false) {
//    echo '저장하는 과정에서 문제가 생김';
//} else {
//    header('Location:page_guest_book.php');
//}

$sql = "select password from guest_book where id='{$filtered['id']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if (($filtered['password']) === $row['password']) {
    $del_sql = "delete from guest_book where id='{$filtered['id']}'";
    $result = mysqli_query($conn, $del_sql);
    if ($result === false) {
        echo '저장하는 과정에서 문제가 생김';
    } else {
        echo '삭제되었습니다';
        header('Location:http://192.168.56.101/guest_book/page_guest_book.php');
    }
}else{
    echo'비번이 틀렷습니다';
}

//else
//{
//    echo ("
//    <script>
//    alert('비밀번호가 틀립니다.');
//    history.go(-1)
//    </script>
//    exit;
//}
//
//<center>
//<meta http-equiv='Refresh" content='0; URL=list.php'>
//<font size=2> 삭제되었습니다.</font>


?>
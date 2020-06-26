<?php
//$conn = mysqli_connect(
//    '127.0.0.1',
//    'root',
//    'root-password', 'portfolio');
include "db_info.php";
print_r($_POST);

$on='1';
$off='0';

//비밀글 설정이 되어있으면 lock_post변수에 $on=1 할당, 아니면 $off=0 할당
if (isset($_POST['lock'])) {
    $lock_guest_book = $on;
} else {
    $lock_guest_book = $off;
}
print_r($lock_guest_book);

$filtered = array(
    'writer'=>mysqli_real_escape_string($conn,$_POST['writer']),
    'password'=>mysqli_real_escape_string($conn,$_POST['password']),
    'content'=>mysqli_real_escape_string($conn,$_POST['content']),
    'lock'=>$lock_guest_book
);


$sql = "
insert into guest_book
(writer,password,content,date,lock_guest_book)
values (
        '{$filtered['writer']}',
        '{$filtered['password']}',
        '{$filtered['content']}',
        NOW(),
        '{$filtered['lock']}'
)";

$result = mysqli_query($conn,$sql);
if($result===false) {
    echo '문제가 생겼습니다 다시 시도해 주세요 ';
}else{
    header('Location:page_guest_book.php');
}
?>

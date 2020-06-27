<?php

include "db_info.php";

function mq($sql){
    global $conn;
    return $conn->query($sql);
}

$on='1';
$off='2';

//각 변수에 write.php에서 input name값들을 저장한다
/*$username = $_POST['name'];*/
$password = $_POST['password'];
print_r($password);
$title = $_POST['title'];
print_r($title);
$content = $_POST['content'];
print_r($content);
$date = date('Y-m-d');
print_r($date);

//비밀글 설정이 되어있으면 lock_post변수에 1 할당, 아니면 0할당
if (isset($_POST['lock'])) {
    $lock_post = $on;
} else {
    $lock_post = $off;
}

if ($password && $title && $content) {
    $sql = mq("insert into bulletin_board
    (password,title,content,date,lock_post) 
    values('" . $password . "','" . $title . "','" . $content . "','" . $date . "','" . $lock_post . "')
    ");
    echo "
    alert('글쓰기 완료되었습니다.');
    ";
    $new_post_id = mysqli_insert_id($conn);
    header('Location:page_read_post.php?id='.$new_post_id);
} else {
    echo "
    alert('글쓰기에 실패했습니다.');
    history.back();";
}
?>
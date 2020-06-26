<?php
include 'db_info.php';

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}

$post_number = $_POST['reply_id'];

/*print_r($_POST['reply_id']);
print_r($_POST['reply_password']);
print_r($_POST['reply_writer']);
print_r($_POST['reply_content']);*/

if($post_number && $_POST['reply_writer'] && $_POST['reply_password'] && $_POST['reply_content']){
    $sql = mq("insert into 
    reply
    (post_number,writer,password,content,date) 
    values('".$post_number."','".$_POST['reply_writer']."','".$_POST['reply_password']."','".$_POST['reply_content']."',NOW())
    ");

    echo "<script>alert('댓글이 작성되었습니다.'); 
        location.href='page_read_post.php?id=$post_number';</script>";
}else{
    echo "<script>alert('댓글 작성에 실패했습니다.'); 
       /* history.back();*/
        </script>";

}

?>
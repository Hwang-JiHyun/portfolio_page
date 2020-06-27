<?php
include "db_info.php";

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}

$post_number = $_GET['id'];
$password = $_POST['password'];
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mq(
    "update bulletin_board set 
    password='".$password."',
    title='".$title."',
    content='".$content."' where id='".$post_number."'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=/bulletin_board/page_read_post.php?id=<?php echo $post_number; ?>">
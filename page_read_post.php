<?php
include 'db_info.php';
session_start();

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}
if (isset($_SESSION['id'])) {
    $modify = "수정";
} else {
    $modify = "";
}

if (isset($_SESSION['id'])) {
    $delete = "삭제";
} else {
    $delete = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <?php include_once '../setting/header.php';?>
</head>
<body>
<?php
/*$post_id에 id값을 받아와 넣음*/
$post_id = $_GET['id'];
$hit = mysqli_fetch_array(mq("select * from bulletin_board where id ='" . $post_id . "'"));
$hit = $hit['hit'] + 1;
$fet = mq("update bulletin_board set hit = '" . $hit . "' where id = '" . $post_id . "'");
/* 받아온 id값을 선택 */
$sql = mq("select * from bulletin_board where id='" . $post_id . "'");
$board = $sql->fetch_array();
?>

<!-- 글 불러오기 -->
<div id="board_read">
    <div id="post_title">TITLE : <?php echo $board['title']; ?></div>
    <div id="post_info">
        <a class="post_date">DATE : <?php echo $board['date']; ?></a><br>
        <a class="post_hit">HIT : <?php echo $board['hit']; ?></a>
        <div id="post_line"></div>
    </div>
    <div id="post_content">
        <?php echo nl2br("$board[content]"); ?>
    </div>
    <!-- 목록, 수정, 삭제 -->
    <div id="post_update">
        <ul>
            <li><a href="page_bulletin_board.php">[목록으로]</a></li>
            <li><a href="modify.php?id=<?php echo $board['id']; ?>"><?=$modify?></a></li>
            <li><a href="delete.php?id=<?php echo $board['id']; ?>"><?=$delete?></a></li>
        </ul>
    </div>
</div>

<!--댓글 불러오기-->

<div class="reply_view">
    <div class="reply_line"></div>
    <?php
    $sql3 = mq("select * from reply where post_number='" . $post_id . "' order by id");
    while ($reply = $sql3->fetch_array()) {
        ?>
        <div class="reply_box">
            <div><b><?php echo $reply['writer']; ?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
            <div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
            <div class="reply_update_menu">
                <a class="btn_reply_modify" href="#">수정</a>
                <a class="btn_reply_delete" href="#">삭제</a>
            </div>
            <!-- 댓글 수정 폼 dialog -->
            <div class="dat_edit">
                <form method="post" action="rep_modify_ok.php">
                    <input type="hidden" name="reply_number" value="<?php echo $reply['id']; ?>"/>
                    <input type="hidden" name="post_number" value="<?php echo $post_id; ?>">
                    <input type="password" name="password" class="dap_sm" placeholder="비밀번호"/>
                    <textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                    <input type="submit" value="수정하기" class="re_mo_bt">
                </form>
            </div>
            <!-- 댓글 삭제 비밀번호 확인 -->
            <div class='reply_delete'>
                <form action="reply_delete.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo $reply['id']; ?>"/><input type="hidden" name="post_number" value="<?php echo $post_id; ?>">
                    <p>비밀번호<input type="password" name="pw"/> <input type="submit" value="확인"></p>
                </form>
            </div>
        </div>
    <?php } ?>

    <!--- 댓글 입력 폼 -->
    <div class="create_reply_box">
        <form action="create_reply.php?id=<?php echo $post_id;?>" method="post">
            <input type="hidden" name="reply_id" value="<?php echo $post_id; ?>">
            <input type="text" name="reply_writer" id="reply_writer" class="reply_writer" size="15" placeholder="작성자">
            <input type="password" name="reply_password" id="reply_password" class="reply_password" size="15" placeholder="비밀번호">
            <div class="reply_textarea">
                <textarea name="reply_content" class="reply_content" id="reply_content" style="width: 600px"></textarea>
                <button id="btn_reply" class="btn_reply">작성완료</button>
            </div>
        </form>
    </div>
</div><!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</div>
</body>
</html>

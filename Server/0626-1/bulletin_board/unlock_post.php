<?php
include 'db_info.php';

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}

?>
<!--<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript">
    $(function(){
        $("#writepass").dialog({
            modal:true,
            title:'비밀글입니다.',
            width:400,
        });
    });
</script>-->
<?php

$post_number = $_GET['id']; /* $post_number에 id값을 받아와 넣음*/
$sql = mq("select * from bulletin_board where id='" . $post_number . "'"); /* 받아온 id값을 선택 */
$board = $sql->fetch_array();

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>게시판-비밀번호 입력 </title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <?php include_once '../setting/header.php';?>
    </head>
<body>

    <form id="input_password" method="post">
        <p>비밀번호<input type="password" name="password_check"/> <input type="submit" value="확인"/></p>
    </form>

<?php
$board_password = $board['password'];
if (isset($_POST['password_check'])) //만약 pw_chk POST값이 있다면
{
    $input_password = $_POST['password_check']; // $pwk변수에 POST값으로 받은 pw_chk를 넣습니다.
    if ($input_password===$board_password) //다시 if문으로 DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
    {
       /* $input_password == $board_password;*/
        ?>
        <script type="text/javascript">location.replace("page_read_post.php?id=<?php echo $board["id"]; ?>");</script><!-- pwk와 bpw값이 같으면 read.php로 보내고 -->
        <?php
    } else { ?>
        <script type="text/javascript">alert('비밀번호가 틀립니다');</script><!--- 아니면 비밀번호가 틀리다는 메시지를 보여줍니다 -->
    <?php }
} ?>
</body>
</html>


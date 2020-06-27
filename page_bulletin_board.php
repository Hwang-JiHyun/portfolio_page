<?php
session_start();
include 'db_info.php';

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}

if(isset($_SESSION['id'])){
    $btn_write="글쓰기";
}else{
    $btn_write="";
}
$post_number = 0;
/*include $_SERVER['DOCUMENT_ROOT']."db_info.php";*/
$show_lock = "<img src='/img_file/eye-lock.png' alt='lock' title='lock' width='15' height='15'/>";

?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <!--todo 바꾸어 주어야 할 부분 -->
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <?php include_once '../setting/header.php';?>
</head>
<body>
<div id="board_area">

    <table class="list-table">
        <thead>
        <tr>
            <th width="70">NO</th>
            <th width="500">TITLE</th>
            <th width="100">DATE</th>
            <th width="100">HIT</th>
        </tr>
        </thead>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $sql = mq("select * from bulletin_board");
        //게시판 총 게시 글 수
        $row_num = mysqli_num_rows($sql);
        //게시글 번호 지정해 주기 위해
        $post_number = $row_num;
        //한 페이지에 보여줄 개수
        $list = 5;
        //블록당 보여줄 페이지 개수
        $block_count = 5;

        $block_num = ceil($page / $block_count); // 현재 페이지 블록 구하기
        $block_start = (($block_num - 1) * $block_count) + 1; // 블록의 시작 번호
        $block_end = $block_start + $block_count - 1; //블록 마지막 번호

        // 페이징한 페이지 수 구하기
        $total_page = ceil($row_num / $list);

        //만약 블록의 마지박 번호가 페이지 수 보다 많다면 마지막 번호는 페이지 수
        if ($block_end > $total_page) {
            $block_end = $total_page;
        }

        //블럭 총 개수
        $total_block = ceil($total_page / $block_count);
        //시작번호 (page-1)에서 $list(한 페이지에 보여줄 개수)를 곱한다.
        $start_num= ($page - 1) * $list;

        $sql_post = mq("select * from bulletin_board order by id desc limit $start_num, $list");
        while ($board = $sql_post->fetch_array()) {
            $title = $board["title"];
           /* $sql3 = mq("select * from reply where post_number='" . $board['id'] . "'");
            $rep_count = mysqli_num_rows($sql3);*/
            ?>
            <tbody>
            <tr>
                <td width="70"><?php echo $board['id']; ?></td>
               <!-- <td width="70"><?php /*echo $post_number; */?></td>-->
                <td width="500">

                    <?php
                    if ($board['lock_post'] == "1")
                    { ?><a href='unlock_post.php?id=<?php echo $board["id"]; ?>'><?php echo $title,  $show_lock;
                        }else{ ?>
                        <a href='page_read_post.php?id=<?php echo $board["id"]; ?>'><?php echo $title;
                            } ?></a>
                </td>
                <td width="100"><?php echo $board['date'] ?></td>
                <td width="100"><?php echo $board['hit']; ?></td>
            </tr>
            </tbody>
        <?php  /*$post_number --;*/} ?>
    </table>

    <!--페이징 넘버-->
    <div id="page_num">
        <ul>
            <?php
            if ($page <= 1) { //만약 page가 1보다 크거나 같다면
                echo "<li class='fo_re'>FIRST</li>"; //처음이라는 글자에 빨간색 표시
            } else {
                echo "<li><a href='?page=1'>FIRST</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
            }


            if ($page <= 1) { //만약 page가 1보다 크거나 같다면 빈값
            } else {
                $pre = $page - 1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                echo "<li><a href='?page=$pre'>PRE</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
            }


            for ($i = $block_start; $i <= $block_end; $i++) {
                //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록 시작번호가 마지막 블록보다 작거나 같을 때까지 $i를 반복시킨다
                if ($page == $i) { //만약 page가 $i와 같다면
                    echo "<li class='show_red'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
                } else {
                    echo "<li><a href='?page=$i'>[$i]</a></li>"; //아니라면 $i
                }
            }


            if ($block_num >= $total_block) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
            } else {
                $next = $page + 1; //next변수에 page + 1을 해준다.
                echo "<li><a href='?page=$next'>NEXT</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
            }


            if ($page >= $total_page) { //만약 page가 페이지수보다 크거나 같다면
                echo "<li class='show_red'>LAST</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
            } else {
                echo "<li><a href='?page=$total_page'>LAST</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
            }
            ?>
        </ul>
    </div>
    <div id="write_btn">
        <a href="write_pending.php">
            <button><?=$btn_write?></button>
        </a>
    </div>
</div>
</body>
</html>
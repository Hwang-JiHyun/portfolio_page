<?php
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <?php include_once '../setting/header.php';?>
</head>
<body>
<div id="board_write">
    <h1><a href="/">자유게시판</a></h1>
    <h4>글을 작성하는 공간입니다.</h4>
    <div id="write_area">
        <form action="write_ok.php" method="post">
            <div id="in_title">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
            </div>
            <div class="wi_line"></div>
            <div class="wi_line"></div>
            <div id="in_content">
                <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
            </div>
            <div id="in_pw">
                <input type="password" name="password" id="upw"  placeholder="비밀번호" required />
            </div>
            <div id="in_lock">
                <input type="checkbox" value="1" name="lock" />비밀글
            </div>
            <div class="bt_se">
                <button type="submit">글 작성</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
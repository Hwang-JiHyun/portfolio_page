<?php
include "db_info.php";

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}

$post_number = $_GET['id'];
$sql = mq("select * from bulletin_board where id='$post_number';");
$board = $sql->fetch_array();
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판 수정</title>
    <link href="writingStyle.css" rel="stylesheet" type="text/css"/>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <?php include_once '../setting/header.php';?>
</head>
<body>
<!--<div id="board_write">
    <div id="write_area">
        <form action="modify_ok.php?idx=<?php /*echo $post_number; */?>" method="post">
            <div id="in_title">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php /*echo $board['title']; */?></textarea>
            </div>
            <div class="wi_line"></div>

            <div id="in_content">
                <textarea name="content" id="ucontent" placeholder="내용" required><?php /*echo $board['content']; */?></textarea>
            </div>
            <div id="in_pw">
                <input type="password" name="pw" id="upw"  placeholder="비밀번호" required />
            </div>
            <div class="bt_se">
                <button type="submit">글 작성</button>
            </div>
        </form>
    </div>
</div>-->

<div class="writing_board">
    <form onsubmit="return writefunction();" action="modify_ok.php?id=<?php echo $post_number; ?>" method="post">
        <label for="summernote">제목 : <input id="title" placeholder="제목을 입력하세요" type="text" name="title" value="<?php echo $board['title'];?>"></label>
        <textarea id="summernote" name="content" required><?php echo $board['content']; ?></textarea>
        <div id="in_pw">
            <input type="password" name="password" id="upw" placeholder="비밀번호" required>
        </div>
        <div id="in_lock">
            <input type="checkbox" value="1" name="lock"/>비밀글
        </div>
        <button id="done" type="submit">글 작성 완료</button>
    </form>
</div>

<script>
    'use strict';
    // $('.summernote').summernote({
    //     height: 500,
    //     minHeight: null,
    //     maxHeight: null,
    //     lang: 'ko-KR',
    //     onImageUpload: function (files, editor, welEditable) {
    //         sendFile(files[0], editor, welEditable);
    //     }
    // });
    let writefunction = function () {
        let markup = $('#summernote').summernote('code');
        return markup;
    }

    $(document).ready(function () {
        $('#summernote').summernote({
            width: 700,
            height: 300,                 // 에디터 높이
            minHeight: null,             // 최소 높이
            maxHeight: null,             // 최대 높이
            focus: true,                  // 에디터 로딩후 포커스를 맞출지 여부
            lang: "ko-KR",					// 한글 설정
            placeholder: '최대 2048자까지 쓸 수 있습니다'
            /* callbacks: {
                 onImageUpload : function(files, editor, welEditable) {
                     console.log('image upload:', files);
                     sendFile(files[0], editor, welEditable);
                 }
             }*/
        });

        /*        function sendFile(file,editor,welEditable) {
                    let data = new FormData();
                    data.append("file", file);
                    $.ajax({
                        url: "save_image.php", // image 저장 소스
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(data){
        //       alert(data);
                            let image = $('<img>').attr('src', '' + data); // 에디터에 img 태그로 저장을 하기 위함
                            $('.summernote').summernote("insertNode", image[0]); // summernote 에디터에 img 태그를 보여줌
        //       editor.insertImage(welEditable, data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus+" "+errorThrown);
                        }
                    });
                }

                $('form').on('submit', function (e) {
                    e.preventDefault();
        //     alert($('.summernote').summernote('code'));
        //     alert($('.summernote').val());
                });*/
    });

</script>
</body>
</html>
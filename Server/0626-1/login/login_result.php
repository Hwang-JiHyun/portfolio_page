<?php
include 'db_info.php';
session_start();

$id = $_REQUEST['id'];
$password = $_REQUEST['password'];
//체크가 안 된 상태로 전송 하게 되면 오류가 뜨게 됨

$sql = "select * from administer";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $filtered = array(
        'id' => htmlspecialchars($row['id']),
        'password' => htmlspecialchars($row['password'])
    );
}

//관리자 id가 맞을 경우
if ($id === $filtered['id']) {
    //아이디 저장 check 박스에 체크를 했으면 아이디를 저장시켜 줌
    if (isset($_REQUEST['save_id'])) {
        //쿠키 변수, 할당할 값,유효 기한(현재 시간 부터 +x초(시간) 뒤 까지)
        //쿠키는 html 이나 head 태그 이전에 사용 해야 한다
        setcookie("id", $id, time() + 60);
    }

    //관리자 password가 맞을 경우
    if ($password === $filtered['password']) {
        print "관리자 로그인이 되었습니다";
        $_SESSION['id'] = $id;
        $_SESSION['name'] = "관리자 모드";
        //절대 주소를 써야함
        header("Location:http://192.168.56.101/main/page_main.php");
    } else {
        ?>
        <script>
            alert("password를 다시 입력해 주세요");
            history.back();
        </script>
        <?php
    }

    //관리자 id가 아닐 경우
} else {
    ?>
    <script>
        alert("id를 다시 입력해 주세요");
        history.back();
    </script>
    <?php
}
?>
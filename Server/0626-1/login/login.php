<?php
include 'db_info.php';

$id = $_REQUEST['id'];
$password=$_REQUEST['password'];


if($id=='admin'&& $password=="1234"){
    print "로그인 완료";
}else {
    print "로그인 실패";
}

?>
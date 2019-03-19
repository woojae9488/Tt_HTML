<html>
<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '00000000',
    'opentutorial',
    '3307'
);
$sql = "
INSERT INTO topic(title, description, created)
VALUES('{$_POST['title']}','{$_POST['description']}',NOW())
";
if (!mysqli_query($conn, $sql)){
    echo '저장하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
}else{
    echo '저장 성공!! <a href="index.php">돌아가기</a>';
}
?>

</html> 
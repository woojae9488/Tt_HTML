<html>
<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '00000000',
    'opentutorial',
    '3307'
);

$filtered = array(
    'title' => mysqli_real_escape_string($conn, $_POST['title']),
    'description' => mysqli_real_escape_string($conn, $_POST['description']),
    'author_id' => mysqli_real_escape_string($conn, $_POST['author_id'])
);
$sql = "
INSERT INTO topic(title, description, created, author_id)
VALUES('{$filtered['title']}','{$filtered['description']}',NOW(), {$filtered['author_id']})
";

if (!mysqli_query($conn, $sql)) {
    echo '저장하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
} else {
    echo '저장 성공!! <a href="index.php">돌아가기</a>';
    // echo $sql;
}
?>

</html> 
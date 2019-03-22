<html>
<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '00000000',
    'opentutorial',
    '3307'
);

settype($_POST['id'], 'integer');
$filtered = array(
    'id' => mysqli_real_escape_string($conn, $_POST['id']),
);
$sql = "DELETE FROM topic WHERE author_id = {$filtered['id']}";
if (!mysqli_query($conn, $sql)) {
    echo '삭제하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
}
$sql = "DELETE FROM author WHERE id = {$filtered['id']}";
if (!mysqli_query($conn, $sql)) {
    echo '삭제하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
} else {
    header("Location: author.php");
    // echo $sql;
}
?>

</html> 
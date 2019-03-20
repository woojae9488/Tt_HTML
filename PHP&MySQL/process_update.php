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
    'title' => mysqli_real_escape_string($conn, $_POST['title']),
    'description' => mysqli_real_escape_string($conn, $_POST['description'])
);
$sql = "
UPDATE topic SET 
title = '{$filtered['title']}',
description = '{$filtered['description']}'
WHERE id = {$filtered['id']}
";
if (!mysqli_query($conn, $sql)) {
    echo '갱신하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
} else {
    echo '갱신 성공!! <a href="index.php">돌아가기</a>';
    // echo $sql;
}
?>

</html> 
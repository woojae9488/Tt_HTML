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
    'name' => mysqli_real_escape_string($conn, $_POST['name']),
    'profile' => mysqli_real_escape_string($conn, $_POST['profile'])
);
$sql = "
UPDATE author SET 
name = '{$filtered['name']}',
profile = '{$filtered['profile']}'
WHERE id = {$filtered['id']}
";
if (!mysqli_query($conn, $sql)) {
    echo '갱신하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
} else {
    header("Location: author.php?id=" . $filtered['id']);
    // echo $sql;
}
?>

</html> 
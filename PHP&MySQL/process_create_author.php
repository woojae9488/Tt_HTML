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
    'name' => mysqli_real_escape_string($conn, $_POST['name']),
    'profile' => mysqli_real_escape_string($conn, $_POST['profile'])
);
$sql = "
INSERT INTO author(name, profile)
VALUES('{$filtered['name']}', '{$filtered['profile']}')
";

if (!mysqli_query($conn, $sql)) {
    echo '저장하는 과정에 문제 발생!!';
    error_log(mysqli_error($conn)); // write error to apache error log
} else {
    header('Location: author.php'); // redirection
    // echo $sql;
}
?>

</html> 
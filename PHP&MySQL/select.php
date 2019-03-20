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
SELECT * FROM topic LIMIT 100
";
if (!($result = mysqli_query($conn, $sql))) {
    echo "파일 읽기 실패!!";
    error_log(mysqli_error($conn));
}
while ($row = mysqli_fetch_array($result)) {
    echo '<h2>' . $row['title'] . '</h2>';
    echo $row['description'] . '<br>';
}
?>

</html> 
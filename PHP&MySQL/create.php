<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '00000000',
    'opentutorial',
    '3307'
);
$sql = "SELECT * FROM topic LIMIT 100";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "정보 불러오기 실패!!";
    error_log(mysqli_error($conn));
}

$list = "";
while ($row = mysqli_fetch_array($result)) {
    // <li><a href="index.php?id=11">HTML</a></li>
    $escaped_title = htmlspecialchars($row['title']);
    $list = $list . "<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
}

$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);
$select_form = '<select name="author_id">';
while ($row = mysqli_fetch_array($result)) {
    $select_form .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}
$select_form .= '</select>';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>WEB</title>
</head>

<body>
    <h1><a href="index.php">WEB</a></h1>
    <ol>
        <?= $list ?>
    </ol>
    <form action="process_create.php" method="POST">
        <p><input type="text" name="title" placeholder="title"></p>
        <p><textarea name="description" placeholder="description"></textarea></p>
        <?= $select_form ?>
        <p><input type="submit"></p>
    </form>
</body>

</html> 
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

$article = array(
    'title' => 'Welcome',
    'description' => 'Hello, WEB'
);
$update_link = '';
if (isset($_GET['id'])) {
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM topic WHERE id ={$filtered_id} LIMIT 100";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = htmlspecialchars($row['title']);
    $article['description'] = htmlspecialchars($row['description']);


    $update_link = '<a href="update.php?id=' . $_GET['id'] . '">update</a>';
}
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
    <form action="process_update.php" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <p><input type="text" name="title" placeholder="title" value="<?= $article['title'] ?>"></p>
        <p><textarea name="description" placeholder="description"><?= $article['description'] ?></textarea></p>
        <p><input type="submit"></p>
    </form>
</body>

</html> 
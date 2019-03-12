<!DOCTYPE html>
<html>

<head>
    <title>index</title>
    <meta charset="utf-8">
</head>

<body>
    <h1><a href="index.php">WEB</a></h1>
    <?php
    $list = scandir('data');
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i] != '.' && $list[$i] != '..') {
            ?>
    <li><a href="index.php?id=<?= $list[$i] ?>"><?= $list[$i] ?></a></li>
    <?php

}
}
?>
    <h2>
        <?php
        if (isset($_GET['id'])) {
            echo $_GET['id'];
        } else {
            echo "Welcome";
        }
        ?>
    </h2>
    <?php
    if (isset($_GET['id'])) {
        echo file_get_contents("data/" . $_GET['id']);
    } else {
        echo "Hello, PHP";
    }
    ?>
</body>

</html> 
<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '00000000',
    'opentutorial',
    '3307'
);

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>WEB</title>
</head>

<body>
    <h1><a href="index.php">WEB</a></h1>
    <p><a href="index.php">topic</a></p>
    <table border="1">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>profile</td>
            <td></td>
            <td></td>
        </tr>
        <?php
        $sql = "SELECT * FROM author";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $filtered = array(
                'id' => htmlspecialchars($row['id']),
                'name' => htmlspecialchars($row['name']),
                'profile' => htmlspecialchars($row['profile'])
            );
            ?>
        <tr>
            <td><?= $filtered['id'] ?></td>
            <td><?= $filtered['name'] ?></td>
            <td><?= $filtered['profile'] ?></td>
            <td><a href="author.php?id=<?= $filtered['id'] ?>">update</a></td>
            <td>
                <form action="process_delete_author.php" method="post" onsubmit="if(!confirm('sure?')){return false;}">
                    <input type="hidden" name="id" value="<?= $filtered['id'] ?>">
                    <input type="submit" value="delete">
                </form>
            </td>
        </tr>
        <?php

    }
    ?>
    </table>
    <?php
    $escape = array(
        'name' => '',
        'profile' => ''
    );
    $label_subit = 'Create author';
    $form_action = 'process_create_author.php';
    $form_id = '';
    if (isset($_GET['id'])) {
        $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
        settype($filtered_id, 'integer');
        $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $escape['name'] = htmlspecialchars($row['name']);
        $escape['profile'] = htmlspecialchars($row['profile']);
        $label_subit = 'Update author';
        $form_action = 'process_update_author.php';
        $form_id = '<input type="hidden" name="id" value="' . $filtered_id . '">';
    }
    ?>
    <form action="<?= $form_action ?>" method="post">
        <?= $form_id ?>
        <p><input type="text" name="name" placeholder="name" value="<?= $escape['name'] ?>"></p>
        <p><textarea name="profile" placeholder="profile"><?= $escape['profile'] ?></textarea></p>
        <p><input type="submit" value="<?= $label_subit ?>"></p>
    </form>
</body>

</html> 
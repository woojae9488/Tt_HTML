<?php
function print_title()
{
    if (isset($_GET['id'])) {
        echo $_GET['id'];
    } else {
        echo "Welcome";
    }
}

function print_description()
{
    if (isset($_GET['id'])) {
        echo file_get_contents("data/" . $_GET['id']);
    } else {
        echo "Hello, PHP";
    }
}

function print_list()
{
    $list = scandir("./data");
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i] != '.' && $list[$i] != '..')
            echo "<li><a href='index.php?id=$list[$i]'>$list[$i]</a></li>\n";
    }
}
?>


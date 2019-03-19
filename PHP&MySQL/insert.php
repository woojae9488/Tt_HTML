<html>
<?php
$conn = mysqli_connect("localhost", "root", "00000000", "opentutorial", "3307");
$sql = "
INSERT INTO topic(title, description, created)
VALUE( 'MySQL', 'MySQL is ...', NOW())
";
if (!mysqli_query($conn, $sql))
    echo mysqli_error($conn);
?>
</html> 
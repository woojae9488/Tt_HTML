<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>CSS</title>
</head>

<body>
    <h1>Cross Site Scripting</h1>
    <?php
    echo htmlspecialchars('<script>alert("babo");</script>');
    ?>
</body>

</html> 
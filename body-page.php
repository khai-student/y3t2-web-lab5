<?php
spl_autoload_register(function ($class_name) {
    include '/classes/' . $class_name . '.php';
});
?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
    <meta charset="UTF-8">
    <title>Fineminds Marketing Solutions Website Template</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div class="border">
    <div id="bg">
        background
    </div>
    <div class="page">
        <?php
        require_once "/inc/sidebar.php";
        ?>
        <div class="body">
            <div>
                <div></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php $link = mysql_connect('localhost', 'root'); ?>
<html>
<head>
    <title>Hello world!</title>
    <style>
    body {
        text-align: center;
    }
    </style>
</head>
<body>
    <h2 align="center">PHP Version: <?php echo phpversion();?></h2>
    <?php if(!$link) { ?>
        <h2>Can't connect to local MySQL Server!</h2>
    <?php } else { ?>
        <h2>MySQL Server version: <?php echo mysql_get_server_info(); ?></h2>
    <?php } phpinfo();?>
</body>
</html>
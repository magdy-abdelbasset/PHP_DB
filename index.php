<?php require_once('./autoload.php');  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php $db = new Src\DB();
    // $db->setColumns(["id","email","password"]);
    print_r($db->table('tags')->insert([
        // "id"=>"2",
        "name"=>"test",
        "name_ar"=>"test_ar"]));
    ?>
</body>
</html>
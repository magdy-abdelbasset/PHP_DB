<?php require_once('./autoload.php');  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/table.css">
</head>

<body>
    <?php $db = new Src\DB();
    // $db->setColumns(["id","email","password"]);

    $data = $db->table('tags')->get(true);
    print_r($data);
    ?>
    <?php include("./Views/table.php"); ?>
    <?php
    /* $db = new Src\DB();
    // $db->setColumns(["id","email","password"]);
    print_r($db->table('tags')->where("id",'=',2)->update([
        "name"=>"test",
        "name_ar"=>"test_ar_update"]));
    */ ?>
</body>

</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aaaae</title>
    <style>
        :root {
            color-scheme: dark;
        }
    </style>
</head>
<body>
    <?php
        require_once "../Tema3/utils.php";
        if(1){
            require_once "./db_mysqli.php";
            $db = DB::getInstance();
            $db->execute("select * from aaa");
            #$db->execute("INSERT INTO aaa (num) VALUES (?), (?), (?), (?), (?)",[9,8,7,6,5]);
            $result = $db->fetchAll(); 
            echo HTML::matrix2table($result,array_keys($result[0]));
        }else{
            if(isset($_FILES["file"])){
                $file = $_FILES["file"];
                var_dump($file);
                var_dump(file_get_contents($file["tmp_name"]));
            }
    ?>
    <form method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="file">
    <input type="submit" value="Upload Image" name="submit">
    </form>
    <?php } ?>
</body>
</html>
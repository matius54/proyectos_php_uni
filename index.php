<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="st.css">
    <title>Electiva 2023</title>
</head>
<body>
    <?php
    $info = json_decode(file_get_contents("info.json"),true);
    foreach ($info as $value) {
        $title = $value["name"];
        $info = htmlspecialchars($value["info"]);
        $desc = htmlspecialchars($value["desc"]);
        echo "<h1>$title</h1><strong>$info</strong><br><br><i>$desc</i><br>";
        foreach($value["exercises"] as $idx => $exercise){
            $idx++;
            $name = htmlspecialchars($exercise["name"]);
            if($name==="")continue;
            echo "<br><span>$idx - </span><a href=\"./$title/$idx.php\" name=\"$idx-$title\">$name</a>";
            if(isset($exercise["extra"])){
                foreach ($exercise["extra"] as $extra) {
                    $sufix = $extra["suff"];
                    $nvName = $extra["name"]; 
                    echo "<strong> / </strong><a href=\"./$title/$idx$sufix.php\" name=\"$idx-$title\"><i>$nvName</i></a>";
                }
            }
            echo "<ul>";
            foreach($exercise["steps"] as $step){
                echo "<li>".htmlspecialchars($step)."</li>";
            }
            echo "</ul>";
        }
    }
    ?>
</body>
</html>
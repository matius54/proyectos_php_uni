<?php include "start.php" ?>
<form method="POST" class="cnt" enctype="multipart/form-data">
    <label>Suba un archivo: <input type="file" name="file"></label>
    <input type="submit">
</form>
<div class="cnt">
    <i>
    <?php
        if(isset($_FILES["file"])){
            $file = $_FILES["file"];
            $fileType = $file["type"];
            $ext = explode("/",$fileType);
            $ext = $ext[0];
            $allowedTypes = ["audio","video","image"];
            if(in_array($ext,$allowedTypes)){
                $type = $ext;
                $mimeType = $file["type"];
                $baseDir = "../file_tmp";
                $temp_name = $file["name"];
                $new_name = explode('.', $temp_name);
                $new_name = end($new_name);
                $dirname = scandir($baseDir);
                $dirname = end($dirname);
                if($dirname==="..")$dirname = "image.tmp";
                if(move_uploaded_file($file["tmp_name"],"$baseDir/$dirname")){
                    rename("$baseDir/$dirname","$baseDir/file.$new_name");
                    echo "subido correctamente";
                }else{
                    echo "ha ocurrido un error inesperado";
                }
            }else{
                echo "el archivo no es valido";
            }
        }else{
            echo "no se ha recibido nada aun";
        }
    ?>
    </i>
</div>
<div class="cnt">
    <p>archivo subido</p>
    <?php
        if(isset($new_name)){
            switch($type){
                case "image":
                    echo "<img src=\"$baseDir/file.$new_name\" width=\"250\">";
                break;
                case "audio":
                    echo "<audio controls><source src=\"$baseDir/file.$new_name\" type\"$mimeType\"></audio>";
                break;
                case "video":
                    echo "<video width=\"250\" controls><source src=\"$baseDir/file.$new_name\" type\"$mimeType\"></video>";
                break;
            }
            echo "<a href=\"$baseDir/file.$new_name\" target=\"_blank\">ver</a>";
            echo "<a href=\"$baseDir/file.$new_name\" download>descargar</a>";
        }
    ?>
</div>
<?php include "end.html" ?> 
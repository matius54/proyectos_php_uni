<?php
    require_once "db_connection.php";

    session_start();
    if (isset($_SESSION["username"])){
        header("Location: index.php");
        exit;
    }

    $errors = array();
    $messages = array();

    if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
    }

    if(empty($username) || empty($password)){
        $errors[] = "Debes ingresar tu nombre de usuario y contraseña";
    }else{
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        
        if($result->num_rows === 1){
            $user = $result->fetch_assoc();

            if(password_verify($password,$user["password"])){
                $_SESSION["username"] = $user["username"];
                header("Location: index.php");
                exit;
            } else {
                $errors[] = "contraseña incorrecta. por favor, intente nuevamente.";
            }
        }else{
            $errors[] = "El nombre de usuario ingresado no existe";
        }
    }

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])){
        $username = $_POST["reg_username"];
        $password = $_POST["reg_password"];
        $email = $_POST["email"];

        if(empty($username) || empty($password) || empty($email)){
            $errors[] = "Debes completar todos los campos del formulario de registro";
        }else{
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $errors[] = "El nombre de usuario ingresado ya está en uso";
            }else{
                $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password, email) VALUES ('$username','$password','$email')";
                $result = $conn->query($sql);
                if($result){
                    $messages[] = "Registro exitoso, ahora puedes iniciar sesion";
                }else{
                    $errors[] = "Ocurrio un error durante el registro, por favor, intenta nuevamente";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Inicar sesion</h1>
        <?php if(!empty($errors)){ ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($errors as $err) echo $err."<br>" ?>
        </div>
        <?php }
        if(!empty($messages)) { ?>
        <div class="alert alert-success" role="alert">
            <?php foreach($messages as $mes) echo $mes."<br>" ?>
        </div>
        <?php } ?>
        <ul class="nav nav-tabs">
            <li class="nav nav-item">
                <a class="nav-link <?php if(!isset($_POST["register"])) echo "active" ?>"
                    id="login-tab" data-toggle="tab" href="#login-form"
                >Iniciar sesion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(!isset($_POST["register"])) echo "active" ?>"
                    id="register-tab" data-toggle="tab" href="#register-form"
                >Registrarse</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-panel fade <?php if(!isset($_POST["register"])) echo "show active" ?>"
                id="login-form" role="tabpanel">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="form-group">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Iniciar sesion</button>    
            </form>
            </div>
            <div class="tab-panel fade <?php if(!isset($_POST["register"])) echo "show active" ?>"
                id="register-form" role="tabpanel">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="form-group">
                    <label for="reg_username">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="reg_username" name="reg_username" required>
                </div>
                <div class="form-group">
                    <label for="reg_password">Contraseña:</label>
                    <input type="password" class="form-control" id="reg_password" name="reg_password" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            <button type="submit" class="btn btn-primary" name="register">Registrarse</button>    
        </form>
        </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
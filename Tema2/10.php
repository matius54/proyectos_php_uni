<?php
$user = "admin123";
$pass = "123456";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    header("Content-Type: application/json; charset=utf-8");
    $data = json_decode(file_get_contents("php://input"));
    $response = [];
    $userOK = false;
    $passwordOK = false;
    foreach ($data as $key => $value) {
        switch($key){
            case "user":
                if($user === $value){
                    array_push($response,"Usuario valido");
                    $userOK = true;
                }else{
                    array_push($response,"Usuario invalido");
                }
            break;
            case "password":
                if($pass = $value){
                    array_push($response,"Clave valida");
                    $passwordOK = true;
                }else{
                    array_push($response,"Clave invalida");
                }
            break;
        }
    }
    echo json_encode(["response" => implode(" y ",$response),"auth" => $userOK && $passwordOK]);
    die();
}
?>
<?php include "start.php" ?>
<form method="POST" class="cnt" autocomplete="off">
    <label>Usuario: <input type="text" name="user" placeholder="<?php echo $user ?>"></label>
    <label>Contraseña: <input type="password" name="password" placeholder="<?php echo $pass ?>"></label>
    <button>Iniciar Sesión</button>
</form>
<div class="cnt"></div>
<script>
    document.querySelector("form.cnt > button").addEventListener("click",e=>{
        e.preventDefault();
        e.target.setAttribute("disabled","");
        let json2Send = {};
        document.querySelectorAll("form.cnt > label > input").forEach(e => json2Send[e.name] = e.value);
        fetch(window.location.href,
            {
                method: "post",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    'Accept': 'application/json'
                },
                body: JSON.stringify(json2Send)
            }
        )
        .then(response => response.json())
        .catch(err=>e.target.removeAttribute("disabled"))
        .then(response => {
            const exit = document.querySelector("div.cnt");
            const resp = document.createElement("p");
            resp.innerText = response["response"];
            const auth = document.createElement("p");
            auth.innerText = `autorizado: ${response["auth"]}`;
            exit.replaceChildren(resp,auth);
            e.target.removeAttribute("disabled");
        })
    })
</script>
<?php include "end.html" ?>
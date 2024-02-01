<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
    header("Content-Type: application/json; charset=utf-8");
    $data = json_decode(file_get_contents("php://input"));
    echo json_encode(["response"=>"ok","code"=>200]);
    die();
}
?>
<?php include "start.php" ?>
<form method="POST" class="cnt" autocomplete="off">
    <label>Usuario: <input type="text" name="user"></label>
    <label>Contraseña: <input type="password" name="password"></label>
    <button>Iniciar Sesión</button>
</form>
<script>
    document.querySelector("form.cnt > button").addEventListener("click",e=>{
        e.preventDefault();
        e.target.removeAttribute("disabled");
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
        .then(response => console.info(response))
    })
</script>
<?php include "end.html" ?>
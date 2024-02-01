<?php include "start.php" ?> 
<div class="cnt">
    <fieldset>
        <legend>Añadir campos</legend>
        <label>Nombre: <input type="text" id="name"></label>
        <button onclick="add(this)">Añadir</button>
    </fieldset>
</div>
<form method="POST" class="cnt" autocomplete="off">
    <input type="submit">
</form>
<div class="cnt">
    <?php 
    if(!empty($_POST)){
        foreach ($_POST as $key => $value) {
            echo "<p>$key: $value</p>";
        }
    }else{
        echo "<i>Sin campos</i>";
    }
    ?>
</div>
<script>
const add = (el) => {
    const nameIN = document.getElementById("name");
    const name = nameIN.value;
    if(name === "") return;
    let duplicated = false;
    document.querySelectorAll("form.cnt > label > input[type=text]").forEach(element => {
        if(name === element.name)duplicated = true;
    });
    if(duplicated)return;
    nameIN.value = "";
    const label = document.createElement("label");
    const input = document.createElement("input");
    const button = document.createElement("button");
    label.innerText = `${name}: `;
    button.innerText = "x";
    input.setAttribute("type","text");
    input.setAttribute("name",name);
    button.addEventListener("click",remove);
    label.appendChild(input);
    label.appendChild(button);
    document.querySelector("form.cnt > input[type=submit]").before(label);
}
const remove = (e)=>{
    e.preventDefault();
    e.target.parentElement.remove();
}
</script>
<?php include "end.html" ?> 
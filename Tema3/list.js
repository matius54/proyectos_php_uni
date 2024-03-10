const CONTROLLER = "./controller.php";
document.querySelectorAll(".list .button").forEach(element=>{
    element.addEventListener("click",(e)=>{
        const listItem = e.target.closest("li");
        const id = listItem.id;
        const button = e.target.closest(".button");
        if(button.classList.contains("accordion")){
            if(listItem.getAttribute("style")){
                listItem.removeAttribute("style");
            }else{
                listItem.setAttribute("style",`max-height: ${listItem.scrollHeight}px;`);
            }
            button.classList.toggle("open");
        }else if(button.classList.contains("edit")){
            //
        }else if(button.classList.contains("delete")){
            //
        }else if(button.classList.contains("check")){
            ajax(`${CONTROLLER}?action=task_toggle`,{id: parseInt(listItem.id)})
            .then(res => {
                if(res.isCompleted){
                    listItem.querySelector(".icon.button.check.off").removeAttribute("hidden");
                    listItem.querySelector(".icon.button.check.on").setAttribute("hidden","");
                    listItem.querySelector("h2").classList.add("completed");
                } else {
                    listItem.querySelector(".icon.button.check.off").setAttribute("hidden","");
                    listItem.querySelector(".icon.button.check.on").removeAttribute("hidden");
                    listItem.querySelector("h2").classList.remove("completed");
                }
            })
            .finally(()=>{});
        }
    });
});
document.querySelectorAll(".unixTimestamp").forEach(element => {
    const text = element.innerText;
    if(!text){
        element.innerText = "Desconocido";
        return;
    }
    const unixTimestamp = parseInt(element.innerText);
    const date = new Date(unixTimestamp);
    element.innerText = date.toLocaleString();
});

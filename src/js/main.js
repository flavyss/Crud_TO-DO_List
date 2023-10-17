const validate = () => {
    let form = document.querySelector("form")
    let name = document.querySelector("input[name=email]")
    let senha = document.querySelector("input[name=senha]")


    form.addEventListener("submit", (e) => {
        let nameValue = name.value
        let senhaValue = senha.value

        if (nameValue == "admin" && senhaValue == "admin"){
            alert("bem vindo")
        }
        else if(nameValue == '' || nameValue == ' ' || senhaValue == '' || senhaValue == ' '){
            alert("Preencha todos os campos");
            name.style.borderColor = "#ff0000";
            senha.style.borderColor = "#ff0000";
            e.preventDefault()
        }
        else{
            alert("Usuário não é válido, tente novamente")
            e.preventDefault()    
        }
    })
}

const menu = () => {
    let disp = document.querySelector(".disp")
    let campo = document.querySelector(".menuMobile ul")
    let fecha = document.querySelector(".fecha")

    disp.addEventListener("click", () => {
        if(campo.classList.contains("aparece")){
            campo.classList.remove("aparece")
        }
        else{
            campo.classList.add("aparece")
        }
    })
    
    fecha.addEventListener("click", () => {
        campo.classList.remove("aparece")
    })
}

menu()
validate()
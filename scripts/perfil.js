// Buscar dados do perfil do usuário
fetch("php/obterPerfil.php")
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("name").value = data.user.name;
            document.getElementById("email").value = data.user.email;
            document.getElementById("phone").value = data.user.phone;
            document.getElementById("nif").value = data.user.nif;
        } else {
            alert("Erro ao carregar perfil: " + data.message);
        }
    })
    .catch(error => console.error("Erro ao buscar perfil:", error));

document.getElementById("editButton").addEventListener("click", function() {
    let inputs = document.querySelectorAll("#profileForm input");
    inputs.forEach(input => input.removeAttribute("disabled"));
    document.getElementById("editButton").style.display = "none";
    document.getElementById("saveButton").style.display = "inline-block";
});

document.getElementById("profileForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    let formData = new FormData(this);

    fetch("php/atualizarPerfil.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Perfil atualizado com sucesso!");
            location.reload();
        } else {
            alert("Erro ao atualizar perfil: " + data.message);
        }
    })
    .catch(error => console.error("Erro:", error));
});

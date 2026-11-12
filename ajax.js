
function enviarRequisicao(metodo, url, dados, aoReceber) {

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log("Resposta do PHP: " + this.responseText);
                try {
                    aoReceber(JSON.parse(this.responseText));
                } catch (e) {
                    aoReceber({ sucesso: false, mensagem: "O PHP não devolveu um JSON válido." });
                }
            } else {
                aoReceber({ sucesso: false, mensagem: "Requisição falhou: " + this.status });
            }
        }
    };

    xmlhttp.open(metodo, url);
    xmlhttp.send(dados);
}

function pegarParametro(nome) {
    return new URLSearchParams(window.location.search).get(nome);
}

function mostrarMensagem(resposta) {
    let msg = document.getElementById("msg");
    msg.textContent = resposta.mensagem;
    msg.style.color = resposta.sucesso ? "green" : "red";
}

function adicionarCelula(tr, texto) {
    let td = document.createElement("td");
    td.textContent = texto;
    tr.appendChild(td);
    return td;
}

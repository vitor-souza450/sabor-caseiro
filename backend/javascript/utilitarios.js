export function alternarModal(abrir, mensagem = undefined) {
    if (mensagem) $("#mensagem-modal").text(mensagem);

    if (abrir) $("#modal").fadeIn(300);

    else $("#modal").fadeOut(300);

    $("#conteudo-modal").animate(abrir ? { top: "50%", opacity: 1 } : { top: 0, opacity: 0 }, 300);
}

export function validarID(id) {
    return id && !isNaN(id) && !id.includes(".") && Number(id) >= 1;
}

export function validarNome(nome) {
    return nome && nome.length <= 30;
}

export function validarTipo(tipo) {
    return ["1", "2", "3"].includes(tipo);
}

export function validarPreco(preco) {
    return (
        preco &&
        !isNaN(preco) &&
        !preco.includes(".") &&
        Number(preco) >= 1 &&
        Number(preco) <= 999.99
    ) || (preco.includes(".") && preco.split(".")[1].length <= 2);
}

export function limparCampo(campo) {
    campo.val("");

    if (window.screen.width >= 768) campo.trigger("focus");

    else campo.trigger("blur");
}
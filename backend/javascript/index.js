import { alternarModal, limparCampo, validarNome, validarTipo, validarPreco } from "./utilitarios.js";

$(function () {
    $("#formulario").on("submit", function () {
        const nome = $("#nome").val().trim();

        const tipo = $("#tipo").val().trim();

        const preco = $("#preco").val().trim();

        if (!$("#nome")[0].checkValidity() || !validarNome(nome)) {
            alternarModal(true, "O nome é obrigatório e deve conter até 30 caracteres.");

            limparCampo($("#nome"));

            return false;
        }

        if (!$("#tipo")[0].checkValidity() || !validarTipo(tipo)) {
            alternarModal(true, "Selecione uma opção.");

            limparCampo($("#tipo"));

            return false;
        }

        if (!$("#preco")[0].checkValidity() || !validarPreco(preco)) {
            alternarModal(true, "O preço é obrigatório e deve ser um número entre 1 e 999,99, com até duas casas decimais.");

            limparCampo($("#preco"));

            return false;
        }
    });
});
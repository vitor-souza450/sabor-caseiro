import {
    alternarModal,
    limparCampo,
    validarID
} from "./utilitarios.js";

$(function () {
    $("#formulario").on("submit", function () {
        const id = $("#id").val().trim();

        if (!$("#id")[0].checkValidity() || !validarID(id)) {
            alternarModal(
                true,
                "Erro: O ID é obrigatório e deve ser um número inteiro a partir de 1."
            );
            limparCampo($("#id"));
            return false;
        }
    });
});
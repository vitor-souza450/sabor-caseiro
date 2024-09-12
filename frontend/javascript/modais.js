import { alternarModal } from "./utilitarios.js";

$(function () {
    $(document).on("click", function (event) {
        if ($(event.target).is("#modal")) alternarModal(false);
    });

    $(document).on("keydown", function (event) {
        if (event.key === "Escape") alternarModal(false);
    });

    $("#botao-fechar-modal").on("click", function () {
        alternarModal(false);
    });
});
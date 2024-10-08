$(function () {
    $("#pesquisa").on("input", function () {
        const pesquisa = $(this).val().trim();

        let temPesquisa = false;

        $(".linha-corpo-tabela").each(function () {
            const textoLinhaTabela = $(this).text();

            if (textoLinhaTabela.toLowerCase().includes(pesquisa.toLowerCase())) {
                $(this).css("display", "table-row");

                temPesquisa = true;
            } else {
                $(this).css("display", "none");
            }
        });

        if (!temPesquisa) {
            $("#area-tabela").css("display", "none");

            $("#mensagem-sem-pesquisa").css("display", "block");
        } else {
            $("#area-tabela").css("display", "block");

            $("#mensagem-sem-pesquisa").css("display", "none");
        }
    });
});
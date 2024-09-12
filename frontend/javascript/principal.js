$(function () {
    $(window).on("resize", function () {
        if (this.screen.width < 768) {
            $("#area-navegacao").slideUp(300);
            $("#botao-menu").find(".bi").removeClass("bi-x");
            $("#botao-menu").find(".bi").addClass("bi-list");
        } else {
            $("#area-navegacao").css("display", "block");
        }
    });

    $("#botao-menu").on("click", function () {
        $("#area-navegacao").slideToggle(300);
        $(this).find(".bi").toggleClass("bi-list bi-x");
    });
});
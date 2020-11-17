//Load more
$(function () {
    var page = 1;

    $("#load-more").on("click", function () {
        page++;

        $.ajax({
            url: "/document/list",
            data: {
                page: page
            },
            success: function (html) {
                $("#listDocument").append(html);
            }
        });
    })
})
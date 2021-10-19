function Getmore(classAttr = ".comments_list") {

    $(".refresh_button").hide();
    $(".refresh_gif").show();
    var href_next = $('.navigations a[rel="next"]').attr('href');
    if (href_next) {
        $.ajax({
            type: "get",
            url: href_next,
            accept: "application/json",
            data: '',
            dataType: "json",
            success: function (data) {
                if (data.view) {
                    var nav = classAttr + " .navigations";
                    $(nav).remove();
                    $(classAttr).append(data.view);
                }
            },
            error: function (req, status, error) {
                console.log(error);
            }
        });
    }else{
        $(".navigations button").attr('onclick','');
        $(".navigations ").html('');

    }
}


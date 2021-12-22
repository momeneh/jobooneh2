$(document).ready(function () {
    $('td').delegate('a.confirm_user', 'click', function (e) {
        e.preventDefault();
        $("#dialog_id_product").val($(this).attr('id'));
        dialog.dialog("open")
    });
    function send_notify() {
        if ($( "#description" ).val().length !== 0 ){
            var desc = $( "#description" ).val();
            var id_product = $("#dialog_id_product").val();
            $.ajax({
                type:'post',
                url: url,
                data:{desc,id_product},
                dataType : 'json',
                //can send multipledata like {data1:var1,data2:var2,data3:var3
                //can use dataType:'text/html' or 'json' if response type expected؟
                success:function(response){
                    demo.showNotification('top','left',created,0);
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    demo.showNotification('top','left',error_happened,4,0);
                    return false;

                }
            })

            dialog.dialog("close");
        }
        // return ;
    }

    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        width: 350,
        modal: true,
        buttons: {
            "send": send_notify,
            Cancel: function () {
                dialog.dialog("close");
            }
        },
        close: function () {
            form[0].reset();
        }
    });

    form = dialog.find("form").on("submit", function (event) {
        event.preventDefault();
        send_notify();
    });
});

$(document).ready(function () {
    $(".starability-growRotate > input").click(function () {
        var s = $( "#star_rate_form" ).attr("route");
        rate = $(this).val();
        qu = q.replace('::rate',rate);
        id = $("#record_id").attr("val_id");
        if( confirm(qu)){
            $.ajax({
                url: s,
                type:"POST",
                dataType: "json",
                data: {
                    'rate': rate,
                    'id': id
                },
                success:function(data){
                    // console.log(data);
                    // process on data
                    demo.showNotification('bottom','center',data.msg,1,'tim-icons icon-satisfied');
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    // console.log('error');
                    demo.showNotification('bottom','center',"something is broken ",2,'tim-icons icon-alert-circle-exc');
                }

            });
        }
    })
});

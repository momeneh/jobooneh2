$(document).ready(function () {

    /*------------ master detail ---------------*/
    AssignUploadImage(0);
    var tr_htm = $( "#image10001" ).html();
    if(row_number>0) {
        for (let i = 1; i <= row_number-1; i++) {
            AssignUploadImage(i);
        }
    }
    $("#add_row").click(function(e){
        e.preventDefault();
        $('#image' + row_number).html(tr_htm).find('td:first-child');
        $('#images_table').append('<tr id="image' + (row_number + 1) +'"></tr>');
        $('#image' + row_number).find('a:first').attr('id', row_number);
        AssignUploadImage(row_number);
        row_number++;
    });

    $('#images_table').delegate('a.btn-remove','click', function(e){
        let id = $(this).attr("id");
        e.preventDefault();
        if (row_number > 1) {
            RemoveImage(id);
            $("#image" + (id)).html('');
            row_number--;
        }
    });
    /*------------ master detail ---------------*/


    $('#pre_pay').hide();
    $('#duration').hide();
    $('#sell_status').on('change', ShowHideDiv()).trigger('change');
    $('#sell_status').on('change', ShowHideDiv()).trigger('change');

});

function ShowHideDiv() {
    var SelectedValue = $('#sell_status').val();
    if (SelectedValue == 1) {
        $('#currency-field').val('');
        $('#pre_pay').hide();
        $('#duration_box').val('');
        $('#duration').hide();
    }
    else if (SelectedValue == 2){
        $('#pre_pay').show();
        $('#duration').show();
    }
}

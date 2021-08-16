function escapeTags( str ) {
    return String( str )
        .replace( /&/g, '&amp;' )
        .replace( /"/g, '&quot;' )
        .replace( /'/g, '&#39;' )
        .replace( /</g, '&lt;' )
        .replace( />/g, '&gt;' );
}

function RemoveImage(rowNumber){
    var img = $( "#picbox"+rowNumber+" > img" ).attr('src');
    var msgbox = $('#msgBox'+rowNumber);
    $.ajax({

        type:"POST",
        url: url_remove,
        data:{img:img},
        dataType : 'json',
        //can send multipledata like {data1:var1,data2:var2,data3:var3
        //can use dataType:'text/html' or 'json' if response type expected
        success:function(response){
            // process on data
            if ( response.success === true ) {
                msgbox.html( '');
                // $('#picbox'+rowNumber).html('');
                $( "#picbox"+rowNumber+"> img").attr( 'src','' );
                $('#uploadBtn'+rowNumber).show();
                $('#uploadBtn'+rowNumber).attr('title', 'Choose File');
                $('#removeBtn'+rowNumber).hide();
            }  else {
                if ( response.msg )  {
                    msgbox.html(escapeTags( response.msg ));
                } else {
                   msgbox.html('An error occurred.');
                }
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            msgbox.html(jqXHR.responseText);
            if(errorThrown == 'Not Found') {
                $('#uploadBtn'+rowNumber).show();
            }
        }
    })

}

function AssignUploadImage(rowNumber) {
    $('#image' + rowNumber).find('button#uploadBtn').attr('id', "uploadBtn"+rowNumber);
    $('#image' + rowNumber).find('button#removeBtn').attr('onClick', "RemoveImage("+rowNumber+")");
    $('#image' + rowNumber).find('button#removeBtn').attr('id', "removeBtn"+rowNumber);
    $('#image' + rowNumber).find('div#progressBar').attr('id', "progressBar"+rowNumber);
    $('#image' + rowNumber).find('div#progressOuter').attr('id', "progressOuter"+rowNumber);
    $('#image' + rowNumber).find('div#msgBox').attr('id', "msgBox"+rowNumber);
    $('#image' + rowNumber).find('div#picbox').attr('id', "picbox"+rowNumber);
    $('#image' + rowNumber).find('input#imageInput').attr('id', "imageInput"+rowNumber);

    var btn =  $( "#uploadBtn"+rowNumber),
        removeBtn =  $( "#removeBtn"+rowNumber),
        progressBar =  $( "#progressBar"+rowNumber),
        progressOuter =  $( "#progressOuter"+rowNumber),
        msgBox = $( "#msgBox"+rowNumber),
        picBox =  $( "#picbox"+rowNumber),
        inputBox =  $( "#imageInput"+rowNumber) ;
    if( inputBox.val().length === 0 ) {inputBox.val(null);}
    window['uploader_'+rowNumber] = new ss.SimpleUpload({
        button: btn,
        url: url,
        name: 'uploadfile'+rowNumber,
        multipart: true,
        hoverClass: 'hover',
        focusClass: 'focus',
        responseType: 'json',
        startXHR: function() {
            progressOuter.show(); // make progress bar visible
            this.setProgressBar( progressBar );
        },
        onSubmit: function() {
            msgBox.html('') ; // empty the message box
        },
        onComplete: function( filename, response ) {
            progressOuter.hide() // hide progress bar when upload is completed

            if ( !response ) {
                msgBox.html('Unable to upload file');
                return;
            }

            if ( response.success === true ) {
                $( "#picbox"+rowNumber+"> img").attr( 'src',response.file );
                inputBox.val(response.name);
                removeBtn.show();
                btn.hide();

            } else {
                if ( response.msg )  {
                    msgBox.html(escapeTags( response.msg ));

                } else {
                    msgBox.html('An error occurred and the upload failed.');
                }
            }
        },
        onError: function() {
            progressOuter.hide();
            msgBox.html('Unable to upload file');
        }
    });
};

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

function AssignUploaderAttachments() {
    var btn =  $( "#uploadBtn"),
        progressOuter =  $( "#progressOuter"),
        msgBox = $( "#msgBox"),
        inputBox =  $( "#imageInput") ;

    // if( inputBox.val().length === 0 ) {inputBox.val(null);}
    window['uploader_'] = new ss.SimpleUpload({
        button: btn,
        url: url,
        name: 'uploadfile',
        hoverClass: 'hover',
        focusClass: 'focus',
        responseType: 'json',
        multiple: true,
        allowedExtensions: ['jpg', 'jpeg', 'png', 'gif','pdf','xls','docx'], // for example, if we were uploading pics
        disabledClass: 'ui-state-disabled',
        onSubmit: function(filename, extension) {
            // Create the elements of our progress bar
            var progress = document.createElement('div'), // container for progress bar
                bar = document.createElement('div'), // actual progress bar
                fileSize = document.createElement('div'), // container for upload file size
                wrapper = document.createElement('div'), // container for this progress bar
                //declare somewhere: <div id="progressBox"></div> where you want to show the progress-bar(s)
                progressBox = document.getElementById('progressBox'); //on page container for progress bars

            // Assign each element its corresponding class
            progress.className = 'progress progress-striped';
            bar.className = 'progress-bar progress-bar-success';
            fileSize.className = 'size';
            wrapper.className = 'wrapper';

            // Assemble the progress bar and add it to the page
            progress.appendChild(bar);
            wrapper.innerHTML = '<div class="name">'+filename+'</div>'; // filename is passed to onSubmit()
            wrapper.appendChild(fileSize);
            wrapper.appendChild(progress);
            progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars


            // Assign roles to the elements of the progress bar
            this.setProgressBar(bar); // will serve as the actual progress bar
            this.setFileSizeBox(fileSize); // display file size beside progress bar
            this.setProgressContainer(wrapper); // designate the containing div to be removed after upload
        },
        onComplete: function( filename, response ) {
            progressOuter.hide() // hide progress bar when upload is completed

            if ( !response ) {
                msgBox.html('Unable to upload file');
                return;
            }

            if ( response.success === true ) {
                var name= response.name;
                var original_name = name.substring(name.indexOf('__')+2, name.length);
                $( "#showBox").append('<div class="file_name"><a target="_blank" href="'+url_download+'/'+name+'"> '+ original_name +'</a>' +
                    '<button type="button"   style="float: right;border: none" onclick=RemoveAttachments(this,"'+name+'")>' +
                    '<i class="tim-icons icon-simple-remove"></i></button>' +
                    '<input type="hidden" name="image[]" value="'+response.name+'" /></div>');
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
}

function RemoveAttachments(elem,name_file){
    var msgbox = $('#msgBox');
    $.ajax({
        type:"POST",
        url: url_remove,
        data:{file:name_file},
        dataType : 'json',
        //can send multipledata like {data1:var1,data2:var2,data3:var3
        //can use dataType:'text/html' or 'json' if response type expected
        success:function(response){
            // process on data
            if ( response.success === true ) {
                msgbox.html( '');
                $(elem).parent(".file_name").remove();
            }  else {
                if ( response.msg )  {
                    msgbox.html(escapeTags( response.msg ));
                } else {
                    msgbox.html('An error occurred.');
                }
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            msgbox.html((jqXHR.responseText));
        }
    })

}

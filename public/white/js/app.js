


  $(document).ready(function () {
      /*-------------------autocomplete--------------------*/
      $("#auto").autocomplete({
          minLength: 4,
          source: function (request, response) {
              $('#loading_data_icon').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');    // showing loading icon
              var s = $( "#auto" ).attr("route");
              $.ajax({
                  url: s,
                  dataType: "json",
                  data: {
                      'term': request.term,
                      'empSearch': 1
                  },
                  success: function (data) {
                      response(data);
                      $('#loading_data_icon').html('');
                  },
                  error : function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                  }

              });

          },
          select: function(event, ui) {
              $('#auto').val(ui.item.value);
              $('#auto_id').val(ui.item.id);
          },
      });
      $( "#auto" ).keydown(function() {
          $('#auto_id').val('');
      });
      /*---------------CURRENCY TEXT BOX-------------*/
      $("input[data-type='currency']").on({

          keyup: function() {
              formatCurrency($(this));
          },
          blur: function() {
              formatCurrency($(this), "blur");
          }
      });

      function formatNumber(n) {
          // format number 1000000 to 1,234,567
          return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      }

      function formatCurrency(input, blur) {
          // appends $ to value, validates decimal side
          // and puts cursor back in right position.

          // get input value
          var input_val = input.val();

          // don't validate empty input
          if (input_val === "") { return; }

          // original length
          var original_len = input_val.length;

          // initial caret position
          var caret_pos = input.prop("selectionStart");

          // check for decimal
          if (input_val.indexOf(".") >= 0) {

              // get position of first decimal
              // this prevents multiple decimals from
              // being entered
              var decimal_pos = input_val.indexOf(".");

              // split number by decimal point
              var left_side = input_val.substring(0, decimal_pos);
              var right_side = input_val.substring(decimal_pos);

              // add commas to left side of number
              left_side = formatNumber(left_side);

              // validate right side
              right_side = formatNumber(right_side);

              // On blur make sure 2 numbers after decimal
              if (blur === "blur") {
                  right_side += "00";
              }

              // Limit decimal to only 2 digits
              right_side = right_side.substring(0, 2);

              // join number by .
              var s = input.attr("currency_title");
              input_val = s + left_side + "." + right_side;

          } else {
              // no decimal entered
              // add commas to number
              // remove all non-digits
              var s = input.attr("currency_title");
              input_val = formatNumber(input_val);
              input_val = s + input_val;

              // final formatting
              if (blur === "blur") {
                  input_val += ".00";
              }
          }

          // send updated string to input
          input.val(input_val);

          // put caret back in the right position
          var updated_len = input_val.length;
          caret_pos = updated_len - original_len + caret_pos;
          input[0].setSelectionRange(caret_pos, caret_pos);
      }
      /*---------------CURRENCY TEXT BOX-------------*/

      //----------------------remove strings from prices in forms
      $("form").submit(function () {
          $("input[data-type='currency']").each(function () {
              var input = $(this);
              var s = input.attr("currency_title");
              var input_val =  input.val();
              $(this).val(input_val.replace(s, ''));
              $(this).val($(this).val().replace(/,/g, ''));
          })
      });
  });


  function RemoveNotification(element){
      $.ajax({
          type:'delete',
          url: $(element).attr("route"),
          data:{},
          dataType : 'json',
          //can send multipledata like {data1:var1,data2:var2,data3:var3
          //can use dataType:'text/html' or 'json' if response type expected
          success:function(response){
              // process on data
              if ( response.success === true ) {
                 return true;
              }  else {
                 return false;
              }
          },
          error : function(jqXHR, textStatus, errorThrown) {
              console.log('error');
              return false;

          }
      })

  }

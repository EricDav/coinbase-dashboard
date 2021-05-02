
var amount = $('#withdraw');
$('#withdraw-funds').click(function() {
    if (amount.val()) {
        $('#withdraw-funds').css('disabled', true);
        $('#withdraw-funds').css('cursor', 'default');
        $('#withdraw-funds').text('Updating..');
        $.ajax('/withdrawFunds', { data: {amount: amount.val()},
        type: 'POST',  success: function(result) {
            $('#withdraw-funds').css('disabled', false);
            $('#withdraw-funds').text('Submit');
           response = result;
           const message = response.message
           console.log(result);
          if (!response.success) {
               $('#m-failure').css('display', 'block');
               $('#m-failure').text(message);
               $('#m-success').css('display', 'none');
          } else {
            $('#m-success').css('display', 'block');
            $('#m-success').text(message);
            $('#m-failure').css('display', 'none');
            setTimeout(function() {
                $('#m-success').css('display', 'none');
            }, 2000);
          }
       }});
    } else {
        $('#m-failure').css('display', 'block');
        $('#m-failure').text('Amount can not be empty');
        $('#m-success').css('display', 'none');
    }
});
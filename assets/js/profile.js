var firstName = $('#dfirstName');
var email = $('#demail');
var phoneNumber = $('#dphoneNumber');
var isError = false;
var id = null;
console.log('Inside====>>>>>>>>');

// Details for next of kin

$('#update-details').click(function() {
    console.log('Fuck you');
    isError = false;
    clearUserDetailsError();
    if (!firstName.val().trim()) {
        $('#dfirstname-error').text('First name is required');
        isError = true;
    }

    if (!email.val().trim()) {
        $('#demail-error').text('Email is required');
        isError = true;
    } 
     if (!phoneNumber.val().trim()) {
        $('#dphoneNumber-error').text('Phone number is required');
        isError = true;
    }

    if (!isError) {
        $('#update-details').css('disabled', true);
        $('#update-details').css('cursor', 'default');
        $('#update-details').text('Updating..');
        $.ajax('/updateUserDetails', { data: {'email': email.val(), 'phoneNumber' :phoneNumber.val(), 'firstName': firstName.val()},
        type: 'POST',  success: function(result) {
            $('#update-details').css('disabled', false);
            $('#update-details').text('Update');
           response = result;
           console.log(result);
          if (!response.success) {
               const messages = response.message
               if (messages.hasOwnProperty('email')) {
                    $('#email-error').text(messages.email);
               }

               if (messages.hasOwnProperty('firstName')) {
                    $('#firstname-error').text(messages.firstName);
                }

                if (messages.hasOwnProperty('phoneNumber')) {
                    $('#password-error').text(messages.password);
                }

               //$('#error-message').text(response.message);
          } else {
            console.log('I got here o!!!');
            $('#m-success').css('display', 'block');
            setTimeout(function() {
                $('#m-success').css('display', 'none');
            }, 2000);
          }
       }});
    }
});

function clearUserDetailsError() {
    $('#dfirstname-error').text('');
    $('#dlastname-error').text('');
    $('#demail-error').text('');
    $('#dphoneNumber-error').text('')
}
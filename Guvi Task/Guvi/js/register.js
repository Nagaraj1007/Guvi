$(document).ready(function() {
  $('#username').on('blur', function() {
    var username = $(this).val();
    $.ajax({
      url: 'signup.php',
      type: 'post',
      data: {username: username},
      success: function(response) {
        if (response == 'taken') {
          $('#username-error').text('This username is already taken');
        }
        else if (response == 'available') {
          $('#username-error').text('');
        }
      }
    });
  });

  $('#email').on('blur', function() {
    var email = $(this).val();
    $.ajax({
      url: 'signup.php',
      type: 'post',
      data: {email: email},
      success: function(response) {
        if (response == 'taken') {
          $('#email-error').text('This email is already registered');
        }
        else if (response == 'available') {
          $('#email-error').text('');
        }
      }
    });
  });

  $('#signup-form').on('submit', function(e) {
    e.preventDefault();
    var username = $('#username').val();
    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
      url: 'signup.php',
      type: 'post',
      data: {username: username, email: email, password: password},
      success: function(response) {
        if (response == 'success') {
          alert('You have successfully signed up!');
          $('#signup-form')[0].reset();
          var formData = {
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val()
          };

          // Store form data in local storage
          localStorage.setItem('signup_data', JSON.stringify(formData));
        }
        else if (response == 'error') {
          alert('An error occurred while processing your request.');
        }
      }
    });
  });
});

<?php

session_start();

echo "Welcome to the members area, " . $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login and Signup System</title>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div>
    <h2>Signup</h2>
    <input type="text" id="signup_username" placeholder="Username">
    <div id="username_status"></div>
    <input type="text" id="signup_password" placeholder="Password">
    <button id="toggle_signup_password">Hide Password</button>
    
    <button id="signup_btn">Signup</button>
    <button id="generate_btn">Generate Username and Password</button>
</div>

<div>
    <h2>Login</h2>
    <input type="text" id="login_username" placeholder="Username">
    <input type="text" id="login_password" placeholder="Password">
    <button id="toggle_login_password">Hide Password</button>
    
    <button id="login_btn">Login</button>
</div>

<script>
$(document).ready(function() {
    // Check username availability
    $('#signup_username').on('keyup', function() {
        var username = $(this).val();
        $.post('check_username.php', {username: username}, function(data) {
            $('#username_status').text(data);
        });
    });

    // Handle signup
    $('#signup_btn').click(function() {
        var username = $('#signup_username').val();
        var password = $('#signup_password').val();
        $.post('signup.php', {username: username, password: password}, function(data) {
            alert(data);
        });
    });

    // Handle login
    $('#login_btn').click(function() {
        var username = $('#login_username').val();
        var password = $('#login_password').val();
        $.post('login.php', {username: username, password: password}, function(data) {
            alert(data);
        });
    });

    // Generate username and password
    $('#generate_btn').click(function() {
    $.ajax({
        url: 'generate_credentials.php',
        type: 'GET',
        dataType: 'json', // Expect a JSON response
        success: function(data) {
            $('#signup_username').val(data.username); // Fill the username
            $('#signup_password').val(data.password); // Fill the password
            $('#username_status').text("Username and password generated!");
        },
        error: function(xhr, status, error) {
            console.error("Error generating credentials: " + error);
        }
    });

    // Toggle for signup password visibility
$('#toggle_signup_password').click(function() {
    var passwordField = $('#signup_password');
    var passwordFieldType = passwordField.attr('type');

    if(passwordFieldType == 'password') {
        passwordField.attr('type', 'text');
        $(this).text('Hide Password');
    } else {
        passwordField.attr('type', 'password');
        $(this).text('Show Password');
    }
});

// Toggle for login password visibility
$('#toggle_login_password').click(function() {
    var passwordField = $('#login_password');
    var passwordFieldType = passwordField.attr('type');

    if(passwordFieldType == 'password') {
        passwordField.attr('type', 'text');
        $(this).text('Hide Password');
    } else {
        passwordField.attr('type', 'password');
        $(this).text('Show Password');
    }
});

});

});

$(document).ready(function() {
    // Toggle for signup password visibility
    $('#toggle_signup_password').on('click', function() {
        var passwordField = $('#signup_password');
        var passwordFieldType = passwordField.attr('type');

        if(passwordFieldType == 'password') {
            passwordField.attr('type', 'text');
            $(this).text('Hide Password');
        } else {
            passwordField.attr('type', 'password');
            $(this).text('Show Password');
        }
    });

    // Toggle for login password visibility
    $('#toggle_login_password').on('click', function() {
        var passwordField = $('#login_password');
        var passwordFieldType = passwordField.attr('type');

        if(passwordFieldType == 'password') {
            passwordField.attr('type', 'text');
            $(this).text('Hide Password');
        } else {
            passwordField.attr('type', 'password');
            $(this).text('Show Password');
        }
    });
});

</script>

</body>
</html>

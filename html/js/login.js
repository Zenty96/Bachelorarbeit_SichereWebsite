$(document).ready(function() {
    $("#loginButton").click(function() {

        function login_user() {    
            var usr = $("#inputUsername").val();
            var pwd = $("#inputPassword").val();
            $.ajax({
                type: "POST",
                url: "php/login.php",
                data: 'user=' + usr + '&password=' + pwd,
                success: function(data) { 
                    window.location.href = data;
                },          
            });
        }

        login_user();
    });
});
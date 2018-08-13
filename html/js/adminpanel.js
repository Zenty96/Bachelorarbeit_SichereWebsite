$(document).ready(function() {
    $("#searchUserButton").click(function() {

        function show_user() {
            var usr = $("#inputSearchUser").val();
            $.ajax({
                type: "POST",
                url: "php/searchUser.php",
                data:{action:usr},
                success: function (data) {
                    $("#searchResults").html(data);
                }
            });
        }

        show_user();
    });
});
var today = new Date();
var dateToday = today.getDate() + "." + (today.getMonth() + 1) + "." + today.getFullYear();

function submitBlogEntry() {
    var username = document.getElementById("inputBlogUser").value;
    var heading = document.getElementById("inputBlogHeading").value;
    var text = document.getElementById("inputBlogText").value;

    var username_encoded = encode(username);
    var heading_encoded = encode(heading);
    var text_encoded = encode(text);

    var html = generateHTML(username_encoded, heading_encoded, text_encoded);
    document.getElementById("entries").innerHTML = html;
}

function generateHTML(usr, hdng, txt) {

    var htmlOld = document.getElementById("entries").innerHTML;
    
    var htmlToAdd =
        "<div class='card'><h2>" + hdng + "</h2><h5>uploaded " + dateToday + " by " + usr + "</h5><br>" + txt + "</div>";

    return htmlToAdd + htmlOld;
}

function encode(str) {

    var substr_lt = "<";
    var substr_gt = ">";

    if (str.includes(substr_lt) && str.includes(substr_gt)) {
        var pos_lt = str.indexOf(substr_lt);
        var pos_gt = str.indexOf(substr_gt);

        if (pos_lt < pos_gt) {
            var str_delete = str.substring(pos_lt, pos_gt+1);
            str = str.replace(str_delete, "");
        }
    }

    str = str.replace(/&/g, "&amp;");

    return str;
}
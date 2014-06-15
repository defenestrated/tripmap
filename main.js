// add any scripting here

$(document).ready(function() {
    pullposts();
});




function pullposts() {
    $.ajax({
        url: "wordpress/wp_api/v1/posts",
        success: function(data) {
            console.log(data);
        }
    });
}

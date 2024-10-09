$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#search").on("input", request);
    function request() {
        var input = $("#search").val();
        $.ajax({
            method: 'POST',
            url: "/search",
            data: {
                search: input
            },
            success: function(data) {
                console.log("done");
                // $("#serchResult").html(data);
            }
        })
    }
});
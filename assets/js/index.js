$(document).ready(() => {
    $("#loadContacts").click(function() {
        $(this).attr("loading", true);
        getData();
    });
});

function getData(){
    $.ajax({
        url: "./home/data",
        type: "post",
        dataType: "json",
        data: null,
        cache: false,
        contentType: false,
        processData: false
    }).done((r) => {
        $("#loadContacts").removeAttr("loading");
        $("#contacts").load(
            "./views/home/table.php",
            {
                "contacts" : r
            }
        );
    });
}
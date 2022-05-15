$(".exportButton").click(function () {
    var action = $('#exportData').val();
    $("#submit").attr("action", action);
    $("#submit").submit();
});

$(".filterButton").click(function () {
    var action = '';
    $("#submit").attr("action", action);
    $("#submit").submit();
});
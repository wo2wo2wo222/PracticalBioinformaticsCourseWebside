$(document).ready(function () {
    $('#table').DataTable({
        "dom": 'lrtip',
        "searching": false,
        "processing": true,
        "ordering":false,
        "bDestroy":true,
        'length':false,
        "bProcessing" : true,
        "bPaginate" : false,
        "sScrollY" : '450px',
        "bScrollCollapse" : true,
        "info": false
    });

});
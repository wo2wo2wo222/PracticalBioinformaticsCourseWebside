$(document).ready(function () {
/*
设置按钮监听
向php端传入用户输入 php端检验
    如果没有数据，打印出表格中前10条默认数据
    如果有输入，查找到所有关于该转录因子的数据（后续能够进行每页选择展示条目数量）

传回数据后
    1.删掉原始数据
    2.在table中加入查询到的数据
 */

    $("#btn_submit").click(function () {
        $('#TF-table').show();

        $('#table').DataTable({
            "dom": 'lrtip',
            "searching": false,
            "processing": true,
            "ordering": false,
            "bDestroy": true,
            'length': false,
            "bProcessing": true,
            "bPaginate": false,
            "sScrollY": '450px',
            "bScrollCollapse": true,
            "info": false
        });

        $.post("./php/BackEndSearch_local.php", {userInput: $("#userInput").val()}, //用于本地数据库连接
            function () {
                // alert("success 连接数据库成功！");
            })
            .done(function (data) {
                if (data.trim() == "") {
                    alert("数据库没有该转录因子数据！");
                } else {
                    $("#tbody").empty();
                    $('#tbody').append(data)
                }
            })
            .fail(function () {
                alert("error 连接数据库失败");
            })
    });

});
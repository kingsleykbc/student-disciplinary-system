//Navigating bweteen issues and pleas
$('#logs').mouseover(function () {
    $('#viewLogs').css('display','block'); 
});
$('#logs').mouseout(function () {
    $('#viewLogs').css('display', 'none');
});

//Filtering
$("#allS").click(function () {
    $("#allS").addClass('active');
    $("#issueI").removeClass('active');
    filter(0);
});
$("#issueI").click(function () {
    $("#issueI").addClass('active');
    $("#allS").removeClass('active');
    filter(1);
});


//Search
$('#searchStudents').keyup(function () {
    var txt = $(this).val();
    $.ajax({
        url: "fetch.php",
        method: "post",
        data: {
            txt: txt,
            aid: $('#aid').html()
        },
        success: function (data) {
            $('#page1').html('');
            $('#page1').html(data);
        },
        error: function name(data) {
            alert(data);
        }
    });
    
});

$("#showIssues").click(function(){
    $(this).addClass('act');
    $("#showPleas").removeClass('act');

    $("#issues").css('display', 'block');
    $("#pleas").css('display','none');
});
$("#showPleas").click(function () {
    $(this).addClass('act');
    $("#showIssues").removeClass('act');

    $("#issues").css('display', 'none');
    $("#pleas").css('display', 'block');
});

//Changing Matric Numbers
$("#getMatric").click(function(){
    $("#saveMatric").css('display','block');
});
$("#saveMatric").click(function(){
    $.ajax({
        url: "saveMatric.php",
        method: "post",
        data: { sid: $('#sid').html(), 
                val: $('#getMatric').val()
        },
        success: function (data) {
            $('#getMatric').val(data);
            $("#saveMatric").css('display', 'none');
        },
        error: function name(data) {
            alert(data);
        }
    });
});

$('#addIssue').click(function () {
    $('.backdrop, .box').animate({ 'opacity': '1' }, 300, 'linear');
    $('.backdrop, .box').css('display', 'block');
});

$('.backdrop').click(function () {
    close();
});

//Adding an Issue
$('#submit').click(function(){
    if ($('#offenseT').val() != "" && $('#offense').val() != "" && $('#punishment').val() != ""){
        $.ajax({
            url: "addIssue.php",
            method: "post",
            data: {
                offenseT: $('#offenseT').val(),
                offense: $('#offense').val(),
                punishment: $('#punishment').val(),
                aid: $('#aid').html(),
                sid: $('#sid').html(),
                category: $('#category').val(),
                severity: $('#severity').val()
            },
            success: function (data) {
                $('#issues').html(data);
                close();
            },
            error: function name(data) {
                alert(data);
            }
        });
   }else{
        $('#error').html("<div style='color:red'>Please Fill in all fields </div>");
   }
});

//Editing an Issue
$('#update').click(function () {
    if ($('#offenseTU').val() != "" && $('#offenseU').val() != "" && $('#punishmentU').val() != "") {
        $.ajax({
            url: "updateIssue.php",
            method: "post",
            data: {
                iid: $('#iid').val(),
                offenseT: $('#offenseTU').val(),
                offense: $('#offenseU').val(),
                aid: $('#aid').html(),
                sid: $('#sid').html(),
                punishment: $('#punishmentU').val(),
                category: $('#categoryU').val(),
                severity: $('#severityU').val()
            },
            success: function (data) {
                $('#issues').html(data);
                close();
            },
            error: function name(data) {
                alert(data);
            }
        });
    } else {
        $('#error').html("<div style='color:red'>Please Fill in all fields </div>");
    }
});

//Deleting an Issue
$('#delete').click(function () {
    if ($('#offenseTU').val() != "" && $('#offenseU').val() != "" && $('#punishmentU').val() != "") {
        $.ajax({
            url: "deleteIssue.php",
            method: "post",
            data: {
                iid: $('#iid').val(),
                sid: $('#sid').html()
            },
            success: function (data) {
                $('#issues').html(data);
                close();
            },
            error: function name(data) {
                alert(data);
            }
        });
    } else {
        $('#error').html("<div style='color:red'>Please Fill in all fields </div>");
    }
});

function close() {
    $('.backdrop, .box').animate({ 'opacity': '0' }, 300, 'linear', function () {
        $('.backdrop, .box').css('display', 'none');
    });
}
function edit (ind){
    $.ajax({
        url: "editIssue.php",
        method: "post",
        data: {
            id:ind
        },
        success: function (data) {
            $('.box').html('');
            $('.backdrop, .box').animate({ 'opacity': '1' }, 300, 'linear');
            $('.backdrop, .box').css('display', 'block');
            $('.box').html(data);
        },
        error: function name(data) {
            alert(data);
        }
    });
}
function filter(res){
    $.ajax({
        url: "filter.php",
        method: "post",
        data: {
            ind: res,
            aid: $('#aid').html()
        },
        success: function (data) {
            $('#page1').html('');
            $('#page1').html(data);
        },
        error: function name(data) {
            alert(data);
        }
    });
}
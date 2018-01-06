var news = [
    { did: '#headline', name: "Appeal Heading" },
    { did: '#content', name: "The content of your appeal" }
]

//Handle the Student form submission------------------------------------------------------------------------------------------------------
$("#submit").click(function() {
    var data = $("#newsForm :input").serializeArray();
    var err = validateform(news);

    if (err == ""){
        $.post($("#newsForm").attr("action"),data,function (info) {
            $("#errors").empty(); 
            $("#errors").html(info);
            clear("#newsForm", "#submit");
        });
    }else{
       $("#errors").html(err);
    }

    $("#newsForm").submit(function(){
        return false;
    });
});
//FUNCTIONS --------------------------------------------------------------------------------------------------------------------------------

//Clear All the data in the input fields when this function is called
function clear(form,sub){
       $(form +" :input").each(function () {
              $(this).val("");
              $(sub).val("Appeal");
       });  
}



//Form Validator function to make sure no input field is empty for the mandatory fields
function validateform(fields){

    var err = "";
    var value = new Array();
    
    for (var i = 0; i < fields.length; i++) {
        value[i] = $(fields[i].did).val();
        
        if (value[i] == ""){   
            $(fields[i].did).css('border-color', 'red');
            err += "<div class='err'> Please enter the " + fields[i].name + "</div>";
        } else {
            //If they entered something
            $(fields[i].did).css('border-color', '#bbbbbb');
            if (!isNaN(value[i])) {
                red(fields[i]);
                err += "<div class='err type'>" + fields[i].name + " cannot be a number </div>";
            }
        }
    }

    return err;
}

//To turn the border color of the field to red
function red(target){
    $(target.did).css("border-color", "red");

}















// //Preview Images when uploaded
// $('#media').change(function () {
//     filePreview(this);
// });

// function filePreview(inp) {
//     if (inp.files && inp.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#head + img').remove();
//             $('#head').after('<img src="' + e.target.result + '" width="150px" height="150px" />');
//         }
//         reader.readAsDataURL(inp.files[0]);
//     }
// }




// function validateImage(){
//     if ($("#picture").val() != "") {
//         var ext = $("#picture").val().split('.').pop().toLowerCase();

//         if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
//             err += "<div class='err type'> Image type not valid </div>"
//             $('#picture').val('');
//         }
//     }
// }
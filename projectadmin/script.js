//These are JavaScript Objects to repesent the ID and appropirate message for the student and admin fields

//Objects for student fields
var studentFields = [
    { did: '#title', name: "Student's Title" },
    { did: '#firstname', name: "Student's First Name" },
    { did: '#lastname', name: "Student's Last Name" },
    { did: '#dob', name: "Student's date of Birth" },
    { did: '#matric', name: "Student's Matric Number" },
    { did: '#merit', name: "amount of merit points this student has" },
    { did: '#cos', name: "Course of Study" },
    { did: '#room', name: "Student's Room Number" },
    { did: '#state', name: "Student's state of origin" },
    { did: '#address', name: "Student's home address" },
    { did: '#nextOfKin', name: "Student's next of kin" },
    { did: '#g_title', name: "Guardian's Title" },
    { did: '#g_firstname', name: "Guardian's First Name" },
    { did: '#g_lastname', name: "Guardian's lastname" },
    { did: '#g_phoneNo', name: "Guardian's phone No" },
    { did: '#g_address', name: "Guardian's address" }
]

//objects for admin fields
var adminFields = [
    { did: '#title', name:"Admin's Title"},
    { did: '#firstname', name:"Admin's First Name"},
    { did: '#lastname', name: "Admin's Last Name" },
    { did: '#role', name: "Admin's Role or Responsibilities" },
    { did: '#g_phoneNo', name: "Admin's Phone Number" },
    { did: '#username', name: "Admin's Application Username" },
    { did: '#password', name: "Admin's Application password" },
    { did: '#passwordRe', name:"Re-typed Password"}
]

//Handle the Student form submission------------------------------------------------------------------------------------------------------
$("#submit").click(function() {
    var data = $("#studentForm :input").serializeArray();
    var err = validateform(studentFields);
    
    //If the user inputs the optional middlename, it must be a string
    if ($("#middlename").val() != "") {
        if (!isNaN($("#middlename").val())) {
            err += "<div class='err type'> The student's middle name cannot be a number </div>";
            $("#middlename").css("border-color","red");
        }
    }
    
    //If the user inputs the optional phone number for student's it must be a number
    if (isNaN($("#phoneNo").val())) {
        err += "<div class='err type'> The student's phone number cannot be a string </div>";
    }
     
    // To make sure the users dont submit a value for merit points greater than 60pt 
    if ($("#merit").val() > 60) {
        $("#merit").val(60);
    }


    if (err == ""){
        $.post($("#studentForm").attr("action"),data,function (info) {
            $("#errors").empty(); 
            $("#errors").html(info);
            clear("#studentForm", "#submit");
        });
    }else{
       $("#errors").html(err);
    }

    $("#studentForm").submit(function(){
        return false;
    });
});

//Handle the Admin Form Validation---------------------------------------------------------------------------------------------------------------
$("#submitA").click(function(){
    var data = $("#adminForm :input").serializeArray();
    var err = validateform(adminFields);

    if ($('#password').val() !== $('#passwordRe').val()){
        err += "<div class='err type'> The two passwords don't match </div>";
    }
    
    if (err == "") {
        $.post($("#adminForm").attr("action"), data, function (info) {
            $("#errors").empty();
            $("#errors").html(info);
            clear("#adminForm","#submitA");
        });
    } else {
        $("#errors").html(err);
    }

    $("#adminForm").submit(function (){
        return false;
    });

});


//FUNCTIONS --------------------------------------------------------------------------------------------------------------------------------

//Clear All the data in the input fields when this function is called
function clear(form,sub){
       $(form +" :input").each(function () {
              $(this).val("");
              $(sub).val("SUBMIT QUERY");
       });  
}

//Preview Images when uploaded
$('#picture').change(function () {
    filePreview(this);
});

function filePreview(inp){
    if(inp.files && inp.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#head + img').remove();
            $('#head').after('<img src="'+e.target.result+'" width="150px" height="150px" />');
        }
        reader.readAsDataURL(inp.files[0]);
    }
}

//Form Validator function to make sure no input field is empty for the mandatory fields
function validateform(fields){

    var err = "";
    var value = new Array();
    
    //for every field in the forms
    for (var i = 0; i < fields.length; i++) {
        value[i] = $(fields[i].did).val();
        
        if (value[i] == ""){   
            //If they left the fields empty
            $(fields[i].did).css('border-color', 'red');
            err += "<div class='err'> Please enter the " + fields[i].name + "</div>";
        } else {
            //If they entered something
            $(fields[i].did).css('border-color', '#bbbbbb');
            if (!isNaN(value[i]) && fields[i].did != '#merit' && fields[i].did != '#g_phoneNo') {
                //If they entered strings for fields that were meant to be numbers
                red(fields[i]);
                err += "<div class='err type'>" + fields[i].name + " cannot be a number </div>";
            }
            if (isNaN(value[i]) && (fields[i].did == '#merit' || fields[i].did == '#g_phoneNo')) {
                //If they entered numbers for fields that were meant to be Strings
                red(fields[i]);
                err += "<div class='err type'>" + fields[i].name + " must be a number </div>";
            }
        }
    }

    return err;
}

//To turn the border color of the field to red
function red(target){
    $(target.did).css("border-color", "red");

}
























// function validateImage(){
//     if ($("#picture").val() != "") {
//         var ext = $("#picture").val().split('.').pop().toLowerCase();

//         if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
//             err += "<div class='err type'> Image type not valid </div>"
//             $('#picture').val('');
//         }
//     }
// }
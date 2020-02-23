$("#passch").hide();
$("#passch1").hide();
$("#passch12").hide();
$('#regfomr').on('submit',function () {
    var uname=$("#namer").val(),
        email=$("#form2").val(),
        pass=$("#form3").val(),
        passc=$("#form4").val();

    if(uname=="" || pass=="" || passc=="" || email=="") {
        $("#passch1").show(300);
    }else{
        $("#passch1").hide(300);
        if (pass != passc) {
            $("#passch").show(300);
        } else {
            $("#passch").hide(300);
            $("#passch12").show(500);
            //$.delay(1500);
            //$.(".submitB").submit();
            //$("#myLogin").show();
            $.ajax({
                url: "test.php",
                dataType: "text",
                type: "POST",
                data: {namer: uname, emailr: email, passr: pass},
                success: function(status) {
                }
            });
        }
    }

    return false;
});
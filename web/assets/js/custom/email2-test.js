$(document).ready(function(){
    $(".email-input").blur(function(){
        var email = this.value;
        $.ajax({
            url:URL+'/email2-test',
            data:{email:email},
            type:'POST',
            success:function(response){
                if(response=="used"){
                    $(".email-input").css("border","2px solid red");
                }else{
                    $(".email-input").css("border","2px solid green");
                }
            }
        });
    }); 
});


$(document).ready(function(){
    $(".nick-input").blur(function(){
        var nick = this.value;
        $.ajax({
            url:URL+'/nick-test',
            data:{nick:nick},
            type:'POST',
            success:function(response){
                if(response=="used"){
                    $(".nick-input").css("border","2px solid red");
                }else{
                    $(".nick-input").css("border","2px solid green");
                }
            }
        });
    }); 
});


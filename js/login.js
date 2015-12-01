$(document).ready(function(){
  $(".sign").click(function(){
 	$(".LoginForm").fadeOut(500);
 	$(".RoleForm").fadeIn(500);
  });
  //$("#add_err").css('display', 'none', 'important');
  $("#login").click(function(){
    email=$("#email").val();
    password=$("#word").val();
    $.ajax({
      type: "POST",
      url: "login.php",
      data: "email="+email+"&pwd="+password,
      success:function(html){
        if(html=='true')    {
          //$("#add_err").html("right username or password");
          window.location="index.php";
        } else {
          console.log("wrong email/pw");
        }
      },
      beforeSend:function() {
        console.log("Loading...");
      }
    });
    return false;
  });
});

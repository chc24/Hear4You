<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name = "viewport" content = "width=device-width", initial-scale = 1.0, maximum-scale = 1.0, user-scalable="no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Hear4You</title>
  <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/landing-page.css" rel="stylesheet">
  <link href="css/groupchat.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>
<body>
  <!-- Navigation -->
  <nav id = "myScrollspy" class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand topnav" href="#">Hear4You</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.html#home">Home</a> </li>
          <li><a href="index.html#mission">Mission</a></li>
          <li><a href="index.html#roles">Roles</a></li>
          <li><a href="resources.html">Resources</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a href="login.html">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class = "jumbotron" id = "messages">

    <div id='messagesDiv'>

    </div>
   <!--  <input type='text' id='nameInput' placeholder='Name'> -->
    <input type='text' id='messageInput' placeholder='Enter your message here'>
    <script>
      var username = '<?php echo $_SESSION["username"];?>';
      var myDataRef = new Firebase('hear4you.firebaseIO.com');
      var chatroomRef = myDataRef.child("IndividualChats");
      var pairRef = chatroomRef.child(username)
      $('#messageInput').keypress(function (e) {
        if (e.keyCode == 13) {
          // var name = $('#nameInput').val();
          var text = $('#messageInput').val();
          pairRef.push({name: name, text: text});
          $('#messageInput').val('');
        }
      });
      pairRef.on('child_added', function(snapshot) {
        var message = snapshot.val();
        displayChatMessage(message.name, message.text);
      });
      function displayChatMessage(name, text) {
        $('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
        $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
      };
    </script>
  </body>
  </html>
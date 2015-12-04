<!--
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Calvin: Created page (Firebase chat implementation, implemented chat room)

Sources Used: Firebase, Bootstrap, Jquery, ajax (Placed inline)
-->

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name = "viewport" content = "width=device-width", initial-scale = 1.0, maximum-scale = 1.0, user-scalable="no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Hear4You</title>
  <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- Firebase -->
  <script src="https://cdn.firebase.com/js/client/2.0.2/firebase.js"></script>
  <!-- Firechat -->
  <link rel="stylesheet" href="https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.css" />
  <script src="https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.js"></script>

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/landing-page.css" rel="stylesheet">
  <link href="css/groupchat.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <script>
    $(document).ready(function(){
      $.ajax({
        type: "GET",
        url: "php/swapuser.php",
        success: function(data) {
          $("#swap-login").html(data);
        }
      })
    });
  </script>
  
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

    <h2 id = "groupName">Individual Chat</h2>
    <h4 id = "chatID"></h4>
    <h5 id = "chatroomNumber"><?php
      session_start();
      if(isset($_SESSION['roomID'])){
        echo "Room ID is " . '<i>'.$_SESSION['roomID'].'</i>';
      }

      ?></h5>

      <div>
      <form method="POST" action="javascript:leaveChatRoom()">
          <input type="submit" value="Leave Chatroom" onClick="location.href = 'landing.html'"></input>
        </form>
      </div>

      <div id='messagesDiv'>

      </div>
      <!--  <input type='text' id='nameInput' placeholder='Name'> -->
      <input type='text' id='messageInput' placeholder='Enter your message here'>
      <script>

      //Generate Random name
      var colors = ["Red", "Green", "Orange", "Blue", "Yellow", "Pink", "Purple", "Teal", "Periwinkle", "Crimson", "Turqoise", "Jade", "Clementine", "Tangerine"];
      var animals = ["Armadillo", "Crocodile", "Bear", "T-Rex", "Elephant", "Puppy", "Alligator", "Ghost"];

      var name = colors[Math.floor(Math.random() * colors.length)] + " " + animals[Math.floor(Math.random() * animals.length)]+" "+Math.floor(Math.random()*10000);

      //The Chatroom Genre
      var chatroom = document.getElementsByTagName("h2");
      var chatroomName = chatroom[0].innerHTML;

      //User's random name
      var chatID = document.getElementsByTagName("h4");
      chatID[0].innerHTML = "My name: " + name;

      //The Chatroom ID Number used by Firebase
      var chatroomID = document.getElementsByTagName("h5");

      //Join the correct chatroom
      var myDataRef = new Firebase('hear4you.firebaseIO.com');
      var chatroomRef = myDataRef.child("IndividualChats");
      var pairRef = chatroomRef.child(chatroomID[0].innerHTML);
      $('#messageInput').keypress(function (e) {
        if (e.keyCode == 13) {
          // var name = $('#nameInput').val();
          var text = $('#messageInput').val();
          pairRef.push({name: name, text: text});
          $('#messageInput').val('');
        }
      });

      //On child added Action Event
      pairRef.on('child_added', function(snapshot) {
        var message = snapshot.val();
        displayChatMessage(message.name, message.text);
      });

      //Add to message Div
      function displayChatMessage(name, text) {
        $('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
        $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
      };
    </script>
    <script>
    // displayChatMessage(name, " has joined the chat.");
    groupRef.push({name: name, text: "has joined the chat."});

    function leaveChatRoom() {
      alert("asfd");
      displayChatMessage(name, text: " has left the chat.");
      <?php
        require(delete_match.php);
        ?>
    }
  </script>
</body>
</html>
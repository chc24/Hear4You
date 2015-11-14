<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hear4You</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/landing-page.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="0">

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
                <?php include('includes/nav.php'); ?>
                </ul>
            </div>
        </div>
    </nav>


    <a name="home"></a>
    <div id="home" class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Hear4You</h1>
                        <h3>An online platform to facilitate healthy conversations about mental health, awareness, and wellbeing</h3>
                        <hr class="intro-divider">
                         
                                <a href="#mission" class="btn btn-default btn-lg"><span class="network-name">Learn More</span></a>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

	<a name="mission"></a>
    <div id="mission" class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Our Mission</h2>
                    <p class="lead">Hear4You provides an on-demand, <b>safe</b>, and anonymous place for Duke students to discuss mental health online.<br><br>
                    You're not alone and others are here to help. After reading the <a href="#roles">roles guide,</a> sign up today using your NetID and join as a speaker or listener.<br><br>
                    Tell us what's on your mind and our matching algorithms will create a <b>secure</b> chat with someone who wants to help.<br><br>
                    Join chat rooms on moderated up-to-date topics in the Duke community. View current topics <a href="#topics">here.</a>
                    </p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <br><br><br><img class="img-responsive" src="img/brain.png" alt="">
                </div>
            </div>

        </div>
    </div>
    <a name="roles"></a>
    <div id="roles" class="content-section-b">

        <div class="container">

            <div class="row">
            

                <div class=".col-sm-5 .col-md-6">
                    <h2 id="roleHeading" class="section-heading">Roles</h2>
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <li><h2 class="section-heading">Speaker</h2></li>
                    <p class="lead">Speak whatever is on your mind. Whether you want to vent or just tell someone about your day, talk with someone who cares to hear what you have to say.
                    <br><br>
                    If you have a specific problem, we will try to match you with someone with experience. If you need to speak to a professional at Duke or elsewhere, please visit our <a href="#resources">resources</a> tab for helpful links.</p>
                </div>
                <div class=".col-sm-5 .col-md-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <li><h2 class="section-heading">Listener</h2></li>
                    <p class="lead">
                    The listener role is very important. Show the speaker that you care. Be sincere in your efforts to help and try your best even if you're not experienced with their problem. Any listener is a good listener as long as you don't say negative things. Be cognizant of how you're responding. Be kind.
                    <br><br>
                    You can really make a difference just by listening. <b>Thank you</b> for volunteering time to be a listener and making a difference in someone else's life.
                    <br><br>
                    If you have experience in certain issues, please enter those in your profile so we can better match individuals with those problems.</p>
                </div>
            

        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#mission">Mission</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#roles">Roles</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Hear4You 2015. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
<script>
    $("#myScrollspy ul li a[href^='#']").on('click', function(e) {

   // prevent default anchor click behavior
   e.preventDefault();

   // store hash
   var hash = this.hash;

   // animate
   $('html, body').animate({
       scrollTop: $(hash).offset().top
     }, 300, function(){

       // when done, add hash to url
       // (default click behaviour)
       window.location.hash = hash;
     });
    });
</script>

</body>

</html>

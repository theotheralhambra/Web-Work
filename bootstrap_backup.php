<!DOCTYPE html>
<html lang="en">
<head>
  <title>Beaver Cinemas</title>
  <meta charset="utf-8">
	<!--bootstrap-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--fonts-->
	<link href='//fonts.googleapis.com/css?family=Atomic Age' rel='stylesheet'>
	<link href='//fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
	<link href='//fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>
	<!--CSS-->
	<style>
		html {
				/*google: abel, carrois gothic, didact gothic, archivo-narrow, or -black, actor, amiko, comfortaa, gruppo, ek mukta*/
				/* Atomic Age or Audiowide for branding; graduate; faster one for deals?, IM Fell*/
				font-family: 'Didact Gothic';
				font-weight: 700;
		}
		body{
				font-family: 'Didact Gothic';
		}
		.jumbotron { 
				background-color: #f4511e; 	/* Orange */
				color: #ffffff;							/* White */
				padding: 100px 25px;
		}
		.corp{
				font-family: 'Audiowide';
				font-size: 52px;
		}
		.container-fluid {
				padding: 60px 50px;
		}
		.container-fluid h2 {
				font-weight: 900;
		}
		.bg-light {
				background-color: #f6f6f6;
				color: #f4511e;
		}
		.logo {
				font-size: 200px;
		}
		@media screen and (max-width: 768px) {
			.col-sm-4 {
					text-align: center;
					margin: 25px 0;
			}
		}
		body, bg-dark{
				background-color: #262626;	/* Dark Grey */
				color: #ffffff;							/* White */		
		}
		/* Add an orange color to all icons and set the font-size */
		.logo-small {
				color: #f4511e;
				font-size: 50px;
		}
		.logo {
				color: #f4511e;
				font-size: 200px;
		}
		.thumbnail {
				padding: 0 0 15px 0;
				border: none;
				border-radius: 0;
		}
		.thumbnail img {
				width: 100%;
				height: 100%;
				margin-bottom: 10px;
		}
		.carousel-control.right, .carousel-control.left {
				background-image: none;
				color: #f4511e;
		}
		.carousel-indicators li {
				border-color: #f4511e;
		}
		.carousel-indicators li.active {
				background-color: #f4511e;
		}
		.item h4 {
				font-size: 19px;
				line-height: 1.375em;
				font-weight: 400;
				font-style: italic;
				margin: 70px 0;
		}
		.item span {
				font-style: normal;
		}
		.navbar {
				margin-bottom: 0;
				background-color: #000000; /* #f4511e; */
				z-index: 9999;
				border: 0;
				font-size: 12px !important;
				line-height: 1.42857143 !important;
				letter-spacing: 4px;
				border-radius: 0;
		}
		.navbar li a, .navbar .navbar-brand {
				color: #fff !important;
		}
		.navbar-nav li a:hover, .navbar-nav li.active a {
				color: #f4511e !important;
				background-color: #fff !important;
		}
		.navbar-default .navbar-toggle {
				border-color: transparent;
				color: #fff !important;
		}
		.navbar-logo{
				width: 20%;
				height: 20%;
				margin-bottom: 1px;
		}
		.inline-brand-big {
				font-family: 'Audiowide';
				font-size: 120%; /*42px;*/
		}
		.inline-brand {
				font-family: 'Audiowide';
		}
	</style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">



<nav href="#header" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#header">Logo</a>
			<img class="navbar-logo" src="images/ticket.PNG" alt="Ticket">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="#movies">MOVIES</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="#locations">LOCATIONS</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="header" class="jumbotron text-center">
  <h1 class="corp">BEAVER CINEMAS</h1> 
  <p>Bringing Hollywood home since 2017</p> 
  <form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control" size="25" placeholder="ZIP" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Search</button>
      </div>
    </div>
  </form>
</div>

<!-- This will be featured movies and pull from DB -->
<div id="movies" class="container-fluid text-center bg-light">
  <h2>FEATURED MOVIES</h2>
  <h4>NOW PLAYING AT A THEATER NEAR YOU!</h4>
  <div class="row text-center">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/paris.jpg" alt="Paris">
        <p><strong>Paris</strong></p>
        <p>Yes, we built Paris</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/newyork.jpg" alt="New York">
        <p><strong>New York</strong></p>
        <p>We built New York</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/sanfran.jpg" alt="San Francisco">
        <p><strong>San Francisco</strong></p>
        <p>Yes, San Fran is ours</p>
      </div>
    </div>
	</div>
</div>

<div id="services" class="container-fluid text-center bg-dark">
  <h2 class="no-breaks">THE <span class="inline-brand-big">BEAVER CINEMAS</span> ADVANTAGE</h2>
  <h4>CUTTING EDGE TECHNOLOGY, INDUSTRY LEADING CUSTOMER SERVICE</h4>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-film logo-small"></span>
      <h4>POWER</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-sound-dolby logo-small"></span>
      <h4>IMMERSIVE AUDIO</h4>
      <p>All theaters feature Dolby Digital 7.1 &reg surround sound to take you out of your seat and into the movie.</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-cutlery logo-small"></span> <!-- glyphicon-glass discuss bar service -->
      <h4>DINING</h4>																					<!-- -music -star -star-empty -off -headphones -volume-up -phone -tree-conifer -sunglasses (3d) -->
      <p>At <span class="inline-brand-big">Beaver Cinemas</span>, your snack options don't stop at popcorn. All Cinemas feature an expanded snack menu and select locations feature a full-service dining experience while you watch the movie.</p>												<!-- -hd-video -sound-dolby -sound-7-1 -cutlery -eye-open -play -facetime-video -->
    </div>
    </div>
    <br><br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-glass logo-small"></span>
      <h4>INDULGE</h4>
      <p>Select Cinemas are equipped with a full service bar featuring hand-crafted cocktails and a rotating selection of craft-brewed beers and local wines for our guests 21+</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-headphones logo-small"></span>
      <h4>ACCESSIBLE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-home logo-small"></span>
      <h4>LOCAL</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
</div>

<!-- This will be a list of our theatres and pull from DB -->
<div id="locations" class="container-fluid text-center bg-light">
  <h2><span class="inline-brand-big">Beaver Cinemas</span> Locations</h2>
  <h4>Your neighbourhood entertainment destination</h4>
  <div class="row text-center">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/paris.jpg" alt="Paris">
        <p><strong>Paris</strong></p>
        <p>Yes, we built Paris</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/newyork.jpg" alt="New York">
        <p><strong>New York</strong></p>
        <p>We built New York</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/sanfran.jpg" alt="San Francisco">
        <p><strong>San Francisco</strong></p>
        <p>Yes, San Fran is ours</p>
      </div>
    </div>
	</div>
</div>

<!-- Feature positive feedback. Could also be adapted for featured movies. -->
<div id="" class="container-fluid text-center bg-dark">
	<h2>What our customers say</h2>
	<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
			<h4>"This company is the best. I am so happy with the result!"<br><span style="font-style:normal;">Michael Roe, Vice President, Comment Box</span></h4>
			</div>
			<div class="item">
				<h4>"One word... WOW!!"<br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4>
			</div>
			<div class="item">
				<h4>"Could I... BE any more happy with this company?"<br><span style="font-style:normal;">Chandler Bing, Actor, FriendsAlot</span></h4>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>


<div id="about" class="container-fluid bg-light">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Company Page</h2>
      <h4>Lorem ipsum..</h4> 
      <p>Lorem ipsum..</p>
      <button class="btn btn-default btn-lg">Get in Touch</button>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div id="" class="container-fluid bg-dark">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo"></span> 
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2>
      <h4><strong>MISSION:</strong> Our mission lorem ipsum..</h4> 
      <p><strong>VISION:</strong> Our vision Lorem ipsum..</p>
    </div>
  </div>
</div>

<div id="contact" class="container-fluid bg-light">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Corvallis, OR</p>
      <p><span class="glyphicon glyphicon-phone"></span> (541) 555-5555</p>
      <p><span class="glyphicon glyphicon-envelope"></span> customer.service@beavermovies.com</p> 
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div> 
    </div>
  </div>
</div>


</body>
</html>

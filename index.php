<?php

	$leanpubApiKey = '1pP95lZcH40xgIMB1eGPcf';

	date_default_timezone_set('America/Los_Angeles');

	$url = 'http://www.apress.com/us/book/9781484221198';
	$price = '9.99';

	//determine URL
	if (FALSE && isset($_GET['coupon']) && !empty($_GET['coupon']))
	{

		$url = 'https://leanpub.com/buildingsecurephpapps/packages/book/purchases/c/' . htmlentities($_GET['coupon']);

		//get price data for this coupon
		$ch = curl_init('https://leanpub.com/buildingsecurephpapps/coupons.json?api_key=' . $leanpubApiKey);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);


		$coupons = array();

		if (isset($response) && !empty($response)) {

			$data = json_decode($response);

			if (isset($data) && !empty($data))
			{

				foreach ($data as $row)
				{

					if (isset($row->package_discounts) && !empty($row->package_discounts))
					{
						foreach ($row->package_discounts as $package)
						{

							if ($package->package_slug == 'book')
							{
								$coupons[$row->coupon_code] = $package->discounted_price;
							}

						}
					}

				}

			}

		}

		//update the price
		if (isset($coupons[$_GET['coupon']]) && $coupons[$_GET['coupon']] > 0)
		{
			$price = $coupons[$_GET['coupon']];
		}
	}

?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<head>

	<meta charset="utf-8">

	<title>Building Secure PHP Apps Ebook</title>
	<meta name="description" content="Building Secure PHP Apps Eboo">
	<meta name="author" content="Ben Edmunds">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/main.css">
	<!--[if IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css"><![endif]-->

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<body class="landing-page">

	<header class="header" id="header">
		<div class="container">

			<div class="sixteen columns">

				<div class="logo">
					<a href="/">Building Secure PHP Apps</a>
				</div>


				<nav class="nav">
					<!-- Mobile Menu Toggle -->
					<a href="#" id="menu-toggle" class="menu-toggle" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Menu_Open', 'Clicked to open the Menu']);">Menu <i class="fa fa-align-justify"></i></a>

					<ul id="menu" class="menu">
						<li class="active"><a href="#" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Menu_Home', 'Clicked Home in the Menu Bar']);">Home</a></li>
						<li><a href="#overview" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Menu_Overview', 'Clicked Overview in the Menu Bar']);">Overview</a></li>
						<li><a href="#sample" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Menu_Sample', 'Clicked Download Sample in the Menu Bar']);">Download Sample</a></li>
						<li><a href="#testimonials">Testimonials</a></li>
						<li><a href="#purchase" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Menu_Purchase', 'Clicked Purchase in the Menu Bar']);">Purchase</a></li>
					</ul>
				</nav>

			</div> <!-- /.sixteen columns -->

		</div><!-- /.container -->
	</header>





	<section id="home" class="home boxed">
		<div class="container">

			<!-- Text -->
			<div class="eight columns">
				<h1 class="title">
					Is your PHP app <span class="title-highlight">truly secure</span>?
				</h1>
				<h2 class="title">
				Let's make sure you get home on time and sleep well at night.
				</h2>

				<div class="subtitle">
					<p class="small">
						Learn the security basics that a senior developer usually acquires over years of experience, all condensed down into one quick and easy handbook.
					</p>
				</div> <!-- /.subtitle -->



				<div id="top-cta-container">

					<a href="<?=$url?>" class="button purchase-button" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'CTA_Purchase', 'Clicked Purchase to proceed to Leanpub Checkout']);">Buy Now from Apress</a>

					<p>Get It Now For Just $<?=$price?></p>

				</div>

			</div><!-- /.eight columns -->

			<!-- Image -->
			<div class="eight columns">
				<img src="images/ebook-home.png" alt="Building Secure PHP Apps Ebook" style="width:82%; border:2px #666666 solid;" id="ebook-home">
			</div><!-- /.eight columns -->

		</div> <!-- /.container -->
	</section> <!-- #home -->





	<section id="reviews" class="reviews boxed-mini">
		<div class="reviews-wrap">
			<div class="flexslider">
				<div class="slides">

					<div class="review">
						<blockquote>
							<i class="fa fa-quote-left"></i>
							<p>This book gave me quite a few new insights and made me aware of potential weaknesses in my own applications.</p>
							<span class="source">- Maks Surguy</span>
						</blockquote>
					</div> <!-- /.review -->

					<div class="review">
						<blockquote>
							<i class="fa fa-quote-left"></i>
							<p>You can never know enough about security.</p>
							<span class="source">- Bret Atkin</span>
						</blockquote>
					</div> <!-- /.review -->

					<div class="review">
						<blockquote>
							<i class="fa fa-quote-left"></i>
							<p>10/5 would read again!</p>
							<span class="source">- Jeff Carouth</span>
						</blockquote>
					</div> <!-- /.review -->

				</div> <!-- /.slides -->
			</div> <!-- /.flexslider -->
		</div> <!-- /.reviews-wrap -->
	</section> <!-- #reviews -->







	<section id="features" class="features boxed">

		<div class="section-header">
			<h3 class="title">What You'll <span class="title-highlight">Learn</span></h3>

			<p class="description">
				Several years ago I was writing a web application for a client in the CodeIgniter PHP framework, but CodeIgniter didn't include any type of authentication system built in.  I of course did what any good/lazy developer would do and went on the hunt for a well made library to supply authentication capabilities.  To my chagrin I discovered that there weren't any clean, concise libraries that fit my needs for authentication in CodeIgniter.  Thus began my journey of creating Ion Auth, a simple authentication library for CodeIgniter, and a career long crusade for securing web applications as well as helping other developers do the same.
			</p>

			<p class="description">
				Here we are years later, a lot of us have moved on to other frameworks or languages, but I still repeatedly see basic security being overlooked.  So let's fix that.  I want to make sure that you'll never have to live the horror of leaking user passwords, or have someone inject malicious SQL into your database, or the suite of other "hacks" that could have been easily avoided.  Let's make sure we all get home on time and sleep well at night.
			</p>

		</div> <!-- /.section-header -->


		<div class="feature">
			<div class="container">

				<div class="sixteen columns">

					<div class="feature-icon"><i class="fa fa-star"></i></div>

					<div class="feature-title">Erase Your Fears</div>

					<div class="feature-description">
						No more late nights.<br />
						No more scary phone calls from clients.<br />
						Peace of Mind.
					</div> <!-- /.feature-description -->

				</div> <!-- /.sixteen columns -->

			</div> <!-- /.container -->
		</div> <!-- /.feature -->

		<div class="feature">
			<div class="container">

				<div class="sixteen columns">
					<div class="feature-icon"><i class="fa fa-book"></i></div>

					<div class="feature-title">Edu-macation</div>

					<div class="feature-description">
						Learn how to write a truly secure PHP web application.
					</div> <!-- /.feature-description -->

				</div> <!-- /.sixteen columns -->

			</div> <!-- /.container -->
		</div> <!-- /.feature -->

		<div class="feature">
			<div class="container">

				<div class="sixteen columns">

					<div class="feature-icon"><i class="fa fa-clock-o"></i></div>

					<div class="feature-title">Sleeeeeep</div>

					<div class="feature-description">
						Sleep is one of the most important things for your productivity, don't let security issues get in the way.
					</div> <!-- /.feature-description -->

				</div> <!-- /.sixteen columns -->

			</div> <!-- /.container -->
		</div> <!-- /.feature -->

	</section> <!-- #features -->






	<section id="overview" class="overview boxed">

		<div class="section-header">
			<h3 class="title"><span class="title-highlight">Overview</span> of Building Secure PHP Apps</h3>

			<p class="description">
				This is a quick read, at just over 100 pages.  This is a handbook style guide to specific items you can act on.  The following sections will be covered:
			</p>
		</div> <!-- /.section-header -->


		<div class="container">

			<div class="sixteen columns" style="text-align:center; margin:0 auto; width:100%;">

				<ul id="toc">

					<li>
						<strong>Chapter One</strong>
						<h4 class="chapter-title">Never Trust Your Users - Escape All Input</h4>
						<br />
					</li>

					<li>
						<strong>Chapter Two</strong>
						<h4 class="chapter-title">HTTPS / SSL / BCA / JWH / SHA and Other Random Letters, Some of Them Actually Matter</h4>
						<br />
					</li>

					<li>
						<strong>Chapter Three</strong>
						<h4 class="chapter-title">Password Encryption and Storage for Everyone</h4>
						<br />
					</li>

					<li>
						<strong>Chapter Four</strong>
						<h4 class="chapter-title">Authentication, Access Control, and Safe File Handing</h4>
						<br />
					</li>

					<li>
						<strong>Chapter Five</strong>
						<h4 class="chapter-title">Safe Defaults, Cross Site Scripting and other Popular Hacks</h4>
						<br />
					</li>

				</ul>


			</div> <!--- /.sixteen columns -->



			<div class="sixteen columns" style="text-align:center; margin:0 auto; width:100%;">
				<br /><br />
				<h3 class="title"><span class="title-highlight">Format</span></h3>
 				<p>All code examples are written in PHP with accompanying source code on GitHub.</p>
 			</div>

			<div class="sixteen columns" style="text-align:center; margin:0 auto; width:100%;">
				<br /><br />
				<h3 class="title"><span class="title-highlight">102 Pages</span> of awesome</h3>
 			</div>

			<div class="sixteen columns" style="text-align:center; margin:0 auto; width:100%;">
				<br /><br />
				<h3 class="title">45 day Money Back <span class="title-highlight">Guarantee</span></h3>
 			</div>

			<div id="sample" class="sixteen columns product-sample" style="display:none;">
				<a href="http://samples.leanpub.com/buildingsecurephpapps-sample.pdf" class="button dl-link" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Download_Sample', 'Clicked Download Sample']);">Download Sample</a>

				<img src="images/product-sample.png" alt="Sample">
			</div> <!-- /.product-sample -->

		</div> <!-- /.container -->

	</section> <!-- #overview -->




	<section id="cta" class="cta boxed">
		<div class="container">

			<div id="cta-container">
				<span class="cta-txt">Get It Now For Just $<?=$price?></span>
				<br /><br />
			</div>
			<a href="<?=$url?>" class="button purchase-button" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'CTA_Purchase_Now', 'Clicked Purchase Now to proceed to Apress']);">Purchase <span>Now</span></a>
			<br /><br />
			<p>Secure checkout on Apress</p>

		</div> <!-- /.container -->
	</section> <!-- #cta -->




	<section id="testimonials" class="testimonials boxed">

		<div class="section-header">
			<h3 class="title">The <span class="title-highlight">Testimonials</span></h3>

			<p class="description">
				These people think you should buy this ebook.
			</p>
		</div> <!-- /.section-header -->

		<div class="testimonial">
			<div class="container">
				<div class="three columns">
					<img src="images/tony-dew.jpg" alt="Tony Dew">
				</div>

				<div class="thirteen columns">
					<div class="profile">
						<span class="name">Tony Dew</span>

						<div class="ratings">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div> <!-- /.ratings -->

						<p>Great balance of what you need to know, why you need to know it, and how to do it. <strong>This book is worth every penny</strong>.</p>
					</div> <!-- /.profile -->
				</div>
			</div> <!-- /.container -->
		</div> <!-- /.testimonial -->

		<div class="testimonial">
			<div class="container">

				<div class="thirteen columns">
					<div class="profile">
						<span class="name">Jeff Carouth</span>

						<div class="ratings">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div> <!-- /.ratings -->

						<p><strong>10/5</strong> would read again!</p>
					</div> <!-- /.profile -->
				</div>

				<div class="three columns">
					<img src="images/jeff-carouth.jpeg" alt="Jeff Carouth">
				</div>

			</div> <!-- /.container -->
		</div> <!-- /.testimonial -->

		<div class="testimonial">
			<div class="container">
				<div class="three columns">
					<img src="images/maks-surguy.jpeg" alt="Maks Surguy">
				</div>

				<div class="thirteen columns">
					<div class="profile">
						<span class="name">Maks Surguy</span>

						<div class="ratings">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div> <!-- /.ratings -->

						<p>This book gave me quite a few <strong>new insights</strong> and made me aware of potential weaknesses in my own applications.</p>
					</div> <!-- /.profile -->
				</div>

			</div> <!-- /.container -->
		</div> <!-- /.testimonial -->



	</section> <!-- #testimonials -->





	<section id="author" class="author boxed">

		<div class="section-header">
			<h3 class="title">About The <span class="title-highlight">Author</span></h3>

			<p class="description">
				Ben Edmunds leads development teams to create cutting-edge web and mobile applications. He is an active leader, developer, and speaker in various development communities, especially the CodeIgniter and Laravel PHP framework communities. He has been developing software professionally for over 10 years and in that time has worked on everything from robotics to government projects.
				<br /><br />
				PHP Town Hall podcast co-host.  Open source advocate.  Nice guy.
			</p>
		</div> <!-- /.section-header -->

		<div class="container">
			<div class="sixteen columns">
				<div class="author-info">
					<div class="author-avatar">
						<img src="images/benedmunds.jpg" alt="Ben Edmunds">
					</div> <!-- /.author-avatar-->

					<div class="author-meta">
						<span class="name">Ben Edmunds</span>
						<div class="social">
							<a href="http://www.twitter.com/benedmunds" target="_blank" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Social_Twitter', 'Clicked Twitter link']);"><i class="fa fa-twitter"></i></a>
							<a href="http://github.com/benedmunds" target="_blank" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Social_Github', 'Clicked Github link']);"><i class="fa fa-github"></i></a>
						</div> <!-- /.social -->
					</div> <!-- /.author-meta -->

					<div class="clearfix"></div>
				</div> <!-- /.author-info -->
			</div> <!-- /.sixteen columns -->
		</div> <!-- /.container -->
	</section> <!-- #author -->





	<section id="purchase" class="purchase boxed">

		<div class="section-header">
			<h3 class="title"><span class="title-highlight">Purchase</span> <span class="product-name">Peace of Mind</span></h3>

			<p class="description">
				Never lose another night's sleep to security issues.  Using the patterns outlined in this ebook you'll only have to email your clients about their bills and not about a compromisation.
			</p>
		</div> <!-- /.section-header -->



		<div class="container">
			<div class="eight columns">

				<div class="price-table recommended">
					<h4 class="price-table-title">Ebook</h4>
					<p><strong>(Instant Access)</strong></p>

					<div class="price">
						<p><span>$</span><?=$price?></p>
					</div>

					<div class="price-table-description">
						<p><strong>PDF</strong><br />(for Mac or PC)</p>
						<p><strong>EPUB</strong><br />(for iPad / iPhone / Android / ebook readers)</p>
						<p><strong>Digitally watermarked, DRM-free</strong></p>
						<p><br /></p>
						<p><strong>ISBN 978-1-4842-2119-8</strong></p>
					</div> <!-- /.price-table-description -->

					<a href="<?=$url?>" class="button" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'CTA_Buy_Now', 'Clicked Buy Now to proceed to Apress']);">Buy Now</a>
				</div> <!-- /.price-table -->

			</div>
			<div class="eight columns">

				<div class="price-table recommended">
					<h4 class="price-table-title">Softcover</h4>
					<p><strong>&nbsp;</strong></p>

					<div class="price">
						<p><span>$</span>14.99</p>
					</div>

					<div class="price-table-description">
						<p><strong>Free shipping for individuals worldwide</strong></p>
						<p><strong>Usually dispatched within 3 to 5 business days.</strong></p>
						<p><br /></p>
						<p><strong>ISBN 978-1-4842-2119-8</strong></p>
					</div> <!-- /.price-table-description -->

					<a href="<?=$url?>" class="button" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'CTA_Buy_Now', 'Clicked Buy Now to proceed to Apress']);">Buy Now</a>
				</div> <!-- /.price-table -->

			</div>
		</div> <!-- /.container -->
	</section> <!-- #purchase -->




	<section id="contact" class="contact boxed" style="display:none;">

		<div class="section-header">
			<h3 class="title"><span class="title-highlight">Discuss</span></h3>

			<p class="description">
				It would be great to hear your feedback.  <a href="https://leanpub.com/buildingsecurephpapps/feedback" target="_blank" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Discuss', 'Clicked Join Coversation to proceed to Leanpub discussion']);">Join the discussion</a>.
			</p>
		</div> <!-- /.section-header -->

	</section> <!-- #contact -->




	<footer class="boxed">
		<div class="section-header">
			<h3 class="title">Thanks!</h3>

			<p class="description">
				I hope you enjoyed the book (you bought it right... right) and learned a ton.  Thanks for reading!
			</p>
		</div> <!-- /.section-header -->

		<div class="copyright">
			<p>
				&copy; 2014 <a href="http://benedmunds.com" onClick="_gaq.push(['_trackEvent', 'Landing_Click', 'Footer_Blog', 'Clicked link in footer to see the Blog']);">Ben Edmunds</a>
			</p>
		</div>


		<div id="back-to-top" class="back-to-top">
			<a href="#"><i class="fa fa-chevron-up back-top"></i></a>
		</div>
	</footer>

<!-- JS -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="js/vendor/jquery.placeholder.js"></script>
<script src="js/vendor/jquery.validate.min.js"></script>
<script src="js/vendor/waypoints.min.js"></script>
<script src="js/vendor/jquery.flexslider-min.js"></script>
<script src="js/main.js"></script>
<script src="js/animations.js"></script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-46501008-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body>
</html>
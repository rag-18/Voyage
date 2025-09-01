<?php
session_start();
$conn = new mysqli("localhost","root","","voyage");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>VOGAYE - Travel and Tourism</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  			 <div align="center" style="background-color:#343a40; color: white;">
				<?php if(isset($_SESSION['msg'])) { 
					echo $_SESSION['msg']; 
					unset($_SESSION['msg']); 
				}?>
			</div>
	
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">VOYAGE</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="places.php" class="nav-link">Places</a></li>
	          <li class="nav-item"><a href="hotel.php" class="nav-link">Packages</a></li>
	          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="review.php" class="nav-link">Review</a></li>

			  <?php 
				if (isset($_SESSION['a'])): 
				$user=$_SESSION['a'];
				?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $user; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php" style="font-size: 1rem;">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="userhistory.php" style="font-size: 1rem;">
                                <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i> History
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="font-size: 1rem;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a href="login/login.php" class="nav-link">Login</a></li>
                <?php endif; ?>

			 
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
	
		  <!-- Logout Modal -->
			<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							<a class="btn btn-primary" href="/voyage/login/logout.php">Logout</a>
						</div>
					</div>
				</div>
			</div>
<!-- End Logout Modal -->
	
	
	
    <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_001.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate mb-5 pb-5 text-center text-md-left" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Discover <br>
              A new Place</h1>
            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Find great places to stay, eat, shop, or visit from local experts</p>
          </div>
        </div>
      </div>
    </div>


   <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4">
    				<div class="intro ftco-animate">
    					<h3>Travel</h3>
    					<p>Kerala, "God's Own Country," is a haven of lush greenery, serene backwaters, and pristine beaches. From Alleppey's tranquil houseboat cruises to Munnar's misty hills, it offers natural beauty and rich culture. Experience Kathakali, Ayurveda, and flavorful cuisine, or explore ancient temples and wildlife sanctuaries for an unforgettable journey.</p>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="intro ftco-animate">
    					<h3>Experience</h3>
    					<p>Discover the soul of Kerala through its unique experiences. Cruise the calm backwaters, hike through lush hills, and unwind with soothing Ayurvedic treatments. Witness captivating cultural performances, taste the spices of Kerala’s cuisine, and connect with its rich traditions. Every experience here leaves an indelible mark on your journey.</p>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="intro ftco-animate">
    					<h3>Relax</h3>
    					<p>Find your sanctuary in Kerala, where every corner whispers peace and serenity. Indulge in calming Ayurvedic treatments, and let the natural beauty of the landscape soothe your mind and body. In this haven, every moment is an invitation to relax and rejuvenate.</p>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">See our latest Travel Packages</h2>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-4 ftco-animate">
        		<a href="hotel.php" class="destination-entry img" style="background-image: url(images/destination-01.jpg);">
        			<div class="text text-center">
        				<h3>Solo</h3>
        			</div>
        		</a>
        	</div>
        	<div class="col-md-4 ftco-animate">
        		<a href="hotel.php" class="destination-entry img" style="background-image: url(images/destination-02-1.jpg);">
        			<div class="text text-center">
        				<h3>Group</h3>
        			</div>
        		</a>
        	</div>
        	<div class="col-md-4 ftco-animate">
        		<a href="hotel.php" class="destination-entry img" style="background-image: url(images/destination-03.jpg);">
        			<div class="text text-center">
        				<h3>Couple</h3>
        			</div>
        		</a>
        	</div>
        </div>
    	</div>
    </section>
		
		<section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(images/about003.jpg);"></div>
    	<div class="one-half ftco-animate">
        <div class="heading-section ftco-animate ">
          <h2 class="mb-4">Experience KERALA</h2>
        </div>
        <div>
  				<p>Kerala, a picturesque state located in the southwestern part of India, is known for its lush green landscapes, serene backwaters, and vibrant culture. Often referred to as "God's Own Country," Kerala offers a unique blend of natural beauty and rich heritage. Its network of tranquil backwaters, hill stations, and pristine beaches make it a popular tourist destination. Kerala is also known for its traditional art forms like Kathakali and Mohiniyattam, Ayurvedic wellness treatments, and a diverse cuisine that reflects the state's tropical environment. With a high literacy rate and progressive social policies, Kerala stands out as one of India's most developed and culturally diverse states.</p>
  			</div>
    	</div>
    </section>

    <section class="ftco-section services-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-yatch"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Special Activities</h3>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-around"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Travel Arrangements</h3>
              </div>
            </div>    
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-compass"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Private Guide</h3>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-map-of-roads"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Location Manager</h3>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Most Popular Destinations</h2>
          </div>
        </div>    		
    	</div>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/destination-101.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Jew Town</a></h3>
		    					
	    						</div>
	    					
    						</div>
    						<p>Historic Jew Town, the heart of the once-thriving Cochin Jewish community, is known for its old-world charm and 16th-century Paradesi Synagogue</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Kochi, Kerala </span> 
    							
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination d-md-flex flex-column-reverse">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/destination-202.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Athirappilly Falls</a></h3>
		    						
	    						</div>
	    						
    						</div>
    						<p>Athirapally Waterfalls offers a breathtaking view from both the top and bottom, showcasing its sheer power and beauty. Surrounded by lush greenery, it stands as a natural wonder captivating the hearts of nature lovers and adventure enthusiasts alikes</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Thrissur, Kerala</span> 
    							    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/destination-303.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#"> Meesapulimala</a></h3>
	    						</div>
	    					</div>
    						<p>Meesapulimala is an Indian peak, the next south of the second highest peak of the Western Ghats on the border of Idukki district, Kerala state. Its peak is 2,640 metres above sea level.
								</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Idukki, Kerala</span> 
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination d-md-flex flex-column-reverse">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/destination-104.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
								<h3><a href="#">Alleppey Houseboats</a></h3>
	    						</div>
	    						<div class="two">
    						    </div>
    						</div>
    						<p>Houseboats offer an immersive journey through the serene backwaters of Kerala. Imagine yourself cruising along picturesque waterways, indulging in delicious meals prepared onboard, and enjoying uninterrupted relaxation day and night.
							</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Alappuzha, Kerala</span> 
    						</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

		
		<div class="container-fluid"></div>
    		<div class="row">
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/VARKALA.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Varkala</a></h3>
		    					
	    						</div>
	    					
    						</div>
    						<p>Varkala is a town in the south Indian state of Kerala. It’s on the Arabian Sea and known for Varkala Beach, backed by palm-covered red cliffs. Just south, Papanasam Beach is believed to have holy waters. On a nearby hill, the ancient Janardanaswamy Temple is a Hindu pilgrimage site dedicated to Vishnu. </p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Thiruvanathapuram, Kerala </span> 
    							
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination d-md-flex flex-column-reverse">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/theyyam.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Kannur</a></h3>
		    						
	    						</div>
	    						
    						</div>
    						<p>Theyyam is a ritual art form that is performed in Kannur, Kerala, India. It is a combination of dance, music, storytelling, and other elements that depict gods, goddesses, and spirits. The performances are believed to bring well-being to society and the family. 
							</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Kannur, Kerala</span> 
    					    </p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/wayanad.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#"> Wayanad</a></h3>
	    						</div>
    						</div>
    						<p>Wayanad is a rural district in Kerala state, southwest India. In the east, the Wayanad Wildlife Sanctuary is a lush, forested region with areas of high altitude, home to animals including Asiatic elephants, tigers, leopards and egrets. In the Ambukuthi Hills to the south, Edakkal Caves contain ancient petroglyphs, some dating back to the Neolithic age.</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Wayanad, Kerala</span> 
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination d-md-flex flex-column-reverse">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/Fort.jpg);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-link"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="#">Kasaragod</a></h3>
								</div>
    						</div>
    						<p>Bekal Fort is a medieval fort built by Shivappa Nayaka of Keladi in 1650 AD, at Bekal. It is the largest fort in Kerala, spreading over 40 acres.The fort appears to emerge from the sea. Almost three-quarters of its exterior is in contact with water. An important feature is the water-tank, magazine and the flight of steps leading to an observation tower built by Tipu Sultan.</p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span><i class="icon-map-o"></i> Kasaragod, Kerala</span>
    						</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="100000">0</strong>
		                <span>Happy Customers</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="40000">0</strong>
		                <span>Destination Places</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="87000">0</strong>
		                <span>Hotels</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="56400">0</strong>
		                <span>Restaurant</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>


    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4"><strong>Latest</strong> Packages</h2>
          </div>
        </div>    		
    	</div>

    	<div class="container-fluid">
    		<div class="row">
								<?php
			$sql2 = "SELECT * FROM packages WHERE status = 1 ORDER BY package_ID DESC LIMIT 4";
			$result2 = $conn->query($sql2);
			
			if ($result2->num_rows > 0) {
				while ($row2 = $result2->fetch_assoc()) {
					?>
    			<div class="col-sm col-md-6 col-lg ftco-animate">
    				<div class="destination">
    					<a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(/voyage/images/<?php echo $row2["image"]; ?> );">

    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><?php echo $row2["title"]; ?></a></h3>
	    						</div>
	    						<div class="two">
	    							<span class="price per-price"> ₹ <?php echo $row2["price"]; ?><br><small></small></span>
    							</div>
    						</div>
    						<p> <?php echo $row2["description"]; ?></p>
    						<hr>
    						<p class="bottom-area d-flex">
    							<span class="ml-auto"><a href="hotel.php">View</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
				<?php
				}
			}
			?>

    		</div>
    	</div>
    </section>

    

    
   

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">VOYAGE</h2>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About Us</a></li>
                <li><a href="#" class="py-2 d-block">Call Us</a></li>
                <li><a href="#" class="py-2 d-block">General enquiries</a></li>
                <li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, Kochi, Kerala</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+91 1234567890</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
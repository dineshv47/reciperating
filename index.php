<?php
include('config/session.php');
include('layout/header.php');
?>
<!-- Slider
		============================================= -->
<section id="slider" class="slider-element min-vh-60 min-vh-md-100 include-header">
	<div class="slider-inner">

		<div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="distortion-addon" data-source="gallery" style="background:#000000;padding:0px;">
			<!-- START REVOLUTION SLIDER 5.4.8.1 fullscreen mode -->
			<div id="rev_slider_2_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8.1">
				<ul>
					<?php
					$sql = "SELECT * FROM recipes ORDER BY RAND() LIMIT 0, 2 ";
					//echo $sqlEmail;
					$result = $conn->query($sql);
					//print_r($result);

					if ($result->num_rows > 0) {

						while ($row = $result->fetch_object()) {
							$rating = 0;
							$sql1 = "SELECT rating FROM reviews WHERE recipe_id = " . $row->id;
							//echo $sqlEmail;
							$result1 = $conn->query($sql1);
							if ($result1->num_rows > 0) {
								while ($row1 = $result1->fetch_object()) {
									$rating = $rating + $row1->rating;
								}
								$rating = $rating / $result1->num_rows;
							}

							$sqlingredients = "SELECT * FROM ingredients WHERE recipe_id = " . $row->id;
							$ingredients = $conn->query($sqlingredients);


							// $sql2 = "SELECT rating FROM  WHERE recipe_id = " . $row->id;
							// //echo $sqlEmail;
							// $result2 = $conn->query($sql2);


					?>
							<!-- SLIDE  -->
							<li data-index="rs-<?php echo $row->id ?>" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="images/slider/1/100x50-bg.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-liquideffect='{"image":"images/slider/fibers_small.jpg","imagesize":"external","autoplay":true,"scalex":4,"scaley":4,"speedx":0.5,"speedy":-0.5,"rotationx":0,"rotationy":0,"rotation":0,"transtime":2000,"easing":"Power3.easeOut","transcross":false,"transpower":false,"transitionx":0,"transitiony":0,"transpeedx":0,"transpeedy":0,"transrotx":0,"transroty":0,"transrot":0}'>
								<!-- MAIN IMAGE -->
								<img src="images/slider/dummy.png" alt="Image" data-duration="4000" data-lazyload="images/slider/1/bg.jpg" data-bgposition="center center" data-bgfit="cover" data-bgparallax="4" class="rev-slidebg" data-no-retina>
								<!-- LAYERS -->

								<!-- LAYER NR. 1 -->
								<h3 class="tp-caption font-primary" id="slide-<?php echo $row->id ?>-layer-13-1" data-x="['left','left','middle','middle']" data-hoffset="['0','30','0','0']" data-y="['middle','middle','top','top']" data-voffset="['-200','-200','80','20']" data-fontsize="['54','54','54','40']" data-width="auto" data-height="auto" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1200,"split":"words","splitdelay":0.05,"speed":1000,"split_direction":"forward","frame":"0","from":"x:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","split":"words","splitdelay":0.02,"speed":300,"split_direction":"backward","frame":"999","to":"auto:auto;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" style="z-index: 7; white-space: nowrap; font-size: 54px; line-height: 54px; letter-spacing: 0px; color:#FFF"><?php echo $row->title ?></h3>

								<!-- LAYER NR. 2 -->
								<!-- <p class="tp-caption Restaurant-Description " id="slide-7-layer-13-2" data-x="['left','left','middle','middle']" data-hoffset="['0','30','0','0']" data-y="['middle','middle','top','top']" data-voffset="['-100','-100','180','80']" data-fontsize="['18','18','18','18']" data-lineheight="['30','30','30','30']" data-fontweight="['400','400','400','400']" data-width="['480','400','480','400']" data-height="auto" data-visibility="['on', 'on', 'off', 'off']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"split":"words","splitdelay":0.05,"speed":1000,"split_direction":"forward","frame":"0","from":"x:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","split":"words","splitdelay":0.02,"speed":300,"split_direction":"backward","frame":"999","to":"auto:auto;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['left','left','center','center']" style="z-index: 5; min-width: 480px; max-width: 480px; white-space: normal; letter-spacing: 0px;">Appropriately provide access to front-end potentialities via synergistic experiences. Competently maximize open-source imperatives after corporate systems.</p> -->

								<!-- LAYER NR. 3 -->
								<div class="tp-caption" id="slide-<?php echo $row->id ?>-layer-12" data-x="['right','right','middle','middle']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','-70','-10']" data-width="auto" data-height="auto" data-whitespace="normal" data-type="image" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;">
									<div class="rs-looped rs-rotate" data-easing="Linear.easeNone" data-startdeg="0" data-enddeg="180" data-speed="40" data-origin="50% 50%"><img src="<?php echo $row->image ?>" alt="Image" data-ww="['530px','400px','200px','200px']" data-hh="['530px','400px','200px','200px']" data-lazyload="<?php echo $row->image ?>" data-no-retina> </div>
								</div>

								<!-- LAYER NR. 6 -->
								<div class="tp-caption  " id="slide-<?php echo $row->id ?>-layer-20" data-x="['left','left','middle','middle']" data-hoffset="['0','30','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','90','130']" data-width="auto" data-fontsize="['20','18','20','20']" data-height="auto" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":2600,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;">
									<span class="me-3">
										<?php
										for ($i = 1; $i <= round($rating, 0); $i++) {
										?>
											<i class="icon-star"></i>
										<?php } ?>
										<?php
										for ($i = 1; $i <= (5 - round($rating, 0)); $i++) {
										?>
											<i class="icon-star2"></i>
										<?php } ?>
									</span>
									<strong><?php echo round($rating) ?> </strong>
									<span style="font-weight: 300">Ratings</span>
								</div>

								<!-- LAYER NR. 5 -->
								<div class="tp-caption slider-features tp-resizeme" id="slide-<?php echo $row->id ?>-layer-19" data-x="['left','left','middle','middle']" data-hoffset="['0','30','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['100','100','210','230']" data-width="auto" data-height="auto" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":2500,"split":"words","splitdelay":0.05,"speed":1000,"split_direction":"forward","frame":"0","from":"x:50px;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","split":"words","splitdelay":0.02,"speed":300,"split_direction":"backward","frame":"999","to":"auto:auto;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;">
									<ul class="list-unstyled dark">
										<li class="d-inline-block">
											<img src="images/icons/timer.svg" alt="Timer" width="30">
											<h4><?php echo $row->duration ?></h4>
										</li>

										<li class="d-inline-block">
											<img src="images/icons/ingredients.svg" alt="ingredients" width="30">
											<h4><?php echo $ingredients->num_rows ?> ingredients</h4>
										</li>
										<!-- 
										<li class="d-inline-block">
											<img src="images/icons/kcal.svg" alt="kcal" width="30">
											<h4><?php echo $row->duration ?></h4>
										</li> -->
									</ul>
								</div>

								<a class="tp-caption rev-btn button button-large m-0 button-white fw-bold button-circle button-light" href="<?php echo BASE_URL; ?>recipe-single.php?id=<?php echo $row->id ?>" target="_blank" id="slide-7-layer-13" data-x="['left','left','middle','middle']" data-hoffset="['0','30','0','0']" data-y="['middle','middle','bottom','bottom']" data-voffset="['200','200','30','0']" data-width="auto" data-height="auto" data-type="button" data-actions='' data-responsive_offset="off" data-responsive="off" data-fontsize="['17', '17', '15', '15']" data-lineheight="['40', '40', '30', '30']" data-frames='[{"delay":3000,"speed":1600,"frame":"0","from":"x:50px;z:0;rX:0;rY:0;rZ:0;sX:1.1;sY:1.1;skX:0;skY:0;opacity:0;fbr:100;","bgcolor":"#FFF","to":"o:1;fbr:100;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","bgcolor":"#FFF","to":"opacity:0;fbr:100;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"150","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;fbr:90%;","style":"c:#000;"}]' style="z-index: 9; background-color: #FFF; padding: 4px 28px"><span>View Recipe</span> <i class="icon-angle-right"></i>
								</a>
							</li>
							<!-- SLIDE  -->

						<?php
						}
					} else {
						?>

						<h4 class="nott ls0 ms-sm-4 mt-sm-4">No recipes found!</h4>
					<?php
					}
					?>
				</ul>
				<div class="tp-bannertimer" style="height: 6px; background: rgba(255,255,255,0.15);"></div>
			</div>
		</div><!-- END REVOLUTION SLIDER -->

	</div>
</section>

<!-- Content
		============================================= -->
<section id="content">
	<div class="content-wrap pb-0" style="overflow: visible;">

		<div class="section mt-2 bg-transparent">
			<div class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2 center">
						<h2 class="text-title-light text-dark mb-5 ls1 text-uppercase">Customer reviews are marketing and sales tools for your business</h2>
						<p style="font-size: 17px; color: #777">The other major reason for obtaining reviews is the opportunity to share them with potential customers. Positive reviews can be used as customer testimonials during lead acquisition and can help you add more contacts to your CRM. In fact, 91% of consumers read at least one review before ordering a food. So, don't just pat yourself on the back the next time you get a five-star review; Make sure everyone knows how good your recipe is.<br><br>Cheers to all that you cook!</p>
						
					</div>
					<div class="col-12 mt-5 mb-3">
						<h3 class="center">Browse by Category</h3>

						<div class="recipe-categories justify-content-center">
							<?php
							$sql = "SELECT * FROM categories";
							//echo $sqlEmail;
							$result = $conn->query($sql);
							//print_r($result);


							if ($result->num_rows > 0) {
								while ($row = $result->fetch_object()) {
							?>
									<a href="<?php echo BASE_URL; ?>recipes.php?id=<?php echo $row->id; ?>" data-animate="fadeInUp" class="recipe-category" style="background-image: url('<?php echo $row->image ?>');">
										<div class="recipe-category-inner">
											<div class="recipe-category-icon"><img src="<?php echo $row->icon ?>" alt="Breakfast"></div>
											<div class="recipe-category-info"><?php echo $row->title; ?></div>
										</div>
									</a>

							<?php
								}
							}
							?>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="section recipe-items p-0" style="overflow: visible;background-color: #f9f9f9">
			<div class="row align-items-stretch align-content-stretch g-0">
				<div class="col-lg-4 dark">
					<div class="position-sticky min-vh-60 min-vh-md-100 d-flex flex-column align-items-center center justify-content-center" style="top:0; background: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.5)), url('images/popular/side-bg.jpg') center center / cover;">
						<h2 class="display-4 px-3 center fw-bold d-block">Latest<br>Recipes</h2>
						<a href="recipes.php" class="button button-large button-light button-white button-circle m-0 px-5">View All</a>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="row g-0">
						<?php
						$sql = "SELECT * FROM recipes ORDER BY id DESC LIMIT 0, 9 ";
						//echo $sqlEmail;
						$result = $conn->query($sql);
						//print_r($result);


						if ($result->num_rows > 0) {
							while ($row = $result->fetch_object()) {
								$rating = 0;
								$sql1 = "SELECT rating FROM reviews WHERE recipe_id = " . $row->id;
								//echo $sqlEmail;
								$result1 = $conn->query($sql1);
								if ($result1->num_rows > 0) {
									while ($row1 = $result1->fetch_object()) {
										$rating = $rating + $row1->rating;
									}
									$rating = $rating / $result1->num_rows;
								}


						?>
								<!-- Item 1 -->
								<div class="col-sm-4 col-6">
									<div class="card">
										<div class="card-body">
											<img src="<?php echo $row->image ?>" alt="image">
											<div class="d-flex justify-content-between align-items-center mt-4 mb-2">
												<p class="card-author">By <a href="#"><?php echo $row->author ?></a></p>
												<span class="badge bg-primary bg-color"><i class="icon-star3"></i> <?php echo round($rating) ?></span>
											</div>
											<h3 class="card-title"><a href="<?php echo BASE_URL; ?>recipe-single.php?id=<?php echo $row->id ?>" class="stretched-link"><?php echo $row->title ?></a></h3>
											<h5 class="card-date"><i class="icon-line2-calendar"></i><?php echo date('d, M Y', strtotime($row->created_at)) ?></h5>
										</div>
									</div>
								</div>
							<?php
							}
						} else {
							?>

							<h4 class="nott ls0 ms-sm-4 mt-sm-4">No recipes found!</h4>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="section bg-transparent" style="padding: 100px 0">
			<div class="container">
				<h2 class="text-title-light" style="margin: 0 0 -20px 15px;">Recipes of the Week</h2>
				<div id="recipes-carousel" class="owl-carousel carousel-widget" data-margin="0" data-nav="true" data-pagi="false" data-items="1">


					<?php
					$sql = "SELECT * FROM recipes ORDER BY RAND() LIMIT 0, 2 ";
					//echo $sqlEmail;
					$result = $conn->query($sql);
					//print_r($result);

					if ($result->num_rows > 0) {

						while ($row = $result->fetch_object()) {
							$rating = 0;
							$sql1 = "SELECT rating FROM reviews WHERE recipe_id = " . $row->id;
							//echo $sqlEmail;
							$result1 = $conn->query($sql1);
							if ($result1->num_rows > 0) {
								while ($row1 = $result1->fetch_object()) {
									$rating = $rating + $row1->rating;
								}
								$rating = $rating / $result1->num_rows;
							}


							// $sql2 = "SELECT rating FROM  WHERE recipe_id = " . $row->id;
							// //echo $sqlEmail;
							// $result2 = $conn->query($sql2);


					?>
							<!-- Item 1 -->
							<!-- <div class="col-sm-4 col-6">
								<div class="card">
									<div class="card-body">
										<img src="<?php echo $row->image ?>" alt="image">
										<div class="d-flex justify-content-between align-items-center mt-4 mb-2">
											<p class="card-author">By <a href="#"><?php echo $row->author ?></a></p>
											<span class="badge bg-primary bg-color"><i class="icon-star3"></i> <?php echo round($rating) ?></span>
										</div>
										<h3 class="card-title"><a href="recipe-single.html" class="stretched-link"><?php echo $row->title ?></a></h3>
										<h5 class="card-date"><i class="icon-line2-calendar"></i><?php echo date('d, M Y', strtotime($row->created_at)) ?></h5>
									</div>
								</div>
							</div> -->
							<div class="row g-0 p-4 align-items-stretch rounded shadow">
								<div class="col-lg-5 rounded-start" style="background: url('<?php echo $row->image ?>') no-repeat center center / cover; min-height: 300px">
									<!-- <a href="https://www.youtube.com/watch?v=P3Huse9K6Xs" data-lightbox="iframe" class="play-video stretched-link">
										<i class="icon-play"></i>
									</a> -->
								</div>
								<div class="col-lg-7 d-flex justify-content-center flex-column rounded-end" style="padding: 80px 50px">
									<h3><?php echo $row->title ?></h3>
									<div class="slider-features d-none d-sm-block my-3">
										<ul class="list-unstyled">
											<li class="d-inline-block me-4">
												<img src="images/icons/timer-dark.svg" alt="Timer" width="30">
												<h5 class="mb-0"><?php echo $row->duration ?></h5>
											</li>

											<li class="d-inline-block me-4">
												<img src="images/icons/ingredients-dark.svg" alt="ingredients" width="30">
												<h5 class="mb-0"><?php echo $row->duration ?></h5>
											</li>

											<!-- <li class="d-inline-block">
											<img src="images/icons/kcal-dark.svg" alt="kcal" width="30">
											<h5 class="mb-0">600 Kcal</h5>
										</li> -->
										</ul>
									</div>
									<div><a href="<?php echo BASE_URL; ?>recipe-single.php?id=<?php echo $row->id ?>" class="button button-circle button-large m-0 fw-semibold nott ls0 text-end">View Recipe <i class="icon-angle-right"></i></a></div>
								</div>
							</div>
						<?php
						}
					} else {
						?>

						<h4 class="nott ls0 ms-sm-4 mt-sm-4">No recipes found!</h4>
					<?php
					}
					?>

				</div>

			</div>
		</div>
	</div>

	<div class="section m-0" style="background: url('images/subscribe-bg.jpg') no-repeat center center / cover; min-height: 300px; padding: 120px 0">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 mt-4 mt-sm-0 subscribe-widget" data-loader="button">
					<img src="images/icons/email.svg" alt="Enmail Icon" width="60" class="mb-4">
					<div class="heading-block border-bottom-0 mb-5">
						<h2 class="nott ls0 mb-1">Stay Tunned!</h2>
						<p class="lead text-muted">Easy Recipes Reviews right to your Inbox</p>
					</div>
					<div class="widget-subscribe-form-result"></div>
					<!-- <form id="widget-subscribe-form" action="assets/include/subscribe.php" role="form" method="post" class="mb-0">
						<div class="input-group input-group-lg">
							<input type="email" name="widget-subscribe-form-email" class="form-control required" placeholder="Enter Your Email Address..">
							<button type="submit" class="btn text-white bg-color px-4" id="inputGroup-sizing-lg">Subscribe</button>
						</div>
					</form> -->
				</div>

			</div>
		</div>
	</div>

	</div>
</section><!-- #content end -->
<?php include('layout/footer.php') ?>
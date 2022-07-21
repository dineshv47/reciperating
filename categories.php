<?php include('layout/header.php') ?>
<!-- Page Title
		============================================= -->
<section id="page-title" class="page-title-parallax page-title-dark include-header" style="background: #111 url('images/recipes-bg.jpg') center center / cover; padding: 100px 0;" data-0="background-position:0px -200px;" data-400="background-position:0px -100px;">

	<div class="container clearfix">
		<div class="row">
			<div class="col-md-7">
				<h1 class="nott mb-5" data-animate="zoomIn">Recipes</h1>
				<span data-animate="zoomIn" data-delay="300" class="text-white-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga debitis deleniti dolores cupiditate quia reiciendis, obcaecati facere. Amet et enim itaque sapiente. Culpa, incidunt, eveniet.</span>
			</div>
		</div>
	</div>

</section><!-- #page-title end -->

<!-- Content
		============================================= -->
<section id="content">
	<div class="content-wrap py-0" style="overflow: inherit;">

		<div class="recipe-items bg-light">
			<div class="row g-0 clearfix">
				<div class="col-lg-9 border-end-0 bg-white">
					<div class="row g-0">
						<?php
						if (isset($_GET) && $_GET['id'] != '') {
							$sql = "SELECT * FROM recipes WHERE category_id = " . $_GET['id'];
						} else {
							$sql = "SELECT * FROM recipes";
						}
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
												<span class="badge bg-primary bg-color"><i class="icon-star3"></i> <?php echo $rating ?></span>
											</div>
											<h3 class="card-title"><a href="recipe-single.html" class="stretched-link"><?php echo $row->title ?></a></h3>
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


						<!-- <div class="col-12 d-flex justify-content-end p-4">
							<a href="#" class="button button-circle m-0 text-end"><span>Next</span><i class="icon-angle-right"></i></a>
						</div> -->
					</div>
				</div>
				<div class="col-lg-3 py-5 px-4 position-sticky h-100" style="top: 80px">

					<div class="row border-0">
						<div class="col-lg-12 col-md-4 col-12 mt-5 mt-md-0 widget border-0 widget_links clearfix">

							<h4 class="nott ls0">Recipes Categories</h4>
							<ul>

								<?php
								$sql = "SELECT * FROM categories";
								//echo $sqlEmail;
								$result = $conn->query($sql);
								//print_r($result);


								if ($result->num_rows > 0) {
									while ($row = $result->fetch_object()) {
								?>

										<li><a href="<?php echo BASE_URL; ?>categories?id=<?php echo $row->id; ?>"><?php echo $row->title; ?></a></li>
								<?php
									}
								}
								?>
							</ul>

						</div>

					</div>

				</div>
			</div>
		</div>

		<div class="section m-0 center dark" style="background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.8)), url('images/about/2.jpg') no-repeat center center / cover; padding: 140px 0;">
			<div class="container">
				<blockquote class="blockquote text-center border-0 m-auto" style="max-width: 700px">
					<h2 class="h1 fw-bold text-capitalize" style="line-height: 1.4">To get the best results, you must talk to your Vegetables.</h2>
					<footer class="blockquote-footer text-white-50 mt-4">Charles, <cite title="Source Title">Prince of Wales</cite></footer>
				</blockquote>
			</div>
		</div>

	</div>
</section><!-- #content end -->

<?php include('layout/footer.php') ?>
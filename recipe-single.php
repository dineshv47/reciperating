<?php
include('config/session.php');
include('layout/header.php');

$message = '';
$message_type = '';

$errors = array(
	'rating' => '',
	'comment' => '',
);

if ($_POST && $_POST['submit'] != '') {

	$message = "";
	$message_type = '';

	if ($_POST['rating'] == '') {
		$errors['rating'] = 'Please select rating';
	}
	if ($_POST['comment'] == '') {
		$errors['comment'] = 'Please enter comment';
	}



	//print_r($errors);
	if ($errors['rating'] == '' && $errors['comment'] == '') {

		$sql = "INSERT INTO reviews (rating, comment, user_id, recipe_id) VALUES (" . $_POST['rating'] . ",'" . $_POST['comment'] . "'," . $_SESSION['id'] . "," . $_GET['id'] . ")";
		if ($conn->query($sql) === TRUE) {
			$message = "Reviews successfully added!";
			$message_type = 'success';
			$_POST = [];
		} else {
			$message = $conn->error;
			$message_type = 'danger';
			//echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

if (isset($_GET) && $_GET['id'] != '') {

	$sqlrecipe = "SELECT * FROM recipes WHERE id = " . $_GET['id'];
	$recipeResult = $conn->query($sqlrecipe);
	$recipe = $recipeResult->fetch_object();

	$rating = 0;
	$sql1 = "SELECT rating FROM reviews WHERE recipe_id = " . $_GET['id'];
	//echo $sqlEmail;
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while ($row1 = $result1->fetch_object()) {
			$rating = $rating + $row1->rating;
		}
		$rating = $rating / $result1->num_rows;
	}

	$sqlparam = "SELECT * FROM parameters WHERE recipe_id = " . $_GET['id'];
	$params = $conn->query($sqlparam);

	$sqlingredients = "SELECT * FROM ingredients WHERE recipe_id = " . $_GET['id'];
	$ingredients = $conn->query($sqlingredients);

	$sqlEmail = "SELECT * FROM reviews WHERE recipe_id = " . $_GET['id'];
	$reviews = $conn->query($sqlEmail);

	$sqlPrep = "SELECT * FROM preparations WHERE recipe_id = " . $_GET['id'] . " ORDER BY id DESC";
	$preparations = $conn->query($sqlPrep);
} else {
	header('Location: ' . BASE_URL);
}


//print_r($reviews);

?>
<!-- Page Title
		============================================= -->
<section id="slider" class="slider-element dark parallax include-header" style="background: #111 url('images/recipe-single.jpg') center center / cover; padding: 230px 0;" data-0="background-position:0px -200px;" data-400="background-position:0px -100px;">

	<div class="container clearfix">
		<div class="mx-auto center" style="max-width: 800px">
			<h3 class="nott fw-bold mb-5 display-4" data-animate="zoomIn"><?php echo $recipe->title ?></h3>
		</div>
		<div class="mx-auto center" style="max-width: 900px">
			<div class="slider-features" data-animate="zoomIn" data-delay="300">
				<ul class="list-unstyled row g-0 align-items-center overflow-hidden col-mb-50 mt-5">
					<li class="col-6 col-lg text-center text-lg-start">
						<div class="grid-inner px-5">
							<img src="images/icons/level.svg" alt="Level" width="30">
							<h5 class="mb-0">Beginner Level</h5>
						</div>
					</li>

					<li class="col-6 col-lg text-center text-lg-start">
						<div class="grid-inner px-5">
							<img src="images/icons/timer.svg" alt="Timer" width="30">
							<h5 class="mb-0"><?php echo $recipe->duration ?></h5>
						</div>
					</li>

					<li class="col-6 col-lg text-center text-lg-start">
						<div class="grid-inner px-5">
							<img src="images/icons/ingredients.svg" alt="Ingredients" width="30">
							<h5 class="mb-0"><?php echo $ingredients->num_rows; ?> Ingredients</h5>
						</div>
					</li>

					<li class="col-6 col-lg text-center text-lg-start">
						<div class="grid-inner px-5">
							<img src="images/icons/star.svg" alt="Reviews" width="30">
							<h5 class="mb-0"><?php echo round($rating, 0) ?> Star</h5>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

</section><!-- #page-title end -->
<?php
if ($message != '') {
?>
	<div class="alert alert-<?php echo $message_type ?> fade show alertFeedback" role="alert">
		<?php echo $message ?>
		<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button> -->
	</div>
<?php
}
?>

<?php
if ($errors['comment'] != '' || $errors['rating'] != '') {
?>
	<div class="alert alert-danger fade show alertFeedback" role="alert">
		<?php echo $errors['comment'] ?>
		<?php echo $errors['rating'] ?>
		<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button> -->
	</div>
<?php
}
?>


<!-- Content
		============================================= -->
<section id="content" class="bg-light">
	<div class="content-wrap pt-0" style="overflow: visible;">
		<div class="container">

			<div class="card border-0 shadow-sm" style="top: -100px;">
				<div class="card-body px-4">
					<div class="row align-items-center justify-content-between py-3">
						<div class="col-12 col-xl">
							<div class="row justify-content-center col-mb-30">
								<?php if ($params->num_rows > 0) {
									while ($row = $params->fetch_object()) {
								?>
										<div class="col-4 col-md">
											<h6 class="text-black-50 text-uppercase font-body fw-normal ls1 mb-1"><?php echo $row->title ?></h6>
											<h4 class="mb-0"><?php echo $row->value ?></h4>
										</div>
								<?php
									}
								}
								?>

							</div>
						</div>

						<!-- <div class="col-12 text-center col-xl-auto mt-5 mt-xl-0">
							<a href="#" class="button button-circle m-0"><i class="icon-line-cloud-download"></i> Download</a>
						</div> -->
					</div>

					<div class="line my-4"></div>

					<div class="row justify-content-between mt-5 mb-4 clearfix">
						<div class="col-lg-4">
							<div class="d-flex justify-content-between align-items-center mb-4">
								<h4 class="mb-0">Ingredients</h4>
								<a href="javascript:window.print()" id="print-button" class="social-icon si-small si-colored si-print" title="Print">
									<i class="icon-line-printer"></i>
									<i class="icon-line-printer"></i>
								</a>
							</div>
							<ul class="list-unstyled list-ingredients bg-light p-4">
								<?php if ($ingredients->num_rows > 0) {
									while ($row = $ingredients->fetch_object()) {
								?>

										<li><?php echo $row->ingredients ?></li>
								<?php
									}
								}
								?>
							</ul>
						</div>
						<div class="col-lg-8 mt-5 mt-lg-0">
							<h4>Image</h4>
							<div class="rounded position-relative dark mb-5" style="background: url('<?php echo $recipe->image ?>') no-repeat center center / cover; min-height: 300px">
								<!-- <a href="https://www.youtube.com/watch?v=P3Huse9K6Xs" data-lightbox="iframe" class="play-video stretched-link">
									<i class="icon-play"></i>
								</a> -->
							</div>
							<h4>Preparation</h4>
							<ol class="list-unstyled list-preparation">

								<ul class="list-unstyled list-ingredients bg-light p-4">
									<?php if ($preparations->num_rows > 0) {
										while ($row = $preparations->fetch_object()) {
									?>

											<li><?php echo $row->text ?></li>
									<?php
										}
									}
									?>
								</ul>
							</ol>

							<div class="line my-5"></div>

							<!-- Post Navigation
							<!-- Comments
									============================================= -->
							<div id="comments" class="clearfix">



								<!-- Comment Form
		============================================= -->
								<div id="respond">

									<?php
									if (isset($_SESSION) && $_SESSION['user'] != '') {
									?>

										<h4>Leave a <span>Review</span></h4>
										<form class="row" action="" method="post" id="commentform">
											<input type="hidden" name="user_id" id="user_id" value="" size="22" tabindex="2" class="form-control form-control-pill" />
											<div class="col-md-4 form-group">
												<label class="nott ls0 fw-normal" for="rating">Rating</label>
												<div class="btn-group d-flex">
													<input type="radio" class="btn-check required" name="rating" id="rating-1" value="1">
													<label class="btn btn-outline-danger" for="rating-1">1</label>

													<input type="radio" class="btn-check required" name="rating" id="rating-2" value="2">
													<label class="btn btn-outline-danger" for="rating-2">2</label>

													<input type="radio" class="btn-check required" name="rating" id="rating-3" value="3">
													<label class="btn btn-outline-warning" for="rating-3">3</label>

													<input type="radio" class="btn-check required" name="rating" id="rating-4" value="4">
													<label class="btn btn-outline-success" for="rating-4">4</label>

													<input type="radio" class="btn-check required" name="rating" id="rating-5" value="5">
													<label class="btn btn-outline-success" for="rating-5">5</label>
												</div>
											</div>

											<div class="w-100"></div>

											<div class="col-12 form-group">
												<label class="nott ls0 fw-normal" for="comment">Comment</label>
												<textarea name="comment" cols="58" rows="7" tabindex="4" class="form-control form-control-pill"></textarea>
											</div>

											<div class="col-12 form-group">
												<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-circle button-large mt-3">Submit a Review</button>
											</div>

										</form>
									<?php
									} else {
									?>
										<h4><a href="<?php echo BASE_URL ?>login.php?redirect=recipe-single&id=<?php echo $_GET['id'] ?>" class="stretched-link" style="position: relative;">Login to give review</a></h4>
									<?php
									}
									?>

								</div><!-- #respond end -->

								<div class="clear"></div>

								<h4 id="comments-title">Reviews</h4>

								<!-- Comments List
										============================================= -->
								<ol class="commentlist clearfix">

									<?php
									if ($reviews->num_rows > 0) {
										while ($row = $reviews->fetch_object()) {
											$sql1 = "SELECT * FROM users WHERE id = " . $row->user_id;
											//echo $sqlEmail;
											$result1 = $conn->query($sql1);
											if ($result1->num_rows > 0) {
												$user = $result1->fetch_object();
												//print_r($user);
											}
									?>

											<li class="comment even thread-even depth-1" id="li-comment-1">

												<div id="comment-1" class="comment-wrap clearfix">

													<div class="comment-meta">

														<div class="comment-author vcard">
															<span class="comment-avatar clearfix">
																<img alt='Image' src='images/profile.png' class='avatar avatar-60 photo avatar-default' height='60' width='60' /></span>
														</div>

													</div>

													<div class="comment-content clearfix">

														<div class="comment-author"><?php echo $user->fname ?><span><a href="#" title="Permalink to this comment"><?php echo date('d, M Y', strtotime($row->created_at)) ?></a></span>
															<small class="comment-ratings text-muted mt-2"><i class="icon-star3"></i><i class="icon-star3"></i><i class="icon-star3"></i><i class="icon-star3"></i><i class="icon-star3"></i> </small>
														</div>

														<p><?php echo $row->comment; ?></p>

													</div>

													<div class="clear"></div>

												</div>


											</li>
										<?php
										}
									} else {
										?>
										<h6 id="comments-title">No Reviews yet!</h6>
									<?php
									}

									?>
								</ol><!-- .commentlist end -->

							</div><!-- #comments end -->
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section><!-- #content end -->

<?php include('layout/footer.php') ?>
<script>
	setTimeout(function() {
		$('.alert').fadeOut('slow');
	}, 5000);
</script>
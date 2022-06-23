<!Doctype html>
<html lang="eng">
<head>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include('common/head.php') ?>
    <style>
        .user-earningblock .earning-table .row h5 {
    text-align: left;
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #6c757d;
}
    </style>
</head>
<body>
<?php include('common/header.php') ?>
<!-- profile -->
<div class="my-profile">
	<div class="container">
		<div class="row">
		<?php include ('common/profile/menu.php') ?>
			<div class="col-md-9">
				<?php include ('common/profile/head.php') ?>
				
				<div class="user-earningblock">
								<?php if ($this->session->flashdata('error')) { ?>
							<div class="users_members">
								<div class="userss">
								<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
								</div>
							</div>
								<?php } ?>
								<?php if ($this->session->flashdata('success')) { ?>
							<div class="users_members">
								<div class="userss">
				 				<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
				 				</div>
				 			</div>
								<?php  } ?>							
						<div class="earning-table">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<h5>Earn through cashback</h5>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<h6><?=number_format($cashback,2)?></h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<h5>Earn through Topup</h5>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<h6><?=number_format($topup,2)?></h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<h5>Earn through Referral</h5>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<h6>0.00</h6>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<h5><span>Total Earned</span></h5>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<h6><span><?=@number_format($topup+$cashback,2)?></span></h6>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<h5><span>Total Spent</span></h5>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<h6><span><?=number_format($totalSpend,2)?></span></h6>
								</div>
							</div> -->
						</div>
						<!-- <div class="user-cart">
							<div class="cart-box">
								<div class="table-responsive cart-table">
									<table class="table">
										<tbody>
											<tr>
												<td width="20%">
													<div class="cart-product">
														<img src="<?=base_url('assets/')?>img/cart-img.png" class="img-fluid" alt="">
													</div>
												</td>
												<td width="50%">
													<div class="table-hd">
														<h3>iPad Air</h3>
														<h5>The all new 2022 Mercedes-AMG G63 is a legend raised to a higher power for a new era!</h5>
													</div>
													<ul>
														<li>
															<a href="#" class="remove-item success"> Accumulated Point <span>1</span>   </a>
														</li>
														<li>
															<a href="#" class="remove-item"> Est. Earnings  <span>5%</span> </a>
														</li>
													</ul>
												</td>
												<td>
													<div class="inquiry-and-buy">
														<p><a href="#"><i class="fas fa-heart"></i></a> &nbsp; &nbsp; <a href="#"><i class="fas fa-share-alt"></i></a></p>
													</div>
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="cart-box">
								<div class="table-responsive cart-table">
									<table class="table">
										<tbody>
											<tr>
												<td width="20%">
													<div class="cart-product">
														<img src="<?=base_url('assets/')?>img/cart-img.png" class="img-fluid" alt="">
													</div>
												</td>
												<td width="50%">
													<div class="table-hd">
														<h3>iPad Air</h3>
														<h5>The all new 2022 Mercedes-AMG G63 is a legend raised to a higher power for a new era!</h5>
													</div>
													<ul>
														<li>
															<a href="#" class="remove-item success"> Accumulated Point <span>1</span>   </a>
														</li>
														<li>
															<a href="#" class="remove-item"> Est. Earnings  <span>5%</span> </a>
														</li>
													</ul>
												</td>
												<td>
													<div class="inquiry-and-buy">
														<p><a href="#"><i class="fas fa-heart"></i></a> &nbsp; &nbsp; <a href="#"><i class="fas fa-share-alt"></i></a></p>
													</div>
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include('common/footer.php') ?>
<?php include('common/footer_script.php') ?>
<!-- Animation Js -->
<script>
	AOS.init({
	  duration: 1200,
	})
</script>
<script>
	/* TOP Menu Stick
	--------------------- */
	var s = $("#sticker");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos > pos.top) {
		s.addClass("stick");
		} else {
			s.removeClass("stick");	
		}
	});
</script>
<!-- Main Slider Js -->
<script>
	jQuery("#main-carousel").owlCarousel({
	  autoplay: true,
	  loop: true,
	  margin: 0,
	  transitionStyle : "goDown",
	  responsiveClass: true,
	  autoHeight: true,
	  autoplayTimeout: 7000,
	  smartSpeed: 800,
	  lazyLoad: false,
	  nav: false,
	  dots:true,
	  responsive: {
		0: {
		  items: 1
		},

		600: {
		  items: 1
		},

		1024: {
		  items: 1
		},

		1366: {
		  items: 1
		}
	  }
	});
</script>
<!-- Home Closing Soon Slider -->
<script>
	jQuery("#closing-soon").owlCarousel({
	  autoplay: true,
	  lazyLoad: true,
	  loop: true,
	  margin: 20,
	  responsiveClass: true,
	  autoHeight: true,
	  autoplayTimeout: 7000,
	  smartSpeed: 800,
	  dots: false,
	  nav: true,
	  responsive: {
		0: {
		  items: 1
		},

		600: {
		  items: 3
		},

		1024: {
		  items: 4
		},

		1366: {
		  items: 4
		}
	  }
	});
</script>
<!-- Home Sold Out Slider -->
<script>
	jQuery("#sold-out").owlCarousel({
	  autoplay: true,
	  lazyLoad: true,
	  loop: true,
	  margin: 20,
	  responsiveClass: true,
	  autoHeight: true,
	  autoplayTimeout: 7000,
	  smartSpeed: 800,
	  dots: false,
	  nav: true,
	  responsive: {
		0: {
		  items: 1
		},

		600: {
		  items: 3
		},

		1024: {
		  items: 4
		},

		1366: {
		  items: 4
		}
	  }
	});
</script>
<!-- Testimonial Slider -->
<script>
	var $owl = $('#testimonial');

		$owl.children().each( function( index ) {
		  $(this).attr( 'data-position', index ); // NB: .attr() instead of .data()
		});

		$owl.owlCarousel({
		  center: true,
		  loop: true,
		  dots:true,
		  nav:true,
		  responsive: {
			0: {
			  items: 1
			},

			600: {
			  items: 1
			},

			800: {
			  items: 3
			},

			1366: {
			  items: 3
			}
		  }
		});

		$(document).on('click', '.owl-item>div', function() {
		  // see https://owlcarousel2.github.io/OwlCarousel2/docs/api-events.html#to-owl-carousel
		  var $speed = 300;  // in ms
		  $owl.trigger('to.owl.carousel', [$(this).data( 'position' ), $speed] );
		});
</script>
<!-- Header Dropdown -->
<script>
	 $('.dropdown > .caption').on('click', function() {
		$(this).parent().toggleClass('open');
	});

	// $('.price').attr('data-currency', 'RUB');

	$('.dropdown > .list > .item').on('click', function() {
		$('.dropdown > .list > .item').removeClass('selected');
		$(this).addClass('selected').parent().parent().removeClass('open').children('.caption').html($(this).html());

		if ($(this).data("item") == "RUB") {
			console.log('RUB');
		} else if ($(this).data("item") == "UAH") {
			console.log('UAH');
		} else {
			console.log('USD');
		}
	});

	$(document).on('keyup', function(evt) {
		if ((evt.keyCode || evt.which) === 27) {
			$('.dropdown').removeClass('open');
		}
	});

	$(document).on('click', function(evt) {
		if ($(evt.target).closest(".dropdown > .caption").length === 0) {
			$('.dropdown').removeClass('open');
		}
	});
</script>
</body>
</html>
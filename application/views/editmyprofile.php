
<!Doctype html>
<html lang="eng">
<head>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include('common/head.php') ?>
    <style>
        .my-profile .confirm_password .change_passworded {
    text-align: end!important;
    padding: 28px 28px 17px 36px;
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
				<div class="users_form">
					<div class="profiles">
						<h4 class="information" >My Profile</h4>
					</div>
				    <form class="form-inline" method="post">
					<div class="row form_user">
					
					<div class="col-md-4 px-0">
						<input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo $profileDetails['users_id']; ?>">
					<div class="inputWithIcon">
                    <input type="text" value="<?php if(set_value('users_name')): echo set_value('users_name'); else: echo stripslashes($profileDetails['users_name']); endif; ?>" placeholder="Name" name="users_name" class=" <?php if(form_error('users_name')): ?>error<?php endif; ?>">
						  <i class="far fa-user " aria-hidden="true"></i>
						  <?php if(form_error('users_name')): ?>
	                          <label id="users_name-error" class="error" for="users_name"><?php echo form_error('users_name'); ?></label>
	                        <?php endif; ?>
						</div>
					</div>
					<div class="col-md-4 px-0">
					<div class="inputWithIcon">
						  <input type="text" value="<?php if(set_value('users_mobile')): echo set_value('users_mobile'); else: echo stripslashes($profileDetails['users_mobile']); endif; ?>" placeholder="Mobile Number" name="users_mobile" class=" <?php if(form_error('user_mobile')): ?>error<?php endif; ?>">
						 <i class="fas fa-mobile" aria-hidden="true"></i>
						 <?php if(form_error('users_mobile')): ?>
	                          <label id="users_mobile-error" class="error" for="users_mobile"><?php echo form_error('users_mobile'); ?></label>
	                        <?php endif; ?>
						</div>
					</div>
					<div class="col-md-4 px-0">
					<div class="inputWithIcon">
						  <input type="text" value="<?php if(set_value('users_email')): echo set_value('users_email'); else: echo stripslashes($profileDetails['users_email']); endif; ?>" placeholder="Email" name="users_email" class=" <?php if(form_error('users_email')): ?>error<?php endif; ?>">
						 <i class="far fa-envelope" aria-hidden="true"></i>
						 <?php if(form_error('users_email')): ?>
	                          <label id="users_email-error" class="error" for="users_email"><?php echo form_error('users_email'); ?></label>
	                        <?php endif; ?>
						</div>
					</div>

					<!-- <div class="col-md-4 px-0">
					<div class="inputWithIcon">
						  <select name="gender" id="gender">
						<option value="Men" <?php if($profileDetails['gender']): if($profileDetails['gender'] == 'Men'): echo 'selected';endif;endif;?>>Men</option>
						<option value="Women" <?php if($profileDetails['gender']): if($profileDetails['gender'] == 'Women'): echo 'selected';endif;endif;?>>Women</option>
					  </select>
						</div>
					</div> -->
					
					</div>
					<div class="change_password">
						 <!--<a href="#" class="user_password" onclick="ConfirmForm();">Change your Password</a>-->
						 <input type="hidden" name="SaveChanges" id="SaveChanges" value="Yes">
						 <button class="btn" type="submit" name="submit">Update Profile</button>
						 <!--<a class="btn" href="<?=base_url('profile/editusers/'.@$profileDetails['users_id']) ?>">Update Profile</a>-->
						 </div>
						 </form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('common/footer.php') ?>
<!-- ALL JS FILES HERE --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
<!-- bootstrap js -->
<script src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
	function ConfirmForm() {
	$("#BlockUIConfirm").show();
}
	</script>
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
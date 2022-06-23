<!Doctype html>
<html lang="eng">
<head>
    
    <style>
        .error{
            color:red;
        }
    </style>
    
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include('common/head.php') ?>
    <style>
        .my-profile .confirm_password .change_passworded {
    text-align: end!important;
    padding: 28px 28px 17px 36px !important;
}
.my-profile .inputWithIcon input[type="text"] {
    padding-left: 40px;
    color: rgb(209 209 209) !important;
}
.my-profile input[type="password"] {
    width: 100%;
    border: 2px solid #f1f1f1;
    border-radius: 4px;
    margin: 8px 0;
    outline: none;
    padding: 5px 28px 5px;
    box-sizing: border-box;
    transition: 0.3s;
     color: rgb(209 209 209) !important;
}
.my-profile .btn:hover{
background: #e72d2e;
    color: #ffffff;
}
.my-profile .btn {
    background: #ffffff;
    border: 1px solid #e72d2e;
    padding: 4px 13px !important;
    border-radius: 8px;
    color: #e72d2e;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    margin-top: 0px;
    height: 37px;
}
.password {
    color: #252525;
    font-size: 13px;
    font-family: 'Open Sans', sans-serif;
    font-weight: 600;
    border-bottom: 0;
}
.my-profile input[type="password"] {
    width: 100%;
    border: 2px solid #f1f1f1;
    border-radius: 4px;
    margin: 8px 0;
    outline: none;
    padding: 5px 28px 5px 10px;
    box-sizing: border-box;
    transition: 0.3s;
    color: rgb(209 209 209) !important;
}
.user-cart{
 background: #f5fcff00;
    border-radius: 8px;
    position: relative;
    margin-top: 32px;
    border: 2px solid #ebebeb;
    text-align: left;
    margin-bottom: 36px;   
}
input[type=text]::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
color: rgb(209 209 209) !important;
	opacity: 1; /* Firefox */
	font-family: 'Open Sans', sans-serif;
}
.my-profile .user_password {
    color: #d12a2b;
    padding-top: 12px;
    font-style: normal;
    text-decoration: revert;
    padding-top: 12px;
    font-family: 'Open Sans';
    line-height: 28px;
}
.my-profile .form-inline {
    padding: 17px 10px 17px 14px;
}
.my-profile .user_password {
    color: #d12a2b;
    padding-top: 12px;
    font-style: normal;
    text-decoration: revert;
    padding-top: 12px;
    font-family: 'Open Sans';
    line-height: 28px;
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
					<?php
									   if ($this->session->flashdata('error')) { ?>
										<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
										<?php } ?>
										<?php if ($this->session->flashdata('success')) { ?>
										<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
								<?php  } ?>
					<div class="row form_user">
					<form class="form-inline">
					<div class="col-md-4 px-0">
					<div class="inputWithIcon">
						  <input type="text" name="name" value="<?=@$profileDetails['users_name']?>" placeholder="Name" readonly>
						  <i class="far fa-user " aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-4 px-0">
					<div class="inputWithIcon">
							  <input type="text" value="<?=@$profileDetails['users_mobile']?>" placeholder="Mobile Number" readonly>
							 <i class="fas fa-mobile" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-4 px-0">
					<div class="inputWithIcon" style="margin-right:0px;">
							  <input type="text" value="<?=@$profileDetails['users_email']?>" placeholder="Email" readonly>
							 <i class="far fa-envelope" aria-hidden="true"></i>
						</div>
					</div>
					<!--<div class="col-md-4 px-0">
					<div class="inputWithIcon">
						  <select name="Gender" id="Gender" p>
						<option value="Men" <?php if($profileDetails['Gender']): if($profileDetails['Gender'] == 'Men'): echo 'selected';endif;endif;?>>Men</option>
						<option value="Women" <?php if($profileDetails['Gender']): if($profileDetails['Gender'] == 'Women'): echo 'selected';endif;endif;?>>Women</option>
					  </select>
						</div>
					</div>-->
					<!-- <div class="col-md-4 px-0">
					<div class="inputWithIcon">
						  <input type="date" value="<?=@$profileDetails['dob']?>" placeholder="Date of Birth" readonly>
						</div>
					</div> -->
					 </form>
					</div>
					<div class="change_password">
						 <a href="#" class="user_password" onclick="ConfirmForm();">Change your password</a>
						 <a class="btn" href="<?php echo base_url()?>edit-profile/<?=$profileDetails['users_id']?>">Update Profile</a>
						 </div>
				</div>
				<div class="confirm_password" id="BlockUIConfirm">
					<div class="col-md-12 px-0" >
								
						<div class="users_form">
							<div class="row form_user">
							<form class="form-inline" id="form" action="<?=base_url('profile/changepassword/'.@$profileDetails['users_id'])?>" method="post">
							
							<div class="col-md-4 px-0">
							<div class="inputWithIcon">
							<label class="password">Old Password</label>
								  <input type="password" name="old_password" id="old_password" placeholder="Old Password">
								</div>
							</div>
							
							
							
							<div class="col-md-4 px-0">
							<div class="inputWithIcon">
							<label class="password">New Password</label>
								  <input type="password" name="new_password" id="new_password" placeholder="New Password">
								</div>
							</div>
							<div class="col-md-4 px-0">
							<div class="inputWithIcon" style="margin-right:0px;">
							<label class="password">Confirm Password</label>
									  <input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password">
								</div>
							</div>
								<div class="col-md-9 px-0">
								    </div>
							<div class="col-md-2 px-0">
							<div class="change_passworded">
								<input type="hidden" name="savechanges" id="savechanges" value="Yes">
								 <button  class="btn">Update Password</button>
							</div>
							</div>
							
							 </form>
							</div>
							
						</div>
					</div>
			   </div>
			   <div class="user-cart">
						<div class="cart-box">
							<div class="table-responsive cart-table">
								<table class="table">
									<tbody>
										<tr>
											<td width="20%">
												<div class="cart-product">
													<img src="https://apkconnectlab.com/dealzarabia/assets/productsImage/1652782593975908.png" class="img-fluid" alt="">
												</div>
											</td>
											<td width="50%">
												<div class="table-hd">
													<h3>iPad Air</h3>
													<h5>The all new 2022 Mercedes-AMG G63 is a legend raised to a higher power for a new era!</h5>
												</div>
												
											</td>
											<td>
												<div class="inquiry-and-buy">
													<p>AED825.00</p>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						
						</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" ></script>
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

<script type="text/javascript">
$("#form").validate({
rules: {
old_password: {
required: true,
},
new_password: {
required: true,
},
conf_password: {
required: true,
},
},

submitHandler: function(savechanges) {
form.submit();
}
});
</script>
</body>
</html>

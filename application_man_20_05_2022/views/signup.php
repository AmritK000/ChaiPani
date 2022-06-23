<!Doctype html>
<html lang="eng">
<head>
	<style>
		.error{
			color:red;
		}
	.signup-block .login-box h4 {
    font-family: 'Open Sans', sans-serif;
    font-size: 21px;
    color: #020202;
    font-weight: 700;
    line-height: 32px;
    margin: 15px 0 15px;
    position: relative;
    left: -21px;
}
	.signup-block .login-box .forgot-link {
    text-align: end !important;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px !important;
    font-weight: 500 !important;
    }
	.color-default-btn {
    background: #e22c2d;
    padding: 9px 20px !important;
    border-radius: 7px;
    display: inline-block;
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    border: 1px solid #e22c2d;
    width: 100%;
}
	</style>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include('common/head.php') ?>
</head>
<body>
<?php include('common/header.php') ?>
<div class="signup-block">
	<div class="container">
		<div class="row">
			<div class="offset-md-7 col-md-5 col-12">
				<div class="login-box">
					<h4>Your First Purchase <br> CAN BE <span>FREE</span>.</h4>
				   <?php
				   if ($this->session->flashdata('error')) { ?>
					<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
					<?php } ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
					<?php  } ?>
					<form action="<?=base_url('sign-up')?>" method="post" id="form">
					<div class="form-group">
						<input type="text" name="fname" id="name" class="form-control" placeholder="Full Name">
					</div>
					<!-- <div class="form-group">
						<input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth">
					</div> -->
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control" placeholder="Email address">
					</div>
					<div class="form-group">
						<input type="text" name="mobile" id ="mobile" class="form-control" placeholder="Mobile Number">
					</div>
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-5 col-12">
						
						</div>
							<div class="col-lg-7 col-md-7 col-12">
							<div class="form-group">
								<a href="<?=base_url('login')?>" class="forgot-link" style="font-weight: 500 !important;">Sign in instead </a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="form-group">
								<input type="submit" class="color-default-btn float-right" value="Signup">
							</div>
						</div>
					</div>
					</form>
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

<script type="text/javascript">
$("#form").validate({
rules: {
fname: { required: true },
//dob: { required: true },
mobile: { required: true, maxlength: 10, remote: "signup/checkDuplicateMobile" },
email: { required: true, remote: "signup/checkDuplicateEmail" },
password: { required: true },
},
messages:{
fname: { required: 'Please enter your name.' },
//dob: { required: 'Please enter your date of birth.' },
email: { required: 'Please enter valid email.', remote:"This email is already exist! Try another."},
password: { required: 'Please enter password.' },
mobile: { required: 'Please enter mobile number.', remote:"This mobile no. is already exist! Try another." },
},
submitHandler: function(form) {
form.submit();
}
});
</script>
</body>
</html>

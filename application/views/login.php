<!Doctype html>
<html lang="eng">
<head>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dealz Arabia || Login</title>
    <meta name="description" content="">
	<!-- Mobile specific metas -->		
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<!-- Favicon -->
	<link rel="icon" href="<?=base_url('assets/')?>img/h-1.png" type="image/x-icon"/>
	<!--All Fonts  Here -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
	<!-- style CSS -->			
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/style.css">
	<!-- responsive CSS -->			
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/responsive.css">
    <style>
		.login_button {
    background: #e22c2d;
    padding: 9px 20px;
    border-radius: 7px;
    display: inline-block;
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
    font-weight: 500;
    border: 1px solid #e22c2d;
    width: 100%;
}
.login-box span.icon {
    position: absolute;
    top: 8px;
    left: 13px;
}
 .login-box {
    background: #fff;
    padding: 20px 40px;
    border-radius: 8px;
    text-align: center;
    position: relative;
    margin: 110px 20px 30px;
    -webkit-box-shadow: 1px 1px 5px 0px rgb(189 189 189);
    -moz-box-shadow: 1px 1px 5px 0px rgba(189,189,189,1);
    box-shadow: 1px 1px 5px 0px rgb(189 189 189);
}
.login-block .login-box h4 {
    font-family: 'Open Sans', sans-serif;
    font-size: 21px;
    color: #020202;
    font-weight: 700;
    line-height: 32px;
    margin: 15px 0 30px;
    position: relative;
    left: 6px !important;
}
.login-block .account_content a {
    margin-left: 10px;
    color: #e22c2d;
    text-align: center;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
    font-weight: 600;
}

	.login-block .login-box .forgot-link {
   text-align: end;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
    font-weight: 500;
}
	.color-default-btn {
    background: #e22c2d;
    padding: 9px 20px;
    border-radius: 7px;
    display: inline-block;
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    border: 1px solid #e22c2d;
    width: 100%;
}
	/*
	.login-block .account_content a {
    margin-left: 10px;
    color: #e22c2d;
    text-align: center;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
    font-weight: 600;
}

	.login-block .login-box .forgot-link {
   text-align: end;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
    font-weight: 500;
}
		.error{
		color: red;
	}
	.color-default-btn {
    background: #e22c2d;
    padding: 9px 20px;
    border-radius: 7px;
    display: inline-block;
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    border: 1px solid #e22c2d;
    width: 100%;
}
*/
.side_bar {
    background-color: #d3bda5;
    height: 888px;
    width: 412px;
    position: relative;
    top: 0px;
}
.banner {
    position: relative;
    top: 178px;
    left: -199px;
    width: 126%;
}
.login-box h4 {
    font-family: 'Open Sans', sans-serif;
    font-size: 21px;
    color: #020202;
    font-weight: 700;
    line-height: 32px;
    margin: 15px 0 30px;
    position: relative;
    left: 6px !important;
}
.login-box .forgot-link {
    text-align: end;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
    font-weight: 500;
}
.account_content a {
    margin-left: 10px;
    color: #e22c2d;
    text-align: center;
    display: block;
    color: #be1a29;
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
    font-weight: 600;
}
.login-box h4 span {
    color: #e22c2d;
}
.login-box .form-control {
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    padding: 8px 25px;
    padding-left: 40px;
    color: #000;
}

.login-box .form-group {
    position: relative;
}
footer {
    position: relative;
    z-index: 2;
	position: relative;
    top: -285px;
   
}
.login-box {
    position: relative;
    top: 39px;
    left: 22px;
    width: 73%;
}
.page-ending {
    background: #292929;
    padding: 40px 0 20px;
    position: relative;
    z-index: 1;
    margin-top: -25px;
    top: -286px;
}
.pages{
height: 600px;	
}
@media (min-width: 360px) and (max-width: 600px) {
 footer{
    z-index: 2;
    position: relative;
    top: 123px !important;
}
 .page-ending {
    background: #292929;
    padding: 40px 0 20px;
    position: relative;
    z-index: 1;
    margin-top: -25px;
    top: 118px !important;
}
}
</style>
</head>
<body class="pages">
<?php include('common/header.php') ?>
<div class="loginess" >
	<div class="container-fluid pl-0">
	
		<div class="row">
			<div class="col-md-3 col-md- col-12">
			<div class="side_bar"></div>
			
			</div>
			<div class="col-md-4 col-md- col-12">
			<img src="https://apkconnectlab.com/dealzarabia/assets/img/login-banner.png" class="banner">
			</div>
				<div class="col-md-5 col-md-5 col-12">
				<div class="login-box">
					<?php if ($this->session->flashdata('error')) { ?>
					<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
					<?php } ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
					<?php  } ?>

					<h4>Your First Purchase <br> CAN BE <span>FREE</span>.</h4>
					<form id="login" action="<?=base_url('login')?>" method="post">
					<div class="form-group">
						<input type="text" name="userid" id="userid" class="form-control" placeholder="Enter Email/Mobile No.">
						<span class="icon"><i class="far fa-user"></i></span>
					</div>
					<div class="form-group my-0">
						<input type="password" name="password" class="form-control" placeholder="Enter Password">
						<span class="icon"><i class="fas fa-key"></i></span>
					</div>
					
					<div class="row">
						<div class="col-lg-5 col-md-5 col-12">
							
						</div>
						<div class="col-lg-7 col-md-7 col-12">
							<div class="form-group " >
								<a href="<?=base_url('forgot-password')?>" class="forgot-link">Forgot Password?</a>
							</div>

						</div>
						
					</div>
					
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="form-group">
								<input type="submit" class="login_button" value="Login">
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="form-group account_content">
								<h5><a href="<?=base_url('sign-up')?>">Signup</a></h5>
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
$("#login").validate({
rules: {
userid: { required: true },
password: { required: true, },
},
messages:{
name: { required: 'Please enter your email or mobile no.', },
mobile: { required: 'Please enter mobile no.',},
},
/*submitHandler: function(form) {
form.submit();
}*/
});
</script>
<script>
	function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 20;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);
	</script>

</body>
</html>

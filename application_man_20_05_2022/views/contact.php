<!Doctype html>
<html lang="eng">
<head>
<style>
	.error{
	color: red;
}
.color-default-btn:hover{
     background:#e22c2d !important;
     color:#ffffff !important;
}
.color-default-btn {
    background: #ffffff !important;
    padding: 4px 20px !important;
    border-radius: 7px;
    display: inline-block;
    color: #e22c2d !important;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    border: 1px solid #e22c2d !important;
}
</style>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dealz Arabia || Contact Us</title>
    <?php include('common/head.php') ?>
</head>
<body>
<?php include('common/header.php') ?>
<div class="contact-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-7 col-12">
				<div class="feedback-block">
					<h3>Contact<span>Dealz - Arabia</span></h3>
					<p>Please fill in the form below and a dedicated member of <br>our team will be in touch within 24 hrs.</p>
				</div>
				<?php if ($this->session->flashdata('error')) { ?>
				<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
				<?php } ?>
				<?php if ($this->session->flashdata('success')) { ?>
 				<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
				<?php  } ?>
				<div class="contact-big-box">
				<form  id="form" action="<?=base_url('contact/contact_detail')?>" method="post">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<textarea rows="4" cols="5" class="form-control" name="message" id="message" placeholder="Message"></textarea>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<input type="submit" class="color-default-btn float-right" value="Submit" style="text-transform:uppercase;">
							</div>
						</div>
					</div>
                 </form>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-12">
				<div class="map-box">
					<?php foreach($general_details as $key => $item){ ?>
					<div class="row">
						<div class="col-lg-12 col-12">
							<p>Dealz Arabia Headquarters</p>
							<h4><?=$item['address']?></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-12">
							<p>Call us now</p>
							<h4><?=$item['contact_no']?></h4>
						</div>
						<div class="col-lg-6 col-12">
							<p>Write us an email</p>
							<h4><?=$item['email_id']?></h4>
						</div>
					</div>
					<div id="googleMap" style="width:100%;height:320px;"></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('common/footer.php') ?>
<?php include('common/footer_script.php') ?>

<!-- Animation Js -->
<script>
$(document).ready(function() {
$("#mobile").inputFilter(function(value) {
return /^\d*$/.test(value);    // Allow digits only, using a RegExp
});

$("#name").inputFilter(function(value) {
return /^[a-zA-Z-'. ]*$/.test(value);    // Allow digits only, using a RegExp
});
$("#message").inputFilter(function(value) {
return /^[a-zA-Z-'.@,()/^\d ]*$/.test(value);    // Allow digits only, using a RegExp
});
});
</script>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd0U-dY13CLZW2EB_By2_dIgqCJFyPMJ8&callback=initMap"></script>
<script>
	function initialize() {
	var mapOptions = {
	zoom: 17,
	scrollwheel: true,
	center: new google.maps.LatLng(-37.7465146, 145.01925299999994),
	styles: [{
	"featureType": "landscape",
	"elementType": "geometry.fill",
	"stylers": [{
	"color": "#f6f6f6"
	}]
	}, {
	"featureType": "poi",
	"elementType": "geometry",
	"stylers": [{
	"color": "#efefef"
	}]
	}, {
	"featureType": "water",
	"stylers": [{
	"visibility": "off"
	}]
	}, {
	"featureType": "road",
	"elementType": "geometry.stroke",
	"stylers": [{
	"visibility": "on"
	}, {
	"color": "#dedddd"
	}]
	}, {
	"featureType": "road",
	"elementType": "geometry.fill",
	"stylers": [{
	"visibility": "on"
	}, {
	"color": "#efefef"
	}]
	}, {
	"featureType": "poi",
	"elementType": "labels.icon",
	"stylers": [{
	"visibility": "on"
	}]
	}]
	};

	var map = new google.maps.Map(document.getElementById('googleMap'),
	mapOptions);

	var marker = new google.maps.Marker({
	position: map.getCenter(),
	animation:google.maps.Animation.BOUNCE,
	icon: '<?=base_url('assets/')?>img/map-marker1.png',
	map: map
	});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
$("#form").validate({
rules: {
name: { required: true, },
mobile: { required: true, maxlength: 10 },
email: { required: true, },
message: { required: true, },
subject: { required: true, },
},
messages:{
name: { required: 'Please enter your name', },
email: { required: 'Please enter valid email',},
subject: { required: 'Please enter subject', },
mobile: { required: 'Please enter mobile number',},
message: { required: 'Please enter message', },
},
submitHandler: function(form) {
form.submit();
}
});
</script>
</body>
</html>

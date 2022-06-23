<!Doctype html>
<html lang="eng">
<head>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include('common/head.php') ?>
    <style>
    .my-profile .change_password {
    
    display: flex;
    justify-content: space-between;
    padding: 20px 0px;
}
    .error{
        font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    line-height: 22px;
    font-weight: 400;
    text-align: left;
    color: #e22c2d;
    margin-bottom: 0;
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
}      
.my-profile .confirm_password .change_passworded {
    text-align: end!important;
    padding: 28px 28px 17px 36px;
}
.recharge .users_form {
    width: 100%;
}
.my-profile .form-inline {
    padding: 0px; 
}
.my-profile input[type="number"] {
    width: 100%;
    border: 2px solid #f1f1f1;
    border-radius: 4px;
    margin: 8px 0;
    outline: none;
    padding: 5px 35px 5px;
    box-sizing: border-box;
    transition: 0.3s;
}
  tr{
    border: 1px solid #ddd;
}
table td {
   border: 1px solid #eee;
    border-top: 0;
    font-weight: 400;
    text-align:center;
    padding: 0.75rem;
    vertical-align: top;
    color: #6c757d;
    font-size: 14px;
    line-height: 22px;
  
    text-align: center;
}
.my-profile .inputWithIcon input::placeholder {
    color: rgb(209 209 209) !important;
    font-size: 15px;
}
 table th {
     padding: 0.75rem;
    vertical-align: top;
    border: 1px solid #dee2e6;
    font-size: 14px;
    line-height: 22px;
    font-weight: 600;
    text-align: center;
    color: #6c757d;
}
.form_user {
    padding: 0px 35px;
}
table {
    border-collapse: collapse;
}
.user_list{
   padding-top: 19px; 
}
    </style>
</head>
<body>
<?php include('common/header.php') ?>
<!-- profile -->
<div class="my-profile recharge">
	<div class="container">
		<div class="row">
		<?php include ('common/profile/menu.php') ?>
			<div class="col-md-9">
				<?php include ('common/profile/head.php') ?>
				<form class="form-inline" id="rechargeForm" method="post" action="<?=base_url('profile/recharge')?>">
					<?php if ($this->session->flashdata('error')) { ?>
					<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
					<?php } ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
					<?php  } ?>
				<div class="users_form">
					<div class="profiles">
						<h4 class="information" >Top Up Recharge</h4>
					</div>
					<div class="row form_user">
					
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
						  <input type="text" autocomplete="off" name="email" id="email" placeholder="Email / Mobile" required>
						  <i class="fa fa-address-card" aria-hidden="true"></i>
						</div>
					</div>	
						<div class="col-md-6 px-0">
					<div class="inputWithIcon" style="margin-right:0px;">
						  <input type="number" min="1" autocomplete="off" name="recharge_amt" id="recharge_amt" placeholder="Recharge amount" required>
						  <i class="fa fa-address-card" aria-hidden="true"></i>
						</div>
					
					</div>
					 <div class="col-md-9 px-0">
					    </div>
					    	<div class="col-md-3 px-0" style="text-align:right;">
					    	    	<div class="change_password" style="display:block;">
						 <!-- <a href="#" class="user_password" onclick="ConfirmForm();">Change your Password</a> -->
						 <button class="btn">Recharge</button>
					</div>
					</div>
					
					    </div>
				
				</div>
				</form>
					<div class="user_list" style="overflow-x: auto;">
				  <table>
				   <tr>
				      <th style="text-align:center;">S.No</th>
				     
				      <th style="text-align:center;">Email</th>
				      <th style="text-align:center;">Phone</th>
				      <th style="text-align:center;">Status</th>
				      <th style="text-align:center;">Recharge Date</th>
				       <th style="text-align:center;">Recharge Amount</th>
				    </tr>
				
				    <tr>
				      <td width="10%">1</td>
				      
				      <td width="15%">sham123@gmail.com</td>
				      <td width="20%">234567891</td>
				      <td width="5%">Debit</td>
				      <td width="20%">20 March,2020</td>
				      <td width="20%">500</td>
				    </tr>
				 
				  </table>
			
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
$("#rechargeForm").validate({
rules: {
email: { required: true, remote: "<?=base_url('profile/checkEmail')?>" },
recharge_amt: { required: true, remote: "<?=base_url('profile/checkarAbianPoints')?>" },
},
messages:{
email: { 	required: 'Please enter Email ID / Mobile No.', 
			remote: 'Invalid Email ID / Mobile No.' },
recharge_amt: { required: 'Please enter arabian points.',
				remote: 'Your available arabian points is low.'},
},
});
</script>
</body>
</html>

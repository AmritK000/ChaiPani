<?php //echo"workig"; ?>
<!Doctype html>
<html lang="eng">
<style>
	.error{
		color:red;
	}
	.my-profile .inputWithIcon input[type="text"] {
    padding-left: 40px;
    color: rgb(209 209 209) !important;
}
input[type=text]::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
color: rgb(209 209 209) !important;
	opacity: 1; /* Firefox */
	font-family: 'Open Sans', sans-serif;
}
</style>
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include('common/head.php') ?>
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
						<h4 class="information" >Edit Address</h4>
					</div>
					<div class="row form_user">
					<form class="form-inline" action="<?=base_url('edit-dilivery-address/'.$address['id'])?>" method="post" id="form">
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
							<input type="text" name="address_type" id="address_type" value="<?=@$address['address_type']?>" placeholder="Address Type">
						  	<i class="fa fa-address-book" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
							<input type="text" name="name" id="name" value="<?=@$address['name']?>" placeholder="Name">
						  	<i class="fa fa-address-book" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
							  <input type="text" name="village" value="<?=@$address['village']?>" placeholder="Village/Town Name">
							 <i class="far fa-envelope" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
							  <input type="text" name="street" value="<?=@$address['street']?>" placeholder="Street Name or No." >
							 <i class="far fa-envelope" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
						  <input type="text" name="area" value="<?=@$address['area']?>" placeholder="Area" >
						  <i class="far fa-envelope" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
						  <input type="text" name="city" value="<?=@$address['city']?>" placeholder="City" >
						  <i class="far fa-envelope" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
						  <input type="text" name="country" value="<?=@$address['country']?>" placeholder="Country" >
						  <i class="fa fa-globe" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputWithIcon">
						  <input type="text" name="mobile" value="<?=@$address['mobile']?>" placeholder="Mobile No." >
						  <i class="fas fa-mobile" aria-hidden="true"></i>
						</div>
					</div>
					</div>
						<div class="change_password">
							 <button class="btn">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('common/footer.php') ?>

<?php include('common/footer_script.php') ?>
<script>
/* TOP Menu Stick
		--------------------- */
var s = $("#sticker");
var pos = s.position();
$(window).scroll(function() {
	var windowpos = $(window).scrollTop();
	if(windowpos > pos.top) {
		s.addClass("stick");
	} else {
		s.removeClass("stick");
	}
});
</script>
<script>
	$('.minus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});
	$('.plus').click(function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
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
	if($(this).data("item") == "RUB") {
		console.log('RUB');
	} else if($(this).data("item") == "UAH") {
		console.log('UAH');
	} else {
		console.log('USD');
	}
});
$(document).on('keyup', function(evt) {
	if((evt.keyCode || evt.which) === 27) {
		$('.dropdown').removeClass('open');
	}
});
$(document).on('click', function(evt) {
	if($(evt.target).closest(".dropdown > .caption").length === 0) {
		$('.dropdown').removeClass('open');
	}
});
</script>
<script type="text/javascript">
$("#form").validate({
rules: {
address_type: { required: true },
name: { required: true },
village: { required: true },
mobile: { required: true, maxlength: 10},
street: { required: true },
area: { required: true },
city: { required: true },
country: { required: true },
},
messages:{
address_type: { required: 'Please enter your address type.' },
name: { required: 'Please enter your name.' },
village: { required: 'Please enter your village/town.'},
street: { required: 'Please enter your street name or no.' },
mobile: { required: 'Please enter mobile number.'},
area: { required: 'Please enter area.'},
city: { required: 'Please enter city.'},
country: { required: 'Please enter country.'},
},
/*submitHandler: function(form) {
form.submit();
}*/
});
</script>
</body>

</html>
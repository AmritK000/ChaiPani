<?php
$url_save = $this->uri->segment(1);
//echo $url_save; die();
$myprofile 			= 	'';
$mycart 			= 	'';
$diliveryaddress	=	'';
$earning 			=	'';
$coupon 			=	'';
$myorder			=	'';
$help 				=	'';
$recharge 			=	'';
$adduser			=	'';

if($url_save == 'my-profile' | $url_save == 'edit-profile'){
	$myprofile 	= 'active';
}elseif ($url_save == 'user-cart') {
	$mycart = 'active';
}elseif($url_save == 'dilivery-address'){
	$diliveryaddress = 'active';
}elseif ($url_save == 'earning') {
	$earning = 'active';
}elseif ($url_save == 'my-coupon') {
	$coupon = 'active';
}elseif ($url_save == 'order-list') {
	$myorder = 'active';
}elseif ($url_save == 'help') {
	$help = 'active';
}elseif($url_save == 'top-up-recharge'){
	$recharge = 'active';
}elseif($url_save == 'add-user'){
	$adduser = 'active';
}

//$url_save = $this->uri->segment(1);
//echo $url_save; die();

?>

<style>
    .avatar-upload {
	 position: relative;
	
}
 .avatar-upload .avatar-edit {
	 position: absolute;
	 right: 12px;
	 z-index: 1;
	 top: 10px;
}
 .avatar-upload .avatar-edit input {
	 display: none;
}
 .avatar-upload .avatar-edit input + label {
    display: inline-block;
    width: 22px;
    height: 21px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 12%);
    cursor: pointer;
    font-weight: normal;
    transition: all .2s ease-in-out;
    position: relative;
    left: 29px;
    top: 8px;
}
 .avatar-upload .avatar-edit input + label:hover {
	 background: #f1f1f1;
	 border-color: #d6d6d6;
}
 .avatar-upload .avatar-edit input + label:after {
content: "+";
    color: #bb2627;
    position: absolute;
    top: -9px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
    font-size: 22px;
}
/*
 .avatar-upload .avatar-preview {
	 width: 192px;
	 height: 192px;
	 position: relative;
	 border-radius: 100%;
	 box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.1);
}
*/
 .avatar-upload .avatar-preview > .abhs{
	 width: 100%;
	 height: 100%;
	 border-radius: 100%;
	 background-size: cover;
	 background-repeat: no-repeat;
	 background-position: center;
}
.profile-pic{
    position: absolute;
    height:120px;
    width:120px;
    left: 50%;
    transform: translateX(-50%);
    top: 0px;
    z-index: 1001;
    padding: 10px;
}
.profile-pic img{
   
    border-radius: 50%;
    box-shadow: 0px 0px 5px 0px #c1c1c1;
    cursor: pointer;
    width: 100px;
    height: 100px;
}   
.avatar-upload .avatar-preview {
  width: 50px;
  height: 50px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}

</style>
<div class="col-md-3">
	<div class="user_profile">
	      
				<div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"></label>
        </div>
       <div class="avatar-preview">
            <div id="imagePreview" class="abhs" style="background-image:url(assets/img/user.png)">	</div>       </div>
        </div>
	
 
		<div class="user">
		<h2><?=@$this->session->userdata('DZL_USERNAME')?></h2>
		<p><?=@$this->session->userdata('DZL_USERSTYPE')?></p>
		<p class="email"><?=@$this->session->userdata('DZL_USEREMAIL')?></p>
		<p><?=@$this->session->userdata('DZL_USERMOBILE')?></p>
		</div>

	</div>

	<div class="sidenav">
      <div class="profiles">
					<h4 class="information" >Account Information</h4>
			</div>
		<ul>
			<li class="<?=$myprofile?>"><a href="<?=base_url('my-profile')?>" >My Profile</a></li>
			<li class="<?=$mycart?>"><a href="<?=base_url('user-cart')?>">My Cart</a></li>
			<li class="<?=$coupon?>"><a href="<?=base_url('my-coupon')?>">My Coupons</a></li>
			<li class="<?=$diliveryaddress?>"><a href="<?=base_url('dilivery-address')?>">My Address</a></li>
			<li class="<?=$myorder?>"><a href="<?=base_url('order-list')?>">My Orders</a></li>
			<li class="<?=$earning?>"><a href="<?=base_url('earning')?>">My Earnings</a></li>
			<?php if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){ ?>
				<li class="<?=$recharge?>"><a href="<?=base_url('top-up-recharge')?>">Top Up Recharge</a></li>
				<li class="<?=$adduser?>"><a href="<?=base_url('add-user')?>">Add Retailer</a></li>
			<?php } ?>
			<?php
			if($this->session->userdata('DZL_USERSTYPE') == 'Retailer'){ ?>
			<li class="<?=$recharge?>"><a href="<?=base_url('top-up-recharge')?>">Top Up Recharge</a></li>
				<li class="<?=$adduser?>"><a href="<?=base_url('add-user')?>">Add User</a></li>
			<?php }	?>	
			<!-- <li class="<?=$recharge?>"><a href="<?=base_url('top-up-recharge')?>">Top Up Recharge</a></li> -->
			<li class="<?=$help?>"><a href="<?=base_url('help')?>">Help</a></li>
			<!-- <li><a href="#">Setting</a></li>
			<li><a href="#">Contact Us</a></li> -->
			<li><a href="<?=base_url('logout')?>" onClick="return confirm('Want to Logout!');" >Logout</a></li>
		</ul>
	</div>
</div>
<script>
	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
	</script>
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

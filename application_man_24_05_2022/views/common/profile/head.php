<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
 .refersh {
    background-color: #ffffff;
    border: none;
    padding: 4px 11px !important;
    border-radius: 8px;
    color: #e72d2e;
    margin: 8px 0px;
    font-size: 10px !important;
    font-weight: 500 !important;
    border: 1px solid #e72d2e;
    /* margin-bottom: 21px; */
}
.my-profile .refersh:hover{
background: #e72d2e;
    color: #ffffff;
}
.my-profile .btn {
    background: #ffffff;
    border: 1px solid #e72d2e;
    padding: 8px 13px;
    border-radius: 8px;
    color: #e72d2e;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    margin-top: 0px;
}
.my-profile .content {
    background: #f5fcff00;
    padding-top: 10px;
}
</style>
<div class="users_members">
	<div class="userss">
		<div class="user_1">
			<?php 
				$points = (int)$this->session->userdata('DZL_TOTALPOINTS');
				$membership = $this->geneal_model->getMembership($points);
				?>
				<h4><?=$membership['type']?></h4>

			<p class="user_content" >Expiring in <?=$this->session->userdata('DZL_EXPIRINGIN')?> Days</p>
		</div>
		<div class="user_1">
			<p  class="ared"> Your Arabian Points : <?=@number_format($this->session->userdata('DZL_AVLPOINTS'),2)?></p>
			<a class="refersh" href="<?php echo base_url()?>refresh-point?>"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>
		</div>
	</div>
		<div class="content">
			<p style=""><?=$membership['benifitDetails']?></p>
		</div>
</div>

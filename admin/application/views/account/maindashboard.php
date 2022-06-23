<style type="text/css">
   /*.d-card-body {
   overflow-y: auto;
   height: 300px;
   }*/
   #container {
   height: 400px;
   }
   .highcharts-figure, .highcharts-data-table table {
   min-width: 310px;
   max-width: 800px;
   margin: 1em auto;
   }
   #datatable {
   font-family: Verdana, sans-serif;
   border-collapse: collapse;
   border: 1px solid #EBEBEB;
   margin: 10px auto;
   text-align: center;
   width: 100%;
   max-width: 500px;
   }
   #datatable caption {
   padding: 1em 0;
   font-size: 1.2em;
   color: #555;
   }
   #datatable th {
   font-weight: 600;
   padding: 0.5em;
   }
   #datatable td, #datatable th, #datatable caption {
   padding: 0.5em;
   }
   #datatable thead tr, #datatable tr:nth-child(even) {
   background: #f8f8f8;
   }
   #datatable tr:hover {
   background: #f1f7ff;
   }
</style>
<div class="pcoded-main-container">
   <div class="pcoded-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
         <div class="page-block">
            <div class="row align-items-center">
               <div class="col-md-12">
                  <div class="page-header-title">
                     <?php /* ?>
                     <h5 class="m-b-10">Welcome <?=sessionData('HCAP_ADMIN_FIRST_NAME')?></h5>
                     <?php */ ?>
                  </div>
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo getCurrentDashboardPath(); ?>"><i class="feather icon-home"></i></a></li>
                     <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header">
                  <h5>Dashboard</h5>
               </div>
               <div class="card-body">
                  <div class="card-block">
                     <div class="row ">
                        <div class="container-fluid">
                           <div class="panel panel-headline">
                              <div class="panel-body">
                                 <div class="row box_guard">
                                    <!-- <h1 style="margin-left: 20%;">Welcome DealzArabia</h1>
                                    <img style="width: 93%;" src="http://localhost/dealzarabia/assets/1648737920295860.png"> -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                       <div class="dashboard-card">
                                          <div class="d-card-header bg-success">
                                             <h4>New Customer Registration</h4>
                                          </div>
                                          <div class="d-card-body">
                                             <div class="table-responsive">
                                                <table class="table">
                                                   <thead>
                                                      <tr>
                                                         <th>Date</th>
                                                         <th>User ID</th>
                                                         <th>Name</th>
                                                         <th>User Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php if($userData): foreach($userData as $UD):?>
                                                      <tr>
                                                         <td><?php echo date("d-m-Y",strtotime($UD['created_at']));?></td>
                                                         <td><?php echo stripslashes($UD['users_seq_id']);?></td>
                                                         <td><?php echo ucfirst($UD['users_name']);?></td>
                                                         <td><?php echo stripslashes($UD['users_type']);?></td>
                                                        <!--  <?php if($UD['status']=='A'):?>
                                                         <td><i class="fas fa-circle active"></i></td>
                                                         <?php else:?>
                                                         <td><i class="fas fa-circle pending"></i></td>
                                                         <?php endif;?> -->
                                                      </tr>
                                                      <?php endforeach; endif;?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <center><a href="{BASE_URL}users/allusers/index"><button>view more</button></a></center>
                                       </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                       <div class="dashboard-card">
                                          <div class="d-card-header bg-c-yellow">
                                             <h4>New Products</h4>
                                          </div>
                                          <div class="d-card-body">
                                             <div class="table-responsive">
                                                <table class="table">
                                                   <thead>
                                                      <tr>
                                                         <th>Date</th>
                                                         <th>Product ID</th>
                                                         <th>Stock</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php if($products): foreach($products as $DD):?>
                                                      <tr>
                                                         <!--<td><?php echo date("d-m-y",$DD['creation_date']);?></td> -->
                                                         <td><?php echo date("d-m-Y",strtotime($UD['created_at']));?></td>
                                                         <td><?php echo stripslashes($DD['product_seq_id']);?></td>

                                                         <td><?php echo stripslashes($DD['stock'].'/'.$DD['totalStock']);?></td>

                                                         <!-- <?php if($DD['status']=='A'):?>
                                                         <td><i class="fas fa-circle active"></i></td>
                                                         <?php else:?>
                                                         <td><i class="fas fa-circle pending"></i></td>
                                                         <?php endif;?> -->
                                                      </tr>
                                                      <?php endforeach; endif;?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <center><a href="{BASE_URL}products/allproducts/index"><button>view more</button></a></center>
                                       </div>
                                    </div> 
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                       <div class="dashboard-card">
                                          <div class="d-card-header bg-c-blue">
                                             <h4>Membership</h4>
                                          </div>
                                          <div class="d-card-body">
                                             <div class="table-responsive">
                                                <table class="table">
                                                   <thead>
                                                      <tr>
                                                         <th>Type</th>
                                                         <th>Arabian Points</th>
                                                         <th>Discont in %</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php if($membership): foreach($membership as $OD):?>
                                                      <tr>
                                                         <td><?php echo stripslashes($OD['membership_type']);?></td>
                                                         <td><?php echo stripslashes($OD['ade']);?></td>

                                                         <td><?php echo stripslashes($OD['benifit']);?> %</td>

                                                         <!-- <?php if($OD['order_status']=='S'):?>
                                                         <td><i class="fas fa-circle active"></i></td>
                                                         <?php else:?>
                                                         <td><i class="fas fa-circle pending"></i></td>
                                                         <?php endif;?> -->
                                                      </tr>
                                                      <?php endforeach; endif;?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <center><a href="{BASE_URL}membership/allmembership/index"><button>view more</button></a></center>
                                       </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                       <div class="dashboard-card">
                                          <div class="d-card-header bg-c-blue">
                                             <h4>Recharge History</h4>
                                          </div>
                                          <div class="d-card-body">
                                             <div class="table-responsive">
                                                <table class="table">
                                                   <thead>
                                                      <tr>
                                                         <th>Date</th>
                                                         <th>Email ID</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php if($loadBalance): foreach($loadBalance as $AD):?>
                                                      <tr>
                                                         <td><?php echo date("d-m-Y",strtotime($AD['created_at']));?></td>
                           <td>
                        <?php
                        if($AD['record_type'] == 'Debit'){
                          if($AD['user_id_deb'] == 0){
                            $userData['users_email'] = 'Admin';   
                          }else{
                            $userData = $this->common_model->getDataByParticularField('da_users', 'users_id', (int)$AD['user_id_deb']);    
                          }
                        }else{
                          $userData = $this->common_model->getDataByParticularField('da_users', 'users_id', (int)$AD['user_id_cred']);  
                        }
                        echo $userData['users_email'];
                        ?>
                        </td>

                                                        <!--  <td><?php echo stripslashes($AD['sequence_appointment_id']);?></td> -->

                                                         <td><?php echo stripslashes($AD['record_type']);?></td>

                                                         <!-- <?php if($AD['appointment_status']=='D'):?>
                                                         <td><i class="fas fa-circle active"></i></td>
                                                         <?php else:?>
                                                         <td><i class="fas fa-circle pending"></i></td>
                                                         <?php endif;?> -->
                                                      </tr>
                                                      <?php endforeach; endif;?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <center><a href="{BASE_URL}recharge/allrecharge/index"><button>view more</button></a></center>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                       <div class="dot-meaning-list">
                                          <ul>
                                             <li><i class="fas fa-circle active"></i> Active</li>
                                             <li><i class="fas fa-circle pending"></i> Pending</li>
                                             <li><i class="fas fa-circle cancel"></i> Block</li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- [ Main Content ] end -->
       <figure class="highcharts-figure">
         <div id="container"></div>
         <table id="datatable">
            <thead>
               <tr>
                  <th></th>
                  <th>Statistics</th>
                   <th><?=@$this->session->userdata('HCAP_ADMIN_FIRST_NAME')?></th> 
               </tr>
            </thead>
            <tbody>
               <tr>
                  <th>Total users</th>
                  <td><?php echo $usercount;?></td>
               </tr>
               <tr>
                  <th>Total Products</th>
                  <td><?php echo $productCount;?></td>
               </tr>
               <tr>
                  <th>Total Orders</th>
                  <td><?php echo $ordercount;?></td>
               </tr>
               <tr>
                  <th>Total Recharge</th>
                  <td><?php echo $rechargeCount;?></td>
               </tr>
            </tbody>
         </table>
      </figure>
   </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
   Highcharts.chart('container', {
    data: {
      table: 'datatable'
    },
    chart: {
      type: 'column'
    },
    title: {
      text: 'Statistics chart'
    },
    yAxis: {
      allowDecimals: false,
      title: {
        text: 'Units'
      }
    },
    tooltip: {
      formatter: function () {
        return '<b>' + this.series.name + '</b><br/>' +
          this.point.y + ' ' + this.point.name.toLowerCase();
      }
    }
   });
</script>
<style>
    .zc-body { 
        background:#ecf2f6;
        margin-bottom:20px;
        /* padding-bottom: 15px; */
        box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,.1), 0 0.9375rem 1.40625rem rgba(90,97,105,.1), 0 0.25rem 0.53125rem rgba(90,97,105,.12), 0 0.125rem 0.1875rem rgba(90,97,105,.1);
     }

    .chart--container {
        height: 100%;
        width: 100%;
        min-height: 530px;
    }

    .zc-ref {
    display: none;
    }
    div#myChart-license-text {
      display: none;
    }
span.text-center.text-danger {
    background: lightgrey;
    font-size: 20px;
    margin-left: 236px;
    padding: 10px;
    position: relative;
    top: 8px;
}
h6.text-muted.mb-0 {
    width: 150px;
}
</style> 

<!-- Main content -->
<?php if($active_volunteers < $min_active_volunteer){ ?>
<span class="text-center text-danger">Available Volunteers ( <?= $active_volunteers ?> ) are less than Minimum Available Volunteers ( <?= $min_active_volunteer ?> ).</span>
<?php } ?>
<div class="main-content">
    <h1 class="page-title">Dashboard</h1>
    <div class="row">
        <?php if (can('view-cases')) { ?> <a href="cases/alluser"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <!-- <h6 class="text-muted mb-0">Clients</h6> -->
                      <h6 class="text-muted mb-0">Cases</h6>
                      <span class="fw-bold mb-0"><?= $cases ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="icon-clipboard"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($case_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$case_growth))) ?>%</span>
                    <?php }?>
                    <?php if($case_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$case_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a>
        <?php if (can('view-volunteer')) { ?> <a href="volunteer/alluser"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Total Volunteers</h6>
                      <span class="fw-bold mb-0"><?= $volunteers ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="icon-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($volunteer_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$volunteer_growth))) ?>%</span>
                    <?php }?>
                    <?php if($volunteer_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$volunteer_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a>
        <?php if (can('view-volunteer')) { ?> <a href="volunteer/alluser"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0 d-inline">Active Volunteers</h6>
                      <span class="fw-bold mb-0"><?= $active_volunteers ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="icon-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($volunteer_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$volunteer_growth))) ?>%</span>
                    <?php }?>
                    <?php if($volunteer_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$volunteer_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a>
        <!-- <?php if (can('view-job')) { ?> <a href="job/alljob"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Jobs</h6>
                      <span class="fw-bold mb-0"><?= $jobs ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="fa fa-suitcase"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm ">
                    <?php if($job_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$job_growth))) ?>%</span>
                    <?php }?>
                    <?php if($job_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$job_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a> -->
        <!-- <?php if (can('view-event')) { ?> <a href="event/allevent"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Events</h6>
                      <span class="fw-bold mb-0"><?= $events ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="fa fa-newspaper-o"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($event_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$event_growth))) ?>%</span>
                    <?php }?>
                    <?php if($event_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$event_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a> -->
        <?php if (can('view-event')) { ?> <a href="logs/calls"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Calls</h6>
                      <span class="fw-bold mb-0"><?= $calls ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="icon-phone"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($call_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$call_growth))) ?>%</span>
                    <?php }?>
                    <?php if($call_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$call_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a>
        <?php if (can('view-event')) { ?> <a href="logs/video_calls"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Video Calls</h6>
                      <span class="fw-bold mb-0"><?= $video_calls ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="fa fa-video-camera"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($video_call_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$video_call_growth))) ?>%</span>
                    <?php }?>
                    <?php if($video_call_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$video_call_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a>
        <?php if (can('view-event')) { ?> <a href="logs/chats"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Chats</h6>
                      <span class="fw-bold mb-0"><?= $chats ?></span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="icon-chat"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <?php if($chat_growth < 0) {?>
                      <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$chat_growth))) ?>%</span>
                    <?php }?>
                    <?php if($chat_growth >= 0) {?>
                      <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$chat_growth)) ?>%</span>
                    <?php }?>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div>
        </a>
        <?php if (can('view-case_report')) { ?> <a href="case_report"> <?php } ?>
        <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
              <div class="card-body card-type-3">
                <div class="row">
                  <div class="col-md-8">
                    <h6 class="text-muted mb-0">Case Reports</h6>
                    <span class="fw-bold mb-0"><?= $case_reports ?></span>
                  </div>
                  <div class="col-md-4">
                    <div class="card-circle l-bg-gradient text-white">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <?php if($case_report_growth < 0) {?>
                    <span class="text-danger me-2"><i class="fa fa-arrow-down"></i><?= str_replace('-','',str_replace('.0','',sprintf('%.1f',$case_report_growth))) ?>%</span>
                  <?php }?>
                  <?php if($case_report_growth >= 0) {?>
                    <span class="text-success me-2"><i class="fa fa-arrow-up"></i><?= str_replace('.0','',sprintf('%.1f',$case_report_growth)) ?>%</span>
                  <?php }?>
                  <span class="text-nowrap">Since last month</span>
                </p>
              </div>
            </div>
        </div>
        </a>
        <!-- <div class="col-lg-3 col-md-6">
            <div class="dashboardBox card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col-md-8">
                      <h6 class="text-muted mb-0">Others</h6>
                      <span class="fw-bold mb-0">1,562</span>
                    </div>
                    <div class="col-md-4">
                      <div class="card-circle l-bg-gradient text-white">
                         <i class="fa fa-list"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success me-2"><i class="fa fa-arrow-up"></i> 7.8%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
            </div>
        </div> -->

        

        <div class="col-md-12">
             <div class="zc-body">
                <div id="myChart" class="chart--container">
                  <a href="https://www.zingchart.com/" rel="noopener" class="zc-ref"></a>
                </div>
             </div>
        </div>
        <!-- <div class="col-md-12">
             <div class="zc-body">
                <div id="shamshagraph" class="chart--container">
                <a href="https://www.zingchart.com/" rel="noopener" class="zc-ref"></a>
                </div>
             </div>
        </div> -->
        <!-- <div class="col-md-5"></div> -->
  

        <!-- <div class="col-md-8">
            <div class="panel panel-default todayShifts">
                <div class="panel-heading no-border clearfix">
                    <h3 class="panel-title">Today Shifts</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive leftTable"> 
                        <table class="table transaction-table mb-0 text-nowrap"> 
                            <thead>
                                <tr class="tableHead">
                                    <th>Image</th>
                                    <th>Volunteer Name</th>
                                    <th>Laungauge</th> -->
                                    <!-- <th>Date &amp;Time </th> -->
                                    <!-- <th>Status </th>
                                </tr> 
                            </thead>
                            <tbody>
                              <?php for($i=0; $i<count($today);$i++) {?>
                              <tr>
                                <td class="imageText">
                                  <?php if($today[$i]->profile_pic ==''){?>
                                      <img class="leftImg" src="<?php echo base_url() ?>public/images/download.png" alt="<?= $today[$i]->vname ?>" title="<?= $today[$i]->vname ?>">
                                  <?php }else{ ?>
                                      <img class="leftImg" src="<?php echo base_url().str_replace('https://shamsaha.com/app/','',$today[$i]->profile_pic); ?>" alt="<?= $today[$i]->vname ?>" title="<?= $today[$i]->vname ?>">
                                  <?php } ?>
                                </td>
                                <td><?= $today[$i]->vname ?></td>
                                <td><?= $today[$i]->shift_language ?></td> -->
                                <!-- <td style="line-height: 25px;"><?= $today[$i]->date.'<br>'.$today[$i]->shift_time ?></td> -->
                                <!-- <td><span class="badge bg-primary rounded-pill"><?= $today[$i]->schedule_status ?></span></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-md-4">
            <div class="panel panel-default rightUpcoming">
                <div class="panel-heading no-border clearfix">
                    <h3 class="panel-title">Upcoming Shifts</h3>
                </div> 
                <div class="panel-body"> -->
                    <!-- Card list view -->
                    <!-- <?php for($i=0; $i<count($upcoming);$i++) {?>
                        <div class="upcomeOne">
                            <div class="bgimg">
                                <div class="profilePic">
                                    <div class="card-photo">
                                        <?php if($upcoming[$i]->profile_pic ==''){?>
                                            <img class="leftImg" src="<?php echo base_url() ?>public/images/download.png" alt="<?= $upcoming[$i]->vname ?>" title="<?= $upcoming[$i]->vname ?>">
                                        <?php }else{ ?>
                                            <img class="leftImg" src="<?php echo base_url().str_replace('https://shamsaha.com/app/','',$upcoming[$i]->profile_pic); ?>" alt="<?= $upcoming[$i]->vname ?>" title="<?= $upcoming[$i]->vname ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="profilePic">
                                    <div class="user-detail">
                                        <h3><?php echo $upcoming[$i]->vname; ?></h3>
                                        <p><?php echo $upcoming[$i]->shift_language; ?></p>
                                    </div>
                                </div>
                                <div class="profilePic">
                                    <div class="user-detail">
                                        <h5><?php echo $upcoming[$i]->date; ?></h5>
                                        <p><?php echo $upcoming[$i]->shift_time; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div> -->
  









		

		
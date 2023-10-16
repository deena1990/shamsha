<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title;?>|<?php echo $site_title;?> </title>
<!-- Site favicon -->
<link rel='shortcut icon' type='<?php echo base_url(); ?>public/image/x-icon' href='images/favicon.ico' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="<?php echo base_url(); ?>public/css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="<?php echo base_url(); ?>public/css/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="<?php echo base_url(); ?>public/css/plugins/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/plugins/colorpicker/bootstrap-colorpicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/plugins/nouislider/nouislider.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/plugins/select2/select2.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/js/plugins/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>public/css/mouldifi-forms.css" rel="stylesheet" >
<link href="<?php echo base_url(); ?>public/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>

<!-- Page container -->
<div class="page-container">

  <!-- Page Sidebar -->
  <div class="page-sidebar">

  		<!-- Site header  -->
		<header class="site-header">
		  <div class="site-logo"><a href="dashboard.php"><img src="<?php echo base_url(); ?>public/images/Shamsaha_Logo_Reverse_white.png" alt="Shamsaha" title="Shamsaha"></a></div>
		  <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
		  <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
		</header>
		<!-- /site header -->

		<!-- Main navigation -->
		<ul id="side-nav" class="main-menu navbar-collapse collapse">
            <?php  if (can('view-dashboard')) { ?>
			<li <?php if($page_title=='Dashboard'){ ?> class="active " <?php }else{} ?> ><a href="<?php echo base_url(); ?>dashboard"><i class="icon-home"></i><span class="title">Dashboard</span></a></li>
            <?php } if (can('view-dashboard')) { ?>
			<!-- <li <?php if($page_title=='Pending Chats'){ ?> class="active " <?php }else{} ?> ><a href="<?php echo base_url(); ?>logs/chats"><i class="icon-chat"></i><span class="title">Pending Chats</span></a></li> -->
            <li <?php if($page_title=='Volunteer Logs' || $page_title=='Chats' || $page_title=='Calls' || $page_title=='Video Calls' || $page_title=='Add Alert' || $page_title=='Cases' || $page_title=='Victim Alert'){ ?> class="has-sub active " <?php }else{ ?>class="has-sub" <?php } ?>><a href="#"><i class="icon-chat"></i><span class="title">Logs</span></a>
				<ul class="nav collapse">
                    <li <?php if($page_title=='Chats'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>logs/chats"><span class="title">Chats</span></a></li>
                    <li <?php if($page_title=='Calls'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>logs/calls"><span class="title">Calls</span></a></li>
                    <li <?php if($page_title=='Video Calls'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>logs/video_calls"><span class="title">Video calls</span></a></li>
                    <?php if (can('view-cases')) { ?>
					<li <?php if($page_title=='Cases'){ ?> class="active " <?php }else{} ?> ><a href="<?php echo base_url(); ?>cases/alluser"><span class="title">Case IDs</span></a></li>
					<?php } ?>
					<li <?php if($page_title=='Volunteer Logs'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>logs/volunteer_logs"><span class="title">Volunteer Logs</span></a></li>
                    <?php if (can('add-alert')) { ?>
					<li <?php if($page_title=='Add Alert'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>victim_alert/add"><span class="title">Add Victim Alert</span></a></li>
					<?php } if (can('view-alert')) { ?>
					<li <?php if($page_title=='Victim Alert'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>victim_alert/allvictimalerts"><span class="title">Victim Alerts</span></a></li>
					<?php } ?>
                </ul>
			</li>
			<?php } if (can('view-case_report')) { ?>
            <li <?php if($page_title=='Case Report'){ ?> class="active " <?php } ?>><a href="<?php echo base_url(); ?>case_report/"><i class="icon-doc"></i></i><span class="title">Case Report</span></a></li>
			<?php } if (can('view-volunteer')) { ?>
			<li  <?php if($page_title == 'VSP Emailer' || $page_title=='Add Volunteer' || $page_title=='Volunteers' || $page_title=='setActiveVols' || $page_title=='Add Announcement' || $page_title=='Volunteers Announcement' || $page_title=='Announcements'){ ?> class="has-sub active " <?php }else{ ?>class="has-sub" <?php } ?>><a href="#"><i class="icon-users"></i><span class="title">Volunteers</span></a>
				<ul class="nav collapse">
                    <?php if (can('add-volunteer')) { ?>
					<li <?php if($page_title=='Add Volunteer'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>volunteer/add"><span class="title">Add Volunteer</span></a></li>
                    <?php } if (can('view-volunteer')) { ?>
					<li <?php if($page_title=='Volunteers'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>volunteer/alluser"><span class="title">List of Volunteer</span></a></li>
                    <?php } if (can('view-set_active_volunteer')) { ?>
					<li <?php if($page_title=='setActiveVols'){ ?> class="active " <?php }else{} ?> ><a href="<?php echo base_url(); ?>volunteer/setActiveVols"><span class="title">Set Active Volunteers</span></a></li>
					<?php } if (can('add-announcement')) { ?>
					<li <?php if($page_title=='Add Announcement'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>announcement/add"><span class="title">Add Announcement</span></a></li>
                    <?php } if (can('view-volunteer_announcement')) { ?>
                    <li <?php if($page_title=='Volunteers Announcement'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>announcement/volannouncement"><span class="title">Volunteer Announcements</span></a></li>
                    <?php } if (can('view-announcement')) { ?>
					<li <?php if($page_title=='Announcements'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>announcement/allannouncement"><span class="title">List of Announcement</span></a></li>
                    <?php } if (can('add-announcement')) { ?>
					<li <?php if($page_title=='VSP Emailer'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>announcement/mailerVSP"><span class="title">Emailer (Same as VSP)</span></a></li>
                    <?php } ?>
				</ul>
			</li>
			<?php } if (can('view-cms')) { ?>
			<li <?php if($page_title=='Notifications' || $page_title=='Logo' || $page_title=='Home' || $page_title=='About Us' || $page_title=='Contact Us' || $page_title=='Terms' || $page_title=='Get Involved' || $page_title=='ISponser' || $page_title=='CSponser' || $page_title=='Work with Us' || $page_title=='AVolunteer' || $page_title=='Add Message' || $page_title=='Messages' || $page_title=='Add Message Title' || $page_title=='Message Titles' || $page_title=='Add Board Member' || $page_title=='Board Members' || $page_title=='Events' || $page_title=='Add Event' || $page_title=='Add Event Images' || $page_title=='Event Images' || $page_title=='Add Media Article' || $page_title=='Media Articles' || $page_title=='Add Job' || $page_title=='All Job' || $page_title=='Advocacy'){ ?> class="has-sub active " <?php }else{ ?>class="has-sub" <?php } ?>><a href="#"><i class="icon-cog"></i><span class="title">Content Management</span></a>
				<ul class="nav collapse">
				<?php if (can('add-message')) { ?>
					<li <?php if($page_title=='Add Message'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>message/add"><span class="title">Add Message</span></a></li>
            		<?php } if (can('view-message')) { ?>
					<li <?php if($page_title=='Messages'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>message/list"><span class="title">Messages</span></a></li>
					<?php } if (can('add-message_title')) { ?>
					<li <?php if($page_title=='Add Message Title'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>message/add_title"><span class="title">Add Message Title</span></a></li>
					<?php } if (can('view-message_title')) { ?>
					<li <?php if($page_title=='Message Titles'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>message/title_list"><span class="title">Message Titles</span></a></li>
					<?php } ?>
                    <li <?php if($page_title=='Home'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>about/hupdate/1"><span class="title">Home</span></a></li>
					<li <?php if($page_title=='About Us'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>about/aupdate/8"><span class="title">About Us</span></a></li>
                    <li <?php if($page_title=='Contact Us'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>contact/update/4"><span class="title">Contact</span></a></li>
                    <?php if (can('add-board_member')) { ?>
					<li <?php if($page_title=='Add Board Member'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>boardmember/add"><span class="title">Add Board Member</span></a></li>
					<?php } if (can('view-board_member')) { ?>
					<li <?php if($page_title=='Board Members'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>boardmember/list"><span class="title">Board Members</span></a></li>
					<?php } if (can('add-event')) { ?>
					<li <?php if($page_title=='Add Event'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>event/add"><span class="title">Add Event</span></a></li>
                    <?php } if (can('view-event')) { ?>
					<li <?php if($page_title=='Events'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>event/allevent"><span class="title">Events</span></a></li>
					<?php } if (can('add-event_image')) { ?>
					<li <?php if($page_title=='Add Event Images'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>event/add_event_image"><span class="title">Add Event Images</span></a></li>
                    <?php } if (can('view-event_image')) { ?>
					<li <?php if($page_title=='Event Images'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>event/alleventimages"><span class="title">Event Images</span></a></li>
					<?php } if (can('add-media_article')) { ?>
					<li <?php if($page_title=='Add Media Article'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>event/add_media_article"><span class="title">Add Media Article</span></a></li>
                    <?php } if (can('view-media_article')) { ?>
					<li <?php if($page_title=='Media Articles'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>event/allmediaarticle"><span class="title">Media Articles</span></a></li>
                    <?php } if (can('add-job')) { ?>
					<li <?php if($page_title=='Add Job'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>job/add"><span class="title">Add Job</span></a></li>
                    <?php } if (can('view-job')) { ?>
					<li <?php if($page_title=='All Job'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>job/alljob"><span class="title">List of Job</span></a></li>
                    <?php }  if ($this->auth->loginStatus()) { ?>
					<li <?php if($page_title=='Advocacy'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>advocacy/alladvocacy"><span class="title">Advocacy Applicants</span></a></li>
                    <?php } ?>
					<li <?php if($page_title=='Terms'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>termsncondition/update/2"><span class="title">Terms & Conditions</span></a></li>
                    <li <?php if($page_title=='Get Involved'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>get_involved/update/3"><span class="title">Get Involved</span></a></li>
                    <li <?php if($page_title=='Work with Us'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>workwithus/update/9"><span class="title">Work With Us</span></a></li>
                    <li <?php if($page_title=='AVolunteer'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>abvolunteer/update/5"><span class="title">Volunteer</span></a></li>
					<li <?php if($page_title=='Notifications'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>notification"><span class="title">Notifications</span></a></li>
                </ul>
			</li>
            <?php } if (can('view-case_report')) { ?>
			<li <?php if($page_title=='Questionnaire' || $page_title=='Feedback'){ ?> class="has-sub active " <?php }else{ ?>class="has-sub" <?php } ?>><a href="#"><i class="icon-doc"></i><span class="title">Forms</span></a>
				<ul class="nav collapse">
					<!--/*sourabh28-11-2022*/-->
					<?php if (can('view-case_report')) { ?>
					<li <?php if($page_title=='Questionnaire'){ ?> class="active " <?php } ?>><a href="<?php echo base_url(); ?>questionnaire/"><span class="title">Intake Form Responses</span></a></li>
					<!--/*sourabh28-11-2022*/-->
					<?php } if (can('view-case_report')) { ?>
            		<li <?php if($page_title=='Feedback'){ ?> class="active " <?php }else{} ?>><a href="<?php echo base_url(); ?>feedback"><span class="title">Client Feedback Form Responses</span></a></li>
					<?php }  ?>
				</ul>
			</li>
            <?php } if (can('view-resource')) { ?>
			<li <?php if($page_title=='Resource' || $page_title=='Resources' || $page_title=='Add Category' || $page_title=='Category' || $page_title=='Add Location' || $page_title=='Location' || $page_title=='Survivor tools' || $page_title=='Add Survivor tool'){ ?> class="has-sub active " <?php }else{ ?>class="has-sub" <?php } ?>><a href="#"><i class="icon-cog"></i><span class="title">Resources</span></a>
				<ul class="nav collapse">
                    <?php if (can('add-resource')) { ?>
					<li <?php if($page_title=='Resource'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>resource/add"><span class="title">Add Resource</span></a></li>
                    <?php } if (can('view-resource')) { ?>
					<li <?php if($page_title=='Resources'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>resource/allresource"><span class="title">List of Resources</span></a></li>
                    <?php } if (can('add-resource_category')) { ?>
                    <li <?php if($page_title=='Add Category'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>resource_category/add"><span class="title">Add Categories </span></a></li>
                    <?php } if (can('view-resource_category')) { ?>
					<li <?php if($page_title=='Category'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>resource_category"><span class="title">List of Categories </span></a></li>
                    <?php } if (can('add-resource_country')) { ?>
                    <li <?php if($page_title=='Add Location'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>resource_location/add"><span class="title">Add Country </span></a></li>
                    <?php } if (can('view-resource_country')) { ?>
					<li <?php if($page_title=='Location'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>resource_location"><span class="title">List of Countries </span></a></li>
                    <?php } if (can('add-survivor_tool')) { ?>
					<li <?php if($page_title=='Add Survivor tool'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>survivor_tools/add"><span class="title">Add Survivor tools </span></a></li>
                    <?php } if (can('view-survivor_tool')) { ?>
					<li <?php if($page_title=='Survivor tools'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>survivor_tools"><span class="title">List of Survivor tools </span></a></li>
                    <?php } ?>
				</ul>
			</li>
            <?php } if (can('view-user')) { ?>
            <li <?php if($page_title=='User Management' || $page_title=='Manage Users' || $page_title=='Add Role' || $page_title=='Manage Roles' || $page_title=='Add Manager on Duty' || $page_title=='Manager on Duty'){ ?> class="has-sub active " <?php }else{ ?>class="has-sub" <?php } ?>><a href="#"><i class="icon-users"></i><span class="title">User Management</span></a>
                <ul class="nav collapse">
                    <?php if (can('add-user')) { ?>
                    <li <?php if($page_title=='User Management'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>usermanagement/add"><span class="title">Add User</span></a></li>
                    <?php } if (can('view-user')) { ?>
                    <li <?php if($page_title=='Manage Users'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>usermanagement"><span class="title">Manage Users</span></a></li>
                    <?php } if (can('add-role')) { ?>
                    <li <?php if($page_title=='Add Role'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>roles/add"><span class="title">Add Role</span></a></li>
                    <?php } if (can('view-role')) { ?>
                    <li <?php if($page_title=='Manage Roles'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>roles"><span class="title">Manage Roles</span></a></li>
                    <?php } if (can('add-manager_on_duty')) { ?>
                    <li <?php if($page_title=='Add Manager on Duty'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>manager_on_duty/add"><span class="title">Add Manager on Duty</span></a></li>
                    <?php } if (can('view-manager_on_duty')) { ?>
                    <li <?php if($page_title=='Manager on Duty'){ ?> class="active" <?php }else{} ?>><a href="<?php echo base_url(); ?>manager_on_duty"><span class="title">List of Manager on Duty</span></a></li>
                    <?php } ?>
                </ul>
            </li>
			<?php } ?>

			
            

		</ul>
		<!-- /main navigation -->
  </div>
  <!-- /page sidebar -->

  <!-- Main container -->
  <div class="main-container">
  
	<!-- Main header -->
    <div class="main-header row">
      <div class="col-sm-12 col-xs-7">
	  
		<!-- User info -->
        <ul class="user-info pull-right">          
          <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="<?php echo base_url(); ?>public/images/download.png">Administrator <span class="caret"></span></a>
		  
			<!-- User action menu -->
            <ul class="dropdown-menu">
			  <li><a href="<?php echo base_url(); ?>update_profile"><i class="icon-user"></i>Profile</a></li>
			  <li><a href="<?php echo base_url(); ?>change_password"><i class="icon-cog"></i>Change Password</a></li>
			  <li><a href="<?php echo base_url(); ?>Login/logout"><i class="icon-logout"></i>Logout</a></li>
            </ul>
			<!-- /user action menu -->
			
          </li>
        </ul>
		<!-- /user info -->
		
      </div>
	  
      <div class="col-sm-6 col-xs-5">
	  	<div class="pull-right" style="display:none;">
			<!-- User alerts -->
			<ul class="user-info pull-left">
			
			  <!-- Notifications -->
			  <li class="notifications dropdown">
				<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-attention"></i><span class="badge badge-info">6</span></a>
				<ul class="dropdown-menu pull-right">
					<li class="first">
						<div class="small"><a class="pull-right danger" href="#">Mark all Read</a> You have <strong>3</strong> new notifications.</div>
					</li>
					<li>
						<ul class="dropdown-list">
							<li class="unread notification-success"><a href="#"><i class="icon-user-add pull-right"></i><span class="block-line strong">New user registered</span><span class="block-line small">30 seconds ago</span></a></li>
							<li class="unread notification-secondary"><a href="#"><i class="icon-heart pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
							<li class="unread notification-primary"><a href="#"><i class="icon-user pull-right"></i><span class="block-line strong">Privacy settings have been changed</span><span class="block-line small">2 hours ago</span></a></li>
							<li class="notification-danger"><a href="#"><i class="icon-cancel-circled pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
							<li class="notification-info"><a href="#"><i class="icon-info pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
							<li class="notification-warning"><a href="#"><i class="icon-rss pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
						</ul>
					</li>
					<li class="external-last"> <a href="#" class="danger">View all notifications</a> </li>
				</ul>
			  </li>
			  <!-- /notifications -->
			  
			  <!-- Messages -->
			  <li class="notifications dropdown">
				<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-mail"></i><span class="badge badge-secondary">12</span></a>
				<ul class="dropdown-menu pull-right">
					<li class="first">
						<div class="dropdown-content-header"><i class="fa fa-pencil-square-o pull-right"></i> Messages</div>
					</li>
					<li>
						<ul class="media-list">
							<li class="media">
								<div class="media-left"><img alt="" class="img-circle img-sm" src="<?php echo base_url(); ?>public/images/domnic-brown.png"></div>
								<div class="media-body">
									<a class="media-heading" href="#">
										<span class="text-semibold">Domnic Brown</span>
										<span class="media-annotation pull-right">Tue</span>
									</a>
									<span class="text-muted">Your product sounds interesting I would love to check this ne...</span>
								</div>
							</li>
							<li class="media">
								<div class="media-left"><img alt="" class="img-circle img-sm" src="<?php echo base_url(); ?>public/images/john-smith.png"></div>
								<div class="media-body">
									<a class="media-heading" href="#">
										<span class="text-semibold">John Smith</span>
										<span class="media-annotation pull-right">12:30</span>
									</a>
									<span class="text-muted">Thank you for posting such a wonderful content. The writing was outstanding...</span>
								</div>
							</li>
							<li class="media">
								<div class="media-left"><img alt="" class="img-circle img-sm" src="<?php echo base_url(); ?>public/images/stella-johnson.png"></div>
								<div class="media-body">
									<a class="media-heading" href="#">
										<span class="text-semibold">Stella Johnson</span>
										<span class="media-annotation pull-right">2 days ago</span>
									</a>
									<span class="text-muted">Thank you for trusting us to be your source for top quality sporting goods...</span>
								</div>
							</li>
							<li class="media">
								<div class="media-left"><img alt="" class="img-circle img-sm" src="<?php echo base_url(); ?>public/images/alex-dolgove.png"></div>
								<div class="media-body">
									<a class="media-heading" href="#">
										<span class="text-semibold">Alex Dolgove</span>
										<span class="media-annotation pull-right">10:45</span>
									</a>
									<span class="text-muted">After our Friday meeting I was thinking about our business relationship and how fortunate...</span>
								</div>
							</li>
							<li class="media">
								<div class="media-left"><img alt="" class="img-circle img-sm" src="<?php echo base_url(); ?>public/images/domnic-brown.png"></div>
								<div class="media-body">
									<a class="media-heading" href="#">
										<span class="text-semibold">Domnic Brown</span>
										<span class="media-annotation pull-right">4:00</span>
									</a>
									<span class="text-muted">I would like to take this opportunity to thank you for your cooperation in recently completing...</span>
								</div>
							</li>
						</ul>
					</li>
					<li class="external-last"> <a class="danger" href="#">All Messages</a> </li>
				</ul>
			  </li>
			  <!-- /messages -->
			  
			</ul>
			<!-- /user alerts -->
			
		</div>
      </div>
    </div>
	<!-- /main header -->
	<script src="<?php echo base_url(); ?>public/js/multiselect.js"></script>

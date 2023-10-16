<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Resources</title>
	<link rel="stylesheet" href="<?=base_url();?>app/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>app/css/bootstrap.min.css">
 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
	<style>
		*{
			margin: 0;
			padding: 0;
            font-family: Red/Black, sans-serif;
		}
		section {
		    width: 680px;
		    margin: 0 auto;
		}
		section .hospital-details{
			background: var(--pinkColor);
			color: #fff !important;
			padding-top: 12px;
			margin: 0;
		}
		section .heading{
			text-align: center;
			padding: 15px 0;
			font-weight: 600;
		}
		.hospital{
			background: #fff;
			padding: 10px 0;
			border-radius: 17px 17px 0 0;
		}
		.hospital-list{
			background:var(--pinkColor);
			margin: 20px;
			padding: 10px 25px ;
			border-radius: 10px;
		}
        .hospital-list a{
            color: #fff;
            text-decoration: none;
        }

		@media only screen and (max-width:767px){
			section {
		    width: 100%;
		    margin: 0 auto;
			}
		}
	</style>
</head>
<body>
	<section>
		<div class="container">
			<div class="row">
				<div class="hospital-details justify-content-center">
				
						<div class="logo-shamsa">
							<img src="img/logo-(2).jpg" alt="">
						</div>
						
						<h3 class="heading"><?= $resource_type ?></h3>
				
					<div class="hospital">
						<?php foreach ($hospital_details as $value) { ?>
							<div class="hospital-list">
								<?php if ($value->name){ ?>
								<h5 class="heading"><?= $value->name ?></h5>
								<?php } if ($value->contact_info1 ){ ?>
								<p><a href="tel:<?= $value->contact_info1 ?>"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?= $value->contact_info1 ?></a></p>
								<?php } if ($value->contact_info2 ){ ?>
								<p><a href="tel:<?= $value->contact_info2 ?>"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?= $value->contact_info2 ?></a></p>
								<?php } if ($value->contact_info3 ){ ?>
								<p><a href="tel:<?= $value->contact_info3 ?>"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?= $value->contact_info3 ?></a></p>
								<?php } if ($value->contact_info4 ){ ?>
								<p><a href="tel:<?= $value->contact_info4 ?>"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?= $value->contact_info4 ?></a></p>
								<?php } if ($value->email_info1){ ?>
								<p><a href="mailto:<?= $value->email_info1 ?>"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;<?= $value->email_info1 ?></a></p>
								<?php } if ($value->email_info2){ ?>
								<p><a href="mailto:<?= $value->email_info2 ?>"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;<?= $value->email_info2 ?></a></p>
								<?php } if ($value->email_info3){ ?>
								<p><a href="mailto:<?= $value->email_info3 ?>"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;<?= $value->email_info3 ?></a></p>
								<?php } if ($value->web_info1){ ?>
								<p><a href="https://<?php echo $value->web_info1 ?>"><i class="fa fa-globe"></i> &nbsp; <?= $value->web_info1 ?></a></p>
								<?php } if ($value->web_info2){ ?>
								<p><a href="https://<?php echo $value->web_info2 ?>"><i class="fa fa-globe"></i> &nbsp; <?= $value->web_info2 ?></a></p>
								<?php } if ($value->address_info){ ?>
								<p><i class="fa fa-location-dot"></i> &nbsp;<?= $value->address_info ?></p>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
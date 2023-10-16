<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Feedback Form</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='<?php echo base_url(); ?>public/image/x-icon' href='images/favicon.ico' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- /site favicon -->

<!-- Bootstrap stylesheet min version -->
<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->
<!-- Font awesome stylesheet -->
<link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet">
<style>
   body{
       background: #fff;
   }
.card {
    padding: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(255, 255, 255, 1);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 12px;
    -webkit-box-shadow: 0px 0px 5px 0px rgba(97,97,97,0.75);
    -moz-box-shadow: 0px 0px 5px 0px rgba(97,97,97,0.75);
    box-shadow: 0px 0px 5px 0px rgba(97,97,97,0.75);
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    margin: 20px;
    width:100%;
}
.success-fa{
    text-align: center;
    display: block;
    font-size: 70px;
    color: #e34587;
}
.failed-fa{
    text-align: center;
    display: block;
    font-size: 70px;
     color: #ff2525;
}
.card h4{
    text-align: center;
    margin-top : 0;
    font-size: 24px;
    font-weight: 600;
}
/* .card p{
    text-align: center;
} */
.center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
  width: 100%;
}
.msgBody {
    text-align: start;
}
</style>

<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>
<div class="container center-screen">
    <div class="row center-screen">
        <div class="col-md-12 center-screen">
          
           <div class="card hovercard">
                <h1>Shamsaha's Client Feedback Form</h1>
                <h1>استمارة ملاحظات عملاء شمسها</h1>
                <span class="success-fa"><i class="fa fa-check-circle"></i></span>
                <h4>Form Submitted Successfully !!</h4><br>
                <div class="msgBody">
                    <p>Thank you for your feedback. We take it very seriously and value your opinion. Please feel free to contact us again at any time!</p>
                    <p>Our contact email is info@shamsaha.org</p><br>
                    <p>Thank you once again!</p><br>
                    <p>شكرا لك على ملاحظاتك. نحن نأخذ الأمر على محمل الجد ونقدر رأيك. لا تتردد في الاتصال بنا مرة أخرى في أي وقت!</p>
                    <p>بريدنا الإلكتروني هو info@shamsaha.org</p><br>
                    <p>شكرا لك مرة أخرى!</p>
                </div>
           </div>
          
        </div>
    </div>
</div>
</body>
</html>

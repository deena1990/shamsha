<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Payment Gateway </title>
<!-- Site favicon -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- /site favicon -->

<script src="<?php echo site_url() ?>assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo site_url() ?>assets/css/materialize.min.css">
<link rel="stylesheet" href="<?php echo site_url() ?>assets/css/google-form.css">
<!-- Compiled and minified JavaScript -->
<script src="<?php echo site_url() ?>assets/js/materialize.min.js"></script>
      <style>
          .error{
              color: red;
          }
          .center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
  width: 100%;
}
.price{
    font-size :35px;
}
      </style>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->

<style>
    .pink-color{
        color:#F05A94!important;
    }
    [type="radio"]:not(:checked)+span:before, [type="radio"]:not(:checked)+span:after {
    border: 2px solid #F05A94;
}
.bold-txt{
    font-weight:bold;
}
.left-align{
    text-align:left!important;
}
.right-align{
    text-align:right!important;
}
</style>

</head>
<body>
<div class="container center-screen">
    <div class="row" style="width:100%">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h5 class="pink-color">Training Fee</h5>
          <span class="price pink-color">35 BHD</span>
          <h5 class="pink-color">Payment Type</h5>
          
          
          <form action="" method="post">
            
           <div class="row">
          <div class="col s6">
              <p class="right-align">
              <label>
                <input class="with-gap" name="payType" value="debit" type="radio"  />
                <span class="pink-color bold-txt">Debit</span>
              </label>
            </p>
          </div>
          <div class="col s6">
               <p class="left-align">
              <label>
                <input class="with-gap" name="payType" value="credit" type="radio"  />
                <span class="pink-color bold-txt">Credit</span>
              </label>
            </p>
          </div>
        </div>
            <br>
            <p class="center-align"><button class="btn waves-effect waves-light" type="submit" name="action">Pay Now</button></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

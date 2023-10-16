<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    <script src="<?php echo site_url() ?>assets/js/jquery.min.js"></script>

</head>
<body>
<div class="container vcenter">
    <div class="row ">
        <div class="col-xs-12 ">
            <a class="btn btn-primary btn-block" href="<?php echo site_url() ?>apis/webview/shortcasereport?case_id=<?= $case_id ?>&volunteer=<?= $volunteer ?>" >Short form</a>
            <a class="btn btn-primary btn-block" href="<?php echo site_url() ?>apis/webview/longcasereport?case_id=<?= $case_id ?>&volunteer=<?= $volunteer ?>" >Long form</a>
			<!--<a class="btn btn-primary btn-block" id="test" href="#" >Test Button</a>-->
        </div>
    </div>


</div>
<script>
/*document.getElementById("test").addEventListener("click",function boom(){
	console.log("asdfasdf");
	try {
		window.webkit.messageHandlers.successfulReport.postMessage(true);
	} catch(err) {
		console.log('error');
		console.log(err);
	} 
	try {
		Android.successfulReport(true);
	} catch(err) {
		console.log('error');
		console.log(err);
	} 
})*/
</script>
<style>
    .btn{
        background: #fa518d !important;
        margin-bottom: 30px !important;
    }
    .vcenter {
        display: table-cell;
        vertical-align: middle;
    }
    body {
        display: table;
        position: absolute;
        height: 100%;
        width: 100%;
    }
</style>
</body>

</html>
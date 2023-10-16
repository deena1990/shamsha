
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base_url();?>app/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>app/css/bootstrap.min.css">
<style>
    .text-content span {
    color: #fff !important;
}
</style>
</head>

<body class="vhBody">
    <div class="maxWidth">
    <section class="termSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="termsContent">

                        <div class="logo-shamsa">
                            <img src="img/logo-(2).jpg" alt="">
                        </div>
                        <h1 class="mainTermHead"><?= $terms['title'] ?></h1>
                        <div class="text-content"><?= $terms['content'] ?></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
   </div>
</body>

</html>
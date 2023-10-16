
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base_url();?>app/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>app/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body class="vhBody">
    <div class="maxWidth">
        <section class="termSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="eventDetail">
                            <div class="logo-shamsa">
                                <img src="img/logo-(2).jpg" alt="">
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="eventDetsils">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mainTermHead"><?= $article['title'] ?></h1>

                        <div class="ImgDetails">
                            <img src="<?php echo base_url().'uploads/Events/mediaPhotos/'.$article['image'] ?>" alt="event_pic">
                        </div>
                    </div>
                </div>
                <div class="contentEventDetails">
                    <p class="mb-0"><?= $article['content'] ?></p>
                </div>

            </div>
        </section>
    </div>
</body>

</html>
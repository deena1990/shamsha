<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wok Station</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo site_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo site_url() ?>assets/bootstrap-3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?php echo site_url() ?>assets/bootstrap-3.3.7/css/bootstrap.css">
    <style>
        .error{
            color: red;
            padding-left: 10px;
        }

        .products .name{
            text-align: left;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 500;
        }
        .products .price{
            text-align: center;
            margin-bottom: 10px;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            top: -6px;
            left: 4px;
            background: #F05A94;
            padding: 6px;
            color: #fff;
        }
        .products .thumbnail{
            margin-bottom: 5px;
            position: relative;
        }
        .product-container{
            padding: 10px;
        }
        .menuList{
            width: 100%;
            padding-bottom: 40px;
        }
        .footer-checkout{
            height: 50px;
            display: block;
            width: 100%;
            background: #F05A94;
            position: fixed;
            bottom: 0;
            z-index: 999;
            line-height: 15px;
            padding: 10px;
        }
        body{
            height: 100%;
            color: #9e9e9e;
        }
        .btn-success{
            width: 100%;
            background: #fff;
            color: #F05A94;
            border: none;
        }
        .btn-success:active,.btn-success:hover,.btn-success:focus,.btn-success:active:focus{
            background: #fff;
            border: none;
            color: #F05A94;
            outline: none;
        }
        .footer-checkout h5{
            font-weight: 500;
            color: #fff;
            font-size: 18px;
        }
        .qty{
            margin-bottom: 10px;
        }
        .btn-pink{
             background: #F05A94!important;
             color: #fff;
             padding: 3px 25px;
         }
        .btn-pink:active,.btn-pink:hover,.btn-pink:focus,.btn-pink:active:focus{
            background: #F05A94!important;
            color: #fff!important;
            padding: 3px 25px;
            outline: none;
        }
        .add-cart-cont{
            display: block;
            margin: 0 auto;
        }
        .checkboxAdd{
            display:inline-block;
            opacity:0;
            text-indent:9999px;
        }
    </style>
</head>
<body>
<div class="menuList">
<div class="container product-container">

        <?php
        foreach ($products as $row){
            ?>
            <div class="row">
                <div class="col-xs-6">
                    <div class="products">
                        <div class="thumbnail">
                            <img src="<?php echo $row->images[0]->src; ?>">
                            <h4 class="price">BHD <?php echo $row->price; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="products">
                        <h4 class="name"><?php echo $row->name; ?></h4>
                        <div class="qty">
                            <div class="row">
                                <div class="col-xs-10">
                                    <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-default btn-number"  data-type="minus" data-field="">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                        <input type="text" id="qty_<?php echo $row->id; ?>" name="quantity" class="form-control input-number quantity" value="1">
                                        <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="add-cart-cont">
                            <button class="btn btn-default btn-pink add-to-cart-btn" data-id="<?php echo $row->id; ?>">Add to cart</button>
                            <input type="checkbox" name="productid" class="checkboxAdd" value="<?php echo $row->id; ?>" id="check_<?php echo $row->id; ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
        <?php } ?>
    </div>

            </div>
<div class="footer-checkout">
    <input type="hidden" value="<?= $volunteer_id ?>" class="form-control" name="volunteer_id" id="volunteer_id">
    <input type="hidden" value="<?= $case_id ?>" class="form-control" name="case_id" id="case_id">
<div class="row">
    <div class="col-xs-6">
        <h5>Total Items : <span id="totalCount">0</span></h5>
    </div>
    <div class="col-xs-6">
        <button class="btn btn-success" id="orderNow">Order Now</button>
    </div>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shipping Address</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First name:</label>
                        <input type="text" class="form-control" name="first_name" id="first_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name:</label>
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="form-group">
                        <label for="area">Area:</label>
                        <input type="text" class="form-control" name="area" id="area">
                    </div>
                    <div class="form-group">
                        <label for="block">Block:</label>
                        <input type="text" class="form-control" name="block" id="block">
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Add</button>

            </div>
        </div>

    </div>
</div>

<script>

    $(document).ready(function(){
        var quantitiy=0;
        var items = [];
        $('.quantity-right-plus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($(this).closest("div.qty").find("input[name='quantity']").val());
            $(this).closest("div.qty").find("input[name='quantity']").val(quantity + 1);
            getSelectedProduct()
        });

        $('.quantity-left-minus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($(this).closest("div.qty").find("input[name='quantity']").val());
            if(quantity>1){
                $(this).closest("div.qty").find("input[name='quantity']").val(quantity - 1);
            }
            getSelectedProduct()
        });


        $('.add-to-cart-btn').on('click', function () {
            var id = $(this).attr('data-id');
            var qty = $("#qty_"+id).val();

            if(!$("#check_"+id).is(":checked")){
                $("#check_"+id).prop("checked",true);
                $(this).closest("div.add-cart-cont").find(".add-to-cart-btn").text("Added");
            }
            else{
                $("#check_"+id).prop("checked",false);
                $(this).closest("div.add-cart-cont").find(".add-to-cart-btn").text("Add to cart");
            }
            getSelectedProduct()
        })

        $("#orderNow").click(function (e) {
            var volunteer_id = $("#volunteer_id").val();
            var case_id = $("#case_id").val();
            if(volunteer_id.length > 0 && case_id.length > 0){
                var product = [];
                $("input:checkbox[name=productid]:checked").each(function(){
                    var id = $(this).val();
                    var qty = $("#qty_"+id).val();
                    product.push({
                        product_id: id,
                        quantity : qty,
                    });
                });

                if(product.length > 0){
					var validate = validateAddress();
					console.log(validate);
					if(validate){
						console.log("Order");
						var first_name = $("#first_name").val();
                        var last_name = $("#last_name").val();
                        var phone = $("#phone").val();
                        var address = $("#address").val();
                        var area = $("#area").val();
                        var block = $("#block").val();
                        /*var data = {
                            products : product,
                            first_name : first_name,
                            last_name : last_name,
                            phone : phone,
                            address : address,
                            area : area,
                            block : block
                        }
						console.log(data);*/
						$.post("https://shamsaha.com/app/apis/services/order",
						{
							products : product,
                            first_name : first_name,
                            last_name : last_name,
                            phone : phone,
                            address : address,
                            area : area,
                            block : block
						},
						function(html){
							alert(html);
							console.log("success ");
								
							$('.checkboxAdd').each(function(){
								this.checked = false;
							});
							$(".add-to-cart-btn").text("Add to cart");
							$('.quantity').val(1);
							getSelectedProduct();
							
						});
                        /*$.ajax({
                            type: 'POST',
                            url: 'https://shamsaha.com/app/apis/services/order',
                            data : data,
                            dataType: "json",
                            success: function(html) {
								console.log("success ");
								
                                $('.checkboxAdd').each(function(){
                                    this.checked = false;
                                });
                                $(".add-to-cart-btn").text("Add to cart");
                                $('.quantity').val(1);
                                getSelectedProduct();
                            }
                        });*/
                    }

                }else{
                    alert("Add any one product");
                }

            }else{
				alert("Something went wrong, Please try again");
            }

        })

    });


    function getSelectedProduct() {
        var totalQty = 0;
        $("input:checkbox[name=productid]:checked").each(function(){
            var id = $(this).val();
            var qty = $("#qty_"+id).val();
            totalQty = parseInt(totalQty) + parseInt(qty);

        });
        $("#totalCount").html(totalQty);
    }

    function validateAddress(){
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var area = $("#area").val();
        var block = $("#block").val();
		//console.log("first_name: "+first_name.length+" last_name: "+last_name.length+" phone : "+phone.length +" address : "+address.length+" area : "+area.length +" block : "+block.length );
        if(first_name.length > 0 && last_name.length > 0 && phone.length > 0 && address.length > 0 && area.length > 0 && block.length > 0){
            return true;
        }
        else{
            $('#myModal').modal('show');
            return false;
        }
    }
</script>
</body>
</html>
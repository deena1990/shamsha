

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Sponsor Registration Details</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"><a href="<?php echo base_url('sponser_registartion/allregistrations'); ?>">Sponsor Registration</a></li>
        <li>Sponsor Registration Details</li>
    </ol>


    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Personal Details</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="col-md-5">Name</th>
                                <td><?= $registartionlist->name ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Email</th>
                                <td><?= $registartionlist->email ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Phone Number</th>
                                <td><?= $registartionlist->mobile ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Address</th>
                                <td><?= $registartionlist->address ?></td>
                            </tr>
                        </table>
                        <br>
                        <br>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Sponsor Details</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="col-md-5">Type</th>
                                <td><?= $registartionlist->stype ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Category</th>
                                <td><?= $registartionlist->category ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Quantity</th>
                                <td><?= $registartionlist->quantity ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Memo</th>
                                <td><?= $registartionlist->memo ?></td>
                            </tr>
                            <tr>
                                <th class="col-md-5">Company Name</th>
                                <td><?= $registartionlist->company_name ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Payment Details</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Date</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td><?= date("d-m-Y", strtotime($registartionlist->created_at)) ?></td>
                                <td><?= $registartionlist->transaction_id ?></td>
                                <td><?= $registartionlist->price ?></td>
                                <td><?= $registartionlist->payment_type ?></td>
                                <td><?= $registartionlist->pay_result ?></td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>


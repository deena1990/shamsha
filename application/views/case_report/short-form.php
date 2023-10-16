

<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">Case Report Details</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>case_report">Case Reports</a></li>
        <li>Case Report Details</li>
    </ol>

    <?php if($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success" id="mydivs"  role="alert">
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger" id="mydivs"  role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Case Report</h3>
                    <ul class="panel-tool-options" style="display:none;">
                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                    </ul>
                </div>

                <div class=" container">
                    <div class=" panel-body personal-info">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Case ID</h4>
                                <p><?= $cr_report->case_id ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>Status:</h4>
                                <form class="form-inline" method="post" action="">
                                    <div class="form-group">
                                        <select name="status" class="form-control" style="width: 150px">
                                            <option value="1" <?php echo $cr_report->status == '1' ? 'selected' : '' ?>>Follow up</option>
                                            <option value="2" <?php echo $cr_report->status == '2' ? 'selected' : '' ?>>Closed</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>What is your full name?</h4>
                                <p><?= $cr_report->fullname ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>What is your most up to date mobile number?</h4>
                                <p><?= $cr_report->mobile ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Was this client a repeat client or an administrative inquiry?</h4>
                                <p><?= $cr_report->repeat_client_r_admin_inquiry ?></p>
                            </div>
                        </div>

                        <?php if($cr_report->repeat_client_r_admin_inquiry == "Repeat client or caller"){ ?>

                        <div class="row">
                            <h2>Repeat client or caller</h2>
                            <div class="col-md-6">
                                <h4>What was the name of the caller?</h4>
                                <p><?= $cr_report->caller_name ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>What was the caller's phone number?</h4>
                                <p><?= $cr_report->caller_phone_num ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Why was she calling?</h4>
                                <p><?= $cr_report->why_she_call ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>Any notes or further details you think we should know?</h4>
                                <p><?= $cr_report->further_details ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Did this case require payment for anything (taxi, hotel, food, etc)?</h4>
                                <p><?= $cr_report->did_case_req_payment ?></p>
                            </div>
                        </div>
                    <?php if($cr_report->did_case_req_payment == "Yes"){ ?>
                        <div class="row">
                            <h2>Payment details</h2>
                            <div class="col-md-6">
                                <h4>What services/items were paid for?</h4>
                                <p><?= str_replace("Others","",$cr_report->service_r_item_paid_for).$cr_report->service_r_item_paid_for_others ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>Did you pay for anything personally, for which you need to be reimbursed?</h4>
                                <p><?= $cr_report->reimbursed ?></p>
                            </div>
                        </div>
                        <?php if($cr_report->reimbursed == "Yes"){ ?>
                        <div class="row">
                            <h2>Reimbursements</h2>
                            <div class="col-md-6">
                                <h4>What was the expense and the purpose?</h4>
                                <p><?= $cr_report->expense_n_purpose ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>What was the exact amount of the expense?</h4>
                                <p><?= $cr_report->amount_of_expense ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Do you have the receipt? (This is required for reimbursement. Please save it and give to us when you get your refund and/or take a photo and email it to info@shamsaha.org.)</h4>
                                <p><?= $cr_report->do_u_have_receipt ?></p>
                            </div>
                        </div>

                        <?php } } } else{ ?>

                        <div class="row">
                            <h2>Administrative/Other Inquiries</h2>
                            <div class="col-md-6">
                                <h4>Was this a spam call/chat?</h4>
                                <p><?= $cr_report->spam_call_chat ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>Please tell us the name of the caller.</h4>
                                <p><?= $cr_report->name_of_caller ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Please describe the interaction.</h4>
                                <p><?= $cr_report->desc_interaction ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>Please describe how this call needs to be followed up on. (Did you promise them a call back? Etc) </h4>
                                <p><?= $cr_report->how_call_follow_up ?></p>
                            </div>
                        </div>
<?php } ?>
                        <div class="row">
                            <h2>Closing and final notes</h2>
                            <div class="col-md-6">
                                <h4>Your final notes and thoughts about case/client.</h4>
                                <p><?= $cr_report->final_notes_n_thought_abt_client ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4>How were you feeling during your interactions with the client?</h4>
                                <p><?= $cr_report->feeling_interaction_with_client ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Please choose any one thing good or bad that you would like us to know about your shift.</h4>
                                <p><?= $cr_report->good_r_bad_abt_shift ?></p>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>


    <style>
        .personal-info h4{
            font-weight: 500;
        }

        .personal-info .row{
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 15px;
        }
    </style>
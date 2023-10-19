

<!-- Main content -->
<div class="main-content">
    <div class="row">
        <div class="col-md-6">    
            <h1 class="page-title">Case Report</h1>
            <!-- Breadcrumb -->
            <ol class="breadcrumb breadcrumb-2">
                <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="<?php echo base_url(); ?>case_report">Case Reports</a></li>
                <li><strong>Case Report Details</strong></li>
            </ol>
        </div>
    </div>
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
                    <div class=" panel-body personal-info">

                        <div class="row">
                            <div class="col-md-4">
                                <h4><b>Case ID</b></h4>
                                <p><?= $cr_report->case_id ?></p>
                            </div>
                            <div class="col-md-4">
                                <h4><b>Casework At Sight:</b></h4>
                                <form class="form-inline" method="post" action="">
                                    <input type="text" name="caseworkAtSight" class="form-control" value="<?php echo $cr_report->form_name; ?>">
                                    <input type="hidden" name="id" value="<?php echo $cr_report->id; ?>">
                                    <input type="hidden" name="post_type" value="cwas">

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <h4><b>Status:</b></h4>
                                <form class="form-inline" method="post" action="">
                                    <div class="form-group">
                                        <select name="status" class="form-control" style="width: 150px">
                                            <option value="1" <?php echo $cr_report->status == '1' ? 'selected' : '' ?>>Follow up</option>
                                            <option value="2" <?php echo $cr_report->status == '2' ? 'selected' : '' ?>>Closed</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="post_type" value="cs">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What is your name?</b></h4>
                                <p><?= $cr_report->fullname ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>What is your phone number?</b></h4>
                                <p><?= "( ".explode(":::", $cr_report->mobile)[0]." ) ".explode(":::", $cr_report->mobile)[1] ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What is your country of location?</b></h4>
                                <p><?= $cr_report->recomment_care ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>At what date and time did you receive the interaction?</b></h4>
                                <p><?= $cr_report->date.' '.$cr_report->time  ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Which country was the client contacting us from ?</b></h4>
                                <p><?= $cr_report->client_country ?></p>
                            </div>
                        </div>

                        <?php if ($cr_report->client_country == "Bahrain") { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Did the caller request immediate in-person support from the Shamsaha casework team?</b></h4>
                                <p><?= $cr_report->new_caller_r_client ?></p>
                            </div>
                        </div>

                            <?php if ($cr_report->new_caller_r_client == "Yes") { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>Did you communicate this immediately to the case work team in Bahrain?</b></h4>
                                    <p><?= $cr_report->why_she_call ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4><b>Did you explain the process (including working hours) to the caller - indicating that the casework team would call her back within 30-60 minutes?</b></h4>
                                    <p><?= $cr_report->name_of_caller ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>What specifically is the caller requesting?</b></h4>
                                    <p><?= $cr_report->desc_interaction  ?></p>
                                </div>
                            </div>
                            <?php }?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Did the caller request ongoing case work support ?</b></h4>
                                <p><?= $cr_report->how_call_follow_up ?></p>
                            </div>
                        </div>

                            <?php if ($cr_report->how_call_follow_up == "Yes") { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>Did you explain the process (including working hour) to the caller - indicating that the casework team would call her back within 3 days ?</b></h4>
                                    <p><?= $cr_report->shift_u_on  ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4><b>With what issues is she requesting support ?</b></h4>
                                    <p><?= $cr_report->client_last_name ?></p>
                                </div>
                            </div>
                            <?php }?>

                        <?php }?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What was the client’s name ?</b></h4>
                                <p><?= $cr_report->caller_name ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>What was the client’s phone number ?</b></h4>
                                <p><?= "( ".explode(":::", $cr_report->caller_phone_num)[0]." ) ".explode(":::", $cr_report->caller_phone_num)[1] ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What type of interaction was this ?</b></h4>
                                <p><?php if (strpos($cr_report->type_of_call, 'Other') === true) { echo $cr_report->type_of_call.' => '.$cr_report->type_of_call_other; }else{ echo $cr_report->type_of_call; } ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>How long was the interaction ?</b></h4>
                                <p><?= $cr_report->how_long_interaction ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>About what issue was the client contacting Shamsaha ?</b></h4>
                                <p><?= $cr_report->repeat_client_r_admin_inquiry ?></p>
                            </div>
                        </div>

                        <?php if ($cr_report->repeat_client_r_admin_inquiry == "The client was a victim of any form of gender-based abuse or violence (Such as domestic violence, sexual violence, or intimate partner violence)") { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What type of abuse is she facing ?</b></h4>
                                <p><?= $cr_report->abuse_she_face ?></p>
                            </div>
                        </div>
                            <?php if (is_int(strpos($cr_report->abuse_she_face, 'Sexual violence'))) { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>Was any form of penetration made ?</b></h4>
                                    <p><?= $cr_report->penetration_made.' => '.$cr_report->penetration_made_other ?></p>
                                </div>
                            </div>
                            <?php } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What was the relationship of the perpetrator to the victim ?</b></h4>
                                <p><?= $cr_report->relationship_of_perpet_to_victim ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Was this interaction for the caller or somebody else ?</b></h4>
                                <p><?= $cr_report->interaction_for ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Did the client answer indicate yes to any of the Urgency Assessment Questions during the client interaction ?</b></h4>
                                <p><?= $cr_report->client_country_other ?></p>
                            </div>
                        </div>

                            <?php if($cr_report->client_country_other == "Yes"){ ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>Which question did the client respond yes to during the Urgency Assessment ?</b></h4>
                                    <p><?php foreach (explode(" ::: ", $cr_report->how_long_interaction_others) as $key => $value) { echo $value."<br>"; } ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4><b>What steps were taken in response to the Urgency Assessment?</b></h4>
                                    <p><?= $cr_report->did_case_req_payment ?></p>
                                </div>
                            </div>
                            <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What was discovered during the risk analysis?</b></h4>
                                <p><?= $cr_report->service_r_item_paid_for ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Was a safety plan completed for any reason?</b></h4>
                                <p><?= $cr_report->service_r_item_paid_for_others ?></p>
                            </div>
                        </div>

                            <?php if($cr_report->service_r_item_paid_for_others == "Yes"){ ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>What were the details and/or outcomes of the safety planning?</b></h4>
                                    <p><?= $cr_report->reimbursed ?></p>
                                </div>
                            </div>
                            <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Is this the first time, or repeat violence or abuse?</b></h4>
                                <p><?= $cr_report->first_time_r_repeat_violence ?></p>
                            </div>
                        </div>

                            <?php if($cr_report->first_time_r_repeat_violence == "Repeat violence"){ ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>When was the last incident of abuse?</b></h4>
                                    <p><?= $cr_report->your_role_in_shamsaha ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4><b>What were the circumstances?</b></h4>
                                    <p><?= $cr_report->expense_n_purpose ?></p>
                                </div>
                            </div>
                            <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Overall, describe the interaction you had with the client. Please elaborate as much as possible here.</b></h4>
                                <p><?= $cr_report->summary_of_case_n_reason ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Does this client want to be put on the service list?</b></h4>
                                <p><?= $cr_report->amount_of_expense ?></p>
                            </div>
                        </div>

                            <?php if($cr_report->service_r_item_paid_for_others == "Yes"){ ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><b>What type of service are they interested in?</b></h4>
                                    <p><?= $cr_report->do_u_have_receipt  ?></p>
                                </div> 
                                <div class="col-md-6">
                                    <h4><b>What were the circumstances of their request?</b></h4>
                                    <p><?= $cr_report->benifit_r_by_cash ?></p>
                                </div>
                            </div>
                            <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Is it safe for Shamsaha to call or contact her back?</b></h4>
                                <p><?= $cr_report->is_it_safe_to_cal_back  ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>How did you get the client’s phone number?</b></h4>
                                <p><?= $cr_report->client_info_abt_ofc_hrs ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Did the client display any signs of being suicidal or at risk of harming themselves or others?</b></h4>
                                <p><?= $cr_report->any_sign_of_suicide_r_harm ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Did you provide any publicly available resources to the client or details about Shamsaha’s operational partners in the relevant country?</b></h4>
                                <p><?= $cr_report->abuse_she_face_other ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What is the ethnicity of the client?</b></h4>
                                <p><?= $cr_report->client_ethnicity ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Which city/ area is the client contacting you from?</b></h4>
                                <p><?= $cr_report->complete_address ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What is the client’s age?</b></h4>
                                <p><?= $cr_report->client_age ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>What is the client’s marital status?</b></h4>
                                <p><?= $cr_report->marital_status ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Does the client have children?</b></h4>
                                <p><?= $cr_report->client_have_children ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Is the client employed?</b></h4>
                                <p><?= $cr_report->client_employed ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>In what language would the client prefer to communicate?</b></h4>
                                <p><?= $cr_report->interaction_for_other ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>How did she hear about Shamsaha?</b></h4>
                                <p><?= $cr_report->hear_about_shamsaha ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Do you have any final notes regarding this client and/or the interaction?</b></h4>
                                <p><?= $cr_report->final_notes_n_thought_abt_client ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>How were you feeling during and after the interaction?</b></h4>
                                <p><?= $cr_report->feeling_interaction_with_client ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Did you face any issues with the App?</b></h4>
                                <p><?= $cr_report->good_r_bad_abt_shift ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>يمكنك إضافة أي ملاحظات أخرى باللغة العربية إذا كانت هناك المزيد معلومات تريدين توضيحها أكثر</b></h4>
                                <p><?= $cr_report->like_to_do_next ?></p>
                            </div>
                        </div>

                        <?php }else if ($cr_report->repeat_client_r_admin_inquiry == "The interaction was an administrative inquiry, spam, other, or failed interaction") { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>What type of interaction was this?</b></h4>
                                <p><?= $cr_report->perpetrator_access_to_gun ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Please detail the interaction?</b></h4>
                                <p><?= $cr_report->recomment_care_other ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><b>Did you provide any additional information or details during this interaction?</b></h4>
                                <p><?= $cr_report->violence_towards_victim ?></p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>يمكنك إضافة أي ملاحظات أخرى باللغة العربية إذا كانت هناك المزيد معلومات تريدين توضيحها أكثر </b></h4>
                                <p><?= $cr_report->perpetrator_mem_of_police ?></p>
                            </div>
                        </div>
                        <?php } ?>

                    
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
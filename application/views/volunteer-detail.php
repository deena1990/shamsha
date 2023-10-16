<div class="row modal-profile">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                    <div class="profile-img">
                        <img src="<?= $volunteerdetail->profile_pic ?>" class="img-circle profile-img-modal" />
                    </div>
                    <h4 class="profile-info-modal"><?= $volunteerdetail->vname ?></h4>
            </div>
        </div>

                <div class="row">
                    <div class="col-md-4">
                        <h4>Email:</h4>
                        <p><?= $volunteerdetail->vemail ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Phone:</h4>
                        <p><?= $volunteerdetail->vmobile ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Whatsapp:</h4>
                        <p><?= $volunteerdetail->whatsapp ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <h4>Address:</h4>
                        <p><?= $volunteerdetail->address ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Date of Birth:</h4>
                        <p><?= date("d-m-Y", strtotime($volunteerdetail->date_of_birth)) ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Date of Joining:</h4>
                        <p><?= date("d-m-Y", strtotime($volunteerdetail->date_of_joining)) ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <h4>Shift Language:</h4>
                        <p><?= $volunteerdetail->shift_language ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Languages Known:</h4>
                        <p><?= $volunteerdetail->language_known ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Rewards:</h4>
                        <p><?= $volunteerdetail->total_rewards ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h4>Emergency Contact No:</h4>
                        <p><?= $volunteerdetail->emergency_contact ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4>Status:</h4>
                        <p><?= $volunteerdetail->status ?></p>
                    </div>


                </div>

            </div>


</div>

<style>
    .profile-img-modal{
        height: 100px;
        margin: auto;
        width: 100px;
        display: block;
        object-fit: cover;
    }
    .profile-info-modal{
        margin-bottom: 30px!important;
        text-align: center;
        color: #000;
    }
    .modal-profile h4{
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }
</style>
<!-- Main content -->
<div class="main-content">
    <h1 class="page-title">All Modules</h1>
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo base_url(); ?>roles">Roles</a></li>
        <li class="active"><strong>All Modules</strong></li>
    </ol>

    <?php if($this->session->flashdata('msg')) { ?>

        <div class="alert alert-success" id="mydivs" role="alert">

            <?php echo $this->session->flashdata('msg'); ?>

        </div>

    <?php } ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">All Modules</h3>
                    <ul class="panel-tool-options" style="display: none;">
                        <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                        <?php foreach ($modules as $module){ ?>
                            <div class="module-cont">


                        <div class="row">
                            <h4 class="head-module"><?= $module->name ?></h4>
                            <?php
                            $i = 1;
                            $this->db->select('*');
                            $this->db->where('module_id', $module->id);
                            $this->db->order_by('name', 'ASC');
                            $query = $this->db->get('permissions');
                            $permissions =$query->result();
                            foreach($permissions as $permission) {
                                $this->db->where('role_id', $role_id);
                                $this->db->where('permission_id', $permission->id);
                                $query = $this->db->get('permission_roles');
                                $assignCount =$query->num_rows();
                            ?>

                                <div class='col-md-3'>
                                    <div class="checkbox">
                                        <label><input class="permission_id" data-role="<?= $role_id ?>" type="checkbox" <?= ($assignCount == 0) ? "" : "checked" ?> value="<?= $permission->id ?>" name="permisions[]"><?= $permission->display_name ?></label>
                                    </div>

                                </div>
                                <?php
                                if($i % 4 === 0) echo "</div><div class='row'>";

                                $i++;
                            }
                            ?>
                        </div>
                            </div>
                        <?php } ?>


                </div>

            </div>
        </div>

    </div>
<style>
    .head-module{
        margin-left: 15px;
        font-weight: 500;
        margin-bottom: 5px;
    }
    .module-cont{
        margin-bottom: 20px;
    }
    .checkbox{
        margin-bottom: 0px;
    }
</style>

    <script>
        $(document).ready(function () {
            $('.permission_id').click(function () {
                var permission_id = $(this).val();
                var role_id = $(this).attr('data-role');
                var data = { permission_id : permission_id, role_id:role_id};
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url() ?>roles/assignpermission",
                    data: data,
                    success: function(resultData) {

                    }
                });
            })
        })
    </script>
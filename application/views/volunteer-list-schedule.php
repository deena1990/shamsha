<?php

foreach ($volunteerlist as $v){
    echo "<li><span class='volSel' data-id='$v->vounter_id'>$v->vname</span> <span class='pull-right profile-view' data-id='$v->vounter_id'><i class='fa fa-eye'></i> </span></li>";
}
?>
<!-- Footer -->
		<footer class="footer-main"> 
			&copy; 2020 <strong>Shamsaha</strong> Designed & Developed by <a target="_blank" href="#/">Say G</a> 
		</footer>	
		<!-- /footer -->
		
	  </div>
	  <!-- /main content -->
	  
  </div>
  <!-- /main container -->
  
</div>
<!-- /page container -->


<script src="<?php echo base_url(); ?>public/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--nouiSlider-->
<script src="<?php echo base_url(); ?>public/js/plugins/nouislider/nouislider.min.js"></script>
<!-- Input Mask-->
<script src="<?php echo base_url(); ?>public/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<!-- Select2-->
<script src="<?php echo base_url(); ?>public/js/plugins/select2/select2.full.min.js"></script>
<!--Bootstrap ColorPicker-->
<script src="<?php echo base_url(); ?>public/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!--Bootstrap DatePicker-->
<script src="<?php echo base_url(); ?>public/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function () {
		

		/*$('#date-popup').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true,
            autoclose: true,
            format:"dd/mm/yyyy",
		});

		$('#date-popup2').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true,
            autoclose: true,
            format:"dd/mm/yyyy",
		});*/

$('.input-group.date').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            todayHighlight: true,
            autoclose: true,
            format:"dd-mm-yyyy",
        });

		

		$(".select2").select2();
		$(".select2-placeholer").select2({
			allowClear: true
		});

		
		
	});
</script>
<script src="<?php echo base_url(); ?>public/js/functions.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script>
	$(document).ready(function () {
		$('.dataTables-example').DataTable({
            // columnDefs: [{
            //     "defaultContent": "-",
            //     "targets": "_all"
            // }],
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				// {
				// 	extend: 'copyHtml5',
				// 	exportOptions: {
				// 		columns: [ 0, ':visible' ]
				// 	}
				// },
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				// {
				// 	extend: 'pdfHtml5',
				// 	exportOptions: {
				// 		columns: [ 0, 1, 2, 3, 4 ]
				// 	}
				// },
				'colvis'
			]
		});
	});
</script>
<script src="<?php echo base_url(); ?>public/js/plugins/summernote/dist/summernote.js" type="text/javascript"></script>
<!--		<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>-->
<script src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>public/ckeditor/config.js"></script>
<script>
  $(function () {

        var myEle1 = document.getElementById('editor1');
        if(myEle1){
          CKEDITOR.replace('editor1');
          myEle1.value = CKEDITOR.instances.editor1.getData();
          //myEle1.value = CKEDITOR.instances.editor1.getUiColor();
        }

          var myEle2 = document.getElementById('editor2');
          if(myEle2){
              CKEDITOR.replace('editor2');
              myEle2.value = CKEDITOR.instances.editor2.getData();
          }
          var myEle3 = document.getElementById('editor3');
          if(myEle3){
              CKEDITOR.replace('editor3');
              myEle3.value = CKEDITOR.instances.editor3.getData();
          }
          var myEle4 = document.getElementById('editor4');
          if(myEle4){
              CKEDITOR.replace('editor4');
              myEle4.value = CKEDITOR.instances.editor4.getData();
          }
          var myEle5 = document.getElementById('editor5');
          if(myEle5){
              CKEDITOR.replace('editor5');
              myEle5.value = CKEDITOR.instances.editor5.getData();
          }
          var myEle6 = document.getElementById('editor6');
          if(myEle6){
              CKEDITOR.replace('editor6');
              myEle6.value = CKEDITOR.instances.editor6.getData();
          }
          var myEle7 = document.getElementById('editor7');
          if(myEle7){
              CKEDITOR.replace('editor7');
              myEle7.value = CKEDITOR.instances.editor7.getData();
          }
          var myEle8 = document.getElementById('editor8');
          if(myEle8){
              CKEDITOR.replace('editor8');
              myEle8.value = CKEDITOR.instances.editor8.getData();
          }

   		/*document.getElementById('editor1').value = CKEDITOR.instances.editor1.getData();
   		document.getElementById('editor2').value = CKEDITOR.instances.editor2.getData();
   		document.getElementById('editor3').value = CKEDITOR.instances.editor3.getData();
   		document.getElementById('editor4').value = CKEDITOR.instances.editor4.getData();
   		document.getElementById('editor5').value = CKEDITOR.instances.editor5.getData();
   		document.getElementById('editor6').value = CKEDITOR.instances.editor6.getData();
   		document.getElementById('editor7').value = CKEDITOR.instances.editor7.getData();
   		document.getElementById('editor8').value = CKEDITOR.instances.editor8.getData();
        document.getElementById('editor1').value = CKEDITOR.instances.editor1.getUiColor;*/
 })
</script>
<script>
    var datePic =  $("#startDate").datepicker({
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true,
        autoclose: true,
        format:"dd-mm-yyyy"

    }).on('changeDate', function (ev) {
        var minDate = new Date(ev.date.valueOf());
        minDate.setDate(minDate.getDate() + 6);
        $('#endDate').datepicker('setDate', minDate);

    });
    $("#endDate").datepicker({
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true,
        autoclose: true,
        format:"dd-mm-yyyy",
    })
</script>
<script type="text/javascript">
	 setTimeout(function() {
            $('#mydivs').hide('fast');
        }, 2000); // in miliseconds (2*1000)
</script>

</body>

</html>

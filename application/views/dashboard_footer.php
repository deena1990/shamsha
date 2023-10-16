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

<!--Load JQuery-->
<!--<script src="<?php /*echo base_url(); */?>public/js/jquery.min.js"></script>
<script src="<?php /*echo base_url(); */?>public/js/bootstrap.min.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/blockui-master/jquery.blockUI.js"></script>
 <!--Float Charts-->
<script src="<?php echo base_url(); ?>public/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/flot/jquery.flot.time.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/functions.js"></script>
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
 <!--ChartJs-->
<script>
// CHART CONFIG
// -----------------------------
let chartConfig = {
  type: 'line',
  backgroundColor: '#fff',
  title: {
    text: 'SHAMSAHA DEPARTMENT PERFORMANCE',
    adjustLayout: true,
    marginTop: '7px',
    fontColor: '#707d94'
  },
  legend: {
    align: 'center',
    backgroundColor: 'none',
    borderWidth: '0px',
    item: {
      cursor: 'hand',
      fontColor: '#707d94'
    },
    marker: {
      type: 'circle',
      borderWidth: '0px',
      cursor: 'hand'
    },
    verticalAlign: 'top'
  },
  plot: {
    aspect: 'spline',
    lineWidth: '2px',
    marker: {
      borderWidth: '0px',
      size: '5px'
    }
  },
  plotarea: {
    margin: 'dynamic 70'
  },
  scaleX: {
    item: {
      fontColor: '#707d94'
    },
    lineColor: '#E3E3E5',
    // minValue: 161218080000,
    minValue: <?php echo $graph_start_month; ?>,
    // step: 'day',
    step: 'month',
    transform: {
      type: 'date',
      // all: '%d %M %Y'
      all: '%M %Y'
    },
    zooming: true,
    zoomTo: [0, 15]
  },
  scaleY: {
    guide: {
      lineStyle: 'dashed'
    },
    item: {
      fontColor: '#707d94'
    },
    lineColor: '#707d94',
    minorGuide: {
      alpha: 0.7,
      lineColor: '#E3E3E5',
      lineStyle: 'dashed',
      lineWidth: '1px',
      visible: true
    },
    minorTick: {
      lineColor: '#E3E3E5'
    },
    minorTicks: 1,
    tick: {
      lineColor: '#E3E3E5'
    }
  },
  crosshairX: {
    marker: {
      alpha: 0.5,
      size: '7px'
    },
    plotLabel: {
      borderRadius: '3px',
      multiple: true
    },
    scaleLabel: {
      backgroundColor: '#53535e',
      borderRadius: '3px'
    }
  },
  crosshairY: {
    type: 'multiple',
    lineColor: '#E3E3E5',
    scaleLabel: {
      bold: true,
      borderRadius: '3px',
      decimals: 0,
      fontColor: '#fff',
      offsetX: '-5px'
    }
  },
  tooltip: {
    borderRadius: '3px',
    borderWidth: '0px'
  },
  preview: {
    adjustLayout: true,
    borderColor: '#E3E3E5',
    label: {
      fontColor: '#fff'
    },
    mask: {
      backgroundColor: '#E3E3E5'
    }
  },
  series: [
    {
      // values: [69, 68, 54, 48, 70, 74, 98, 70, 72, 68, 49, 69],
      values: [<?php echo implode(',',$chat_missed_graphValues); ?>],
      lineColor: '#e24484',
      text: 'Chats : missed ',
      marker: {
        backgroundColor: '#e24484'
      }
    },
    {
      // values: [51, 53, 47, 60, 48, 52, 75, 52, 55, 47, 60, 48],
      values: [<?php echo implode(',',$case_graphValues); ?>],
      lineColor: '#5e5783',
      text: 'Case Reports',
      marker: {
        backgroundColor: '#5e5783'
      }
    },
    {
      // values: [42, 43, 30, 50, 31, 48, 55, 46, 48, 32, 50, 38],
      values: [<?php echo implode(',',$call_missed_graphValues); ?>],
      lineColor: '#fdc413',
      text: 'Calls : missed',
      marker: {
        backgroundColor: '#fdc413'
      }
    },
    {
      // values: [25, 15, 26, 21, 24, 26, 33, 25, 15, 25, 22, 24],
      values: [<?php echo implode(',',$victim_graphValues); ?>],
      lineColor: '#4e4f57',
      text: 'Cases',
      marker: {
        backgroundColor: '#4e4f57'
      }
    }
  ]
};

zingchart.render({
  id: 'myChart',
  data: chartConfig,
  height: '100%',
  width: '100%',
});
</script>
</body>

</html>

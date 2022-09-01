<?php

add_shortcode('codeweavers_finance_calculator_single','codeweavers_finance_calculator_standalone_script');

function codeweavers_finance_calculator_standalone_script(){
	ob_start(); ?> 
	<div class="enquiry-form wow fadeInUp">
    <script type="text/javascript" src="https://plugins.codeweavers.net/scripts/v1/platform/ecommerce?ApiKey=KoX2u5RF6uG52UPGSV&SystemKey=Codeweavers"></script>
	<script type="text/javascript">
	  function loadPlugin(){
	    codeweavers.ecommerce.apply.main({
	      pluginContentDivId: 'finance_calculator'
	    });
	  }
	  </script>
	  <script>
		function loadCodeweaverStart() {
		  loadPlugin();
		}
		window.onload = loadCodeweaverStart;
    </script>
	  <div id="finance_calculator"></div>
	 </div>
	
<?php	return ob_get_clean();	
}
<?php

add_shortcode('codeweavers_finance_calculator_Vhicle','codeweavers_finance_calculator_Vhicle_script');

function codeweavers_finance_calculator_Vhicle_script($atts ){ 
	 extract(shortcode_atts(array(
		'apikey' => '',
	  ), $atts));
	ob_start(); ?> 
	<div class="col-inner text-center"> <script type="text/javascript" src="https://plugins.codeweavers.net/scripts/v1/platform/finance?ApiKey=<?php echo $atts['apikey']; ?>"></script> <script type="text/javascript"> function loadPlugin() {
 codeweavers.main({
 pluginContentDivId: "finance-plugin-container",
 "vehicleSelection": {
 "isEnabled": true
 },
 "defaultParameters": {
 "deposit": {
 "defaultValue": null
 },
 "payment": {
 "defaultValue": 100
 },
 "calculationType": {
 "defaultValue": "RegularPayment"
 },
 "settlement": {
 "defaultValue": 0
 },
 "partExchange": {
 "defaultValue": 0
 },
 "product": {
 "defaultValue": null
 },
 "term": {
 "defaultValue": "48",
 "minimumValue": "24",
 "maximumValue": "60",
 "increment": "1"
 },
 "annualMileage": {
 "defaultValue": "10000",
 "minimumValue": "5000",
 "maximumValue": "50000",
 "increment": "1000"
 }
 },
 "customerReference": null,
 "settings": {
 "callToAction": {
 "custom": [
 {
 "label": "download this incredible brochure",
 "isVisible": true
 }
 ]
 }
 }
 });
 } </script>
 <div id="finance-plugin-container"></div> 
 <script type="text/javascript"> loadPlugin(); </script>
 </div>
	
<?php	return ob_get_clean();	
}
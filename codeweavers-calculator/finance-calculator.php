<?php

add_shortcode('codeweavers_finance_calculator_flexible','codeweavers_finance_calculator_flexible_script');

function codeweavers_finance_calculator_flexible_script($atts ){
	 extract(shortcode_atts(array(
		'apikey' => '',
	  ), $atts));
	ob_start(); ?> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
<div style="margin: 0 auto; max-width: 800px; background-color: #F2F2F2; text-align:center; font-family: Veranda, sans-serif; border: 1px hidden; font-size: 20px; padding: 10px 0px 1px 0px;">
<form action="javascript:myFunction(); return false;">
<label for="cw_standalone_cashprice">Please enter your vehicle price:</label><br />
<span style="background-color: #E6E6E6; border:1px solid #CCCCCC; border-radius: 3px; display: inline-block; margin-top: 8px;"><label for="cw_standalone_cashprice" style="text-align:center; margin: 15px;">&pound;</label><input class="form-control" size="5" maxlength="7" style="margin: 0px; padding: 0.5px; text-align:center; font-family: Veranda, sans-serif; font-size: 20px; border-width:0px 1px 0px 1px; background-color:#FFF; border-style:solid; border-color:#ccc; height: 36px;" id="cw_standalone_cashprice" value="6000" type="text"><button type="button" id="cw_standalone_calculate_button" style=" text-align:center; vertical-align: middle; margin: 0px 10px 2px 10px; font-family: Veranda, sans-serif; font-size: 14px; color: white; background-color: #337AB7; border:1px solid #2E6DA4; border-radius: 5px; padding: 4px;">Calculate</button></span></form></div>
<script>document.getElementById("cw_standalone_calculate_button").onclick = function () { loadPlugin(); };</script><div style="width:100%"><div id="codeweavers-plugin" style="margin: 0 auto; max-width: 800px;"></div>
</div>
<script type="text/javascript"src="https://services.codeweavers.net/v2/script/FinancePlugin?key=<?php echo $atts['apikey']; ?>"></script>
<script type='text/javascript'>
function loadPlugin(){
codeweavers.main({
pluginContentDivId: 'codeweavers-plugin',
vehicle: {
    type: 'Car',
    cashPrice: document.getElementById('cw_standalone_cashprice').value,
    mileage: "10",
    isNew: "false",
    identifierType: '',
    identifier: "",
    imageUrl: "http://i.imgur.com/eN1UzJm.jpeg",
    linkBackUrl: "https://fundmyvan.co.uk/",
    registration:
            {
              number: "NOVEHICLE",
              date: "2018-01-01",
            }
},
defaultParameters: {
      deposit: {
    defaultValue:10,
    defaultType: "Percentage"
      },
    term: {
  defaultValue:120,
    },
    annualMileage: {
  defaultValue: 10000,
    },
},
});
};
loadPlugin();
</script>
	
<?php	return ob_get_clean();	
}
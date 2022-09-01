<?php
/*
Plugin Name: Codeweavers Finance Calculator
Plugin URI: https://codeweavers.net
Description: Add Finance Calculator for Fund My Van.co.uk
Version: 1.0.5
Author: Syed Muzaffar Tirmizi
Author URI: https://www.upwork.com/freelancers/syedtirmizi
License: GNU Public License v3
*/
add_shortcode('codeweavers_finance_calculator','codeweavers_finance_calculator_script');

function codeweavers_finance_calculator_script($atts = array(), $content = null){
	if( is_singular('product') ){
		$cdwrarr = array(
			'type', 
			'isNew', 
			'identifierType' ,
			'identifier',
			'vin', 
			'cashPrice',
			'mileage',
			'date',
			'number',
			'imageUrl',
			'linkBackUrl',
			'depositValue',
			'depositType',
			'term',
			'annualMileage'	
		   );
    $len = sizeof($cdwrarr); 
	global $post;
	$postID = $post->ID;
    for($k=0;$k<$len;$k++){
	    $cdwritem =  $cdwrarr[$k];
		$$cdwritem = get_post_meta( $postID , 'cdwr_'.$cdwritem , true );		
    }
}else{
	$imageUrl = get_bloginfo('url').'/wp-content/uploads/2022/06/Untitled-design-1-1.png' ;
	$linkBackUrl = get_bloginfo('url');
 extract(shortcode_atts(array(
    'type' => 'car',
	'isNew' => 'false',
	'identifierType' => 'Vrm',
	'identifier' => 'YX16YRM',
	'vin' => 'WDD2120012B324850',
	'cashPrice' => '24499',
	'mileage' => '45390',
	'date' => '02/03/2016',
	'number' => 'YX16YRM',
	'imageUrl' => $imageUrl,
	'linkBackUrl' => $linkBackUrl,
	'depositValue' => '10',
	'depositType' => 'Percentage',
	'term' => '48',
	'annualMileage' => '10000',
	'currency' => '£',
   ), $atts));
   
}
ob_start(); ?> 	
	<!-- <script type="text/javascript" src="https://plugins.codeweavers.net/scripts/v1/platform/finance?ApiKey=KoX2u5RF6uG52UPGSV"></script> -->
	<script type="text/javascript" src="https://services.codeweavers.net/v2/script/FinancePlugin?key=KoX2u5RF6uG52UPGSV"></script>

<script type="text/javascript">
  function loadPlugin(){
    //alert("fin plug");
    codeweavers.main({
      pluginContentDivId: 'FinanceContent',
      vehicle: {
        type: '<?php echo $type ; ?>',
        identifier: '<?php echo $identifier ; ?>',
        identifierType: '<?php echo $identifierType; ?>',
        isNew: <?php echo $isNew ;?>,
        cashPrice: '<?php echo $cashPrice ; ?>',
        imageUrl: '<?php echo $imageUrl ; ?>',
        linkBackUrl: '<?php echo $linkBackUrl ; ?>',
        mileage: '<?php echo $mileage ; ?>',
        registration: {
          date: '<?php echo $date ; ?>',
          number: '<?php echo $number; ?>'
        },
      },
      defaultParameters: {
        deposit: { defaultValue: <?php echo $depositValue ; ?>, defaultType: '<?php echo $depositType ;?>' },
        term: { defaultValue: <?php echo $term; ?>, minimumValue: 12, maximumValue: 60  },
        annualMileage: { defaultValue: <?php echo $annualMileage ; ?>, minimumValue: 8000, maximumValue: 60000 },
        payment: {defaultValue: 100},
        calculationType: {defaultValue: 'RegularPayment'},
        settlement: {defaultValue: 0},
        partExchange: {defaultValue: 0}
      }
    });
  }
  </script>
   
   
        <div id="FinanceContent"></div>
		<script type="application/javascript">
			window.addEventListener("load", function(){
				loadPlugin();
			});
		</script>
 <?php	return ob_get_clean();
 }
 
 function save_codeweavers_meta_box($post_id){
	$cdwrarr = array(
    'type', 
	'isNew', 
	'identifierType' ,
	'identifier',
	'vin', 
	'cashPrice',
	'mileage',
	'date',
	'number',
	'imageUrl',
	'linkBackUrl',
	'depositValue',
	'depositType',
	'term',
	'annualMileage'	
   );
   $len = sizeof($cdwrarr);
   for($k=0;$k<$len;$k++){
	    $cdwritem =  $cdwrarr[$k];
		if( isset( $_POST[ 'txt_'.$cdwritem ] ) ) {
		  $cdwritemv = $_POST[ 'txt_'.$cdwritem ] ;
		  update_post_meta( $post_id,  'cdwr_'.$cdwritem, $cdwritemv );
		}
   }
}
add_action('save_post', 'save_codeweavers_meta_box', 10, 2);


function mjt_meta_box_codeweavers_prod_detail( $post ){ 
	$cdwrarr = array(
    'type', 
	'isNew', 
	'identifierType' ,
	'identifier',
	'vin', 
	'cashPrice',
	'mileage',
	'date',
	'number',
	'imageUrl',
	'linkBackUrl',
	'depositValue',
	'depositType',
	'term',
	'annualMileage'	
   );
   $len = sizeof($cdwrarr);
   for($k=0;$k<$len;$k++){
	 $cdwritem =  $cdwrarr[$k];
	/* $cdwrvaluename = 'cdwrv_'.$cdwritem ; */
	 $cdwrvalue = get_post_meta( $post->ID , 'cdwr_'.$cdwritem , true );   
?>
	<p>
		<label for="_amazon_product_id"> <?php ucfirst( _e( $cdwritem, 'codeweavers_product_detail' ) ); ?><br/>
			<input type="textbox" name="txt_<?php echo $cdwritem ;?>" id="id_<?php echo $cdwritem ;?>" value="<?php echo  $cdwrvalue ;?>"  />    
		</label>
	</p>	
<?php }
}

function mjt_codeweavers_add_custom_meta_box() {    
	 add_meta_box('codeweavers-detail-meta-box', __('Codeweavers Product Detail', 'codeweavers-detail'), 'mjt_meta_box_codeweavers_prod_detail', 'product', 'side', 'high', null);   
}
add_action('add_meta_boxes', 'mjt_codeweavers_add_custom_meta_box'); 

/*include standalone form*/
include_once('standalone.php');
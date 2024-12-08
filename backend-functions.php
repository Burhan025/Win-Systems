<?php

/******************Start Category page hooks****************/

// display product subtitle in category page after title
add_action('woocommerce_after_shop_loop_item', 'woocommerce_subtitle_add');
     
function woocommerce_subtitle_add() {
   echo '<p class="custom_subtitle">';
            the_field('short_description');
            echo '</p>';
}
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

/******************End Category page hooks****************/



/******************Start product details page hooks****************/


// Remove price,add to cart options
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


// remove description and review tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	unset( $tabs['description'] );        			// Remove the description tab
  	unset( $tabs['reviews'] );            			// Remove the reviews tab
  	//unset( $tabs['additional_information'] );     // Remove the additional information tab

  	return $tabs;
}



// add description after title
function woocommerce_template_product_description() {
	woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description' );



// function for add button(upload files),features
add_action( 'woocommerce_single_product_summary', 'upload_product_data_sheet' );
function upload_product_data_sheet(){

	//if( get_field('upload_product_mannual') ):
    ?>
    	<div class="manual_pro"><a target ="blank" href="<?php the_field('upload_product_mannual'); ?>" >PRODUCT MANUAL</a></div>
    <?php
		//endif;

	//if( get_field('upload_product_mannual') ):
    ?>
    	<div class="data-sheet"><a target ="blank" href="<?php the_field('upload_data_sheet'); ?>" >DATA SHEET</a></div>
    <?php
		//endif;
    ?>

    <div class="custom_feature">
    	<p>Features</p>
    	<ul class="custom_feature_ul">
    		<?php
				// check if the repeater field has rows of data
				//if( have_rows('features') ):
					while ( have_rows('features') ) : the_row();
			?>
			        	<li><?php the_sub_field('add_feature_name');?></li>
			<?php        	
			    	endwhile;
				//endif;
			?>
		</ul> 
	</div>	
<?php
}


// Add static image after product gallery
add_action( 'woocommerce_after_single_product_summary', 'bbloomer_custom_action', 10 );
function bbloomer_custom_action() {
	echo '<div class="custom_image">';
	echo '<img src="/wp-content/uploads/2018/12/product-badges.png">';
	echo '</div>';
}



/******************End product details page hooks****************/
?>
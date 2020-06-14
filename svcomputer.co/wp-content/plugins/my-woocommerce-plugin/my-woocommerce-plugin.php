<?php
/**
 * Plugin Name: My WooCommerce Plugin 
 * Author: TOAN
*/


// Add Amazon and eBay Affiliate Links below the Add To Cart form
function action_woocommerce_after_add_to_cart_form() {
	global $product;
	//$sku = $product->get_sku();
	//if (strpos($sku, "TEST-PRODUCT") === false) { return; }
	//
	$amazon_affiliate_text_url = $product->get_attribute('amazon-affiliate-text-url');
	$amazon = "";
	if ($amazon_affiliate_text_url != "") {
		$amazon = '<a target="_blank" href="' . $amazon_affiliate_text_url . '"><button class="amazon-affiliate-link-button"></button></a>';
	}
	//
	$ebay_affiliate_url = $product->get_attribute('ebay-affiliate-url');
	$ebay = "";
	if ($ebay_affiliate_url != "") {
		$ebay = '<a target="_blank" href="' . $ebay_affiliate_url . '"><button class="ebay-affiliate-link-button"></button></a>';
	}

	if ($amazon == "" && $ebay == "") { return; }
	$text = '<span class="buy-from-affiliate-links">or buy from our stores on</span>';
	$html = '<div>' . $text . $amazon . $ebay . '</div>';
	echo $html;
}; 
// add the action
add_action( 'woocommerce_after_add_to_cart_form', 'action_woocommerce_after_add_to_cart_form', 10, 0 ); 



/**
 * Customize product search form
 * Reference: http://woocommerce.wp-a2z.org/oik_api/get_product_search_form/
 */
function customize_product_search_form($html) {
    //$res = str_replace('class="search-field"', 'class="customized-search-field"', $html);
	if (is_front_page()) {
		$res = str_replace('class="search-field"', 'class="customized-search-field" style="border:solid 1px white !important; border-radius:5px !important; padding-right:110px !important;"', $html);
		$submit_button = '<input type="submit" value="Search" />';
		$new_submit_button = '<input type="submit" value="Shop Now" style="background: #ef6700 !important; font-size: 18px !important; font-weight: bold !important; color:white !important; text-transform: none !important; width: auto !important; padding-left: 5px !important; padding-right: 5px !important; border:none !important; border-radius:0px 5px 5px 0px !important; ">';
		$res = str_replace($submit_button, $new_submit_button, $res);
	}
	else {
		$res = str_replace('class="search-field"', 'class="customized-search-field" style="border-color:rgba(84, 84, 84, 0.2) !important; border-radius:5px !important; padding-right:40px !important;"', $html);
	}
	return $res;
}
add_filter('get_product_search_form', 'customize_product_search_form');




/**
 * Modify add-to-cart notification (from single product page) to link to product external URL.
 */
add_filter('wc_add_to_cart_message', 'my_add_to_cart_message');
function my_add_to_cart_message($message) {
	global $woocommerce;
	$items = $woocommerce->cart->get_cart();
	$id = end($items)['data']->post->ID;
	$product = wc_get_product($id);
	$message = '"' . $product->get_title() . '" added to cart.  ';
	$message = '<a href="/cart" class="my-add-to-cart-message">' . $message . '<div style="text-align:center;padding-top:10px;text-decoration:underline;">VIEW CART</div></a>';
	$url = $product->get_attribute('pa_product-image-url-0');
	if ($url == "" || $url == null) $url = get_the_post_thumbnail_url($id);
	$res = '<div><style>'
		. '.product_notification_background'
		. '{' 
		. 'background:url(' . $url . ');'
		. '}'
		. '</style>'
		 . '<div>' . $message . '</div></div>';
	return $res;
}



/**
 * Sort related products by in-stock vs. out-of-stock
 */
/*
function wc_sort_related_products( $args ) {
	$args['orderby'] = 'stock';
	$args['order'] = 'DESC';
	return $args;
}
add_filter('woocommerce_related_products_args','wc_sort_related_products', 10);
*/


/**
 * Sorting out of stock WooCommerce products - Order product collections by stock status, in-stock products first.
 *
 * Reference: https://wpdoityourself.com/sorting-out-of-stock-woocommerce-products-wordpress/
 */
/*
class iWC_Orderby_Stock_Status {
	public function __construct() {
		// Check if WooCommerce is active
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			add_filter('posts_clauses', array($this, 'order_by_stock_status'), 2000);
		}
	}

	public function order_by_stock_status($posts_clauses) {
		global $wpdb;
		// only change query on WooCommerce loops
		if (is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
			$posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
			$posts_clauses['orderby'] = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
			$posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
		}
		return $posts_clauses;
	}
}
new iWC_Orderby_Stock_Status;
*/
/**
* END - Order product collections by stock status, instock products first.
*/ 





$ITEM_CONDITION = array(
	'Brand New',
	'Used - Like New',
	'Used - Very Good',
	'Used - Good',
	'Used - Acceptable'
);


/***
 * Display item condition in the thumbnail view (shop or catalog page).
 *
 * REF: http://stackoverflow.com/questions/26594089/how-to-add-hot-attribute-like-sale-on-product-image-in-woocommerce
 */
//add_action('woocommerce_after_shop_loop_item_title','display_item_condition_sticker');
/*
add_action('woocommerce_after_shop_loop_item_title_loop_rating','display_item_condition_sticker');
function display_item_condition_sticker() {
	global $product, $ITEM_CONDITION;
	$cond = $product->get_attribute('pa_item-condition-detail');
	echo '<span style="font-size:14px; color:#a6a6a6;"> Item condition: ' . $cond . '</span>';
}
*/



/**
 * Make sure product featured image thumbnail (or equivalent post thumbnail) is from external URL.
 *
 * Reference:
 *	- featured-image-from-url/admin/thumbnail.php (a plugin)
 */
function post_thumbnail_html_from_url( $html, $post_id ) {
	$post = get_post($post_id);
	if ($post->post_type == 'product') {
		$product = wc_get_product($post_id);
		$url = $product->get_attribute('pa_product-image-url-0');
		if ($url) return '<img src="' . $url . '" >';
		else return $html;
	}
	else {
		return $html;
	}
}
add_filter('post_thumbnail_html', 'post_thumbnail_html_from_url', 10, 2);

/**
 * Make sure product image gallery thumbnails are from external URL.
 * This is for Thumbnail Column in product detail page.
 *
 * REF: http://hookr.io/filters/woocommerce_single_product_image_thumbnail_html/
 */
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'filter_woocommerce_single_product_image_thumbnail_html', 10, 2 );
function filter_woocommerce_single_product_image_thumbnail_html( $sprintf, $post_id ) { 
	return $sprintf;
}
/*
// For Woocommerce 2017 version. New version use (10, 2) function signature
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'filter_woocommerce_single_product_image_thumbnail_html', 10, 4 );
function filter_woocommerce_single_product_image_thumbnail_html( $sprintf, $attachment_id, $post_id, $esc_attr ) { 
	$url = wp_get_attachment_url($attachment_id);
	if ( strpos( $url, 'cloudinary.com') ) {
		//return '<div class="swiper-slide swiper-slide-active active"><img src="' . $url . '"></div>';
		return '<li class="carousel-cell"><img src="' . $url . '"></li>';
	}
	else {
		return $sprintf;
	}
}
*/

/**
 * Change attachment url to external URL (for product featured image and images gallery)
 * by modifying the output of wp_get_attachment_url($attachment_id).
 *
 * Reference:
 *	- https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
 */
add_filter('wp_get_attachment_url', 'modify_attachment_url');
function modify_attachment_url($url) {
	$post = get_post(); // get the current post
	//error_log('Post_ID = ' . $post->ID . '. Post_type = ' . $post->post_type . '. Attachment URL: ' . $url);
	if ($post->post_type == 'product') {
		// Change the attachment url to external URL (product image gallery)
		$product = wc_get_product( $post->ID );
		if ( strpos( $url, 'PIP0') ) {
			return $product->get_attribute('pa_product-image-url-0');
		}
		elseif ( strpos( $url, 'PIP1') ) {
			return $product->get_attribute('pa_product-image-url-1');
		}
		elseif ( strpos( $url, 'PIP2') ) {
			return $product->get_attribute('pa_product-image-url-2');
		}
		elseif ( strpos( $url, 'PIP3') ) {
			return $product->get_attribute('pa_product-image-url-3');
		}
		elseif ( strpos( $url, 'PIP4') ) {
			return $product->get_attribute('pa_product-image-url-4');
		}
		elseif ( strpos( $url, 'PIP5') ) {
			return $product->get_attribute('pa_product-image-url-5');
		}
	}
	
	// Everything else ==> don't change the url
	return $url;
}


<?php
/**
 * Plugin Name: My Utilities Plugin 
 * Author: TOAN
*/



/* Display a product search box under the header (for larger screen). Added by TOAN */
$PAGES_WITHOUT_PRODUCT_SEARCH_BOX_UNDER_HEADER = array(
	"svcomputer.co", "contact", "my-account",
	"quality-control", "packaging", "shipping",
	"guarantee", "stores", "terms-conditions",
	"privacy-policy", "vendors", "about-us",
	"business-buyers"
);
//
function display_product_search_box_under_header___large_screen() {
	global $PAGES_WITHOUT_PRODUCT_SEARCH_BOX_UNDER_HEADER;

	$url = get_permalink();
	$tokens = explode("/", $url);
	$page = $tokens[count($tokens)-2];

	if (!in_array($page, $PAGES_WITHOUT_PRODUCT_SEARCH_BOX_UNDER_HEADER)) {
		echo '<div class="product-search-box-under-header-large-screen-background">';
		echo '<div class="product-search-box-under-header-large-screen">';
		echo do_shortcode('[widgets_on_pages id="1"]');
		echo '</div></div>';
	}
}
//
function display_product_search_box_under_header___small_screen() {
	global $PAGES_WITHOUT_PRODUCT_SEARCH_BOX_UNDER_HEADER;

	$url = get_permalink();
	$tokens = explode("/", $url);
	$page = $tokens[count($tokens)-2];

	if (!in_array($page, $PAGES_WITHOUT_PRODUCT_SEARCH_BOX_UNDER_HEADER)) {
		echo '<div class="product-search-box-under-header-small-screen">';
		echo do_shortcode('[widgets_on_pages id="1"]');
		echo '</div>';
	}
}


/************************
 * Inventory Statistics *
 ************************/
$numberOfProductLine = 0;
$numberOfProduct = 0; 
$numberOfCategory = 0; // number of leaf categories
$numberOfBrand = 0; // number of vendors

function get_number_of_brand() {
	global $numberOfBrand;
	if ($numberOfBrand <= 0) {
		get_inventory_statistics();
	}
	return $numberOfBrand;
}
add_shortcode( 'number-of-brand', 'get_number_of_brand' );

function get_number_of_category() {
	global $numberOfCategory;
	if ($numberOfCategory <= 0) {
		get_inventory_statistics();
	}
	return $numberOfCategory;
}
add_shortcode( 'number-of-category', 'get_number_of_category' );

function get_number_of_product() {
	global $numberOfProduct;
	if ($numberOfProduct <= 0) {
		get_inventory_statistics();
	}
	return $numberOfProduct;
}
add_shortcode( 'number-of-product', 'get_number_of_product' );

function get_number_of_product_line() {
	global $numberOfProductLine;
	if ($numberOfProductLine <= 0) {
		get_inventory_statistics();
	}
	return $numberOfProductLine;
}
add_shortcode( 'number-of-product-line', 'get_number_of_product_line' );

function get_inventory_statistics() {
	global $numberOfProductLine, $numberOfProduct, $numberOfCategory, $numberOfBrand;

	$pageTitle = "ADMIN - Inventory Statistics";
	$page = get_page_by_title($pageTitle);
	if ($page) {
		$content = $page->post_content;
		$lines = explode(PHP_EOL, $content);
		$offSet = 0;

		// Number of product lines
		$lineNo = 0;
		$tokens = explode(":", $lines[$offSet + $lineNo]);
		$numberOfProductLine = intval(trim($tokens[1]));

		// Number of products
		$lineNo = 1;
		$tokens = explode(":", $lines[$offSet + $lineNo]);
		$numberOfProduct = intval(trim($tokens[1]));

		// Number of categories
		$lineNo = 2;
		$tokens = explode(":", $lines[$offSet + $lineNo]);
		$numberOfCategory = intval(trim($tokens[1]));

		// Number of brands
		$lineNo = 3;
		$tokens = explode(":", $lines[$offSet + $lineNo]);
		$numberOfBrand = intval(trim($tokens[1]));	
	}
}



/*******************
 * Buyer Feedbacks *
 *******************/
$allPositiveFeedbackCount = 0;
$allNegativeFeedbackCount = 0;
$feedbackCountByMarketplace = array(
	"amazon" => array("postive" => 0, "negative" => 0),
	"amazon.ca" => array("postive" => 0, "negative" => 0),
	"ebay" => array("postive" => 0, "negative" => 0)
);

/**
 * Get the number of feedback for a marketplace, e.g. Amazon or eBay
 */
function get_buyer_feedback_count($atts) {
	global $allPositiveFeedbackCount, $allNegativeFeedbackCount, $feedbackCountByMarketplace;
	if ($allPositiveFeedbackCount <= 0) {
		get_buyer_feedback_count_all();
	}

	$atts = shortcode_atts( array(
		'marketplace' => "unknown"
	), $atts);

	$marketplace = trim($atts['marketplace']);
	return $feedbackCountByMarketplace[$marketplace]["positive"] + $feedbackCountByMarketplace[$marketplace]["negative"];
}
add_shortcode( 'buyer-feedback-count', 'get_buyer_feedback_count' );


/**
 * Get the percent of positive feedback for a marketplace, e.g. Amazon or eBay.
 */
function format_percent($percent) {
	if ($percent >= 99.99) { return 100; }
	else { return number_format((float)$percent, 2, '.', ''); }
}

function get_positive_buyer_feedback_percent($atts) {
	global $allPositiveFeedbackCount, $allNegativeFeedbackCount, $feedbackCountByMarketplace;
	if ($allPositiveFeedbackCount <= 0) {
		get_buyer_feedback_count_all();
	}

	$atts = shortcode_atts( array(
		'marketplace' => "unknown"
	), $atts);

	$marketplace = trim($atts['marketplace']);
	$totalFeedbackCount = $feedbackCountByMarketplace[$marketplace]["positive"] + $feedbackCountByMarketplace[$marketplace]["negative"];
	$percent = 100;
	if ($totalFeedbackCount > 0) {
		$percent = 100.0*$feedbackCountByMarketplace[$marketplace]["positive"] / $totalFeedbackCount;
	}
	return format_percent($percent);
}
add_shortcode( 'positive-buyer-feedback-percent', 'get_positive_buyer_feedback_percent' );


/**
 * Get the number of feedback for all marketplaces
 */
function get_buyer_feedback_count_all() {
	global $allPositiveFeedbackCount, $allNegativeFeedbackCount, $feedbackCountByMarketplace;
	if ($allPositiveFeedbackCount > 0) {
		return $allPositiveFeedbackCount;
	}

	$pageTitle = "ADMIN - Buyer Feedback List";
	$page = get_page_by_title($pageTitle);
	if ($page) {
		$content = $page->post_content;
		$lines = explode(PHP_EOL, $content);
		$numMarketplaces = intval($lines[0]);
		$offSet = 1;
		$allPositiveFeedbackCount = 0;
		$allNegativeFeedbackCount = 0;
		for ($i = 0; $i < $numMarketplaces; $i++) {
			$tokens = explode(":", $lines[$offSet + $i]);
			$marketplace = trim($tokens[0]);
			$positive = intval(trim($tokens[1]));
			$negative = intval(trim($tokens[2]));
			$feedbackCountByMarketplace[$marketplace]["positive"] = $positive;
			$feedbackCountByMarketplace[$marketplace]["negative"] = $negative;
			$allPositiveFeedbackCount += $positive;
			$allNegativeFeedbackCount += $negative;
		}
		return $allPositiveFeedbackCount + $allNegativeFeedbackCount;
	}
	else { return 0; }
}
add_shortcode( 'buyer-feedback-count-all', 'get_buyer_feedback_count_all' );


/**
 * Get percent of positive buyer feedbacks for all marketplaces
 */
function get_positive_buyer_feedback_percent_all() {
	global $allPositiveFeedbackCount, $allNegativeFeedbackCount, $feedbackCountByMarketplace;
	if ($allPositiveFeedbackCount <= 0) {
		get_buyer_feedback_count_all();
	}

	$totalFeedbackCount = $allPositiveFeedbackCount + $allNegativeFeedbackCount;
	$percent = 100;
	if ($totalFeedbackCount > 0) {
		$percent = 100.0*$allPositiveFeedbackCount / $totalFeedbackCount;
	}
	return format_percent($percent);
}
add_shortcode( 'positive-buyer-feedback-percent-all', 'get_positive_buyer_feedback_percent_all' );


/**
 * Get the list of feedback from all marketplaces
 */
function get_buyer_feedback_list($argv = null) {
	$feedbacks = array();

	$pageTitle = "ADMIN - Buyer Feedback List";
	$page = get_page_by_title($pageTitle);
	if ($page) {
		$content = $page->post_content;
		$lines = explode(PHP_EOL, $content);
		$numMarketplaces = intval($lines[0]);
		$offSet = 1 + $numMarketplaces;
		$linesPerFeedback = 3;
		$numFeedbacks = (count($lines) - $offSet) / $linesPerFeedback;
		for ($i = 0; $i < $numFeedbacks; $i++) {
			$post = new WP_Post();
			$feedbackContent = trim($lines[$offSet + $i*$linesPerFeedback + 1]);
			$feedbackAuthor = $lines[$offSet + $i*$linesPerFeedback + 2];
			$post->post_content = '<p class="testimonial-content">' . quote_feedback($feedbackContent) . '</p>'
						. '<img src="https://www.svcomputer.co/wp-content/uploads/5-Stars-h20.png" alt="" width="97" height="20" class="testimonial-star alignnone size-full wp-image-233" />'
						. '<p><a class="hyperlink testimonial-author" href="/stores">' . $feedbackAuthor . '</a></p>';
			array_push($feedbacks, $post);
		}
	}

	return $feedbacks;
}
function quote_feedback($str) { return '"' . $str . '"'; }
add_shortcode( 'buyer-feedback-list', 'get_buyer_feedback_list' );



/**
 * Get a slice of feedbacks (for pagination display in Testimonial Rotator plugin).
 */
function get_buyer_feedbacks_slice($start, $length) {
	$feedbacks = array();
	$numFeedbacksFound = 0;

	$pageTitle = "ADMIN - Buyer Feedback List";
	$page = get_page_by_title($pageTitle);
	if ($page) {
		$content = $page->post_content;
		$lines = explode(PHP_EOL, $content);
		$numMarketplaces = intval($lines[0]);
		$offSet = 1 + $numMarketplaces;
		$linesPerFeedback = 3;
		$numFeedbacksFound = (count($lines) - $offSet) / $linesPerFeedback;
		for ($i = 0; $i < $length; $i++) {
			if ($i + $start >= $numFeedbacksFound) break;
			$index = $offSet + ($start + $i)*$linesPerFeedback;
			$post = new WP_Post();
			$feedbackContent = trim($lines[$index + 1]);
			$feedbackAuthor = $lines[$index + 2];
			$post->post_content = '<p class="testimonial-content" style="margin-bottom:5px;">' . quote_feedback($feedbackContent) . '</p>'
						. '<img src="https://www.svcomputer.co/wp-content/uploads/5-Stars-h20.png" alt="" width="97" height="20" class="testimonial-star alignnone size-full wp-image-233" />'
						. '<p class="hyperlink testimonial-author">' . $feedbackAuthor . '</p>';
			array_push($feedbacks, $post);
		}
	}

	return array('feedbackList' => $feedbacks, 'numFeedbacksFound' => $numFeedbacksFound);
}



/**
 * Encode it using "Email Encoder Bundle - Protect Email Address" plugin
 */
function encode_phone_link($params = array()) {
	// Default parameters
	extract(shortcode_atts(array(
		'phone' => null
	), $params));

	if ($phone === null or $phone === '') return '';
	$html = '<a class="hyperlink" href="tel:' . $phone . '">' . $phone . '</a>';
	// return eeb_content($html); // eeb_content function becomes not defined 13 Apr 2020
	return $html;
}
add_shortcode( 'encode-phone-link', 'encode_phone_link' );

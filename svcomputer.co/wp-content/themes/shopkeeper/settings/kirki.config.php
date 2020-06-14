<?php

// Customizer / WP Methods
$sep = 0;

add_action( 'customize_register','getbowtied_customizer' );
function getbowtied_customizer( $wp_customize ) {

	// Add Panels
	$wp_customize->add_panel( 'panel_header', array(
		'title'          => esc_html__( 'Header', 'getbowtied' ),
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
	) );
}

add_action( 'customize_register', 'kirki_custom_control_separator' );
function kirki_custom_control_separator( $wp_customize ) {

	class Kirki_Control_Separator extends WP_Customize_Control {
		public $type = 'separator';
		public function render_content() {
			if ( ! $this->label ) :
				echo '<hr />';
			else :
				echo '<h3>' . $this->label . '</h3>';
			endif;
		}
	}

	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['separator'] = 'Kirki_Control_Separator';
		return $controls;
	} );
}


function add_my_custom_font( $standard_fonts ) {
    $fonts["Radnika"] = array(
        "label" => "Radnika",
        "stack" => "Radnika"
    );

    $fonts["NeueEinstellung"] = array(
        "label" => "NeueEinstellung",
        "stack" => "NeueEinstellung",
    );

    $fonts["Arial, Helvetica, sans-serif"] = array(
        "label" => "Arial, Helvetica, sans-serif",
        "stack" => "Arial, Helvetica, sans-serif",
    );

    $fonts["Arial Black, Gadget, sans-serif"] = array(
        "label" => "Arial Black, Gadget, sans-serif",
        "stack" => "Arial Black, Gadget, sans-serif",
    );

    $fonts["Bookman Old Style, serif"] = array(
        "label" => "Bookman Old Style, serif",
        "stack" => "Bookman Old Style, serif",
    );

    $fonts["Comic Sans MS, cursive"] = array(
        "label" => "Comic Sans MS, cursive",
        "stack" => "Comic Sans MS, cursive",
    );

    $fonts["Courier, monospace"] = array(
        "label" => "Courier, monospace",
        "stack" => "Courier, monospace",
    );

    $fonts["Garamond, serif" ] = array(
        "label" => "Garamond, serif" ,
        "stack" => "Garamond, serif" ,
    );

    $fonts["Georgia, serif"] = array(
        "label" => "Georgia, serif",
        "stack" => "Georgia, serif",
    );

    $fonts["Impact, Charcoal, sans-serif"] = array(
        "label" => "Impact, Charcoal, sans-serif",
        "stack" => "Impact, Charcoal, sans-serif",
    );

    $fonts["Lucida Console, Monaco, monospace"] = array(
        "label" => "Lucida Console, Monaco, monospace",
        "stack" => "Lucida Console, Monaco, monospace",
    );

    $fonts["MS Sans Serif, Geneva, sans-serif"] = array(
        "label" => "MS Sans Serif, Geneva, sans-serif",
        "stack" => "MS Sans Serif, Geneva, sans-serif",
    );

    $fonts["MS Serif, New York, sans-serif"] = array(
        "label" => "MS Serif, New York, sans-serif",
        "stack" => "MS Serif, New York, sans-serif",
    );

    $fonts["Palatino Linotype, Book Antiqua, Palatino, serif"] = array(
        "label" => "Palatino Linotype, Book Antiqua, Palatino, serif",
        "stack" => "Palatino Linotype, Book Antiqua, Palatino, serif",
    );

    $fonts["Tahoma,Geneva, sans-serif"] = array(
        "label" => "Tahoma,Geneva, sans-serif",
        "stack" => "Tahoma,Geneva, sans-serif",
    );

    $fonts["Times New Roman, Times,serif" ] = array(
        "label" => "Times New Roman, Times,serif" ,
        "stack" => "Times New Roman, Times,serif" ,
    );

    $fonts["Trebuchet MS, Helvetica, sans-serif"] = array(
        "label" => "Trebuchet MS, Helvetica, sans-serif",
        "stack" => "Trebuchet MS, Helvetica, sans-serif",
    );

    $fonts["Verdana, Geneva, sans-serif" ] = array(
        "label" => "Verdana, Geneva, sans-serif" ,
        "stack" => "Verdana, Geneva, sans-serif" ,
    );
    
    return $fonts;
}
add_filter( 'kirki/fonts/standard_fonts', 'add_my_custom_font' );

function shopkeeper_customizer_backend_styles() { ?>
	<style>
		#customize-controls .customize-control.customize-control-separator h3 {
			font-size: 11px;
			text-transform: uppercase;
		}
		#customize-controls .customize-control-kirki-image img {
			max-height: 80px;
		}
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'shopkeeper_customizer_backend_styles', 999 );


if ( class_exists( 'Kirki' ) ) {

	// **************************************
	// Configs
	// **************************************
	Kirki::add_config( 'shopkeeper', array(
		'capability'        => 'edit_theme_options',
		'option_type'       => 'theme_mod',
		'disable_output'    => true,
	) );

	// **************************************
	// Sections
	// **************************************
	Kirki::add_section( 'header_style', array(
		'title'          => esc_attr__('Header Styles', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel_header',
	) );

	Kirki::add_section( 'header_elements', array(
		'title'          => esc_attr__( 'Header Elements', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel_header',
	) );

	Kirki::add_section( 'header_logo', array(
		'title'          => esc_attr__( 'Logo', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel_header',
	) );

	Kirki::add_section( 'top_bar', array(
		'title'          => esc_attr__( 'Top Bar', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel_header',
	) );

	Kirki::add_section( 'sticky_header', array(
		'title'          => esc_attr__( 'Sticky Header', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel_header',
	) );

	Kirki::add_section( 'footer', array(
		'title'          => esc_attr__( 'Footer', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'blog', array(
		'title'          => esc_attr__( 'Blog', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'shop', array(
		'title'          => esc_attr__( 'Shop', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'product', array(
		'title'          => esc_attr__( 'Product Page', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'styling', array(
		'title'          => esc_attr__( 'Styling', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'fonts', array(
		'title'          => esc_attr__( 'Fonts', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'social_media', array(
		'title'          => esc_attr__( 'Social Media', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'custom_code', array(
		'title'          => esc_attr__( 'Custom Code', 'getbowtied' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
	) );


	// **************************************
	// Fields
	// **************************************

	/**
	 * HEADER
	 */

		/* Header Styles */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-image',
				'settings'    => 'main_header_layout',
				'label'       => esc_attr__( 'Header Layout', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => '1',
				'priority'    => 10,
				'choices'     => array(
						'1'         => get_template_directory_uri() . '/images/theme_options/icons/header_1.png',
						'11'        => get_template_directory_uri() . '/images/theme_options/icons/header_1b.png',
						'2'         => get_template_directory_uri() . '/images/theme_options/icons/header_2.png',
						'22'        => get_template_directory_uri() . '/images/theme_options/icons/header_2b.png',
						'3'         => get_template_directory_uri() . '/images/theme_options/icons/header_3.png',
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'main_header_font_size',
				'label'       => esc_attr__( 'Navigation Font Size', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => '13',
				'choices'     => array(
						'min'  => 11,
						'max'  => 16,
						'step' => 1,
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'main_header_font_color',
				'label'       => esc_attr__( 'Navigation Font Color', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => '#000',
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'main_header_transparency',
				'label'       => esc_attr__( 'Transparent Header', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => false,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'main_header_transparency_scheme',
				'label'       => esc_attr__( 'Default Transparency Color Scheme', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => 'transparency_light',
				'priority'    => 10,
				'choices'     => array(
						'transparency_light'    => 'Light Transparency',
						'transparency_dark'     => 'Dark Transparency',
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'shop_category_header_transparency_scheme',
				'label'       => esc_attr__( 'Default Transparency for Product Categories', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => 'no_transparency',
				'priority'    => 10,
				'choices'     => array(
						'inherit'               => 'Same as Above',
						'no_transparency'       => 'No Transparency',
						'transparency_light'    => 'Light Transparency',
						'transparency_dark'     => 'Dark Transparency',
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
				'label'		  => 'Light Transparency Scheme'
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'main_header_transparent_light_color',
				'label'       => esc_attr__( 'Text / Icon Color', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => '#fff',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'light_transparent_header_logo',
				'label'       => esc_attr__( 'Logo Light', 'getbowtied' ),
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
				'label'		  => 'Dark Transparency Scheme'
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'main_header_transparent_dark_color',
				'label'       => esc_attr__( 'Text / Icon Color', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => '#fff',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'dark_transparent_header_logo',
				'label'       => esc_attr__( 'Logo Dark', 'getbowtied' ),
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'background',
				'settings'    => 'main_header_background',
				'label'       => esc_attr__( 'Header Background Color', 'getbowtied' ),
				'section'     => 'header_style',
				'default'	  => array('background-color' => '#FFFFFF'),
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
			    'type'        => 'slider',
			    'settings'    => 'spacing_above_logo',
			    'label'       => esc_html__( 'Spacing Above the Logo', 'getbowtied' ),
			    'section'     => 'header_style',
			    'default'     => 20,
			    'priority'    => 10,
			    'choices'     => array(
			        'min'  => 0,
			        'max'  => 200,
			        'step' => 1,
			    ),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'spacing_below_logo',
				'label'       => esc_html__( 'Spacing Below the Logo', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => 20,
				'priority'    => 10,
				'choices'     => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_style',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'header_width',
				'label'       => esc_html__( 'Header Width', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => 'custom',
				'priority'    => 10,
				'choices'     => array(
						'full'  => 'Full',
						'custom'    => 'Custom',
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'header_max_width',
				'label'       => esc_html__( 'Custom Max Width', 'getbowtied' ),
				'section'     => 'header_style',
				'default'     => 1680,
				'priority'    => 10,
				'choices'     => array(
						'min'  => 960,
						'max'  => 1680,
						'step' => 1,
					),
				'active_callback'    => array(
					array(
						'setting'  => 'header_width',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			));

		/* Header Elements */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'main_header_wishlist',
				'label'       => esc_attr__( 'Wishlist Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'help'        => esc_html__( 'Requires YITH WooCommerce Wishlist Plugin', 'getbowtied' ),
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'main_header_wishlist_icon',
				'label'       => esc_html__( 'Custom Wishlist Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'main_header_wishlist',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_elements',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'main_header_shopping_bag',
				'label'       => esc_attr__( 'Shopping Cart Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'main_header_shopping_bag_icon',
				'label'       => esc_html__( 'Custom Shopping Cart Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'main_header_shopping_bag',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'option_minicart',
				'label'       => esc_attr__( 'Cart Icon Function', 'getbowtied' ),
				'section'     => 'header_elements',
				'default'     => '1',
				'priority'    => 10,
				'choices'     => array(
						'1'     => esc_attr__( 'Mini Cart', 'getbowtied' ),
						'2'     => esc_attr__( 'Link', 'getbowtied' ),
					),
				'active_callback'    => array(
					array(
						'setting'  => 'main_header_shopping_bag',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'main_header_minicart_message',
				'label'       => esc_attr__( 'Mini Cart Message', 'getbowtied' ),
				'section'     => 'header_elements',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'main_header_shopping_bag',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'option_minicart',
						'operator' => '==',
						'value'    => '1',
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_elements',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'my_account_icon_state',
				'label'       => esc_attr__( 'My Account Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'custom_my_account_icon',
				'label'       => esc_html__( 'Custom My Account Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'my_account_icon_state',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_elements',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'main_header_search_bar',
				'label'       => esc_attr__( 'Search Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'main_header_search_bar_icon',
				'label'       => esc_html__( 'Custom Search Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'main_header_search_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_elements',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'main_header_off_canvas',
				'label'       => esc_attr__( 'Off-Canvas Drawer', 'getbowtied' ),
				'section'     => 'header_elements',
				'default'     => false,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'main_header_off_canvas_icon',
				'label'       => esc_html__( 'Custom Off-Canvas Icon', 'getbowtied' ),
				'section'     => 'header_elements',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'main_header_off_canvas',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

		/* Header Logo */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'site_logo',
				'label'       => esc_html__( 'Your Logo', 'getbowtied' ),
				'section'     => 'header_logo',
				'priority'    => 10,
				'default'	  => get_template_directory_uri() . '/images/shopkeeper-logo.png',
				'description' => __('Applied on Non-Transparent Headers. To upload a logo for a Tansparent Background go to <strong>Header Layout & Style</strong> section.', 'getbowtied'),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_logo',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'image',
				'settings'    => 'sticky_header_logo',
				'label'       => esc_html__( 'Alternative Logo', 'getbowtied' ),
				'section'     => 'header_logo',
				'priority'    => 10,
				'default'	  => get_template_directory_uri() . '/images/shopkeeper-logo.png',
				'description' => __('Used on the <strong>Sticky Header</strong> and <strong>Mobile Devices</strong>.', 'getbowtied'),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'header_logo',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'logo_min_height',
				'label'       => esc_html__( 'Logo Container Min Width', 'getbowtied' ),
				'section'     => 'header_logo',
				'priority'    => 10,
				'default'	  => 50,
				'choices'     => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 1,
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'logo_height',
				'label'       => esc_html__( 'Logo Container Height', 'getbowtied' ),
				'section'     => 'header_logo',
				'priority'    => 10,
				'default'	  => 50,
				'choices'     => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
			));


			// array (

		/* Top Bar */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'top_bar_switch',
				'label'       => esc_attr__( 'Top Bar', 'getbowtied' ),
				'section'     => 'top_bar',
				'default'     => false,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'top_bar',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'top_bar_background_color',
				'label'       => esc_attr__( 'Top Bar Background Color', 'getbowtied' ),
				'section'     => 'top_bar',
				'default'     => '#333333',
				'priority'    => 10,
				'choices'     => array(
					'alpha' => true,
				),
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'top_bar',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'top_bar_typography',
				'label'       => esc_attr__( 'Top Bar Text Color', 'getbowtied' ),
				'section'     => 'top_bar',
				'default'     => '#fff',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'top_bar',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'top_bar_text',
				'label'       => esc_attr__( 'Top Bar Text', 'getbowtied' ),
				'section'     => 'top_bar',
				'default' 	  => 'Free Shipping on All Orders Over $75!',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'top_bar',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'top_bar_navigation_position',
				'label'       => esc_attr__( 'Top Bar Navigation Position', 'getbowtied' ),
				'section'     => 'top_bar',
				'default' 	  => 'right',
				'priority'    => 10,
				'choices'	  => 
					array(
						'left' 		=> 'Left',
                    	'right' 	=> 'Right'
					),
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'top_bar',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'top_bar_social_icons',
				'label'       => esc_attr__( 'Top Bar Social Icons', 'getbowtied' ),
				'section'     => 'top_bar',
				'default' 	  => false,
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'top_bar_switch',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

		/* Sticky Header */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'sticky_header',
				'label'       => esc_attr__( 'Sticky Header', 'getbowtied' ),
				'section'     => 'sticky_header',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'sticky_header',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'sticky_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'sticky_header_background_color',
				'label'       => esc_attr__( 'Sticky Header Background Color', 'getbowtied' ),
				'section'     => 'sticky_header',
				'default'     => '#fff',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'sticky_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'sticky_header',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'sticky_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'sticky_header_color',
				'label'       => esc_attr__( 'Sticky Header Color', 'getbowtied' ),
				'section'     => 'sticky_header',
				'default'     => '#000',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'sticky_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'sticky_header',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'sticky_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

	/**
	 * FOOTER
	 */	
		/* Footer */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'footer_background_color',
				'label'       => esc_attr__( 'Footer Background Color', 'getbowtied' ),
				'section'     => 'footer',
				'default'     => '#f4f4f4',
				'priority'    => 10,
				'choices'	  => 
					array(
						'alpha'		=> true
					)
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'footer',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'footer_texts_color',
				'label'       => esc_attr__( 'Footer Text', 'getbowtied' ),
				'section'     => 'footer',
				'default'     => '#868686',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'footer',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'footer_links_color',
				'label'       => esc_attr__( 'Footer Links', 'getbowtied' ),
				'section'     => 'footer',
				'default'     => '#000',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'footer',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'footer_social_icons',
				'label'       => esc_attr__( 'Social Networking Icons', 'getbowtied' ),
				'section'     => 'footer',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'footer',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'textarea',
				'settings'    => 'footer_copyright_text',
				'label'       => esc_attr__( 'Copyright Footnote', 'getbowtied' ),
				'section'     => 'footer',
				'default' 	  => 'Shopkeeper - eCommerce WP Theme',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'footer',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'expandable_footer',
				'label'       => esc_attr__( 'Collapsed Widget Area on Mobiles', 'getbowtied' ),
				'section'     => 'footer',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'footer',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'back_to_top_button',
				'label'       => esc_attr__( 'Back To Top Button', 'getbowtied' ),
				'section'     => 'footer',
				'default'     => false,
				'priority'    => 10,
			));

	/**
	 * BLOG
	 */
		/* Blog */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-image',
				'settings'    => 'layout_blog',
				'label'       => esc_attr__( 'Blog Layout', 'getbowtied' ),
				'section'     => 'blog',
				'default'     => 'layout-3',
				'priority'    => 10,
				'choices'     => array(
						'layout-1'        => get_template_directory_uri() . '/images/theme_options/icons/blog_layout_1.png',
						'layout-2'        => get_template_directory_uri() . '/images/theme_options/icons/blog_layout_2.png',
						'layout-3'        => get_template_directory_uri() . '/images/theme_options/icons/blog_layout_3.png'
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'blog',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'sidebar_blog_listing',
				'label'       => esc_attr__( 'Blog Sidebar', 'getbowtied' ),
				'section'     => 'blog',
				'default'     => false,
				'description' => 'Only available for Blog Layout 1 and 2.',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'layout_blog',
						'operator' => '!=',
						'value'    => 'layout-3',
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'blog',
				'priority'    => 10,
				'active_callback'    => array(
					array(
						'setting'  => 'layout_blog',
						'operator' => '!=',
						'value'    => 'layout-3',
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'pagination_blog',
				'label'       => esc_attr__( 'Blog Pagination Style', 'getbowtied' ),
				'section'     => 'blog',
				'default'     => 'infinite_scroll',
				'priority'    => 10,
				'choices'     => array(
						'classic'               	=> 'Classic',
	                    'load_more_button'          => 'Load More',
	                    'infinite_scroll'           => 'Infinite'
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'blog',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'portfolio_item_slug',
				'label'       => esc_attr__( 'Portfolio Item Slug', 'getbowtied' ),
				'section'     => 'blog',
				'default'     => 'portfolio-item',
				'description' => __('Default slug is "portfolio-item". Enter a custom one to overwrite it. <br/><b>You need to regenerate your permalinks if you modify this!</b>', 'shopkeeper'),
				'priority'    => 10,
			));		

	/**
	 * SHOP
	 */
		/* Shop */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'catalog_mode',
				'label'       => esc_attr__( 'Catalog Mode', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => false,
				'description' => __('When enabled, the feature Turns Off the shopping functionality of WooCommerce.', 'getbowtied'),
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'products_per_column',
				'label'       => esc_attr__( 'Number of Products per Row', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => 6,
				'priority'    => 10,
				'choices'	  =>
					array(
						'min'	=> 2,
						'max'	=> 6,
						'step'  => 1
					)
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'products_per_page',
				'label'       => esc_attr__( 'Number of Products per Page', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => 18,
				'priority'    => 10,
				'choices'	  =>
					array(
						'min'	=> 1,
						'max'	=> 48,
						'step'  => 1
					)
			));

			Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'slider',
		        'settings'   	=> 'product_title_font_size',
		        'label'    	  	=> esc_attr__( 'Product Title Font Size (px)', 'getbowtied' ),
		        'section'     	=> 'shop',
		        'priority'    	=> 10,
		        'default'     	=> 12,
		        'choices'		=> 
		        	array
		        	(
		        		'min' => '10',
                		'step' => '1',
                		'max' => '24',
		        	)
		    ));

		    Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'mobile_columns',
				'label'       => esc_attr__( 'Number of Columns on Mobile', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => 2,
				'priority'    => 10,
				'choices'	  =>
					array(
						'min'	=> 1,
						'max'	=> 2,
						'step'  => 1
					)
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'pagination_shop',
				'label'       => esc_attr__( 'Pagination Style', 'getbowtied' ),
				'section'     => 'shop',
				'priority'    => 10,
				'choices'	  =>
					array(
						'classic'               => 'Classic',
			            'load_more_button'      => 'Load More',
			            'infinite_scroll'       => 'Infinite'
					),
				'default'     => 'infinite_scroll'
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'breadcrumbs',
				'label'       => esc_attr__( 'Breadcrumbs', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'quick_view',
				'label'       => esc_attr__( 'Quick View', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => false,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'second_image_product_listing',
				'label'       => __( '2<sup>nd</sup> Product Image on Hover', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'ratings_catalog_page',
				'label'       => __( 'Rating Stars', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'predictive_search',
				'label'       => esc_attr__( 'Predictive Search', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'sidebar_style',
				'label'       => __( 'Sidebar Style', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => '1',
				'priority'    => 10,
				'choices'	  => 
					array(
						'0'		=> __('On Page', 'getbowtied'),
						'1'		=> __('Off-Canvas', 'getbowtied')
					)
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'add_to_cart_display',
				'label'       => __( 'Add to Cart Button Display', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => '1',
				'priority'    => 10,
				'choices'	  => 
					array(
						'1'		=> __('When Hovering', 'getbowtied'),
						'0'		=> __('At all Times', 'getbowtied')
					)
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'notification_mode',
				'label'       => __( 'Notification Style', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => '1',
				'priority'    => 10,
				'choices'	  => 
					array(
						'1'		=> __('Animated', 'getbowtied'),
						'0'		=> __('Classic', 'getbowtied')
					)
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-buttonset',
				'settings'    => 'notification_style',
				'label'       => __( 'Animation', 'getbowtied' ),
				'section'     => 'shop',
				'default'     => '1',
				'priority'    => 10,
				'choices'	  => 
					array(
						'1'		=> __('Slide Out', 'getbowtied'),
						'0'		=> __('Always Visible', 'getbowtied')
					),
				'active_callback'    => array(
					array(
						'setting'  => 'notification_mode',
						'operator' => '==',
						'value'    => '1',
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'shop',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'out_of_stock_label',
				'label'       => __( 'Out of Stock Label', 'getbowtied' ),
				'help'		  => __('If you\'re using a multi language plugin we recommend leaving the default value.', 'getbowtied'),
				'section'     => 'shop',
				'default'     => 'Out of stock',
				'priority'    => 10
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'sale_label',
				'label'       => __( 'Sale Label', 'getbowtied' ),
				'help'		  => __('If you\'re using a multi language plugin we recommend leaving the default value.', 'getbowtied'),
				'section'     => 'shop',
				'default'     => 'Sale!',
				'priority'    => 10
			));

	/**
	 * PRODUCT PAGE
	 */
		/* Product Page */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-image',
				'settings'    => 'product_layout',
				'label'       => esc_attr__( 'Product Page Layout', 'getbowtied' ),
				'section'     => 'product',
				'default'     => 'default',
				'priority'    => 10,
				'choices'     => array(
						'default'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_1.png',
						'style_2'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_2.png',
						'style_3'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_3.png',
						'style_4'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_4.png'
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'product',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'radio-image',
				'settings'    => 'product_quantity_style',
				'label'       => esc_attr__( 'Product Quantity Style', 'getbowtied' ),
				'section'     => 'product',
				'default'     => 'default',
				'priority'    => 10,
				'choices'     => array(
						'default'        => get_template_directory_uri() . '/images/theme_options/icons/product_qty_style_1.png',
						'custom'         => get_template_directory_uri() . '/images/theme_options/icons/product_qty_style_2.png'
					),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'product',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'product_gallery_zoom',
				'label'       => esc_attr__( 'Product Gallery Zoom', 'getbowtied' ),
				'section'     => 'product',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'product',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'product_gallery_lightbox',
				'label'       => esc_attr__( 'Product Gallery Lightbox', 'getbowtied' ),
				'section'     => 'product',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'product',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'related_products',
				'label'       => esc_attr__( 'Related Products', 'getbowtied' ),
				'section'     => 'product',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'slider',
				'settings'    => 'related_products_number',
				'label'       => esc_attr__( 'Number of Related Products', 'getbowtied' ),
				'section'     => 'product',
				'default'     => 4,
				'priority'    => 10,
				'choices'	  => 
					array 
					(
						'min'	=> 2,
						'max'	=> 6,
						'step'	=> 1
					),
				'active_callback'    => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'product',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'sharing_options',
				'label'       => esc_attr__( 'Social Sharing Options', 'getbowtied' ),
				'section'     => 'product',
				'default'     => true,
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'product',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'review_tab',
				'label'       => esc_attr__( 'Review Tab', 'getbowtied' ),
				'section'     => 'product',
				'default'     => true,
				'priority'    => 10,
			));

	/**
	 * STYLING
	 */
		/* Styling */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'body_color',
				'label'       => esc_attr__( 'Body Text Color', 'getbowtied' ),
				'section'     => 'styling',
				'default'     => '#545454',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'styling',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'headings_color',
				'label'       => esc_attr__( 'Headings Color', 'getbowtied' ),
				'section'     => 'styling',
				'default'     => '#000000',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'styling',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'color',
				'settings'    => 'main_color',
				'label'       => esc_attr__( 'Accent Color', 'getbowtied' ),
				'section'     => 'styling',
				'default'     => '#EC7A5C',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'styling',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'background',
				'settings'    => 'main_background',
				'label'       => esc_attr__( 'Body Background', 'getbowtied' ),
				'section'     => 'styling',
				'default'     => array('background-color' => '#FFFFFF'),
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'styling',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'toggle',
				'settings'    => 'smooth_transition_between_pages',
				'label'       => esc_attr__( 'Smooth Transition Between Pages', 'getbowtied' ),
				'section'     => 'styling',
				'default'     => 0,
				'priority'    => 10,
			));

	/**
	 * FONTS
	 */
		/* Fonts */

		    Kirki::add_field( 'shopkeeper', array(
		        'type'     		=> 'select',
		        'settings' 		=> 'main_font',
		        'label'    	  	=> esc_attr__( 'Main Font', 'getbowtied' ),
		        'description' 	=> esc_html__( 'Used for titles and Headings.', 'getbowtied' ),
		        'section'  		=> 'fonts',
		        'priority' 		=> 10,
		        'choices' 		=> Kirki_Fonts::get_font_choices(),
		        'default'  		=> 'NeueEinstellung'
		    ));

		    Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'toggle',
		        'settings'   	=> 'main_font_variants_advanced',
		        'label'    	  	=> esc_attr__( 'Custom Main Font Variants', 'getbowtied' ),
		        'section'     	=> 'fonts',
		        'priority'    	=> 10,
		        'default'     	=> true,
		        'description'	=> esc_html__( 'If disabled regular 400 fonts will be loaded.', 'getbowtied')
		    ));

	        Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'multicheck',
		        'settings'   	=> 'main_font_variants',
		        'label'    	  	=> esc_attr__( 'Main Font Variants', 'getbowtied' ),
		        'section'     	=> 'fonts',
		        'priority'    	=> 10,
		        'choices'     	=> Kirki_Fonts::get_all_variants(),
		        'default'     	=> array('regular'),
				'active_callback'    => array(
					array(
						'setting'  => 'main_font_variants_advanced',
						'operator' => '==',
						'value'    => true,
					),
				),
		    ));

		    Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'slider',
		        'settings'   	=> 'headings_font_size',
		        'label'    	  	=> esc_attr__( 'Headings Font Size (px)', 'getbowtied' ),
		        'section'     	=> 'fonts',
		        'priority'    	=> 10,
		        'default'     	=> 23,
		        'choices'		=> 
		        	array
		        	(
		        		'min' => '16',
                		'step' => '1',
                		'max' => '40',
		        	)
		    ));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'fonts',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        	=> 'select',
				'settings'    	=> 'secondary_font',
				'label'       	=> esc_attr__( 'Secondary Font', 'getbowtied' ),
		        'section'  	  	=> 'fonts',
		        'priority'    	=> 10,
		        'choices'   	=> Kirki_Fonts::get_font_choices(),
		        'default'     	=> 'Radnika'
		    ));

		    Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'toggle',
		        'settings'   	=> 'secondary_font_variants_advanced',
		        'label'    	  	=> esc_attr__( 'Custom Secondary Font Variants', 'getbowtied' ),
		        'section'     	=> 'fonts',
		        'priority'    	=> 10,
		        'default'     	=> true,
		        'description'	=> esc_html__( 'If disabled regular 400 fonts will be loaded.', 'getbowtied')
		    ));

		    Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'multicheck',
		        'settings'   	=> 'secondary_font_variants',
		        'label'    	  	=> esc_attr__( 'Secondary Font Variants', 'getbowtied' ),
		        'section'     	=> 'fonts',
		        'priority'    	=> 10,
		        'choices'    	=> Kirki_Fonts::get_all_variants(),
		        'default'     	=> array('regular'),
		        'active_callback'    => array(
					array(
						'setting'  => 'secondary_font_variants_advanced',
						'operator' => '==',
						'value'    => true,
					),
				),
		    ));

		    Kirki::add_field( 'shopkeeper', array(
		        'type'        	=> 'slider',
		        'settings'   	=> 'body_font_size',
		        'label'    	  	=> esc_attr__( 'Body Font Size (px)', 'getbowtied' ),
		        'section'     	=> 'fonts',
		        'priority'    	=> 10,
		        'default'     	=> 16,
		        'choices'		=> 
		        	array
		        	(
		        		'min' => '12',
                		'step' => '1',
                		'max' => '20',
		        	)
		    ));

	/**
	 * SOCIAL MEDIA
	 */
		/* Social Media */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'facebook_link',
				'label'       => esc_attr__( 'Facebook', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '#',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'twitter_link',
				'label'       => esc_attr__( 'Twitter', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '#',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'pinterest_link',
				'label'       => esc_attr__( 'Pinterest', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'linkedin_link',
				'label'       => esc_attr__( 'LinkedIn', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'googleplus_link',
				'label'       => esc_attr__( 'Google+', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'rss_link',
				'label'       => esc_attr__( 'RSS', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'tumblr_link',
				'label'       => esc_attr__( 'Tumblr', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'instagram_link',
				'label'       => esc_attr__( 'Instagram', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'youtube_link',
				'label'       => esc_attr__( 'Youtube', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'vimeo_link',
				'label'       => esc_attr__( 'Vimeo', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'behance_link',
				'label'       => esc_attr__( 'Behance', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'dribbble_link',
				'label'       => esc_attr__( 'Dribbble', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'flickr_link',
				'label'       => esc_attr__( 'Flickr', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'git_link',
				'label'       => esc_attr__( 'Git', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'skype_link',
				'label'       => esc_attr__( 'Skype', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'weibo_link',
				'label'       => esc_attr__( 'Weibo', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'foursquare_link',
				'label'       => esc_attr__( 'Foursquare', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'soundcloud_link',
				'label'       => esc_attr__( 'Soundcloud', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'vk_link',
				'label'       => esc_attr__( 'VK', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'houzz_link',
				'label'       => esc_attr__( 'Houzz', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'naver_line_link',
				'label'       => esc_attr__( 'Naver LINE', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'tripadvisor_link',
				'label'       => esc_attr__( 'TripAdvisor', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'text',
				'settings'    => 'wechat_link',
				'label'       => esc_attr__( 'WeChat', 'getbowtied' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));


	/**
	 * CUSTOM CODE
	 */
		/* Custom Code */

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'code',
				'settings'    => 'custom_css',
				'label'       => esc_attr__( 'Custom CSS', 'getbowtied' ),
				'section'     => 'custom_code',
				'default'     => '',
				'priority'    => 10,
				'choices'     => array(
					'language' => 'css',
					'theme'    => 'monokai',
					'height'   => 150,
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'custom_code',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'code',
				'settings'    => 'header_js',
				'label'       => esc_attr__( 'Header JavaScript Code', 'getbowtied' ),
				'section'     => 'custom_code',
				'default'     => '',
				'priority'    => 10,
				'choices'     => array(
					'language' => 'javascript',
					'theme'    => 'monokai',
					'height'   => 150,
				),
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'separator',
				'settings'    => 'separator_' . $sep++,
				'section'     => 'custom_code',
				'priority'    => 10,
			));

			Kirki::add_field( 'shopkeeper', array(
				'type'        => 'code',
				'settings'    => 'footer_js',
				'label'       => esc_attr__( 'Footer JavaScript Code', 'shopkeeper' ),
				'section'     => 'custom_code',
				'default'     => '',
				'priority'    => 10,
				'choices'     => array(
					'language' => 'javascript',
					'theme'    => 'monokai',
					'height'   => 150,
				),
			));

}// End if().

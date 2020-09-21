<?php
/**
* Brand Palettes
* General Brand Colors, Neutrals, Options
*/
function spring_brand_colors() {
	return array(
		'brand-color-1' => array(
			'name'  => 'Brand Color 1 (Primary)',
			'color' => '#de1e7e',
		),
		'brand-color-2' => array(
			'name'  => 'Brand Color 2 (Secondary)',
			'color' => '#1D7FA7',
		),
		'brand-color-3' => array(
			'name'  => 'Brand Color 3 (Accent)',
			'color' => '#0C8670',
		),
		'brand-color-4' => array(
			'name'  => 'Brand Color 4 (Accent)',
			'color' => '#7F4FD2',
		),
		'brand-color-5' => array(
			'name'  => 'Brand Color 5 (Accent)',
			'color' => '#D63F10',
		),
	);
}
function spring_brand_options() {
	return array(
		'brand-links' => array(
			'name'  => 'Link Color',
			'color' => '#BC1A6B',
		),
		'brand-alert' => array(
			'name'  => 'Alert Color',
			'color' => '#E6135A',
		),
	);
}

function spring_brand_text() {
	return array(
		'brand-text'       => array(
			'name'  => 'Primary Text Color',
			'color' => '#303030',
		),
		'brand-heading'    => array(
			'name'  => 'Heading Color',
			'color' => '#303030',
		),
		'brand-subheading' => array(
			'name'  => 'Subheading Color',
			'color' => '#303030',
		),
	);
}


function spring_brand_neutrals() {
	return array(
		'neutral-lightest' => array(
			'name'  => 'Lightest Neutral Background',
			'color' => '#f6f6f6',
		),
		'neutral-light'    => array(
			'name'  => 'Light Neutral/Background',
			'color' => '#e0e0e0',
		),
		'neutral-mid'      => array(
			'name'  => 'Middle Neutral Background',
			'color' => '#949494',
		),
		'neutral-dark'     => array(
			'name'  => 'Dark Neutral/Background',
			'color' => '#535353',
		),
		'neutral-darkest'  => array(
			'name'  => 'Darkest Neutral Background',
			'color' => '#000000',
		),
	);
}

function spring_brand_neutralwhite() {
	$brandneutrals = spring_brand_neutrals();
	$white         = array(
		'neutral-white' => array(
			'name'  => 'White',
			'color' => '#ffffff',
		),
	);
	return array_merge( $white, $brandneutrals );
}

/**
* Brand All Colors (minus white)
*/
function spring_brand_palette() {
	$brandcolor    = spring_brand_colors();
	$brandneutrals = spring_brand_neutrals();
	return array_merge( $brandcolor, $brandneutrals );
}

/**
* Customizer Palette
* Colors in Customizer (includes links, text, etc.)
*/
function spring_customizer_palette() {
	$brand   = spring_brand_palette();
	$options = spring_brand_options();
	$text    = spring_brand_text();
	return array_merge( $brand, $options, $text );
}

/**
* Editor Palette
* Colors for Gutenberg Editor (includes white)
*/
function spring_editor_palette() {
	$brandcolors   = spring_brand_colors();
	$brandoptions  = spring_brand_options();
	$brandneutrals = spring_brand_neutralwhite();
	return array_merge( $brandcolors, $brandoptions, $brandneutrals );
}

/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * @link https://gist.github.com/stephenharris/5532899
 * @param str $hex Colour as hexadecimal (with or without hash);
 * @param float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * @return str Lightened/Darkend colour as hexadecimal (with hash);
 */
function color_luminance( $hex, $percent ) {
	if ( $hex ) {
		$hex     = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		for ( $i = 0; $i < 3; $i++ ) {
			$dec      = hexdec( substr( $hex, $i * 2, 2 ) );
			$dec      = min( max( 0, $dec + $dec * $percent ), 255 );
			$new_hex .= str_pad( dechex( $dec ), 2, 0, STR_PAD_LEFT );
		}
		return $new_hex;
	}
}

function hex2rgb( $colour ) {
	if ( $colour ) {
		if ( '#' === $colour[0] ) {
						$colour = substr( $colour, 1 );
		}
		if ( 6 === strlen( $colour ) ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
		} elseif ( 3 === strlen( $colour ) ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
		} else {
						return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );
		return array( $r, $g, $b );
	}
}


/**
* CSS Color Variables Inline Style
*/
function spring_palette_css() {
	$palette = spring_brand_colors();
	foreach ( $palette as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$color       = get_theme_mod( $key, $item['color'] );
			$css_vars[]  = '--' . $key . ':' . $color . ';';
			$css_vars[]  = '--' . $key . '-darker:' . color_luminance( $color, -.25 ) . ';';
			$css_vars[]  = '--' . $key . '-lighter:' . color_luminance( $color, .25 ) . ';';
			$css_style[] = '.has-' . $key . '-background-color{background-color:' . $color . ' !important;}';
			$css_style[] = '.has-' . $key . '-color{color:' . $color . ' !important;}';
		}
	}
	$options = spring_brand_options();
	foreach ( $options as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$color       = get_theme_mod( $key, $item['color'] );
			$css_vars[]  = '--' . $key . ':' . $color . ';';
			$css_vars[]  = '--' . $key . '-darker:' . color_luminance( $color, -.25 ) . ';';
			$css_vars[]  = '--' . $key . '-lighter:' . color_luminance( $color, .25 ) . ';';
			$css_style[] = '.has-' . $key . '-background-color{background-color:' . $color . ' !important;}';
			$css_style[] = '.has-' . $key . '-color{color:' . $color . ' !important;}';
		}
	}
	$text = spring_brand_text();
	foreach ( $text as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$color       = get_theme_mod( $key, $item['color'] );
			$css_vars[]  = '--' . $key . ':' . $color . ';';
			$css_style[] = '.has-' . $key . '-color{color:' . $color . ' !important;}';
		}
	}
	$neutrals = spring_brand_neutralwhite();
	foreach ( $neutrals as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$color       = get_theme_mod( $key, $item['color'] );
			$css_vars[]  = '--' . $key . ':' . $color . ';';
			$css_style[] = '.has-' . $key . '-background-color{background-color:' . $color . ' !important;}';
			$css_style[] = '.has-' . $key . '-color{color:' . $color . ' !important;}';
		}
	}
	$root  = ! empty( $css_vars ) ? ':root{' . implode( ' ', $css_vars ) . ' }' : '';
	$style = ! empty( $css_style ) ? implode( ' ', $css_style ) : '';
	return $root . "\n" . $style;
}

/**
* CSS Gradients Inline Style
*/
function spring_gradient_css() {
	$palette = spring_brand_colors();
	$j       = 1;

	foreach ( $palette as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$color       = get_theme_mod( $key, $item['color'] );
			$css_style[] = '.has-' . $key . '-gradient-darker-gradient-background{background:linear-gradient(135deg,' . $color . ' 0%,' . color_luminance( $color, -.5 ) . ' 100%) !important;}';
			$css_style[] = '.has-' . $key . '-gradient-lighter-gradient-background{background:linear-gradient(135deg,' . $color . ' 0%,' . color_luminance( $color, .6 ) . ' 100%) !important;}';

			foreach ( array_slice( $palette, $j++ ) as $key2 => $item2 ) {
				$color2 = get_theme_mod( $key2, $item2['color'] );
				if ( $color2 ) {
					$css_style[] = '.has-' . $key . '-' . $key2 . '-gradient-gradient-background{background:linear-gradient(135deg,' . $color . ' 0%,' . $color2 . ' 100%) !important;}';
				}
			}
		}
	}
	$style = ! empty( $css_style ) ? implode( ' ', $css_style ) : '';
	return $style;
}

/**
* CSS RGB
*/
function spring_rgb_css() {
	$palette = spring_brand_colors();
	foreach ( $palette as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$convert    = hex2rgb( get_theme_mod( $key, $item['color'] ) );
			$color      = implode( ', ', $convert );
			$css_vars[] = '--' . $key . '-rgb:' . $color . ';';
		}
	}
	$neutrals = spring_brand_neutralwhite();
	foreach ( $neutrals as $key => $item ) {
		if ( array_key_exists( 'color', $item ) ) {
			$convert    = hex2rgb( get_theme_mod( $key, $item['color'] ) );
			$color      = implode( ', ', $convert );
			$css_vars[] = '--' . $key . '-rgb:' . $color . ';';
		}
	}
	$root  = ! empty( $css_vars ) ? ':root{' . implode( ' ', $css_vars ) . ' }' : '';
	$style = ! empty( $css_style ) ? implode( ' ', $css_style ) : '';
	return $root . "\n" . $style;
}

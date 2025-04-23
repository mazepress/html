<?php
/**
 * The PhpUnit bootstrap file.
 *
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

/**
 * Merges user defined arguments into defaults array.
 *
 * @param mixed        $args     The args.
 * @param array<mixed> $defaults The defaults.
 *
 * @return array<mixed>
 */
function wp_parse_args( $args, $defaults = array() ): array {

	if ( is_object( $args ) ) {
		$parsed_args = get_object_vars( $args );
	} elseif ( is_array( $args ) ) {
		$parsed_args =& $args;
	} else {
		parse_str( (string) $args, $parsed_args );
	}

	if ( is_array( $defaults ) && $defaults ) {
		return array_merge( $defaults, $parsed_args );
	}

	return $parsed_args;
}

/**
 * Sanitizes an HTML classname to ensure it only contains valid characters.
 *
 * Strips the string down to A-Z,a-z,0-9,_,-. If this results in an empty
 * string then it will return the alternative value supplied.
 *
 * @todo Expand to support the full range of CDATA that a class attribute can contain.
 *
 * @since 2.8.0
 *
 * @param string $classname The classname to be sanitized.
 * @param string $fallback  Optional. The value to return if the sanitization ends up as an empty string.
 *                          Default empty string.
 * @return string The sanitized value.
 */
function sanitize_html_class( $classname, $fallback = '' ): string {

	// Strip out any percent-encoded characters.
	$sanitized = preg_replace( '|%[a-fA-F0-9][a-fA-F0-9]|', '', $classname );

	// Limit to A-Z, a-z, 0-9, '_', '-'.
	$sanitized = preg_replace( '/[^A-Za-z0-9_-]/', '', $sanitized );

	if ( '' === $sanitized && $fallback ) {
		return sanitize_html_class( $fallback );
	}

	return $sanitized;
}

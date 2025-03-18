<?php
/**
 * The editor field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Editor class.
 */
class Editor extends BaseField {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param mixed  $value The field value.
	 */
	public function __construct( string $name, $value = null ) {

		// Set the required values.
		$this->set_type( 'editor' );
		$this->set_name( $name );
		$this->set_value( $value );
	}

	/**
	 * Render the input field.
	 *
	 * @return void
	 */
	public function render(): void {

		$attributes = $this->get_attributes();

		$attributes['media_buttons'] = ! empty( $attributes['media_buttons'] ) ? true : false;
		$attributes['quicktags']     = ! empty( $attributes['quicktags'] ) ? true : false;

		$settings = wp_parse_args(
			$attributes,
			array(
				'textarea_name' => esc_attr( $this->get_name() ),
				'textarea_rows' => get_option( 'default_post_edit_rows', 10 ),
				'media_buttons' => false,
				'quicktags'     => false,
			)
		);

		wp_editor(
			wp_kses_post( (string) $this->get_value() ),
			sanitize_title( $this->get_name() ),
			$settings
		);
	}
}

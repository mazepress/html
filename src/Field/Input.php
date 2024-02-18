<?php
/**
 * The input field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Input class.
 */
class Input extends BaseField {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param string $value The field value.
	 * @param string $type  The field type.
	 */
	public function __construct( string $name, $value = '', $type = 'text' ) {

		// Set the required values.
		$this->set_name( $name );
		$this->set_value( $value );
		$this->set_type( $type );
	}

	/**
	 * Render the input field.
	 *
	 * @return void
	 */
	public function render(): void {

		$attributes = array();

		foreach ( $this->get_attributes() as $key => $value ) {
			$attributes[] = sprintf( '%1$s="%2$s"', $key, $value );
		}

		$html = sprintf(
			'<input type="%1$s" name="%2$s" value="%3$s" %4$s/>',
			$this->get_type(),
			$this->get_name(),
			! empty( $this->get_value() ) ? $this->get_value() : '',
			implode( ' ', $attributes )
		);

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}
}

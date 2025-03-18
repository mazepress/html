<?php
/**
 * The label field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Label class.
 */
class Label extends BaseField {

	/**
	 * Initiate class.
	 *
	 * @param string $label The field label.
	 */
	public function __construct( string $label ) {

		// Set the required values.
		$this->set_type( 'label' );
		$this->set_label( $label );
		$this->set_name( bin2hex( random_bytes( 10 ) ) );
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
			'<label %1$s>%2$s</label>',
			implode( ' ', $attributes ),
			$this->get_label()
		);

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}
}

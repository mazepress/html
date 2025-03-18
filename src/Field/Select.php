<?php
/**
 * The select field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Select class.
 */
class Select extends BaseField {

	/**
	 * The empty text.
	 *
	 * @var string $empty_text
	 */
	private $empty_text;

	/**
	 * The options.
	 *
	 * @var array<mixed> $options
	 */
	private $options = array();

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param mixed  $value The field value.
	 */
	public function __construct( string $name, $value = null ) {

		// Set the required values.
		$this->set_type( 'select' );
		$this->set_name( $name );
		$this->set_value( $value );
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
			'<select name="%1$s" %2$s>',
			$this->get_name(),
			implode( ' ', $attributes )
		);

		if ( ! empty( $this->get_empty_text() ) ) {
			$html .= sprintf(
				'<option value="">%1$s</option>',
				esc_html( $this->get_empty_text() )
			);
		}

		foreach ( $this->get_options() as $key => $value ) {

			if ( is_array( $this->get_value() ) ) {
				$selected = in_array( $key, $this->get_value(), true ) ? 'selected' : '';
			} else {
				$selected = ( $this->get_value() === $key ) ? 'selected' : '';
			}

			$option_attributes = array();

			if ( is_array( $value ) && ! empty( $value['text'] ) ) {
				foreach ( $value as $option_key => $option_value ) {
					if ( 'text' !== $option_key && 'value' !== $option_key ) {
						$option_attributes[] = sprintf( 'data-%1$s="%2$s"', $option_key, esc_attr( $option_value ) );
					}
				}

				$field_value = ! empty( $value['value'] ) ? $value['value'] : $key;
				$field_text  = $value['text'];
			} else {
				$field_value = $key;
				$field_text  = $value;
			}

			$html .= sprintf(
				'<option %1$s %2$s value="%3$s">%4$s</option>',
				esc_attr( $selected ),
				implode( ' ', $option_attributes ),
				esc_attr( $field_value ),
				esc_html( $field_text )
			);
		}

		$html .= '</select>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Get the empty text.
	 *
	 * @return string|null
	 */
	public function get_empty_text(): ?string {
		return $this->empty_text;
	}

	/**
	 * Set the empty text.
	 *
	 * @param string $empty_text The empty text.
	 *
	 * @return self
	 */
	public function set_empty_text( string $empty_text ): self {
		$this->empty_text = $empty_text;
		return $this;
	}

	/**
	 * Get the options.
	 *
	 * @return array<mixed>
	 */
	public function get_options(): array {
		return $this->options;
	}

	/**
	 * Set the options.
	 *
	 * @param array<mixed> $options The options.
	 *
	 * @return self
	 */
	public function set_options( array $options ): self {
		$this->options = $options;
		return $this;
	}
}

<?php
/**
 * The dynamic field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Dynamic class.
 */
class Dynamic extends BaseField {

	/**
	 * The button text.
	 *
	 * @var string $button_text
	 */
	private $button_text;

	/**
	 * Initiate class.
	 *
	 * @param string       $name  The field name.
	 * @param array<mixed> $value The field value.
	 */
	public function __construct( string $name, array $value = array() ) {

		// Set the required values.
		$this->set_name( $name );
		$this->set_value( $value );
		$this->set_type( 'dynamic' );
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

		$html  = '<div class="dynamic-block">';
		$html .= '<div class="dynamic-items">';

		$values = $this->get_value();
		$count  = 1;

		if ( ! empty( $values ) && is_array( $values ) ) {
			foreach ( $values as $key => $value ) {
				if ( ! empty( $value ) ) {
					$attributes['id'] = sprintf( 'id="dynamic-field-%1$s"', $count );
					$html            .= $this->render_item( $value, $attributes );
					++$count;
				}
			}
		}

		$label = ! empty( $this->get_button_text() ) ? ' ' . $this->get_button_text() : '';

		$html .= '</div>';
		$html .= '<div class="dynamic-clone" style="display:none;" data-count="' . $count . '">';
		$html .= $this->render_item( '', $attributes );
		$html .= '</div>';
		$html .= '<p><a type="button" class="button dynamic-add">
			<span class="dashicons-before dashicons-plus"></span>' . $label . '</a></p>';
		$html .= '</div>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Render the input field.
	 *
	 * @param mixed    $value      The value.
	 * @param string[] $attributes The attributes.
	 *
	 * @return string
	 */
	public function render_item( $value, array $attributes ): string {

		$html  = '<p class="dynamic-item">';
		$html .= sprintf(
			'<input type="text" name="%1$s" value="%2$s" %3$s/>',
			$this->get_name(),
			$value,
			implode( ' ', $attributes )
		);
		$html .= '<a type="button" class="button dynamic-remove">
			<span class="dashicons-before dashicons-trash"></span></a>';
		$html .= '</p>';

		return $html;
	}

	/**
	 * Get the button text.
	 *
	 * @return string|null
	 */
	public function get_button_text(): ?string {
		return $this->button_text;
	}

	/**
	 * Set the button text.
	 *
	 * @param string $button_text The button text.
	 *
	 * @return self
	 */
	public function set_button_text( string $button_text ): self {
		$this->button_text = $button_text;
		return $this;
	}
}

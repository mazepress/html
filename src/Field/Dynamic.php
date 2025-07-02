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
	 * The CSS class.
	 *
	 * @var string $css_class
	 */
	private $css_class;

	/**
	 * Initiate class.
	 *
	 * @param string       $name  The field name.
	 * @param array<mixed> $value The field value.
	 * @param string       $type  The field type.
	 */
	public function __construct( string $name, array $value = array(), string $type = 'dynamic' ) {

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

		$attrs = $this->get_attributes();
		$html  = sprintf( '<div class="dynamic-block %1$s">', (string) $this->get_css_class() );
		$html .= '<div class="dynamic-items">';

		$values = $this->get_value();
		$count  = 1;

		if ( ! empty( $values ) && is_array( $values ) ) {
			foreach ( $values as $key => $value ) {
				if ( ! empty( $value ) ) {
					$html .= $this->render_item( $value, $attrs, $count );
					++$count;
				}
			}
		}

		$label = ! empty( $this->get_button_text() ) ? ' ' . $this->get_button_text() : '';

		$html .= '</div>';
		$html .= '<div class="dynamic-clone" style="display:none;" data-count="' . $count . '">';
		$html .= $this->render_item( null, $attrs );
		$html .= '</div>';
		$html .= '<p><a type="button" class="button dynamic-add">
			<span class="dashicons-before dashicons-plus"></span>' . $label . '</a></p>';
		$html .= '</div>';

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Render the fields.
	 *
	 * @param mixed    $value The value.
	 * @param string[] $attrs The attributes.
	 * @param int      $count The item count.
	 *
	 * @return string
	 */
	public function render_item( $value, array $attrs, int $count = 0 ): string {

		$html = sprintf(
			'<div class="dynamic-item form-group" id="dynamic-field-%1$s">',
			$count
		);

		// Render the dynamic fields.
		$html .= $this->render_fields( $value, $attrs );

		$html .= '</div>';

		return $html;
	}

	/**
	 * Render the input fields.
	 *
	 * @param mixed    $value The value.
	 * @param string[] $attrs The attributes.
	 * @param int      $count The item count.
	 *
	 * @return string
	 */
	public function render_fields( $value, array $attrs, int $count = 0 ): string {

		foreach ( $attrs as $key => $attr ) {
			$attr          = ( 'id' === $key ) ? $attr . '-' . $count : $attr;
			$attrs[ $key ] = sprintf( '%1$s="%2$s"', $key, $attr );
		}

		// The fields.
		$html = sprintf(
			'<input type="text" name="%1$s[]" value="%2$s" %3$s/>',
			$this->get_name(),
			$value,
			implode( ' ', $attrs )
		);

		// Buttons.
		$html .= '<a type="button" class="button dynamic-remove">
			<span class="dashicons-before dashicons-trash"></span></a>';

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

	/**
	 * Get the css class.
	 *
	 * @return string|null
	 */
	public function get_css_class(): ?string {
		return $this->css_class;
	}

	/**
	 * Set the css class.
	 *
	 * @param string $css_class The css class.
	 *
	 * @return self
	 */
	public function set_css_class( string $css_class ): self {
		$this->css_class = $css_class;
		return $this;
	}
}

<?php
/**
 * The pages field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Pages class.
 */
class Pages extends BaseField {

	/**
	 * The empty text.
	 *
	 * @var string $empty_text
	 */
	private $empty_text;

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param int    $value The field value.
	 */
	public function __construct( string $name, int $value = 0 ) {

		// Set the required values.
		$this->set_type( 'pages' );
		$this->set_name( $name );
		$this->set_value( $value );
	}

	/**
	 * Render the input field.
	 *
	 * @return void
	 */
	public function render(): void {

		$settings = \wp_parse_args(
			$this->get_attributes(),
			array(
				'selected'         => (int) $this->get_value(),
				'name'             => \esc_attr( $this->get_name() ),
				'show_option_none' => \esc_html( (string) $this->get_empty_text() ),
			)
		);

		\wp_dropdown_pages( $settings ); //phpcs:ignore WordPress.Security.EscapeOutput
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
}

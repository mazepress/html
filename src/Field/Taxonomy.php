<?php
/**
 * The taxonomy field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Taxonomy class.
 */
class Taxonomy extends BaseField {

	/**
	 * The taxonomy.
	 *
	 * @var string $taxonomy
	 */
	private $taxonomy;

	/**
	 * The empty text.
	 *
	 * @var string $empty_text
	 */
	private $empty_text;

	/**
	 * Initiate class.
	 *
	 * @param string $taxonomy The taxonomy.
	 * @param string $name     The field name.
	 * @param string $value    The field value.
	 */
	public function __construct( string $taxonomy, string $name, string $value = '' ) {

		// Set the required values.
		$this->set_type( 'taxonomy' );
		$this->set_taxonomy( $taxonomy );
		$this->set_name( $name );
		$this->set_value( $value );
	}

	/**
	 * Render the input field.
	 *
	 * @return void
	 */
	public function render(): void {

		$settings = wp_parse_args(
			$this->get_attributes(),
			array(
				'taxonomy'          => esc_attr( $this->get_taxonomy() ),
				'name'              => esc_attr( $this->get_name() ),
				'show_option_none'  => esc_html( (string) $this->get_empty_text() ),
				'option_none_value' => '',
				'selected'          => $this->get_value(),
				'orderby'           => 'name',
				'hierarchical'      => 1,
				'hide_empty'        => 0,
				'value_field'       => 'slug',
			)
		);

		wp_dropdown_categories( $settings );
	}

	/**
	 * Get the taxonomy.
	 *
	 * @return string
	 */
	public function get_taxonomy(): string {
		return $this->taxonomy;
	}

	/**
	 * Set the taxonomy.
	 *
	 * @param string $taxonomy The taxonomy.
	 *
	 * @return self
	 */
	public function set_taxonomy( string $taxonomy ): self {
		$this->taxonomy = $taxonomy;
		return $this;
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

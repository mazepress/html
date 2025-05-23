<?php
/**
 * The BaseField class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

/**
 * The BaseField class.
 */
abstract class BaseField {

	/**
	 * The type.
	 *
	 * @var string $type
	 */
	private $type;

	/**
	 * The name.
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * The value.
	 *
	 * @var mixed $value
	 */
	private $value;

	/**
	 * The label.
	 *
	 * @var string $label
	 */
	private $label;

	/**
	 * The description.
	 *
	 * @var string $description
	 */
	private $description;

	/**
	 * The attributes.
	 *
	 * @var string[] $attributes
	 */
	private $attributes = array();

	/**
	 * Render the form field.
	 *
	 * @return void
	 */
	abstract public function render(): void;

	/**
	 * Get the type.
	 *
	 * @return string
	 */
	public function get_type(): string {
		return $this->type;
	}

	/**
	 * Set the type.
	 *
	 * @param string $type The type.
	 *
	 * @return static
	 */
	public function set_type( string $type ): self {
		$this->type = $type;
		return $this;
	}

	/**
	 * Get the name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Set the name.
	 *
	 * @param string $name The name.
	 *
	 * @return static
	 */
	public function set_name( string $name ): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * Get the value.
	 *
	 * @return mixed
	 */
	public function get_value() {
		return $this->value;
	}

	/**
	 * Set the value.
	 *
	 * @param mixed $value The value.
	 *
	 * @return static
	 */
	public function set_value( $value ): self {
		$this->value = $value;
		return $this;
	}

	/**
	 * Get the label.
	 *
	 * @return string|null
	 */
	public function get_label(): ?string {
		return $this->label;
	}

	/**
	 * Set the label.
	 *
	 * @param string $label The label.
	 *
	 * @return static
	 */
	public function set_label( string $label ): self {
		$this->label = $label;
		return $this;
	}

	/**
	 * Get the description.
	 *
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * Set the description.
	 *
	 * @param string $description The description.
	 *
	 * @return self
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * Get the attributes.
	 *
	 * @return string[]
	 */
	public function get_attributes(): array {
		return $this->attributes;
	}

	/**
	 * Get the single attribute.
	 *
	 * @param string $key The attribute key.
	 *
	 * @return string
	 */
	public function get_attribute( string $key ): string {
		$attributes = $this->get_attributes();
		return isset( $attributes[ $key ] ) ? $attributes[ $key ] : '';
	}

	/**
	 * Set the attributes.
	 *
	 * @param string[] $attributes The attributes.
	 *
	 * @return static
	 */
	public function set_attributes( array $attributes ): self {
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Add or modify an attribute.
	 *
	 * @param string $key   The key.
	 * @param string $value The value.
	 *
	 * @return static
	 */
	public function set_attribute( string $key, string $value = '' ): self {
		$this->attributes[ $key ] = $value;
		return $this;
	}

	/**
	 * Add, modify or append attributes.
	 *
	 * @param string[] $attributes The attributes key value pair.
	 *
	 * @return static
	 */
	public function add_attributes( array $attributes ): self {
		$this->attributes = array_merge( $this->attributes, $attributes );
		return $this;
	}
}

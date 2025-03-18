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
	 * Add or modify attributes.
	 *
	 * @param string $key   The key.
	 * @param string $value The value.
	 *
	 * @return static
	 */
	public function add_attributes( string $key, string $value = '' ): self {
		$this->attributes[ $key ] = $value;
		return $this;
	}

	/**
	 * Append attributes.
	 *
	 * @param string[] $attributes The attributes key value pair.
	 *
	 * @return static
	 */
	public function append_attributes( array $attributes ): self {
		$this->attributes = array_merge( $this->attributes, $attributes );
		return $this;
	}
}

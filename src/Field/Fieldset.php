<?php
/**
 * The Fieldset class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Fieldset class.
 */
class Fieldset {

	/**
	 * The slug.
	 *
	 * @var string $slug
	 */
	private $slug;

	/**
	 * The title.
	 *
	 * @var string $title
	 */
	private $title;

	/**
	 * The description.
	 *
	 * @var string $description
	 */
	private $description;

	/**
	 * The fields.
	 *
	 * @var BaseField[] $fields
	 */
	private $fields = array();

	/**
	 * Initiate class.
	 *
	 * @param string $slug The slug.
	 */
	public function __construct( string $slug ) {

		// Set the required values.
		$this->set_slug( $slug );
	}

	/**
	 * Get the slug.
	 *
	 * @return string|null
	 */
	public function get_slug(): ?string {
		return $this->slug;
	}

	/**
	 * Set the slug.
	 *
	 * @param string $slug the slug.
	 *
	 * @return self
	 */
	public function set_slug( string $slug ): self {
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get the title.
	 *
	 * @return string|null
	 */
	public function get_title(): ?string {
		return $this->title;
	}

	/**
	 * Set the title.
	 *
	 * @param string $title The title.
	 *
	 * @return self
	 */
	public function set_title( string $title ): self {
		$this->title = $title;
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
	 * Get the fields.
	 *
	 * @return BaseField[]
	 */
	public function get_fields(): array {
		return $this->fields;
	}

	/**
	 * Set the fields.
	 *
	 * @param BaseField[] $fields the field.
	 *
	 * @return self
	 */
	public function set_fields( array $fields ): self {
		$this->fields = $fields;
		return $this;
	}

	/**
	 * Add or append the field.
	 *
	 * @param BaseField $field the field.
	 *
	 * @return self
	 */
	public function add_fields( BaseField $field ): self {
		$this->fields[] = $field;
		return $this;
	}
}

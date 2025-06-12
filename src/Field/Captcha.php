<?php
/**
 * The re-captcha field class file.
 *
 * @package    Mazepress\Html
 * @subpackage Field
 */

declare(strict_types=1);

namespace Mazepress\Html\Field;

use Mazepress\Html\Field\BaseField;

/**
 * The Captcha class.
 */
class Captcha extends BaseField {

	/**
	 * The public key.
	 *
	 * @var string $public_key
	 */
	private $public_key;

	/**
	 * Initiate class.
	 *
	 * @param string $public_key The API public key.
	 */
	public function __construct( string $public_key ) {

		// Set the required values.
		$this->set_public_key( $public_key );
		$this->set_name( 'captcha' );
		$this->set_value( '' );
		$this->set_type( 'captcha' );
	}

	/**
	 * Render the input field.
	 *
	 * @return void
	 */
	public function render(): void {

		$html = sprintf( '<div class="g-recaptcha" data-sitekey="%s"></div>', $this->get_public_key() );
		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Set the button text.
	 *
	 * @param string $text The button text.
	 *
	 * @return self
	 */
	public function set_public_key( string $text ): self {
		$this->public_key = $text;
		return $this;
	}

	/**
	 * Get the button text.
	 *
	 * @return string
	 */
	public function get_public_key(): string {
		return $this->public_key;
	}
}

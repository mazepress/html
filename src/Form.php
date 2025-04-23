<?php
/**
 * The Form class file.
 *
 * @package Mazepress\Html
 */

declare(strict_types=1);

namespace Mazepress\Html;

use Mazepress\Html\Field\BaseField;
use Mazepress\Html\Field\Input;
use Mazepress\Html\Field\Textarea;
use Mazepress\Html\Field\Button;
use Mazepress\Html\Field\Label;
use Mazepress\Html\Field\Editor;
use Mazepress\Html\Field\Pages;
use Mazepress\Html\Field\Taxonomy;
use Mazepress\Html\Field\Select;
use Mazepress\Html\Field\Checkbox;
use Mazepress\Html\Field\Dynamic;
use Mazepress\Html\Field\Radio;

/**
 * The Form class.
 */
class Form {

	/**
	 * Render form start.
	 *
	 * @param string   $action The form action.
	 * @param string   $method The form method.
	 * @param string[] $attrs  The form attributes.
	 *
	 * @return void
	 */
	public static function start( string $action = '', string $method = 'post', array $attrs = array() ): void {

		$attributes = array();

		foreach ( $attrs as $key => $value ) {
			$attributes[] = sprintf( '%1$s="%2$s"', $key, $value );
		}

		$html = sprintf(
			'<form action="%1$s" method="%2$s" %3$s>',
			esc_attr( $action ),
			esc_attr( $method ),
			implode( ' ', $attributes )
		);

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Render form start.
	 *
	 * @param string $action  The action name.
	 * @param string $wpnonce The action hidden field name.
	 *
	 * @return void
	 */
	public static function end( string $action = '', string $wpnonce = '_wpnonce' ): void {

		if ( ! empty( $action ) ) {
			wp_nonce_field( $action, $wpnonce );
			self::hidden( 'action', $action )->render();
		}

		echo '</form>'; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Render form label.
	 *
	 * @param string $label The label.
	 *
	 * @return Label
	 */
	public static function label( string $label ): Label {
		return new Label( $label );
	}

	/**
	 * Render form button.
	 *
	 * @param string $name  The name.
	 * @param string $label The label.
	 * @param string $value The value.
	 * @param string $type  The type.
	 *
	 * @return Button
	 */
	public static function button(
		string $name,
		string $label,
		string $value = '',
		string $type = 'submit'
	): Button {
		return new Button( $name, $label, $value, $type );
	}

	/**
	 * Render form input.
	 *
	 * @param string $name  The name.
	 * @param string $value The value.
	 * @param string $type  The type.
	 *
	 * @return Input
	 */
	public static function input( string $name, string $value = '', string $type = 'text' ): Input {
		return new Input( $name, $value, $type );
	}

	/**
	 * Render form text.
	 *
	 * @param string $name  The name.
	 * @param string $value The value.
	 *
	 * @return Input
	 */
	public static function text( string $name, string $value = '' ): Input {
		return new Input( $name, $value, 'text' );
	}

	/**
	 * Render form hidden.
	 *
	 * @param string $name  The name.
	 * @param string $value The value.
	 *
	 * @return Input
	 */
	public static function hidden( string $name, string $value = '' ): Input {
		return new Input( $name, $value, 'hidden' );
	}

	/**
	 * Render form password.
	 *
	 * @param string $name The name.
	 *
	 * @return Input
	 */
	public static function password( string $name ): Input {
		return new Input( $name, '', 'password' );
	}

	/**
	 * Render form number.
	 *
	 * @param string $name  The name.
	 * @param int    $value The value.
	 * @param int    $min   The minimum value.
	 * @param int    $max   The maximum value.
	 * @param int    $step  The step value.
	 *
	 * @return Input
	 */
	public static function number(
		string $name,
		int $value = 0,
		int $min = 0,
		int $max = 10000,
		int $step = 1
	): Input {
		return ( new Input( $name, (string) $value, 'number' ) )
			->add_attributes(
				array(
					'min'  => (string) $min,
					'max'  => (string) $max,
					'step' => (string) $step,
				)
			);
	}

	/**
	 * Render form textarea.
	 *
	 * @param string $name  The name.
	 * @param string $value The value.
	 *
	 * @return Textarea
	 */
	public static function textarea( string $name, string $value = '' ): Textarea {
		return new Textarea( $name, $value );
	}

	/**
	 * Render form editor.
	 *
	 * @param string $name  The name.
	 * @param string $value The value.
	 *
	 * @return Editor
	 */
	public static function editor( string $name, string $value = '' ): Editor {
		return new Editor( $name, $value );
	}

	/**
	 * Render form pages dropdown.
	 *
	 * @param string $name       The name.
	 * @param int    $value      The value.
	 * @param string $empty_text The empty text.
	 *
	 * @return Pages
	 */
	public static function pages(
		string $name,
		int $value = 0,
		string $empty_text = ''
	): Pages {
		return ( new Pages( $name, $value ) )->set_empty_text( $empty_text );
	}

	/**
	 * Render form taxonomy dropdown.
	 *
	 * @param string $taxonomy   The taxonomy name.
	 * @param string $name       The name.
	 * @param string $value      The value.
	 * @param string $empty_text The empty text.
	 *
	 * @return Taxonomy
	 */
	public static function taxonomy(
		string $taxonomy,
		string $name,
		string $value = '',
		string $empty_text = ''
	): Taxonomy {
		return ( new Taxonomy( $taxonomy, $name, $value ) )->set_empty_text( $empty_text );
	}

	/**
	 * Render form select dropdown.
	 *
	 * @param string       $name       The field name.
	 * @param mixed        $value      The value.
	 * @param array<mixed> $options    The options.
	 * @param string       $empty_text The empty text.
	 *
	 * @return Select
	 */
	public static function select(
		string $name,
		$value = null,
		array $options = array(),
		string $empty_text = ''
	): Select {
		return ( new Select( $name, $value ) )
			->set_options( $options )
			->set_empty_text( $empty_text );
	}

	/**
	 * Render form checkbox.
	 *
	 * @param string       $name    The field name.
	 * @param mixed        $value   The value.
	 * @param array<mixed> $options The options.
	 *
	 * @return Checkbox
	 */
	public static function checkbox(
		string $name,
		$value = null,
		array $options = array()
	): Checkbox {
		return ( new Checkbox( $name, $value ) )->set_options( $options );
	}

	/**
	 * Render form radio.
	 *
	 * @param string       $name    The field name.
	 * @param mixed        $value   The value.
	 * @param array<mixed> $options The options.
	 *
	 * @return Radio
	 */
	public static function radio(
		string $name,
		$value = null,
		array $options = array()
	): Radio {
		return ( new Radio( $name, $value ) )->set_options( $options );
	}

	/**
	 * Render dynamic field.
	 *
	 * @param string       $name   The field name.
	 * @param array<mixed> $value  The value.
	 * @param string       $button The options.
	 *
	 * @return Dynamic
	 */
	public static function dynamic(
		string $name,
		$value = array(),
		string $button = ''
	): Dynamic {
		return ( new Dynamic( $name, $value ) )->set_button_text( $button );
	}

	/**
	 * Render the form group.
	 *
	 * @param BaseField  $field       The field.
	 * @param Label|null $label       The label.
	 * @param string     $description The field description.
	 * @param string     $group_class The form group class.
	 * @param string     $field_class The form field class.
	 *
	 * @return void
	 */
	public static function group(
		BaseField $field,
		?Label $label = null,
		string $description = '',
		$group_class = 'form-group',
		$field_class = 'form-control'
	): void {

		printf(
			'<div class="%1$s">',
			esc_attr( $group_class )
		);

		if ( ! empty( $label ) ) {
			$id  = ! empty( $field->get_attribute( 'id' ) ) ? $field->get_attribute( 'id' ) : $field->get_name();
			$for = ! empty( $field->get_attribute( 'for' ) ) ? $field->get_attribute( 'for' ) : $id;
			$label->set_attribute( 'for', $for )->render();
		}

		$calss  = $field->get_attribute( 'class' );
		$calss .= ! empty( $calss ) ? ' ' . $field_class : $field_class;

		$field->set_attribute( 'class', $calss )->render();

		if ( ! empty( $description ) ) {
			printf(
				'<small class="form-text text-muted">%1$s</small>',
				esc_html( $description )
			);
		}

		echo '</div>';
	}
}

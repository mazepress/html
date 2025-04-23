<?php
/**
 * The FormTest class file.
 *
 * @package    Mazepress\Html
 * @subpackage Tests\Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Helper;

use WP_Mock\Tools\TestCase;
use Mazepress\Html\Form;
use WP_Mock;

/**
 * The FormTest class.
 *
 * @group Forms
 */
class FormTest extends TestCase {

	/**
	 * Test start function.
	 *
	 * @return void
	 */
	public function test_start(): void {

		Form::start( 'test', 'get', array( 'class' => 'test-class' ) );
		$this->expectOutputString( '<form action="test" method="get" class="test-class">' );
	}

	/**
	 * Test end function.
	 *
	 * @return void
	 */
	public function test_end(): void {

		WP_Mock::passthruFunction( 'wp_nonce_field' );
		Form::end( 'testaction' );

		$this->expectOutputString( '<input type="hidden" name="action" value="testaction" /></form>' );
	}

	/**
	 * Test label function.
	 *
	 * @return void
	 */
	public function test_label(): void {

		Form::label( 'Test Label' )->set_attributes( array( 'class' => 'test-class' ) )->render();

		$this->expectOutputString( '<label class="test-class">Test Label</label>' );
	}

	/**
	 * Test button function.
	 *
	 * @return void
	 */
	public function test_button(): void {

		Form::button( 'submit', 'Test Label', 'dosubmit', 'button' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			'<button type="button" name="submit" value="dosubmit" class="test-class">Test Label</button>'
		);
	}

	/**
	 * Test input function.
	 *
	 * @return void
	 */
	public function test_input(): void {

		$field = Form::input( 'testname', 'testvalue', 'text' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->add_attributes( array( 'id' => 'test-id' ) )
			->set_attribute( 'disabled', '1' );

		$field->render();

		$this->expectOutputString(
			'<input type="text" name="testname" value="testvalue" class="test-class" id="test-id" disabled="1"/>'
		);

		$this->assertEquals( 'test-id', $field->get_attribute( 'id' ) );
	}

	/**
	 * Test text function.
	 *
	 * @return void
	 */
	public function test_text(): void {

		Form::text( 'testname', 'testvalue' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			'<input type="text" name="testname" value="testvalue" class="test-class"/>'
		);
	}

	/**
	 * Test password function.
	 *
	 * @return void
	 */
	public function test_password(): void {

		Form::password( 'testname' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			'<input type="password" name="testname" value="" class="test-class"/>'
		);
	}

	/**
	 * Test number function.
	 *
	 * @return void
	 */
	public function test_number(): void {

		Form::number( 'testname', 5 )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			'<input type="number" name="testname" value="5" class="test-class"/>'
		);
	}

	/**
	 * Test textarea function.
	 *
	 * @return void
	 */
	public function test_textarea(): void {

		Form::textarea( 'testname', 'testvalue' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			'<textarea name="testname" class="test-class" rows="4">testvalue</textarea>'
		);
	}

	/**
	 * Test editor function.
	 *
	 * @return void
	 */
	public function test_editor(): void {

		WP_Mock::passthruFunction( 'get_option' );
		WP_Mock::passthruFunction( 'wp_kses_post' );
		WP_Mock::passthruFunction( 'sanitize_title' );
		WP_Mock::echoFunction( 'wp_editor' );
		Form::editor( 'testname', 'testvalue' )->render();

		$this->expectOutputString( 'testvalue' );
	}

	/**
	 * Test pages function.
	 *
	 * @return void
	 */
	public function test_pages(): void {

		WP_Mock::passthruFunction( 'wp_dropdown_pages' );
		Form::pages( 'testname', 1, 'Select' )->render();

		$this->expectOutputString( '' );
	}

	/**
	 * Test taxonomy function.
	 *
	 * @return void
	 */
	public function test_taxonomy(): void {

		WP_Mock::passthruFunction( 'wp_dropdown_categories' );
		Form::taxonomy( 'taxonomy', 'testname', 'texttax', 'Select' )->render();

		$this->expectOutputString( '' );
	}

	/**
	 * Test select function.
	 *
	 * @return void
	 */
	public function test_select(): void {

		Form::select( 'test', 1, array( 1 => 'Option 1' ), 'Select' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<select name="test" class="test-class"><option value="">Select</option><option selected  value="1">Option 1</option></select>'
		);
	}

	/**
	 * Test select function.
	 *
	 * @return void
	 */
	public function test_select_multiple(): void {

		Form::select(
			'test',
			array( 1, 2 ),
			array(
				1 => 'Option 1',
				2 => array(
					'text'  => 'Option 2',
					'extra' => '3',
				),
			),
			'Select'
		)->set_attributes( array( 'multiple' => 'multiple' ) )->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<select name="test" multiple="multiple"><option value="">Select</option><option selected  value="1">Option 1</option><option selected data-extra="3" value="2">Option 2</option></select>'
		);
	}

	/**
	 * Test checkbox function.
	 *
	 * @return void
	 */
	public function test_checkbox(): void {

		WP_Mock::passthruFunction( 'wp_kses_post' );

		Form::checkbox( 'test', 1, array( 1 => 'Option 1' ) )
			->set_attributes(
				array(
					'class' => 'test-class',
					'id'    => 'test-id',
				)
			)
			->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label form-checkbox"><input type="checkbox" name="test" checked class="test-class" id="test-id-1" value="1"/>Option 1<span class="form-check-icon checked"></span></label>'
		);
	}

	/**
	 * Test checkbox function.
	 *
	 * @return void
	 */
	public function test_checkbox_multiple(): void {

		WP_Mock::passthruFunction( 'wp_kses_post' );

		Form::checkbox(
			'test',
			array( 1, 2 ),
			array(
				1 => 'Option 1',
				2 => array(
					'text'  => 'Option 2',
					'extra' => '3',
				),
			)
		)->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label form-checkbox"><input type="checkbox" name="test[]" checked   value="1"/>Option 1<span class="form-check-icon checked"></span></label><label class="form-check-label form-checkbox"><input type="checkbox" name="test[]" checked  data-extra="3" value="2"/>Option 2<span class="form-check-icon checked"></span></label>'
		);
	}

	/**
	 * Test radio function.
	 *
	 * @return void
	 */
	public function test_radio(): void {

		WP_Mock::passthruFunction( 'wp_kses_post' );

		Form::radio( 'test', 1, array( 1 => 'Option 1' ) )
			->set_attributes(
				array(
					'class' => 'test-class',
					'id'    => 'test-id',
				)
			)
			->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label form-radio"><input type="radio" name="test" checked class="test-class" id="test-id-1" value="1"/>Option 1<span class="form-check-icon checked"></span></label>'
		);
	}

	/**
	 * Test radio function.
	 *
	 * @return void
	 */
	public function test_radio_multiple(): void {

		WP_Mock::passthruFunction( 'wp_kses_post' );

		Form::radio(
			'test',
			array( 1, 2 ),
			array(
				1 => 'Option 1',
				2 => array(
					'text'  => 'Option 2',
					'extra' => '3',
				),
			)
		)->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label form-radio"><input type="radio" name="test" checked   value="1"/>Option 1<span class="form-check-icon checked"></span></label><label class="form-check-label form-radio"><input type="radio" name="test" checked  data-extra="3" value="2"/>Option 2<span class="form-check-icon checked"></span></label>'
		);
	}

	/**
	 * Test dynamic function.
	 *
	 * @return void
	 */
	public function test_dynamic(): void {

		Form::dynamic( 'test', array( 1 => 'Option 1' ) )
			->set_button_text( 'Add Item' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->render();

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<div class="dynamic-block"><div class="dynamic-items"><p class="dynamic-item"><input type="text" name="test" value="Option 1" class="test-class" id="dynamic-field-1"/><a type="button" class="button dynamic-remove"><span class="dashicons-before dashicons-trash"></span></a></p></div><div class="dynamic-clone" style="display:none;" data-count="2"><p class="dynamic-item"><input type="text" name="test" value="" class="test-class" id="dynamic-field-1"/><a type="button" class="button dynamic-remove"><span class="dashicons-before dashicons-trash"></span></a></p></div><p><a type="button" class="button dynamic-add"><span class="dashicons-before dashicons-plus"></span> Add Item</a></p></div>'
		);
	}

	/**
	 * Test group function.
	 *
	 * @return void
	 */
	public function test_group(): void {

		Form::group(
			Form::input( 'testname', 'testvalue', 'text' ),
			Form::label( 'Test Label' ),
			'This field is mandatory'
		);

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<div class="form-group"><label for="field-testname">Test Label</label><input type="text" name="testname" value="testvalue" id="field-testname" class="form-control"/><small class="form-text text-muted">This field is mandatory</small></div>'
		);
	}

	/**
	 * Test group function.
	 *
	 * @return void
	 */
	public function test_group_without_label(): void {

		Form::group( Form::input( 'testname', 'testvalue', 'text' ) );

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<div class="form-group"><input type="text" name="testname" value="testvalue" id="field-testname" class="form-control"/></div>'
		);
	}

	/**
	 * Test group function.
	 *
	 * @return void
	 */
	public function test_group_custom(): void {

		$field = Form::input( 'testname', 'testvalue', 'text' )
			->set_attributes( array( 'class' => 'test-class' ) )
			->add_attributes( array( 'id' => 'test-id' ) );

		$label = Form::label( 'Test Label' );

		Form::group( $field, $label, 'This field is mandatory', 'test-group' );

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<div class="form-group test-group"><label for="test-id">Test Label</label><input type="text" name="testname" value="testvalue" class="form-control test-class" id="test-id"/><small class="form-text text-muted">This field is mandatory</small></div>'
		);
	}
}

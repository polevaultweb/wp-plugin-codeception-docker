<?php

use Codeception\Module\ModuleWait;
use Codeception\Scenario;
use PHPUnit\Framework\Assert;


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

	public function __construct( Scenario $scenario ) {
		parent::__construct( $scenario );
		$this->login();
		$this->amOnPluginsPage();
		$this->activatePlugin( 'wp-plugin-codeception-docker' );
	}

	/**
	 * Check if text exists on page to be used in a conditional.
	 *
	 * @param $text
	 *
	 * @return bool
	 */
	public function seeOnPage( $text ) {
		try {
			$this->see( $text );
		} catch ( \PHPUnit\Framework\ExpectationFailedException $f ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if text exists on page to be used in a conditional.
	 *
	 * @param $text
	 *
	 * @return bool
	 */
	public function cantSeeOnPage( $text ) {
		try {
			$this->see( $text );
		} catch ( \PHPUnit\Framework\ExpectationFailedException $f ) {
			return true;
		}

		return false;
	}
}

<?php

function add_are_you_human(&$known_verifications)
{
	$known_verifications[] = 'areyouhuman';
	loadLanguage('Areyouhuman');
}

class Control_Verification_Areyouhuman implements Control_Verifications
{
	private $_options = null;
	private $_checked = false;
	private $_tested = false;

	public function __construct($verificationOptions = null)
	{
		if (!empty($verificationOptions))
			$this->_options = $verificationOptions;
	}
		
	public function showVerification($isNew, $force_refresh = true)
	{
		global $modSettings;

		$this->_tested = false;

		return !empty($modSettings['configure_verification_areyouhuman_enable']);
	}

	public function createTest($refresh = true)
	{
		if ($refresh)
			$this->_checked = false;
		else
			$this->_checked = !empty($_POST['are_you_human']);
	}

	public function prepareContext()
	{
		loadTemplate('Areyouhuman');

		return array(
			'template' => 'areyouhuman',
			'values' => array(
				'value' => !empty($this->_checked),
				'is_error' => $this->_tested && !$this->_verifyAnswer(),
			)
		);
	}

	public function doTest()
	{
		$this->_tested = true;

		if (!$this->_verifyAnswer())
			return 'wrong_you_are_human';

		return true;
	}

	public function hasVisibleTemplate()
	{
		return true;
	}

	public function settings()
	{
		global $txt, $scripturl, $modSettings;

		// Visual verification.
		$config_vars = array(
			array('title', 'configure_verification_areyouhuman'),
			array('desc', 'configure_verification_areyouhuman_desc'),
			array('check', 'configure_verification_areyouhuman_enable'),
		);

		return $config_vars;
	}

	private function _verifyAnswer()
	{
		return !empty($_POST['are_you_human']);
	}
}


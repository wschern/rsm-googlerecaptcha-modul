<?php

/**
 * Contao Open Source CMS
 *
 *
 * @package   rsm-googlerecaptcha-modul
 * @author    Waldemar Schern <schern@werbeagentur-rsm.de>
 * @license   MIT
 * @copyright © 2018 Werbeagentur RSM. kommunikations-marketing GmbH | Nürnberg
 */


/**
 * Namespace
 */
namespace Rsm\RsmGooglerecaptchaModul\Captcha;


class FormRsmGoogleReCaptcha extends \Widget {

	/**
	 * The CSS class prefix
	 *
	 * @var string
	 */
	protected $strPrefix = 'widget widget-recaptcha';

	/**
	 * Template
	 *
	 * @var string
	 */
	protected $strTemplate = 'rsm_googlerecaptcha';

	/**
	 * ReCaptcha object
	 *
	 * @var ReCaptcha
	 */
	protected $reCaptcha;


	/**
	 * Initialize the object
	 *
	 * @param array $arrAttributes An optional attributes array
	 */
	public function __construct($arrAttributes=null)
	{
		parent::__construct($arrAttributes);

		$this->arrAttributes['required'] = true;
		$this->arrConfiguration['mandatory'] = true;

		if (TL_MODE == 'BE')
	    {
	      return;
	    }
				
		$this->reCaptcha = new ReCaptcha;
		
		// Get the reCAPTCHA keys from the root page settings 
		global $objPage;		
		$objRoot = \PageModel::findById($objPage->rootId);
		
		// Set public and private key

		// Test with this site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
		if(strlen($objRoot->rsm_public_key)){
			$this->reCaptcha->setPublicKey($objRoot->rsm_public_key);
		} 
		
		// Test with this secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
		if(strlen($objRoot->rsm_private_key)){
			$this->reCaptcha->setPrivateKey($objRoot->rsm_private_key);
		}
		
		// Set the remaining options
		if(strlen($this->tabindex)){
			$this->reCaptcha->setTabIndex($this->tabindex);	
		}
		if(strlen($this->rsm_type)){
			$this->reCaptcha->setType($this->rsm_type);	
		}
		if(strlen($this->rsm_size)){
			$this->reCaptcha->setSize($this->rsm_size);	
		}
		if(strlen($this->rsm_theme)){
			$this->reCaptcha->setTheme($this->rsm_theme);	
		}

	}


	/**
	 * Validate the input and set the value
	 */
	public function validate()
	{			
		$this->reCaptcha->check();

		if (!$this->reCaptcha->getValidation()) {
			$this->class = 'error';
			$this->addError($GLOBALS['TL_LANG']['ERR']['rsm_googlerecaptcha_modul']['default']);		    		    
		}

	}

	/**
	 * Generate the widget and return it as string
	 *
	 * @return string The widget markup
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
	    {
	      return;
	    }
	    
	    if(strlen($this->reCaptcha->getPrivateKey()) && strlen($this->reCaptcha->getPublicKey())) {
	    	return $this->reCaptcha->generate();	
	    } else {	    	
	    	return $GLOBALS['TL_LANG']['ERR']['rsm_googlerecaptcha_modul']['keys'];
	    }
		
	}

}

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


class ReCaptcha {

	/**
     * Public key
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Private key
     *
     * @var string
     */
    protected $privateKey;

    /**
     * reCAPTCHA validation flag
     *
     * @var bool
     */
    protected $validation = false;

    /**
     * Optional. The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.
     *
     * @var int
     */
    protected $dataTabindex = 0;

    /**
     * Optional. The type of CAPTCHA to serve.
     *
     * @var string
     */
    protected $dataType = 'image';

    /**
     * Optional. The size of the widget.
     *
     * @var string
     */
    protected $dataSize = 'normal';    

    /**
     * Optional. The color theme of the widget.
     *
     * @var string
     */
    protected $dataTheme = 'light';    

    /**
     * Set public key
     *
     * @param string $key
     * @return reCaptcha
     */
    public function setPublicKey($key)
    {
        $this->publicKey = $key;
        return $this;
    }

    /**
     * Set private key
     *
     * @param string $key
     * @return reCaptcha
     */
    public function setPrivateKey($key)
    {
        $this->privateKey = $key;
        return $this;
    }

    /**
     * Get public key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Get private key
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set validation flag
     *
     * @param bool $flag
     * @return ReCaptcha
     */
    protected function setValidation($flag)
    {
        $this->validation = $flag;
        return $this;
    }

    /**
     * Get validation flag
     *
     * @return bool
     */
    public function getValidation()
    {
        return $this->validation;
    }    

    /**
     * Set the tab index of reCAPTCHA
     *
     * @param int $index
     * @return ReCaptcha
     */
    public function setTabIndex($index)
    {
        if(is_numeric($index)){
            $this->dataTabindex = $index;
        }
        return $this;
    }

    /**
     * Set the type of reCAPTCHA
     *
     * @param string $type
     * @return ReCaptcha
     */
    public function setType($type)
    {
        $types = array('audio','image');

        if(in_array($type, $types)){
            $this->dataType = $type;
        }

        return $this;
    }

    /**
     * Set the size of reCAPTCHA
     *
     * @param string $size
     * @return ReCaptcha
     */
    public function setSize($size)
    {
        $sizes = array('compact','normal');

        if(in_array($size, $sizes)){
            $this->dataSize = $size;
        }

        return $this;
    }

    /**
     * Set the color theme of reCAPTCHA
     *
     * @param string $theme
     * @return ReCaptcha
     */
    public function setTheme($theme)
    {
        $themes = array('dark','light');

        if(in_array($theme, $themes)){
            $this->dataTheme = $theme;
        }

        return $this;
    }    

    /**
     * Check the user response from reCAPTCHA widget
     *
     * @return ReCaptcha
     */
    public function check()
    {
        if(isset($_POST["g-recaptcha-response"])) {
            $response = $this->request(
                array(
                    'secret' => $this->getPrivateKey(),
                    'response' => $_POST["g-recaptcha-response"]          
                )
            );
        }   
        
        $response = @json_decode($response,true);
        
        if(is_array($response) && isset($response['success']) && $response['success']) {
            $this->setValidation(true);
        } else {
            $this->setValidation(false);
        }
        
        return $this;     
    }

    /**
     * Send a validation request to reCAPTCHA server
     *
     * @param array $data
     * @return string
     */
    protected function request($data)
    {
        
        $data = http_build_query($data);        
        $response = @file_get_contents('https://www.google.com/recaptcha/api/siteverify?' . $data);      

        // if allow_url_fopen (file_get_contents) is not allowed on the web server make a curl request
        if($response === NULL || $response === FALSE) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,'https://www.google.com/recaptcha/api/siteverify?' . $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        }         

        return $response;
    }

    /**
     * Generate the reCAPTCHA widget
     *     
     * @return string
     */
    public function generate()
    {
        $str = '<script src="https://www.google.com/recaptcha/api.js?hl='.$GLOBALS['TL_LANGUAGE'].'" async defer></script>
                <div class="g-recaptcha" data-sitekey="'.$this->getPublicKey().'" data-tabindex="'.$this->dataTabindex.'" data-type="'.$this->dataType.'" data-size="'.$this->dataSize.'" data-theme="'.$this->dataTheme.'" ></div>';
        return $str;
    }

}

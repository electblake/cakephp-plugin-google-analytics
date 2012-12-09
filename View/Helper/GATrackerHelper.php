<?php
App::uses('AppHelper','View/Helper');
class GATrackerHelper extends AppHelper {

  var $gaq = array(
    'push' => array()
  );
  
	/**
	* Loadable construct, pass in locale settings
	* Fail safe locale to 'en_US'
	*/
	public function __construct(View $View, $settings = array()){
		App::uses('GoogleAnalyticsException', 'GoogleAnalytics.Lib');

		$this->_set($settings);
		$this->view = $View;
		$this->loadConfig();
		$this->init_gaq();
  	
		parent::__construct($View, $settings);
	}
	
	private function loadConfig() {
		try {
			Configure::load('googleanalytics');
			$this->config = Configure::read('GoogleAnalytics.Tracker');
		} catch (Exception $e) {
			SessionComponent::setFlash('Error loading configuration file googleanalytics.php');
		}
	}

	private function init_gaq($options = array()) {
  	
  	
  	$mode = $this->config['mode'];
  	$this->_gaq('push', array('_setAccount', $this->config['account']));
  	if ($mode != 'domain') {
    	$this->_gaq('push', array('_setDomainName', $this->config['domain']));	
  	}
  	
  	if ($mode == 'domains') {
    	$this->_gaq('push', array('_setAllowLinker', true));
  	}
  	
  	$this->_gaq('push', array('_trackPageview')); // by default, track a pageview on load yeo.
  	
	}
	
	/**
	 * Output the GoogleAnalytics tracking codeblock
	 */
	public function code($options = array()) {	  
	  if ($this->isDevUrl() and $this->config['allowDevUrl'] !== true) {
  	  return '';
	  } else {
    	$code = $this->element('code_tracker', $this->get_gaq());
    	return $this->view->Html->scriptBlock($code, array('safe' => false));  
	  }
	}
	
	private function isDevUrl($url = null) {
	  if (empty($url) or trim($url)) {
    	$url = $_SERVER['HTTP_HOST'];
	  }
    // should we include analytics?
    $array = array('.dev', '.local', '.code');
    foreach ($array as $a) {
      $l = strlen($a);
      if (substr($url, -$l) == $a) {
         return true;
      }
    }
    
    return false;
	}
	
	public function _gaq($method, $array = array()) {
  	
  	$this->gaq[$method][] = $array;
  	
	}
	
	private function get_gaq() {
  	return array('_gaq' => $this->gaq);
	}
	
	public function element($name, $options = array()) {
  	return $this->view->element($name, $options, array('plugin' => 'GoogleAnalytics'));
	}

}

?>
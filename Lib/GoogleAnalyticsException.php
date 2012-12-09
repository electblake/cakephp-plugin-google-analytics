<?php

class GoogleAnalyticsException extends CakeException {

	protected $_messageTemplate = 'Seems that config file googleanalytics.php is missing or misconfigured';

	public static function handle($error) {
    echo 'Oh noes! ' . $error->getMessage();
  }
}

?>
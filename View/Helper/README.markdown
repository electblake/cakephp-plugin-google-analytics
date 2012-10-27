# Install
* Copy .. `app/Plugin/GoogleAnalytics/View/Helper/googleanalytics.php.default` to `app/Config/googleanalytics.php`
* Edit details in `app/Config/googleanalytics.php` to suit your needs
* Make sure your `bootstrap.php` includes 
* include in your `AppController.php`   `public $helpers = array('GoogleAnalytics.GATracker');`
* in your Layout (or wheverever) include `echo $this->GATracker->code();` (putting in `<head>` is good)

# TODO
* Integrate core GoogleAnalytics Config in cakephp manor (vs. the include class used now inherited from oldness)


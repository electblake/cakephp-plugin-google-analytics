<?php
/**
 * The GoogleAnalytics Tracking Code Template
 * 
 * The if $includeTags is really never going to be true but it's there so my
 * editor still gives me sexy parsing of js.
 */
?>
<?php if (!empty($includeTags) and $includeTags === true) : ?>
<script type="text/javascript">
<?php endif; ?>
  var _gaq = _gaq || [];
<?php
  foreach ($_gaq as $method => $actions) {
    
    $_gaqRender[] = "\t"."/* Rendering ".ucwords($method)." Actions */";
    foreach ($actions as $action) {
      $_gaqRender[] = "\t".'_gaq.'.$method.'('.json_encode($action).');';
    }
  }
  
  if (!empty($_gaqRender) and count($_gaqRender)) {
    echo implode("\n", $_gaqRender);
  }
?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
<?php if (!empty($includeTags) and $includeTags === true) : ?>
</script>
<?php endif; ?>
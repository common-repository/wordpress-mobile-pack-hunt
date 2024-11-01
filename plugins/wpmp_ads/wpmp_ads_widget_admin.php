<?php

/*
Copyright (c) 2009 HUNT, James Pearce & friends, portions mTLD Top Level Domain Limited, ribot, Forum Nokia

This file is part of the WordPress Mobile Pack.

The WordPress Mobile Pack is Licensed under the Apache License, Version 2.0
(the "License"); you may not use this file except in compliance with the
License.

You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed
under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
CONDITIONS OF ANY KIND, either express or implied. See the License for the
specific language governing permissions and limitations under the License.
*/

?>
<?php /* We're not using Title field, because we don't show this as a widget */ 
/*
?>
<p>
  <label for="wpmp_ads_title"><?php _e('Titulo:', 'wpmp'); ?></label>
  <?php print wpmp_ads_option('wpmp_ads_title', '', 'widefat'); ?>
</p>
*/
/* We're not giving provider's options for our clients, just HuntMAds */
/*
<p>
  <label for="wpmp_ads_provider"><?php _e('Prov:', 'wpmp'); ?></label>
  <?php print wpmp_ads_option('wpmp_ads_provider'); ?>
</p>
*/
?>
<p>WordPress Mobile Pack + HUNT will need some configuration in order for the ads which display within your pages, to then show up in the HUNT reporting.<br>

Please visit us at @ <a href="http://www.huntmads.com/" target=”_new”>to set up your account</a> with HUNT if you haven’t yet.
</p>
<p>
  <label for="wpmp_ads_publisher_id"><?php _e('Site ID:', 'wpmp'); ?></label>
  <br />
  <?php print wpmp_ads_option('wpmp_ads_publisher_id', '', 'widefat'); ?>
  <br /><?php _e("1234 (HUNT Site ID)", 'wpmp'); ?>
</p>
<p>
  <label for="wpmp_ads_hunt_header_id"><?php _e('Header Zone ID:', 'wpmp'); ?></label>
  <br />
  <?php print wpmp_ads_option('wpmp_ads_hunt_header_id', '', 'widefat'); ?>
  <br /><?php _e("12345 (Header Zone ID provided by HUNT)", 'wpmp'); ?>
</p>
<p>
  <label for="wpmp_ads_hunt_footer_id"><?php _e('Footer Zone ID:', 'wpmp'); ?></label>
  <br />
  <?php print wpmp_ads_option('wpmp_ads_hunt_footer_id', '', 'widefat'); ?>
  <br /><?php _e("12345 (Footer Zone ID provided by HUNT)", 'wpmp'); ?>
</p>
<p>
  <?php print wpmp_ads_option('wpmp_ads_over_18'); ?>
  <label for="wpmp_ads_over_18"><?php _e('Display ads with content appropriate for age 18 and older', 'wpmp'); ?></label>
</p>
<p>
  <?php printf(__("This widget should only be used on mobile themes. If you are using a theme from, or derived from, the WordPress Mobile Pack, you will need to enable this widget <a%s>here</a>.", 'wpmp'), " href='".get_bloginfo('url')."/wp-admin/themes.php?page=wpmp_theme_widget_admin' target='_blank'"); ?>
</p>
<p>
  <?php print wpmp_ads_option('wpmp_ads_desktop_disable'); ?>
  <label for="wpmp_ads_desktop_disable"><?php _e('Attempt to automatically disable for desktop themes (when switcher is running)', 'wpmp'); ?></label>
</p>
<p>
  <?php _e('Note also that this widget will be completely hidden if no ads are returned from the provider you have selected.', 'wpmp'); ?>
</p>
<input type="hidden" id="wpmp_ads" name="wpmp_ads" value="1" />

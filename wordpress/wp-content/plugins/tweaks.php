<?php
/*
  Plugin Name: Sam's Tweaks
  Version:     0
  Description: any little addons to make wordpress work right
 */

add_filter( 'pre_http_request', '__return_true', 100 );

?>
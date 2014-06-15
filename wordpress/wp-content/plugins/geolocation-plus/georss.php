<?php
/* By Adrian Short http://adrianshort.org */
require('../../../wp-load.php');
require('../../../wp-admin/includes/plugin.php');

/* From http://code.garyjones.co.uk/get-wordpress-plugin-version/ */
// function geolocation_plus_version_number() {
//   $data = get_plugin_data( __FILE__ . "/../geolocation.php");
//   return $data['Name'] . " " . $data['Version'];
// }

function geolocation_plus_plugin_get_version() {
    if ( ! function_exists( 'get_plugins' ) )
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
    $plugin_file = "geolocation.php";
    return $plugin_folder[$plugin_file]['Name'] . " " . $plugin_folder[$plugin_file]['Version'];
}


header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
    <title><?php echo get_bloginfo('name') ?></title>
  	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
    <description><?php echo get_bloginfo('description') ?></description>
    <link><?php echo home_url("/") ?></link>
    <generator><?php echo geolocation_plus_plugin_get_version() ?></generator>
<?php

// Get all the published posts
$query = new WP_Query('post_type=post&post_status=publish&posts_per_page=-1');

while( $query->have_posts() ): $query->the_post();

  $lat = get_post_meta(get_the_ID(), 'geo_latitude', true);
  $lng = get_post_meta(get_the_ID(), 'geo_longitude', true);

  // Only output the posts that have got geodata
  if ($lat > '' && $lng > '') {
?>
    <item>
      <title><?php the_title_rss() ?></title>
      <link><?php the_permalink_rss() ?></link>
      <description><![CDATA[ <?php the_excerpt_rss() ?>]]></description>
      <georss:point><?php echo "$lat $lng" ?></georss:point>
      <guid isPermaLink="false"><?php the_guid(); ?></guid>
      <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
      <dc:creator><?php the_author() ?></dc:creator>
    </item>
<?php
  }
endwhile;

wp_reset_postdata();

?>
  </channel>
</rss>

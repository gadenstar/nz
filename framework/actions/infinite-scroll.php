<?php
/**
 * Load javascripts used by the theme
 */


function custom_theme_js() {
    global $mk_options;
    wp_register_script('infinite_scroll', get_stylesheet_directory_uri() . '/js/jquery-ias.min.js', array('jquery'), null, false);

    //wp_register_script('infinite_scroll', get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), null, true);
   // wp_register_script('infinite_scroll_behavior', get_stylesheet_directory_uri() . '/js/behaviors/manual-trigger.js', array('jquery','infinite_scroll'), null, true);
    if ( $mk_options['infinite-scroll'] == 'true' && !is_singular()) {
        wp_enqueue_script('infinite_scroll');
      //  wp_enqueue_script('infinite_scroll_behavior');
    }
}

add_action('wp_enqueue_scripts', 'custom_theme_js');

/**
 * Infinite Scroll
 */
function custom_infinite_scroll_js() {
    global $mk_options;
    if ($mk_options['infinite-scroll'] == 'true' && !is_singular() ) {
        ?>
        <script type="text/javascript">
           var ias = $.ias({
             container: "#icontent",
             item: ".post",
             pagination: "#navigation",
             next: "#navigation a",
             //delay: 600,
           });

           ias.extension(new IASTriggerExtension({
            offset: 2,
            }));
           ias.extension(new IASSpinnerExtension({
                // src: 'data:image/gif;base64,R0lGODlhEAALALMMAOXp8a2503CHtOrt9L3G2+Dl7vL0+J6sy4yew1Jvp/T2+e/y9v///wAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCwAMACwAAAAAEAALAAAEK5DJSau91KxlpObepinKIi2kyaAlq7pnCq9p3NZ0aW/47H4dBjAEwhiPlAgAIfkECQsADAAsAAAAAAQACwAABA9QpCQRmhbflPnu4HdJVAQAIfkECQsADAAsAAAAABAACwAABDKQySlSEnOGc4JMCJJk0kEQxxeOpImqIsm4KQPG7VnfbEbDvcnPtpINebJNByiTVS6yCAAh+QQJCwAMACwAAAAAEAALAAAEPpDJSaVISVQWzglSgiAJUBSAdBDEEY5JMQyFyrqMSMq03b67WY2x+uVgvGERp4sJfUyYCQUFJjadj3WzuWQiACH5BAkLAAwALAAAAAAQAAsAAAQ9kMlJq73hnGDWMhJQFIB0EMSxKMoiFcNQmKjKugws0+navrEZ49S7AXfDmg+nExIPnU9oVEqmLpXMBouNAAAh+QQFCwAMACwAAAAAEAALAAAEM5DJSau91KxlpOYSUBTAoiiLZKJSMQzFmjJy+8bnXDMuvO89HIuWs8E+HQYyNAJgntBKBAAh+QQFFAAMACwMAAIABAAHAAAEDNCsJZWaFt+V+ZVUBAA7', // optionally
                src: '<?php echo THEME_IMAGES; ?>', // optionally
                html: '<div class="ias-spinner" style="text-align: center;"><div><img src="{src}/ajax-loader.gif"/></div></div>'
            }));
           ias.extension(new IASNoneLeftExtension({
                text: '<div>You reached the end.</div>', // optionally
            }));

        </script>
        <?php
    }
}

add_action('wp_head', 'custom_infinite_scroll_js', 100);
?>

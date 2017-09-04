<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="wrap">
        <div class="contact">
            <a href="callto:0987654321">Call Us <span>0987654321</span></a>
            <a href="mailto:testdomain@gmail.to">Email <span>testdomain@gmail.to</span></a>
            <a href="#popup" class="callPopup">Contact Us</a>
        </div>
        <?php
        get_template_part( 'template-parts/footer/footer', 'widgets' );

        if ( has_nav_menu( 'social' ) ) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'social',
                    'menu_class'     => 'social-links-menu',
                    'depth'          => 1,
                    'link_before'    => '<span class="screen-reader-text">',
                    'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
                ) );
                ?>
            </nav><!-- .social-navigation -->
        <?php endif;

        get_template_part( 'template-parts/footer/site', 'info' );
        ?>
    </div><!-- .wrap -->
</footer><!-- #colophon -->
</div><!-- .site-content-contain -->
</div><!-- #page -->
<div class="popupWindow" id="popup" style="display:none;">
    <h2>Random text for popup window</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem fugit ipsa recusandae tempora voluptatem! Accusamus at delectus deleniti dolorum enim iure labore nam, nulla perferendis perspiciatis, placeat qui, quod voluptatem?</p>
</div>
<?php wp_footer(); ?>

</body>
</html>

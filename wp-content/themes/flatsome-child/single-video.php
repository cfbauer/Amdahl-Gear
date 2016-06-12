<?php
/**
 * The Template for displaying all single posts.
 *
 * @package flatsome
 */

get_header();

global $flatsome_opt;
if(!isset($flatsome_opt['blog_post_layout'])){$flatsome_opt['blog_post_layout'] = $flatsome_opt['blog_layout'];}

?>

<?php // Add blog header if set
if($flatsome_opt['blog_header']){ echo do_shortcode($flatsome_opt['blog_header']);}
?>

<?php
// Create big featured image if set
if($flatsome_opt['blog_post_style'] == 'big-featured-image') { ?>
  <div class="parallax-title">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php ob_start(); ?>
      <header class="entry-header text-center">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="tx-div small"></div>
        <?php if ( 'post' == get_post_type() ) : ?>
          <div class="entry-meta">
            <?php flatsome_posted_on(); ?>
          </div>
        <?php endif; ?>
      </header>
      <?php
      $bg = '#333';
      if( has_post_thumbnail() ) $bg = get_post_thumbnail_id();

      $header_html = ob_get_contents();
      $header_html = '[ux_banner animate="fadeInDown" bg_overlay="#000" parallax="3" parallax_text="2" height="360px" bg="'.$bg.'"]'.$header_html.'[/ux_banner]';

      ob_end_clean();
      echo do_shortcode($header_html);

      ?>
    <?php endwhile; // end of the loop. ?>
  </div>
<?php } ?>


  <div class="page-wrapper page-<?php echo $flatsome_opt['blog_post_layout']; ?>">
    <div class="row">

      <?php if($flatsome_opt['blog_post_layout'] == 'left-sidebar') {
        echo '<div id="content" class="large-9 right columns" role="main">';
      } else if($flatsome_opt['blog_post_layout'] == 'right-sidebar'){
        echo '<div id="content" class="large-9 left columns" role="main">';
      } else if($flatsome_opt['blog_post_layout'] == 'no-sidebar'){
        echo '<div id="content" class="large-12 columns" role="main">';
      } else {
        echo '<div id="content" class="large-9 left columns" role="main">';
      }
      ?>

      <div class="page-inner">
        <?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if($flatsome_opt['blog_post_style'] == 'default' || !isset($flatsome_opt['blog_post_style'])) { ?>
              <header class="entry-header text-center">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="tx-div small"></div>
              </header><!-- .entry-header -->


              <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
                <div class="entry-image">
                  <?php if($flatsome_opt['blog_parallax']) { ?><div class="parallax_img has-parallax" style="overflow:hidden"><div class="parallax_img_inner" data-velocity="0.15"><?php } ?>
                      <?php the_post_thumbnail('large'); ?>
                      <?php if($flatsome_opt['blog_parallax']) { ?></div></div><?php } ?>
                  <div class="post-date large">
                    <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
                    <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>

            <div class="entry-content">
              <?php the_content(); ?>
              <?php
              wp_link_pages( array(
                  'before' => '<div class="page-links">' . __( 'Pages:', 'flatsome' ),
                  'after'  => '</div>',
              ) );
              ?>
            </div><!-- .entry-content -->


            <?php if(isset($flatsome_opt['blog_share']) && $flatsome_opt['blog_share']) {
              // SHARE ICONS
              echo '<div class="blog-share text-center">';
              echo '<div class="tx-div medium"></div>';
              echo do_shortcode('[share]');
              echo '</div>';
            } ?>

            <footer class="entry-meta">
              <?php
              /* translators: used between list items, there is a space after the comma */
              $category_list = get_the_category_list( __( ', ', 'flatsome' ) );

              /* translators: used between list items, there is a space after the comma */
              $tag_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );


              // But this blog has loads of categories so we should probably display them here
              if ( '' != $tag_list ) {
                $meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'flatsome' );
              } else {
                $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'flatsome' );
              }


              printf(
                  $meta_text,
                  $category_list,
                  $tag_list,
                  get_permalink(),
                  the_title_attribute( 'echo=0' )
              );
              ?>

            </footer><!-- .entry-meta -->


          </article><!-- #post-## -->

        <?php endwhile; // end of the loop. ?>



      </div><!-- .page-inner -->
    </div><!-- #content -->

    <div class="large-3 columns left">
      <?php if($flatsome_opt['blog_post_layout'] == 'left-sidebar' || $flatsome_opt['blog_post_layout'] == 'right-sidebar'){
        get_sidebar();
      }?>
    </div><!-- end sidebar -->


  </div><!-- end row -->
  </div><!-- end page-wrapper -->


<?php get_footer(); ?>
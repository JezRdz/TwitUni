<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package abnomize
 */

?>

<div class="columns">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ) : ?>

<div class="card-flex-article card">
<?php abnomize_commentnumber(); ?> 
<div class="card-image">
     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail('abnomize-featured-image'); ?>
	</a>
<?php echo get_the_tag_list('<span class="card-tag"> ',' ','</span>'); ?>
  </div>
  <div class="card-section">
	<?php the_title( sprintf( '<h2 class="article-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    <div class="article-details">
      <span class="time"><?php echo abnomize_posted_on(); ?></span>
    </div>
    <p class="article-summary"><?php abnomize_excerpt('abnomize_excerptlength_index', 'abnomize_excerptmore'); ?></p>
  </div>
   <div class="card-divider align-middle">
     <div class="avatar with-add-icon">
	  <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )), get_the_author_meta( 'user_nicename' ) ); ?>"><?php  echo  the_author_meta('name') . get_avatar( get_the_author_meta('ID'), 45 ); ?>
      <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
	   
	   
     </div>
    <div class="user-info">
      <p class="user-name"><?php the_author(); ?></p>
	  
	  <footer class="entry-footer">
		<?php 
		/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'abnomize' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );
		
		if ( 'post' === get_post_type() ) {			
			
				if ( $categories_list && abnomize_categorized_blog() ) {
							echo '<p class="category">'. esc_html('added to ','abnomize') . wp_kses_post($categories_list) . '</p>';
						}
				
		} 
		?>
	</footer><!-- .entry-footer -->
    </div>
  </div>
</div>
<?php else : ?>

<div class="card-flex-article card">
	<?php abnomize_commentnumber(); ?> 

<div class="card-image nothumb">
     
<?php echo get_the_tag_list('<span class="card-tag"> ',' ','</span>'); ?>
  </div>
  <div class="card-section">
	<?php the_title( sprintf( '<h2 class="article-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    <div class="article-details">
      <span class="time"><?php echo abnomize_posted_on(); ?></span>
    </div>
    <p class="article-summary"><?php abnomize_excerpt('abnomize_excerptlength_index', 'abnomize_excerptmore'); ?></p>
  </div>
   <div class="card-divider align-middle">
     <div class="avatar with-add-icon">
	  <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )), get_the_author_meta( 'user_nicename' ) ); ?>"><?php  echo  the_author_meta('name') . get_avatar( get_the_author_meta('ID'), 45 ); ?>
      <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
	   
	   
     </div>
    <div class="user-info">
      <p class="user-name"><?php the_author(); ?></p>
	  
	  <footer class="entry-footer">
		<?php 
		/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'abnomize' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );
		
		if ( 'post' === get_post_type() ) {			
			
				if ( $categories_list && abnomize_categorized_blog() ) {
							echo '<p class="category">'. esc_attr('added to ','abnomize') . wp_kses_post($categories_list) . '</p>';
						}
				
		} 
		?>
	</footer><!-- .entry-footer -->
    </div>
  </div>
</div>

<?php endif; ?>

</article><!-- #post-## -->
</div>
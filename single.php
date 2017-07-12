<?php
/**
 * The Template for displaying all single Kitten posts.
 * It's just a copy of single.php modified to show kittney stuff.
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">			

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<!-- The kitten name -->
						<h1 class="entry-title"><?php the_title(); ?></h1>
					
						<!-- grabbing the custom thumbnail "kittens-single" for this kitten -->
						<?php echo get_the_post_thumbnail($page->ID, 'course-single'); ?>

						<!-- Output of all our kitten Custom Taxonomies -->
						<div class="entry-meta">
							<?php the_terms( $post->ID, 'type', '<strong>Type :</strong> ', ', ', ' ' ); ?><br />
							<?php the_terms( $post->ID, 'publisher', '<strong>Publisher :</strong> ', ', ', ' ' ); ?><br />
							 <strong>Author : </strong><?php echo esc_html( get_post_meta( get_the_ID(), '_names_list', true ) ); ?>
						</div><!-- .entry-meta -->
						
					</header><!-- .entry-header -->

					<div class="course-excerpt">									
						<!-- Displays The Excerpt -->
						<?php the_excerpt(); ?>
					</div>
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>


		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
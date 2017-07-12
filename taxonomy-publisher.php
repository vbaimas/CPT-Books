<?php
/**
 * The template for displaying our Custom Taxonomy "Colors".
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

				<header>
					<h1 class="page-title">
						
						Publisher : <?php single_cat_title(); ?>
					</h1>
				</header><!-- .page-header -->
			
				<ul id="books-list" class="clearfix">

				<!-- Here is the loop that displays product matching the taxonomy's term -->
				<?php while ( have_posts() ) : the_post(); ?>

					<li>
						<div class="books-thumbnail">
							<!-- Displays the custom thumbnail size "product-thumb" -->
							<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($page->ID, 'books-thumb'); ?></a>

							<!-- Displays the product name -->
							<h3><?php the_title(); ?></h3>
							 <strong>Instructor : </strong><?php echo esc_html( get_post_meta( get_the_ID(), '_names_list', true ) ); ?>
							<div class="books-excerpt">									
								<!-- Displays The Excerpt -->
								<?php the_excerpt(); ?>
							</div>

							<!-- "View Kitten" button that links to the single Kitten post -->
							<a href="<?php the_permalink() ?>" rel="bookmark" class="books-link" title="<?php the_title_attribute(); ?>">View book</a>
						</div>
					</li>	

				<?php endwhile; ?>
				
				</ul>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
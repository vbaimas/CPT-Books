<?php
/*
Template Name: Books
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div id="books-container">
				<!-- start the courses CPT Query and loop -->
				
				<!-- The courses Wp_Query and array  -->
				<?php $booksloop = new WP_Query (array ('post_type' => 'wcp_books', 'order' => 'ASC' ) ); ?>
					<!-- Stuff before the loop  -->
					<ul id="books-list" class="clearfix">
					<!-- Loop starts! -->
					<?php while ($booksloop->have_posts()) : $booksloop->the_post(); ?>
						<li>
							<div class="books-thumbnail">
								<!-- Displays the custom thumbnail size "courses-thumb" -->
								<a href="<?php the_permalink() ?>">
									<?php echo get_the_post_thumbnail($page->ID, 'books-thumb'); ?>
								</a>

								<!-- Displays the course name -->
								<h3><?php the_title(); ?></h3>
								<!-- Displays the names of Leaders -->
								<span> Author: <?php echo esc_html( get_post_meta( get_the_ID(), '_names_list', true ) ); ?></span>
								
								<div class="books-excerpt">	
															
									<!-- Displays The Excerpt -->
									<?php the_excerpt(); ?>
									

								</div>

								<!-- "View Kitten" link that links to the single Kitten post -->
								<a href="<?php the_permalink() ?>" rel="bookmark" class="books-link" title="<?php the_title_attribute(); ?>">View book</a>
							</div>
						</li>	
					<?php endwhile;  ?>	
					<?php wp_reset_postdata();?>
					<!-- Loop ends -->
					
					</ul>
			</div>  <!-- #books-container -->
		</div><!-- #content -->
	</div><!-- #primary -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
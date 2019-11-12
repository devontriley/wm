<?php 
/*Template Name: All Topics Listing */
get_header(); 
$tag_groups = false;
if ( function_exists( 'tag_groups_cloud' ) ) {
	$tag_groups = tag_groups_cloud( array( 'orderby' => 'name', 'order' => 'ASC' ), true );
}
$all_tags = WMHelper::getTerms( array('number' => false, 'orderby' => 'name', 'order' => 'ASC') );
$tags_alpha_sorted = array();
if($all_tags['total'] > 0){
	foreach($all_tags['terms'] as $term){
		$first_letter = strtolower(substr($term->name, 0, 1)) ;
		$tags_alpha_sorted[$first_letter][] = $term;
	}	
}
?>

<div class="boxed">
	<!---Boxed-->
	<div class="sm-wrapp">
		<h2 class="section_heading"><?php _e('All Topics'); ?></h2>
		<div class="tabs-me full-w wm-archive-tabs">
			<span class="tabs_links_lbl"><?php _e('View By:'); ?></span>
			<span class="tabs-links">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true"><?php _e('Category'); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="glossary-tab" data-toggle="tab" href="#glossary" role="tab" aria-controls="glossary" aria-selected="false"><?php _e('A - Z'); ?></a>
					</li>
				</ul>
			</span>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
					<?php if($tag_groups): ?>
					<?php $tgroup_count = count($tag_groups); ?>
					<?php $tgroup_half = (int) ceil($tgroup_count / 2); ?>
					<?php $tgroup_counter = 0; ?>
					<div class="row">
						<div class="col-sm-6">
							<?php foreach($tag_groups as $tag_group): ?>
								<div class="data-listing">
									<h2><?php echo $tag_group['name']; ?></h2>
									<?php if($tag_group['amount'] > 0): ?>
										<ul>
											<?php foreach($tag_group['tags'] as $tag): ?>
											<li><a href="<?php echo esc_attr($tag['link']); ?>"><?php echo $tag['name']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php else: ?>
										<?php _e( sprintf('No topic found for %s.', $tag_group['name']) ); ?>
									<?php endif; ?>
								</div>
								<?php 
								$tgroup_counter++;
								if($tgroup_counter === $tgroup_half){ //divide into 2 cols
									echo '</div><div class="col-sm-6">';
								}
								?>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="tab-pane fade" id="glossary" role="tabpanel" aria-labelledby="glossary-tab">
					<?php if(count($tags_alpha_sorted) > 0): ?>
					<?php $alpha_count = count($tags_alpha_sorted); ?>
					<?php $alpha_half = (int) ceil($alpha_count / 2); ?>
					<?php $alpha_counter = 0; ?>
					<div class="row">
						<div class="col-sm-6">
							<?php foreach($tags_alpha_sorted as $letter => $terms): ?>
								<div class="data-listing">
									<h2><?php echo ucfirst($letter); ?></h2>
									<?php if(count($terms) > 0): ?>
										<ul>
											<?php foreach($terms as $tag): ?>
											<li><a href="<?php echo esc_attr(get_term_link($tag, 'post_tag')); ?>"><?php echo $tag->name; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php else: ?>
										<?php _e( sprintf('No topic listed for %s.', ucfirst($letter)) ); ?>
									<?php endif; ?>
								</div>
								<?php 
								$alpha_counter++;
								if($alpha_counter === $alpha_half){ //divide into 2 cols
									echo '</div><div class="col-sm-6">';
								}
								?>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
	
<?php get_footer(); ?>
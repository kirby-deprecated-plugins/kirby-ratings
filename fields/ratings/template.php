<div class="ratings">
	<div class="ratings-info">
		<div class="ratings-preview">
			<?php snippet( 'rating-stars', array('page' => $page, 'size' => 'small') ); ?>
		</div>
		<strong><?php echo l::get('plugin.ratings.average', 'Rating'); ?>:</strong> <?php echo $page->ratingAverage(); ?>/5<br>
		<strong><?php echo l::get('plugin.ratings.count', 'Votes'); ?>:</strong> <?php echo $page->ratingCount(); ?>
	</div>

	<div class="ratings-delete">
		<a href="<?php echo u() . '/plugin.ratings.delete.blacklist/' . $page->id(); ?>" class="btn btn-rounded btn-submit btn-negative" onclick="return confirm('Delete blacklist?');" target="_top">
			<?php echo l::get('plugin.ratings.delete.blacklist', 'Delete blacklist'); ?>
		</a>
		<a href="<?php echo u() . '/plugin.ratings.delete.votes/' . $page->id(); ?>" class="btn btn-rounded btn-submit btn-negative" onclick="return confirm('Delete votes?');" target="_top">
			<?php echo l::get('plugin.ratings.delete.votes', 'Delete votes'); ?>
		</a>
	</div>
</div>

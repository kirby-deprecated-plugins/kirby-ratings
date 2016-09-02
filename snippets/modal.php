<div class="ratings-success">
	<div class="ratings-success-message">
		<?php echo l::get('plugin.ratings.success', 'You have voted!'); ?>
		<a class="ratings-success-close" href="<?php echo $page->uri(); ?>">Stäng</a>
	</div>
</div>

<div class="ratings-modal">
	<div class="ratings-form">
		<div class="ratings-fields" data-id="<?php echo $page->id(); ?>" data-secret="" data-value="">
			<div class="ratings-description"><?php echo l::get('plugin.ratings.vote.for', 'Vote for'); ?>:</div>
			<div class="ratings-title"></div>
			<span class="ratings-stars">
				<input type="radio" name="rating" value="1"><i></i>
				<input type="radio" name="rating" value="2"><i></i>
				<input type="radio" name="rating" value="3"><i></i>
				<input type="radio" name="rating" value="4"><i></i>
				<input type="radio" name="rating" value="5"><i></i>
			</span>


			<div class="ratings-vote">
				<span class="ratings-vote-value"></span> <?php echo l::get('plugin.ratings.stars', 'Stars'); ?>
			</div>

			<div class="ratings-submit">
				<?php echo l::get('plugin.ratings.send', 'Send'); ?>
			</div>
		</div>

		<div class="ratings-error">
			<?php echo l::get('plugin.ratings.not.rated', 'You have not rated!'); ?>
		</div>
	</div>
</div>

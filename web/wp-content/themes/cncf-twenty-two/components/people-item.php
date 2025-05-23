<?php
/**
 * People Block (includes Modal for each person)
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

// setup values.
global $wp;
global $post;
$person_id             = get_the_ID();
$person_slug           = $post->post_name;
$company               = get_post_meta( get_the_ID(), 'lf_person_company', true );
$company_logo_url      = get_post_meta( get_the_ID(), 'lf_person_company_logo_url', true );
$company_landscape_url = get_post_meta( get_the_ID(), 'lf_person_company_landscape_url', true );
$pronouns              = ucwords( get_post_meta( get_the_ID(), 'lf_person_pronouns', true ), $separators = " \t\r\n\f\v\\;/" );
$gb_role               = get_post_meta( get_the_ID(), 'lf_person_gb_role', true );
$toc_role              = get_post_meta( get_the_ID(), 'lf_person_toc_role', true );
$tab_role              = get_post_meta( get_the_ID(), 'lf_person_tab_role', true );
$linkedin              = get_post_meta( get_the_ID(), 'lf_person_linkedin', true );
$bluesky               = get_post_meta( get_the_ID(), 'lf_person_bluesky', true );
$twitter               = get_post_meta( get_the_ID(), 'lf_person_twitter', true );
$mastodon              = get_post_meta( get_the_ID(), 'lf_person_mastodon', true );
$github                = get_post_meta( get_the_ID(), 'lf_person_github', true );
$wechat                = get_post_meta( get_the_ID(), 'lf_person_wechat', true );
$website               = get_post_meta( get_the_ID(), 'lf_person_website', true );
$youtube               = get_post_meta( get_the_ID(), 'lf_person_youtube', true );
$certdirectory         = get_post_meta( get_the_ID(), 'lf_person_certdirectory', true );
$image_url             = get_post_meta( get_the_ID(), 'lf_person_image', true );
$location              = get_post_meta( get_the_ID(), 'lf_person_location', true );
$related_post          = get_post_meta( get_the_ID(), 'lf_related_post', true );
$languages             = get_the_terms( get_the_ID(), 'lf-language' );
$projects              = get_the_terms( get_the_ID(), 'lf-project' );
$content               = get_the_content();
$current_url           = home_url( 'people/ambassadors' );

$show_modal = isset( $args['show_profile'] ) && $args['show_profile'] ? true : false;
$show_logos = isset( $args['show_logos'] ) && $args['show_logos'] ? true : false;

$extra_classes = '';
if ( has_term( 'golden-kubestronaut', 'lf-person-category' ) ) {
	$extra_classes = 'golden-kubestronaut';
}
?>
<div class="person has-animation-scale-2<?php echo ' ' . esc_html( $extra_classes ); ?>">
	<?php
	// Make image link if show_modal.
	if ( $show_modal ) :
		?>
	<button data-modal-content-id="modal-<?php echo esc_html( $person_id ); ?>"
		data-modal-slug="<?php echo esc_html( $person_slug ); ?>"
		data-modal-prefix-class="person" class="js-modal button-reset">
		<?php endif; ?>

		<figure class="person__image">
			<img loading="lazy" src="<?php echo esc_attr( $image_url ); ?>"
				alt="Picture of <?php the_title_attribute(); ?>">
		</figure>

		<?php
		// Close show_modal link.
		if ( $show_modal ) :
			?>
	</button>
	<?php endif; ?>

	<div class="person__padding">

		<?php
		if ( $show_modal ) :
			?>
		<button
			data-modal-content-id="modal-<?php echo esc_html( $person_id ); ?>"
			data-modal-slug="<?php echo esc_html( $person_slug ); ?>"
			data-modal-prefix-class="person"
			class="js-modal button-reset modal-<?php echo esc_html( $person_slug ); ?>">
			<?php endif; ?>
			<h3 class="person__name">
				<?php the_title(); ?>
			</h3>
			<?php
			// Close show_modal link.
			if ( $show_modal ) :
				?>
		</button>
		<?php endif; ?>

		<p class="person__pronouns">
	<?php if ( $pronouns ) : ?>
		(<?php echo esc_html( $pronouns ); ?>)
	<?php else : ?>
		&nbsp;
	<?php endif; ?>
		</p>

		<?php

		if ( $gb_role ) :
			?>
			<h4 class="person__role">GB <?php echo esc_html( $gb_role ); ?></h4>
			<?php
		endif;

		if ( $toc_role ) :
			?>
			<h4 class="person__role">TOC <?php echo esc_html( $toc_role ); ?></h4>
			<?php
		endif;

		if ( $company ) {
			?>
<div class="person__company-container">
			<?php
			if ( $show_logos && $company_logo_url && $company_landscape_url ) {
				?>
					<a class="person__company-logo-link" title="View <?php echo esc_html( $company ); ?> in the CNCF Landscape" href="<?php echo esc_url( $company_landscape_url ); ?>">
						<img class="person__company-logo" src="<?php echo esc_attr( $company_logo_url ); ?>"
						alt="Logo of <?php echo esc_html( $company ); ?>">
					</a>
					<?php
			} elseif ( $show_logos && $company_logo_url ) {
				?>
				<img class="person__company-logo" src="<?php echo esc_attr( $company_logo_url ); ?>"
						alt="Logo of <?php echo esc_html( $company ); ?>">
				<?php
			} else {
				?>
				<h4 class="person__company"><?php echo esc_html( $company ); ?></h4>
				<?php
			}
			?>
		</div>
			<?php
		}

		if ( $tab_role ) :
			?>
			<h4 class="person__role"><?php echo esc_html( $tab_role ); ?></h4>
			<?php
		endif;
		?>

		<div class="person__social">
			<?php
			// Social Icons.
			if ( $linkedin || $bluesky || $twitter || $mastodon || $github || $wechat || $website || $youtube || $certdirectory ) :
				?>
			<div class="person__social-margin">
				<?php
				if ( $linkedin ) :
					?>
				<a
					href="<?php echo esc_url( $linkedin ); ?>"><?php LF_Utils::get_svg( 'social/boxed-linkedin.svg' ); ?></a>
					<?php
			endif;
				if ( $bluesky ) :
					?>
				<a
					href="<?php echo esc_url( $bluesky ); ?>"><?php LF_Utils::get_svg( 'social/boxed-bluesky.svg' ); ?></a>
					<?php
			endif;
				if ( $twitter ) :
					?>
				<a
					href="<?php echo esc_url( $twitter ); ?>"><?php LF_Utils::get_svg( 'social/boxed-x.svg' ); ?></a>
					<?php
			endif;
				if ( $mastodon ) :
					?>
				<a  rel="me"
					href="<?php echo esc_url( $mastodon ); ?>"><?php LF_Utils::get_svg( 'social/boxed-mastodon.svg' ); ?></a>
					<?php
			endif;
				if ( $github ) :
					?>
				<a
					href="<?php echo esc_url( $github ); ?>"><?php LF_Utils::get_svg( 'social/boxed-github.svg' ); ?></a>
					<?php
			endif;
				if ( $wechat ) :
					?>
				<a
					href="<?php echo esc_url( $wechat ); ?>"><?php LF_Utils::get_svg( 'social/boxed-wechat.svg' ); ?></a>
					<?php
			endif;
				if ( $website ) :
					?>
				<a
					href="<?php echo esc_url( $website ); ?>"><?php LF_Utils::get_svg( 'social/boxed-website.svg' ); ?></a>
					<?php
			endif;
				if ( $youtube ) :
					?>
				<a
					href="<?php echo esc_url( $youtube ); ?>"><?php LF_Utils::get_svg( 'social/boxed-youtube.svg' ); ?></a>
					<?php
			endif;
				if ( $certdirectory ) :
					?>
				<a
					href="<?php echo esc_url( $certdirectory ); ?>"><?php LF_Utils::get_svg( 'social/boxed-certdirectory.svg' ); ?></a>
					<?php
			endif;
				?>
			</div>
			<?php endif; ?>
		</div>
		<?php
		if ( $show_modal ) :
			// Load in Modal markup.
			?>
		<div class="modal-hide" id="modal-<?php echo esc_html( $person_id ); ?>"
			aria-hidden="true">
			<div class="modal-content-wrapper<?php echo ' ' . esc_html( $extra_classes ); ?>">

				<figure class="person__image">
					<img loading="lazy"
						src="<?php echo esc_attr( $image_url ); ?>"
						alt="Picture of <?php the_title_attribute(); ?>">
				</figure>

				<div class="modal__content">

					<h3 class="person__name">
						<?php the_title(); ?>
						<br class="show-upto-600">
						<?php
						if ( $pronouns ) :
							?>
							<span
							class="person__pronouns">(<?php echo esc_html( $pronouns ); ?>)</span>
							<?php
						endif;
						?>
					</h3>

					<?php
					if ( $toc_role ) :
						?>
						<h4 class="person__company person__role">TOC <?php echo esc_html( $toc_role ); ?></h4>
						<?php
					endif;

					if ( $gb_role ) :
						?>
						<h4 class="person__company person__role">GB <?php echo esc_html( $gb_role ); ?></h4>
						<?php
					endif;

					if ( $company ) {
						?>
			<div class="person__company-container">
						<?php
						if ( $show_logos && $company_logo_url && $company_landscape_url ) {
							?>
								<a class="person__company-logo-link" title="View <?php echo esc_html( $company ); ?> in the CNCF Landscape" href="<?php echo esc_url( $company_landscape_url ); ?>">
									<img class="person__company-logo" src="<?php echo esc_attr( $company_logo_url ); ?>"
									alt="Logo of <?php echo esc_html( $company ); ?>">
								</a>
								<?php
						} elseif ( $show_logos && $company_logo_url ) {
							?>
							<img class="person__company-logo" src="<?php echo esc_attr( $company_logo_url ); ?>"
									alt="Logo of <?php echo esc_html( $company ); ?>">
							<?php
						} else {
							?>
							<h4 class="person__company"><?php echo esc_html( $company ); ?></h4>
							<?php
						}
						?>
					</div>
						<?php
					}

					if ( $location || $projects || $languages ) :
						?>
					<ul class="person__metadata">
						<?php
						if ( $location ) {
							?>
						<li><strong>Location:</strong>
							<?php echo esc_html( $location ); ?> </li>
							<?php
						}

						if ( $languages ) {
							?>
						<li><strong>Languages:</strong>
							<?php
							$comma = '';
							$out   = '';
							foreach ( $languages as $language ) {
								$out  .= esc_html( $comma ) . '<a title="See more Ambassadors who speak ' . esc_html( $language->name ) . '" href="' . $current_url . '/?_sft_lf-language=' . $language->slug . '">' . esc_html( $language->name ) . '</a>';
								$comma = ', ';
							}
						echo $out; //phpcs:ignore
							?>
						</li>
							<?php
						}

						if ( $projects ) {
							?>
						<li><strong>Project Experience:</strong>
							<?php
							$comma = '';
							$out   = '';
							foreach ( $projects as $project ) {
								$out  .= esc_html( $comma ) . '<a title="See more Ambassadors who have experience in ' . esc_html( $project->name ) . '" href="' . $current_url . '/?_sft_lf-project=' . $project->slug . '">' . esc_html( $project->name ) . '</a>';
								$comma = ', ';
							}
						echo $out; //phpcs:ignore
							?>
						</li>
							<?php
						}

						if ( $related_post ) {
							?>
						<li><strong>Related Post:</strong>
							<?php
							// Display related post.
							echo '<a href="' . esc_url( get_permalink( $related_post ) ) . '">' . esc_html( get_the_title( $related_post ) ) . '</a>';
							?>
						</li>
							<?php
						}
						?>
					</ul>
					<?php endif; ?>

					<div class="person__content">
						<?php the_content(); ?>
					</div>

					<div class="person__social">
						<?php
						// Social Icons.
						if ( $linkedin || $bluesky || $twitter || $mastodon || $github || $wechat || $website || $youtube || $certdirectory ) :
							?>
						<div class="person__social-margin">
							<?php
							if ( $linkedin ) :
								?>
							<a
								href="<?php echo esc_url( $linkedin ); ?>"><?php LF_Utils::get_svg( 'social/boxed-linkedin.svg' ); ?></a>
								<?php
								endif;
							if ( $bluesky ) :
								?>
							<a
								href="<?php echo esc_url( $bluesky ); ?>"><?php LF_Utils::get_svg( 'social/boxed-bluesky.svg' ); ?></a>
								<?php
								endif;
							if ( $twitter ) :
								?>
							<a
								href="<?php echo esc_url( $twitter ); ?>"><?php LF_Utils::get_svg( 'social/boxed-x.svg' ); ?></a>
								<?php
								endif;
							if ( $mastodon ) :
								?>
							<a  rel="me"
								href="<?php echo esc_url( $mastodon ); ?>"><?php LF_Utils::get_svg( 'social/boxed-mastodon.svg' ); ?></a>
								<?php
								endif;
							if ( $github ) :
								?>
							<a
								href="<?php echo esc_url( $github ); ?>"><?php LF_Utils::get_svg( 'social/boxed-github.svg' ); ?></a>
								<?php
								endif;
							if ( $wechat ) :
								?>
							<a
								href="<?php echo esc_url( $wechat ); ?>"><?php LF_Utils::get_svg( 'social/boxed-wechat.svg' ); ?></a>
								<?php
								endif;
							if ( $website ) :
								?>
							<a
								href="<?php echo esc_url( $website ); ?>"><?php LF_Utils::get_svg( 'social/boxed-website.svg' ); ?></a>
								<?php
								endif;
							if ( $youtube ) :
								?>
							<a
								href="<?php echo esc_url( $youtube ); ?>"><?php LF_Utils::get_svg( 'social/boxed-youtube.svg' ); ?></a>
								<?php
								endif;
							if ( $certdirectory ) :
								?>
							<a
								href="<?php echo esc_url( $certdirectory ); ?>"><?php LF_Utils::get_svg( 'social/boxed-certdirectory.svg' ); ?></a>
								<?php
								endif;
							?>
						</div>
						<?php endif; ?>
					</div>


				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div><!-- end of people box  -->

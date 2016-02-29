<?php
/**
 * Template Name: User Dashboard
 *
 * @author Andrew Hausdorf
 */
 
 // if you aren't logged in, go to the preferred pricing page
global $user_ID;
global $current_user;
get_currentuserinfo();
if ( $user_ID == "" || $current_user->user_level != "0") {
	$headLocation = "location: ".home_url()."/access-preferred-pricing";
	header($headLocation);
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			
				<!--! ^#Hero Section -->
				<?php $featImg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<?php if ( ! $featImg || $featImg == "" ) { $featImg = get_field('default_header_image', 'option'); } ?>
				<div class="dashboardHeroSection" style="background: url(<?php echo $featImg; ?>) no-repeat center; background-size: cover;">
					<div class="overlay"></div>
					<div class="centerMe">
						<div class="title"><?php the_field('page_title'); ?></div>
					</div><!--centerMe-->
				</div><!--defaultHeroSection-->

				<?php
	                //get user's name
	                $name = get_user_meta($user_ID, 'first_name', true);
	            ?>
				<div class="container"><div class="row">
					<div class="dashSidebar col-xs-12 col-sm-3">
						<div class="sidebarTitle">
							<?php the_field('sidebar_title'); ?>, <?php echo($name); ?>
						</div>
						<div class="sidebarLinks">
							<ul>
								<li class="dashButton active" id="dashButton1" data-class=".mainDashWrap"><?php the_field('sidebar_text_0'); ?></li>
								<li class="dashButton" id="dashButton2" data-class=".editProfile"><?php the_field('sidebar_text_1'); ?></li>
								<li><a href="<?php the_field('sidebar_link_2'); ?>"> <?php the_field('sidebar_text_2'); ?> </a></li>
								<li><a href="<?php the_field('sidebar_link_3'); ?>"> <?php the_field('sidebar_text_3'); ?> </a></li>
								<li><a href="<?php the_field('sidebar_link_4'); ?>"> <?php the_field('sidebar_text_4'); ?> </a></li>
								<li><a href="<?php the_field('sidebar_link_5'); ?>"> <?php the_field('sidebar_text_5'); ?> </a></li>
							</ul>
						</div>
					</div> <!-- dashSidebar -->
					<div class="centerDashWrap col-xs-12 col-sm-8 col-sm-offset-1">
						<div class="mainDashWrap dashView open">
							<div class="greyMessageWrap">
								<div class="messageTitle">
									<?php the_field('message_title'); ?>
								</div>
								<div class="messageParagraph">
									<?php the_field('message_paragraph'); ?>
								</div>
							</div> <!-- greyMessageWrap -->
							<div class="websiteTips">
								<div class="websiteTipsTitle">
									<?php the_field('website_tips_title'); ?>
								</div>
								<!-- Website Tip Tabs -->
								<?php if ( get_field('has_subcontent_tabs') ) { ?>
								<?php 
									$subTabTitles = array();
									$subTabContents = array();
									//holds all arrays of bullets
									$subTabBulletsWrap = array();
									//individual array of bullets where $subTabBullets[0]=$count_rows and $subTabBullets[1..$count_rows] are the bullet values
									$subTabBullets = array();
									while ( have_rows('subcontent_tabs') ) : the_row(); 
										$subTabTitles[] = get_sub_field('sc_tab_title');
										$subTabContents[] = get_sub_field('sc_tab_content');
										// If you don't unset $subTabBullets it will get ugly (causes rolling adds to $subTabBulletsWrap)
										unset($subTabBullets); 
										// get row count 
										$rows = get_sub_field('sc_tab_bullets');
										$count_rows = count($rows);
										// if there are no bullets don't add the count to an array (this is done below) 
										if ($count_rows != 0) {
											$subTabBullets[] = $count_rows;
										}
										while (have_rows('sc_tab_bullets') ) : the_row();
											// adds bullets to the array after the count
											$subTabBullets[] = get_sub_field('bullet');
										endwhile;
										// adds a zero count and empty bullets as a placeholder if there are no bullets
										if ( empty( $subTabBullets ) ) {
											$subTabBulletsWrap[] = [0, [], [], [], []];
										}
										// adds the count and bullets to BulletsWrap
										else {
											$subTabBulletsWrap[] = $subTabBullets;
										}
									endwhile;

									//echo "<br>";
								?>
								
								<!--! ^#Mobile Tab Buttons -->
								<div class="scmTabWrap">
									<div class="labelBar">
										<div class="tipTitle">
											<span class="text"><?php echo $subTabTitles[0]; ?></span>
										</div>
										<div class="plus">
											<i class="fa fa-plus"></i>
										</div>
									</div> <!--labelBar // achieve-box-->
									<div class="scmDropWrapper">
										<?php $i = 0; ?>
										<?php foreach ($subTabTitles as $title) : $add = ""; ?>
											<?php if ( $i == 0 ) { $add = "active"; } ?>
												<div class="scmTabButton <?php echo $add; ?>" data-sectionID="scSectWrap<?php echo $i; ?>">
													<?php echo $title; ?>
												</div>
											<?php $i++; ?>
										<?php endforeach; ?>
									</div><!--scmDropWrapper-->
								</div><!--scmTabWrap-->
							</div> <!-- websiteTips -->
								
							<!--! ^#Desktop Tab Buttons -->
							<div class="width100">			
							
								<!-- ^#Desktop Tabs -->
								<div class="scDeskTabContentWrap">
									<?php $i = 0; ?>
									<?php foreach ( $subTabContents as $content_left ) : $add = ""; ?>
										<?php if ( $i == 0 ) { $add = "active"; } ?>
										<div class="scDeskTabComplete <?php echo $add; ?>" id="scSectWrap<?php echo $i; ?>">
											<div class="content_left">
												<div class="scDeskTab cgifting-paragraph">
													<?php echo $content_left; ?>
												</div><!--scDeskTab-->
											</div> <!-- cols -->
										</div><!--scDeskTabComplete-->
										<?php $i++; ?>
									<?php endforeach; ?>
								</div><!--scDeskTabContentWrap-->
							</div> <!--width100-->
								
							<?php } //end if has subcontent tabs?>
						</div> <!--mainDashWrap -->
						<div class="editProfile dashView">
							<?php echo do_shortcode('[wp-members page=user-edit]'); ?>
						</div>
					</div> <!-- centerDashWrap -->

					<?php $img = get_field('little_hero_picture_1'); ?>
					<?php if ( $img ) { ?>
					<div class="littleHeroes">
						<div class="heroImgWrap col-xs-12 col-sm-6">
							<div class="littleDashHero firstHero col-xs-12 col-sm-6" style="background: url(<?php echo $img; ?>) no-repeat right center; background-size: cover;">
								<div class="littleTitle">
									<a href="<?php the_field('little_hero_link_1'); ?>"> <?php the_field('little_hero_text_1'); ?> </a>
								</div>
								<hr class="redLineHero"/>
							</div>
						</div>
						<?php } ?>

						<?php $img2 = get_field('little_hero_picture_2'); ?>
						<?php if ( $img2 ) { ?>
						<div class="heroImgWrap col-xs-12 col-sm-6">
							<div class="littleDashHero secondHero col-xs-12 col-sm-6" style="background: url(<?php echo $img2; ?>) no-repeat right center; background-size: cover;">
								<div class="littleTitle">
									<a href="<?php the_field('little_hero_link_2'); ?>"> <?php the_field('little_hero_text_2'); ?> </a>
								</div>
								<hr class="redLineHero" />
							</div>
						</div>
						<?php } ?>
					</div> <!-- .littleHeroes -->
				</div></div><!--container and row-->

			<?php endwhile; // end of the loop. ?>

			<!--event experiences with stats -->
			<div class="noMarginBottom">
				<?php get_template_part('callout', 'eventExperiences'); ?>
			</div>
				<!--brand logo slider -->
				<?php get_template_part('callout', 'brandSlider'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
<?php get_footer(); ?>

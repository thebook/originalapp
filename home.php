<?php get_header(); ?>

	
	<!-- Header -->
	<section class="header">
		<div class="header_wrap">
			
			<div class="header_invisible_box">
				<!-- <div class="header_invisible_box_title_wrap">
					<div class="header_invisible_box_title_logo"><span class="with-icon-invisible-title-logo"></span></div>
					<div class="header_invisible_box_title">
						<span class="header_invisible_box_title_one_and_two_wrap">
							<span class="header_invisible_box_title_one">Recycla</span>
							<span class="header_invisible_box_title_two">book</span>
						</span>	
						<span class="header_invisible_box_title_three">co.uk</span></div>
				</div> -->
				<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/header_logo.png" alt="" class="header_invisible_box_image_title">
				<div class="header_invisible_box_text_wrap">
					<div class="header_invisible_box_text_title">What We Do</div>
					<div class="header_invisible_box_text">Recyclabook accepts over a million different titles, you can easily sell your book and get quick and safe payment</div>
				</div>
				<!-- <div class="header_invisible_box_arrow_text">Check and see!</div>
				<div class="with-icon-down-arrow"></div> -->
			</div>

			<div class="header_text_box">
				<div class="header_text_box_title">How <span class="header_text_box_title_highlight">much</span> is <br/><span class="header_text_box_title_highlight">your</span> book <span class="header_text_box_title_highlight">worth?</span></div>
					<!-- <div class="header_text_box_text">use a comma to search for more than one book</div> -->
				<div class="header_text_box_input">	
					<div class="header_field_for_input">
						<input type="text" class="header_input_block_for_search block_for_search" placeholder="isbn, book title, keyword, etc...">
					</div>
					<span data-function-instruction="{'type':'header'}" data-function-to-call="front.prototype.search_though_amazon" class="with-icon-header-search"></span>
				</div>
			</div>
			<div class="with-icon-header-text-box-arrow"></div>

		</div>
		
		<div class="header_image_wrap">
			<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/jhonc.png'; ?>" class="header_image">
		</div>

	</section>
	
	<!-- Bar  -->
	<section class="bar_outer_wrap"></section>
	
	<!-- Homepage -->
	<section class="homepage_body_wrap pages" style="display: none;">

		<div class="homepage_body_inner_wrap">

			<div class="homepage_how_it_works_option_title_wrap">
				<div class="homepage_how_it_works_option_title_scrible">1st option</div>
				<div class="homepage_how_it_works_option_title">
					<span class="homepage_how_it_works_option_title_part_one">Free</span>
					<span class="homepage_how_it_works_option_title_part_two">post</span>
				</div>
			</div>

			<div class="homepage_how_it_works_boxes_numbers_wrap">
				<div class="with-icon-homepage-how-it-works-box-number-one"></div>
				 <div class="with-icon-homepage-how-it-works-box-number-two"></div>	
				<div class="with-icon-homepage-how-it-works-box-number-three"></div>
			</div>

			<div class="homepage_how_it_works_boxes_wrap">
				<div class="homepage_how_it_works_box_wrap_first">
					<div class="homepage_how_it_works_box homepage_how_it_works_box_first">						
						<div class="homepage_how_it_works_box_text_wrap">
							<div class="homepage_how_it_works_box_title">Find Your Books</div>
							<div class="homepage_how_it_works_text">find your books and add them to your sell basket</div>
						</div>
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/type.png'; ?>" class="homepage_how_it_works_box_first_image">
					</div>
					<div class="homepage_arrows_warp">
						<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>
						<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>						
						<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>
					</div>
				</div>				

				<div class="homepage_how_it_works_box_wrap_second">				
					<div class="homepage_how_it_works_box_second">											
						<div class="homepage_how_it_works_box_text_wrap">
							<div class="homepage_how_it_works_box_title">Freepost<br/>Your Books</div>
							<div class="homepage_how_it_works_text">we send you a freepost pack and you send us your books</div>
						</div>					
						<img  src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/letter.png'; ?>" class="homepage_how_it_works_box_second_image">					
					</div>
					<div class="homepage_arrows_warp">
						<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>
						<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>						
						<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>
					</div>
				</div>

				<div class="homepage_how_it_works_box_wrap_last">
					<div class="homepage_how_it_works_box homepage_how_it_works_box_last">												
						<div class="homepage_how_it_works_box_text_wrap">
							<div class="homepage_how_it_works_box_title"><br/>Get Paid</div>
							<div class="homepage_how_it_works_text">we send you a cheque the same day we receive your books</div>
						</div>
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/check.png'; ?>" class="homepage_how_it_works_box_third_image">
					</div>
				</div>
			</div>

			<div class="homepage_how_it_works_boxes_buttons_wrap">
				
				<div class="homepage_how_it_works_box_first_button_wrap">
					<div id="where_is_my_isbn_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">
						Where is My ISBN 
						<span id="where_is_my_isbn_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>
					</div>
					<div id="where_is_my_isbn_toggle" class="homepage_how_it_works_box_button_expanded">
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/where_is_my_isbn.png'; ?>" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">
						<div class="homepage_how_it_works_box_button_expanded_text">
							Just look at the back of your book and find the 13 or 9 digit number bellow the barcode.
						</div>
					</div>
				</div>
				
				<div class="homepage_how_it_works_box_second_button_wrap">
					<div id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">
						Freepost Options 
						<span id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>
					</div>
					<div id="freepost_toggle" class="homepage_how_it_works_box_button_expanded">
						<div class="homepage_how_it_works_box_button_expanded_text">
							We'll send you a postage pack, inside you'll get an envelope with which you can post your books for free
						</div>
						<div class="homepage_how_it_works_box_button_expanded_text_highlight">or</div>
						<div class="homepage_how_it_works_box_button_expanded_text">
							If you have your own package you can print off our own packaging label from this website
						</div>
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/freepost_options.png'; ?>" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">
					</div>
				</div>
				
				<div class="homepage_how_it_works_box_third_button_wrap">
					<div  id="paid_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_last_box_button">
						How Am I Being Paid 
						<span id="paid_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>						
					</div>
					<div id="paid_toggle" class="homepage_how_it_works_box_button_expanded">
						<div class="homepage_how_it_works_box_button_expanded_text">
							Dont worry about filling in your bank details, we'll send you a cheque the same day we recieve your books.
						</div> 
					</div>
				</div>
			</div>

			<div class="with-icon-or-sticker-recyclabus"></div>
			<div class="homepage_recyclabus_box_wrap">
				<div class="homepage_recyclabus_box_title_scrible">2nd option</div>
				<div class="homepage_recyclabus_box_title">
					Recycla<span class="homepage_recyclabus_box_title_color">Bus</span>
				</div>
				<div class="homepage_recyclabus_box_text_wrap">
					<div class="homepage_recyclabus_box_point">
						<div class="with-icon-recyclabus-point-leaf"></div>
						<div class="homepage_recyclabus_box_point_text">Our bus is touring Universities all over the country, come along and get paid instantly</div>
					</div>
					<div class="homepage_recyclabus_box_point">
						<div class="with-icon-recyclabus-point-leaf"></div>
						<div class="homepage_recyclabus_box_point_text">It gives you an <strong>extra 20%</strong> on your sell quote</div>
					</div>
					<div class="homepage_recyclabus_box_point">
						<div class="with-icon-recyclabus-point-leaf"></div>
						<div class="homepage_recyclabus_box_point_text">No need to fill in any details <strong>just turn up on the day</strong></div>
					</div>
				</div>
				<div class="homepage_recyclabus_box_button_wrap">
					<div data-function-instructions="{'page' : 'recyclabus' }" data-function-to-call="front.prototype.change_page" class="homepage_recyclabus_box_button_text">Find Out More</div>
					<div class="with-icon-recyclabus-find-out-more-arrow"></div>
				</div>
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/recyclabus.png'; ?>"class="homepage_recyclabus_box_image">
			</div>

			<div class="homepage_alies_bar">
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/iod.png'; ?>" alt="" class="homepage_ally_bar_image">
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/fsc.png'; ?>" alt="" class="homepage_ally_bar_image">
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/recycle.png'; ?>" alt="" class="homepage_ally_bar_image">
			</div>
		</div>			
	</section>
	
	<!-- Recyclabus -->
	<section class="recyclabus pages"></section>

	<!-- User registration -->
	<section class="input_box_body_wrap account pages">
		<div class="account_wrap"></div>
	</section>
	
	<!-- Selling -->
	<section class="body pages"></section>

	<section class="checkout pages">
		<!-- <div class="checkout_wrap">
			<div class="confirmation_overview">
				<div class="basket_overview_outer_wrap">

					<div class="basket_overview_wrap">
						<div class="basket_overview_title">Basket Overview</div>
						<div class="basket_overview_items">
							<div class="basket_overview_item">
								<img class="basket_overview_item_thumbnail" src="http://farm8.staticflickr.com/7278/8166869046_393e5eecf4.jpg">
								<div class="basket_overview_item_text_wrap">
									<div class="basket_overview_item_text_title">Jaggarnath</div>
									<div class="basket_overview_item_text_author">by Kelsey McDolth</div>
									<div class="basket_overview_item_isbn"><span class="basket_overview_item_isbn_highlight">isbn</span> 923495943</div>
								</div>
								<div class="basket_overview_item_price_wrap">
									<div class="basket_overview_item_price_text">Sell for</div>
									<div class="basket_overview_item_price">£ 12.20</div>
								</div>
							</div>
								<div class="with-icon-x-for-overview-item"></div>
							<div class="basket_overview_item">
								<img class="basket_overview_item_thumbnail" src="http://farm8.staticflickr.com/7278/8166869046_393e5eecf4.jpg">
								<div class="basket_overview_item_text_wrap">
									<div class="basket_overview_item_text_title">Jaggarnath</div>
									<div class="basket_overview_item_text_author">by Kelsey McDolth</div>
									<div class="basket_overview_item_isbn"><span class="basket_overview_item_isbn_highlight">isbn</span> 923495943</div>
								</div>
								<div class="basket_overview_item_price_wrap">
									<div class="basket_overview_item_price_text">Sell for</div>
									<div class="basket_overview_item_price">£ 12.20</div>
								</div>
							</div>
						</div>
						<div class="basket_overview_bar">
							<div class="basket_overview_bar_block"></div>
						</div>
					</div>
					
					<div class="basket_overview_edit_button">Edit Basket</div>
					<div class="basket_overview_total_wrap">
						<div class="basket_overview_total">£12.20</div>
						<div class="basket_overview_total_text">Total Sale:</div>
					</div>
					
				</div>
				
				<div class="address_overview_wrap_outer">
					<div class="address_overview_wrap">
						<div class="address_overview_title">Address Confirmation</div>
						<div class="address_overview_inputs">
							<input class="address_overview_input" 		readonly value="">
							<input class="address_overview_input" 		readonly value="Country">
							<input class="address_overview_input" 		readonly value="Region">
							<input class="address_overview_input_small" readonly value="Post Code">
						</div>
					</div>
					<div class="address_overview_edit">Edit Address</div>
				</div>
			</div>

			<div class="how_would_you_like_wrap">
				<div class="how_would_you_like_title">How would you like to send your books?</div>
				<div class="how_would_you_like_titles_wrap">
					<div class="how_would_you_like_tab_title_active ">We Send you a freepost pack</div>
					<div class="how_would_you_like_tab_title active_tab_right">Print your own freepost pack</div>
				</div>
				<div class="how_would_you_like_tab_wrap">
					<div class="how_would_you_like_we_send_active_tab">
						<img class="we_send_freepost_tab_image" src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/freepost_send.png">
						<div class="we_send_freepost_tab_text_wrap">
							<ul class="we_send_freepost_tab_text">
								<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>
								<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>
								<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>
							</ul>
							<div class="we_send_freepost_tab_tick_button">
								<div class="with-icon-we-checkout-tick"></div>
								<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>
							</div>
						</div>
					</div>

					<div class="how_would_you_like_we_send_tab">
						<img class="we_send_freepost_tab_image" src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/print.png">
						<div class="we_send_freepost_tab_text_wrap">
							<ul class="we_send_freepost_tab_text">
								<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>
								<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>
								<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>
							</ul>
							<div class="we_send_freepost_tab_tick_button">
								<div class="with-icon-we-checkout-tick-dark"></div>
								<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>
							</div>
						</div>
					</div>
				</div>
				<div class="checkout_button">Confirm & Complete</div>
			</div>
		</div> -->
		
	</section>

	<section class="thank_you pages">
		
		<!-- <div class="thank_you_banner_wrap">
			<div class="thank_you_banner">
				<div class="with-icon-thank-you-icon-leaf"></div>
				<div class="thank_you_banner_title_one">Thank you </div>
				<div class="thank_you_banner_title_two">For using recyclabook</div>
				<div class="thank_you_banner_summary">You have sold your books. You will recieve a cheque for <span class="thank_you_banner_summary_underline">£xx.xx</span> as soon as we get your books</div>
				<div class="thank_you_banner_paragraph">We'll be waiting for your books to arrive, in the meantime, <strong>you have an account now</strong>. You cna login and track the books and payments anytime, theres also an option to tell us when you've sent your books so we can get your payment out <strong>even quicker.</strong></div>
			</div>
			<div class="with-icon-thank-you-bottom-arrow"></div>
		</div>
		<div class="thank_you_circle_wrap">
			<div class="with-icon-thank-you-corn"></div>
			<div class="thank_you_circle_text_wrap">
				<div class="thank_you_circle_text_header">Alas we shall</div>
				<div class="thank_you_circle_text">to the edge of earth and back dear friend and trips and trips till death</div>
			</div>
		</div>
		<div class="with-icon-your-account"></div> -->

	</section>
	
	<div class="homepage_blue_bar"></div>
	<div class="homepage_bottom_navigation_wrap">

		<div class="homepage_bottom_navigation">
			<div class="homepage_bottom_navigation_button">Contact</div>
			<div class="homepage_bottom_navigation_button">Got Questions?</div>
			<div class="homepage_bottom_navigation_button">Media</div>
			<div class="homepage_bottom_navigation_button">Jobs</div>
			<div class="homepage_bottom_navigation_button">Word From Us</div>
			<div class="homepage_bottom_navigation_button">T&C's</div>

			<div class="homepage_bottom_navigation_copyright">
				<div class="with-icon-bottom-navigation-copyright"></div>
				<div class="homepage_bottom_navigation_copyright_text">Recyclabook &copy. 2013</div>
			</div>
		</div>

	</div>

<?php get_footer(); ?>
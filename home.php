<?php get_header(); ?>
	
	<div class="profile_hub_popup_screen">
		<div class="profile_hub_withdraw">
			<div class="profile_hub_withdraw_logo_wrap">
				<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/header_logo.png" class="profile_hub_withdraw_logo">
				<div class="profile_hub_withdraw_description">Withdraw Funds</div>
			</div>
			<div class="profile_hub_withdraw_body">
				<div class="profile_hub_withdraw_line">
					<div class="profile_hub_withdraw_line_description">Cheque to me made out to :</div>
					<div class="profile_hub_withdraw_line_text_wrap">
						<input type="text" class="profile_hub_withdraw_line_text" value="Mcjoe Poopy" readonly>
					</div>
					<div class="profile_hub_withdraw_line_edit">edit</div>
				</div>
				<div class="profile_hub_withdraw_line">
					<div class="profile_hub_withdraw_line_description">Cheque to be sent to :</div>
					<div class="profile_hub_withdraw_line_text_wrap">
						<input type="text" class="profile_hub_withdraw_line_text" value="Something somewhere">
						<input type="text" class="profile_hub_withdraw_line_text" value="East something">
						<input type="text" class="profile_hub_withdraw_line_text" value="Areaus">
						<input type="text" class="profile_hub_withdraw_line_text" value="CF2LK2">
					</div>
					<div class="profile_hub_withdraw_line_edit">edit</div>
				</div>
				<div class="profile_hub_withdraw_mesure">
					<div class="profile_hub_withdraw_mesure_text">Withdraw ammount :</div>
					<input type="text" class="profile_hub_withdraw_mesure_ammount" value="" readonly>
					<div class="profile_hub_withdraw_mesure_seperate"></div>
					<input type="text" class="profile_hub_withdraw_mesure_ammount" value="" readonly>
					<div class="profile_hub_withdraw_mesure_incrimentor">
						<div class="profile_hub_withdraw_mesure_incrimentor_up"></div>
						<div class="profile_hub_withdraw_mesure_incrimentor_down"></div>
					</div>
				</div>
				<div class="profile_hub_withdraw_and_send">Withdraw & Send</div>
				<div class="profile_hub_withdraw_cancel">Cancel</div>
			</div>
		</div>
	</div>
	<section class="profile_hub">
		<div class="profile_hub_inner_wrap">

			<div class="profile_hub_header">
				<div class="profile_hub_header_title">Profile Hub</div>
				<div class="profile_hub_header_text">For withdrawals, tracking, order history and editing account details</div>
			</div>
			
			<div class="profile_hub_left_boxes_wrap">
				<div class="profile_hub_account profile_hub_box">
					<div class="profile_hub_account_bar">
						<div class="with-icon-profile-hub-account"></div>
						<div class="profile_hub_account_bar_greeting">Hi james</div>
						<div class="profile_hub_account_bar_text">Account Details</div>
					</div>
					<div class="profile_hub_account_body">
						<div class="profile_hub_account_main_details">
							<input type="text" class="profile_hub_account_main_details_small_input">
							<input type="text" class="profile_hub_account_main_details_small_input">
							<input type="text" class="profile_hub_account_main_details_large_input">
							<input type="text" class="profile_hub_account_main_details_small_input">
							<input type="text" class="profile_hub_account_main_details_small_input">
							<input type="text" class="profile_hub_account_main_details_small_input">
						</div>

						<div class="profile_hub_account_extra_details">
							<div class="profile_hub_account_extra_details_title">Registered email</div>
							<input type="text" class="profile_hub_account_extra_details_input">
						</div>
						<div class="profile_hub_account_extra_buttons">
							<div class="profile_hub_account_extra_buttons_small_button">
								<div class="with-icon-plus-for-profile-hub-account-extra-buttons"></div>
							</div>
							<div class="profile_hub_account_extra_buttons_large_button">Edit Account Details</div>
						</div>
					</div>
				</div>

				<div class="profile_hub_history profile_hub_box">
					<div class="profile_hub_history_bar">
						<div class="with-icon-for-profile-hub-history"></div>
						<div class="profile_hub_history_bar_greeting">Order History</div>
						<div class="profile_hub_history_notification"></div>
					</div>
					<div class="profile_hub_history_body">
						<div class="profile_hub_history_inner_body">
							<div class="profile_hub_history_scroll">
								<div class="profile_hub_history_scroll_handle"></div>
							</div>
							<div class="profile_hub_history_items">
								<div class="profile_hub_history_item">
									<div class="profile_hub_history_item_image"></div>
									<div class="profile_hub_history_item_text">
										<div class="profile_hub_history_item_title">Jagganath</div>
										<div class="profile_hub_history_item_author">by Author</div>
										<div class="profile_hub_history_item_price">£7.32</div>
										<div class="profile_hub_history_item_isbn">02930492</div>
									</div>
									<div class="profile_hub_history_item_icon">
										<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/profilehub/sold.png" class="profile_hub_history_item_icon_image">
										<div class="profile_hub_history_item_icon_date">02/05/2013</div>
									</div>
								</div>
								<div class="profile_hub_history_item">
									<div class="profile_hub_history_item_image"></div>
									<div class="profile_hub_history_item_text">
										<div class="profile_hub_history_item_title">Jagganath</div>
										<div class="profile_hub_history_item_author">by Author</div>
										<div class="profile_hub_history_item_price">£7.32</div>
										<div class="profile_hub_history_item_isbn">02930492</div>
									</div>
									<div class="profile_hub_history_item_icon">
										<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/profilehub/donated.png" class="profile_hub_history_item_icon_image">
										<div class="profile_hub_history_item_icon_date">02/05/2013</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="profile_hub_right_boxes_wrap">
				<div class="profile_hub_bank profile_hub_box_right">
					<div class="profile_hub_bank_bar">
						<div class="with-icon-for-profile-hub-bank"></div>
						<div class="profile_hub_bank_greeting">RecyclaBank</div>
					</div>
					<div class="profile_hub_bank_body">
						<div class="profile_hub_bank_status">
							<div class="profile_hub_bank_stats_first">
								<div class="with-icon-pig-for-account-balance"></div>
								<div class="profile_hub_bank_stats_label">Account balance</div>
								<input type="text" class="profile_hub_bank_stats_input" value="£10.32" readonly>
							</div>
							<div class="profile_hub_bank_stats_middle">
								<div class="with-icon-clock-for-account-withdrawal"></div>
								<div class="profile_hub_bank_stats_label">Last withdrawal</div>
								<input type="text" class="profile_hub_bank_stats_input" value="02/05/2013" readonly>
							</div>
							<div class="profile_hub_bank_stats_last">
								<div class="with-icon-hand-for-account-donation"></div>
								<div class="profile_hub_bank_stats_label">Total Donations</div>
								<input type="text" class="profile_hub_bank_stats_input" value="0.01" readonly>
							</div>
							<div class="profile_hub_bank_buttons">
								<div class="with-icon-for-bank-withdraw">Withdraw Funds</div>
								<div class="with-icon-for-bank-donate">Donate to RAG</div>
							</div>
						</div>
					</div>
				</div>

				<div class="profile_hub_tracking profile_hub_box_right">
					<div class="profile_hub_tracking_bar">
						<div class="with-icon-for-profile-hub-tracking"></div>
						<div class="profile_hub_tracking_bar_title">Book Tracking</div>
						<div class="profile_hub_tracking_bar_sort">
							<div class="profile_hub_tracking_bar_sort_drop">
								<div class="with-icon-for-profile-hub-tracking-drop-arrow"></div>
								<div class="profile_hub_tracking_bar_sort_drop_item">Order By</div>
								<div class="profile_hub_tracking_bar_sort_drop_item">Show something</div>
								<div class="profile_hub_tracking_bar_sort_drop_item">Something else</div>
							</div>
							<div class="with-icon-eye-for-profile-hub-tracking"></div>
							<div class="with-icon-down-arrow-for-profile-hub-drop"></div>
						</div>
					</div>
					<div class="profile_hub_tracking_body">
						<div class="profile_hub_tracking_inner_body">
							<div class="profile_hub_tracking_sroll">
								<div class="profile_hub_tracking_sroll_handle"></div>
							</div>
							<div class="profile_hub_tracking_show_bar">
								<div class="profile_hub_tracking_show_bar_text">Showing all</div>
								<div class="with-icon-for-profile-hub-tracking-envelope"></div>
							</div>
							<div class="profile_hub_tracking_items">
								<div class="profile_hub_tracking_title">Price promises</div>
								<div class="profile_hub_tracking_item">
									<div class="profile_hub_tracking_item_image"></div>
									<div class="profile_hub_tracking_item_text">
										<div class="profile_hub_tracking_item_text_title">Jaggernath</div>
										<div class="profile_hub_tracking_item_text_author">by Author</div>
										<div class="profile_hub_tracking_item_text_quote">£7.32</div>
										<div class="profile_hub_tracking_item_text_isbn">09232145</div>
									</div>
									<div class="profile_hub_tracking_item_options">
										<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/profilehub/freepost.png" alt="" class="profile_hub_tracking_item_options_image">
										<div class="with-icon-for-profile-hub-tracking-remove-book">Remove book</div>
									</div>
								</div>
								<div class="profile_hub_tracking_item">
									
									<div class="profile_hub_tracking_item_options_damaged_book_dropout">
										<div class="with-icon-left-arrow-for-damaged-book-box"></div>
										<div class="profile_hub_tracking_item_options_damaged_book_dropout_title">Comments</div>
										<div class="profile_hub_tracking_item_options_damaged_book_dropout_text">It was a reall poopady pop, and a stuffed ystuff stuff stuff</div>
									</div>

									<div class="profile_hub_tracking_item_image"></div>
									<div class="profile_hub_tracking_item_text">
										<div class="profile_hub_tracking_item_text_title">Jaggernath</div>
										<div class="profile_hub_tracking_item_text_author">by Author</div>
										<div class="profile_hub_tracking_item_text_quote">£7.32</div>
										<div class="profile_hub_tracking_item_text_isbn">09232145</div>
									</div>

									<div class="profile_hub_tracking_item_options">
										<div class="profile_hub_tracking_item_options_damaged_book_info">
											<div class="with-icon-for-damaged-book-info"></div>
											<div class="profile_hub_tracking_item_options_damaged_book_info_text">Damaged book</div>
										</div>								

										<div class="with-icon-for-damaged-book-return">Return</div>
										<div class="with-icon-for-damaged-book-donate">Donate</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</section>






	















	






	<!-- <div class="homepage_blue_bar"></div> -->
	<!-- <div class="homepage_bottom_navigation_wrap">

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
	</div> -->

<?php get_footer(); ?>
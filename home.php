<?php get_header(); ?>



	<section class="header"></section>

	<section class="bar">

		<!-- Logo  -->
		<div class="logo_for_bar">
			<span class="with-icon-logo"></span>
		</div>

		<!-- Progress bar  -->
		<!-- <div class="progress_icon_for_bar">
			<span class="progress_icon_for_bar_text">Confirm</span>
		</div> -->

		<!-- Navigation  -->
		<div class="navigation_text_for_bar">How It Works</div>
		<div class="navigation_text_for_bar">Recyclabus</div>
		<div class="navigation_text_for_bar">Us</div>

		<!-- User registration or sign in button -->
		<div class="button_for_user">
			<span class="with-icon-user"></span>
			<span class="with-icon-user-arrow"></span>
		</div>

		<!-- Search Input -->
		<div class="input_for_bar">	
			<div class="field_for_input">
				<input type="text" class="input_block_for_search">
			</div>
			<div class="button_for_input"><span class="with-icon-search"></span></div>
		</div>

	</section>

	<section class="body">
		
		<!-- Price checker -->
		<div class="price_selection">
			
			<div class="price_selection_quote">Quote</div>
			
			<div class="price_selection_selection">
				<span class="price_selection_box">
					<span class="with-icon-selection-tick"></span>
				</span>
				<span class="price_selection_text">Freepost</span>
			</div>

			<div class="price_selection_selection">
				<span class="price_selection_box"></span>
				<span class="price_selection_text">Recyclabus</span>
			</div>
		</div>
		
		<!-- Books description title -->
		<div class="search_books_description_title">
			<!-- <div class="search_books_description_title_text">Search Results For: 'Yo Motha'</div> -->

			<div class="sell_and_buy_basket">
				<div id="sell_basket" class="basket_stats"><span class="buy_basket_text">Buy : </span><span class="buy_basket_number">0</span></div>
				<div id="buy_basket" class="basket_stats"><span class="sell_basket_text">Sell : </span><span class="sell_basket_number">0</span> |</div>
			</div>
		</div>
		
		<!-- A result book -->
		<div class="result_book_search_wrapper_left">
			<div class="result_book_search_added">
				
				<!-- Info Icon -->
				<span class="with-icon-info-for-book"></span>
				
				<!-- Books thumbnail image -->
				<img src="http://farm8.staticflickr.com/7278/8166869046_393e5eecf4.jpg" class="result_book_thumbnail_image">
				
				<!-- Article book search -->
				<article class="result_book_search_text">
					<strong class="result_book_title">Jaggarenath</strong>
					<div class="result_book_author">by Karla Talb..</div>
					<div class="result_book_price_wrap">
						<span class="result_book_price_text">Sell for -</span>
						<storng class="result_book_price">£5.30</storng>
					</div>
				</article>
				
				<!-- Add book button -->
				<div class="result_book_add_button">
					<span class="with-icon-added-to-sell-basket-tick">
						Added To Basket
					</span>
				</div>

			</div>
			
			<!-- Extra buttons -->
			<div class="result_book_extra_options_buttons">

				<span class="result_book_added_book_sell_button">
					<span class="with-icon-sell-now-arrow"></span>
					Sell now?
				</span>

				<span class="result_book_added_book_add_again_button">
					<span class="with-icon-add-again"></span>
					Add again+
				</span>

			</div>
		</div>
		
		<!-- Middle wrapper -->
		<div class="result_book_search_wrapper">
			<div class="result_book_search">

				<span class="with-icon-info-for-book"></span>

				<img src="http://www.tangentbooks.co.uk/product_images/a/short_story_vol2__99344.jpg" class="result_book_thumbnail_image">

				<article class="result_book_search_text">
					<strong class="result_book_title">Bristol Short Stories</strong>
					<div class="result_book_author">by Guy Mcgee</div>
					<div class="result_book_price_wrap">
						<span class="result_book_price_text">Sell for -</span>
						<storng class="result_book_price">£7.80</storng>
					</div>
				</article>

				<div class="result_book_add_button">
					<span class="result_book_add_button_text">
						Add To Sell Basket
					</span>
				</div>
			</div>
		</div>
		
		<!-- Last wrapper -->
		<div class="result_book_search_wrapper_right">
			<div class="result_book_search">

				<span class="with-icon-info-for-book"></span>

				<img src="http://1.bp.blogspot.com/_nXknRDZBs0E/STIHwAsUmwI/AAAAAAAACfA/hkB8fkCiGY0/s400/tongue.jpg" class="result_book_thumbnail_image">

				<article class="result_book_search_text">
					<strong class="result_book_title">The Mayors</strong>
					<div class="result_book_author">by Nathaniel..</div>
					<div class="result_book_price_wrap">
						<span class="result_book_price_text">Sell for -</span>
						<storng class="result_book_price">£5.80</storng>
					</div>
				</article>

				<div class="result_book_add_button"><span class="result_book_add_button_text">Add To Sell Basket</span></div>
			</div>
		</div>

	</section>

<?php get_footer(); ?>
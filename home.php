<?php get_header(); ?>



	<section class="header"></section>

	<section class="bar">				
		<!-- Logo  -->
		<div class="logo_for_bar"></div>

		<!-- Progress bar  -->
		<div class="progress_icon_for_bar">			
			<span class="progress_icon_for_bar_text">Confirm</span>
		</div>

		<!-- User registration or sign in button -->
		<div class="button_for_user"></div>

		<!-- Search Input -->
		<div class="input_for_bar">	
			<div class="field_for_input">
				<input type="text" class="input_block_for_search">
			</div>
			<div class="button_for_input"></div>
		</div>

	</section>

	<section class="body">
		
		<!-- Price checker -->
		<div class="price_selection">
			<div class="price_selection_quote">Quote</div>
		</div>
		
		<!-- Books description title -->
		<div class="search_books_description_title">
			<div class="search_books_description_title_text">Search Results For: Yo Motha</div>

			<div class="sell_and_buy_basket">
				<div id="buy_basket" class="basket_stats"><span class="sell_basket_text">Sell</span><span class="sell_basket_number">(0)</span></div>
				<div id="sell_basket" class="basket_stats"><span class="buy_basket_text">Buy</span><span class="buy_basket_number">(0)</span> | </div>
			</div>
		</div>
		
		<div class="result_book_search">
			<img class="img" src="http://farm8.staticflickr.com/7278/8166869046_393e5eecf4.jpg">

			<article>
				<strong class="result_book_title">Jaggarenath</strong>
				<div class="result_book_author">by Karla Talbeck</div>
				<div class="result_book_price_wrap">
					<span class="result_book_price_text">Sell for</span>
					<storng class="result_book_price">£5.30</storng>
				</div>
			</article>

			<div class="result_book_add_button"><span class="result_book_add_button_text">Added To Basket</span></div>
			<span class="result_book_added_book_button">Sell now?</span>
			<span class="result_book_added_book_button">Add again+</span>
		</div>

	</section>

<?php get_footer(); ?>
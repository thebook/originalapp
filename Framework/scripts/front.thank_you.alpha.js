var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.thank_you = function () { 

		if ( alpha.front.prototype.parts.thank_you === undefined ) {

			alpha.front.prototype.thank_you.prototype.manifest();
			alpha.front.prototype.parts.thank_you.banner.branch.branch.inner_banner.branch.branch.summary.branch.quote.text('£'+ alpha.front.prototype.being.basket.total/100 );
		}
		
		alpha.front.prototype.thank_you.prototype.animate();
		alpha.front.prototype.being.on_page = 'thank_you';

		alpha.front.prototype.complete_book_selling(function () {
			alpha.front.prototype.being.basket.inside = {};
			alpha.front.prototype.being.basket.total  = 0;
		});
		
	};

	alpha.front.prototype.thank_you.prototype.animate = function () {

		alpha.front.prototype.registration.prototype.progress_to_icon(4);
		alpha.front.prototype.registration.prototype.progress_to_icon(5);
		alpha.front.prototype.parts.bar.wrap.branch.branch.arrow.self.fadeOut(300);
		alpha.front.prototype.parts.bar.wrap.branch.branch.progress_popup.self.fadeOut(300);
		alpha.front.prototype.parts.thank_you.banner.self.css({ top: '-1000px' });
		alpha.front.prototype.parts.thank_you.banner.self.animate({ top: '0px' }, 2000);

		alpha.front.prototype.parts
		.bar.wrap.branch.branch
		.navigation.branch.branch.wrap.branch.branch
		.progress.branch.branch.back.self.css({ display : 'block'}).animate({ opacity : 1 }, 400);;


	};

	alpha.front.prototype.thank_you.prototype.manifest = function () {

		alpha.front.prototype.parts.thank_you = { 
			banner : {
				self   : '<div class="thank_you_banner_wrap"></div>',
				branch : {
					branch : {
						inner_banner : {
							self   : '<div class="thank_you_banner"></div>',
							branch : {
								branch : {
									leaf : { 
										self : '<div class="with-icon-thank-you-icon-leaf"></div>'
									},
									title_one : {
										self :'<div class="thank_you_banner_title_one">Thank you </div>'
									},
									title_two : {
										self : '<div class="thank_you_banner_title_two">For using recyclabook</div>'
									},
									summary : {
										self   : '<div class="thank_you_banner_summary"></div>',
										branch : {
											text_one : '<span>You have sold your books. You will recieve a cheque for </span>',
											quote    : '<span class="thank_you_banner_summary_underline">£xx.xx</span>',
											text_two : '<span> as soon as we get your books</span>'
										}
									},
									paragraph : {
										self : '<div class="thank_you_banner_paragraph">We\'ll be waiting for your books to arrive, in the meantime, <strong>you have an account now</strong>. You can login and track the books and payments anytime, theres also an option to tell us when you\'ve sent your books so we can get your payment out <strong>even quicker.</strong></div>'}, }
							}
						},
						bottom : {
							self : '<div class="with-icon-thank-you-bottom-arrow"></div>'
						}
					}
				}
			},
			circle : {
				self   :'<div class="thank_you_circle_wrap"></div>',
				branch : {
					branch : {
						corn : {
							self :'<div class="with-icon-thank-you-corn"></div>'
						},
						text : {
							self   : '<div class="thank_you_circle_text_wrap"></div>',
							branch : {
								header : '<div class="thank_you_circle_text_header">Alas we shall</div>',
								text   : '<div class="thank_you_circle_text">to the edge of earth and back dear friend and trips and trips till death</div>		'
							}
						}
					}
				}
			},
			icon : {
				self : '<div class="with-icon-your-account"></div>'
			}			
		};

		alpha.front.prototype.parts.thank_you = alpha.manifest({
			what_to_manifest : alpha.front.prototype.parts.thank_you,
			append_to_who    : $('.thank_you') 
		});
	};

	return alpha;

})(alpha || {}, jQuery);
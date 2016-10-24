import $ from 'jquery';

export default {
	init() {
		console.log("init");
		const social = $('.social-share');
		const headerHeight = $('header.header').outerHeight() + 35; // 25px of padding
		const doc = document.documentElement;
		let cssFixed = false;
		if (social.length) {
			console.log("true");
			const initialPositionY = social.offset().top;
			window.onscroll = () => {
				let currentScroll = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
				if (currentScroll >= (initialPositionY - headerHeight) && !cssFixed) {
					social.addClass('social-fixed');
					cssFixed = true;
				} else
				if (currentScroll < (initialPositionY - headerHeight) && cssFixed) {
					social.removeClass('social-fixed');
					cssFixed = false;
				}
			}
		}
	}
}
import $ from 'jquery';

export default {
	init() {
		$('#menu-toggle').on('click', () => {
			$('#menu').toggleClass('open');
		});
	}
}
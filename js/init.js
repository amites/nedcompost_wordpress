/*
	Exponent by Pixelarity
	pixelarity.com @pixelarity
	License: pixelarity.com/license
*/

(function($) {

	skel.init({
		reset: 'full',
		breakpoints: {
			global: { href: 'css/style.css', containers: '70em', grid: { gutters: ['3em', 0] } },
			xlarge: { media: '(max-width: 1680px)', href: 'css/style-xlarge.css' },
			large: { media: '(max-width: 1280px)', href: 'css/style-large.css', containers: '90%', grid: { gutters: [ '2.5em', 0 ] } },
			medium: { media: '(max-width: 980px)', href: 'css/style-medium.css', containers: '90%!' },
			small: { media: '(max-width: 736px)', href: 'css/style-small.css', grid: { gutters: ['2em', 0] }, viewport: { scalable: false } },
			xsmall: { media: '(max-width: 480px)', href: 'css/style-xsmall.css' }
		},
		plugins: {
			layers: {
				menuPanel: {
					animation: 'overlayX',
					clickToHide: true,
					height: '100%',
					hidden: true,
					html:	'<h2>Menu</h2><span class="closer" data-action="toggleLayer" data-args="menuPanel">Close</span><div data-action="moveElement" data-args="menuPanel-content"></div>',
					orientation: 'vertical',
					position: 'top-right',
					side: 'right',
					width: { small: '17em', global: '20em' }
				}
			}
		}
	});

	$(function() {

		var	$window = $(window),
			$body = $('body');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {

				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 500);

			});

		// Touch?
			if (skel.vars.isTouch)
				$body.addClass('is-touch');

		// Forms (IE<10).
			var $form = $('form');
			if ($form.length > 0) {

				if (skel.vars.IEVersion < 10) {
					$.fn.n33_formerize=function(){var _fakes=new Array(),_form = $(this);_form.find('input[type=text],textarea').each(function() { var e = $(this); if (e.val() == '' || e.val() == e.attr('placeholder')) { e.addClass('formerize-placeholder'); e.val(e.attr('placeholder')); } }).blur(function() { var e = $(this); if (e.attr('name').match(/_fakeformerizefield$/)) return; if (e.val() == '') { e.addClass('formerize-placeholder'); e.val(e.attr('placeholder')); } }).focus(function() { var e = $(this); if (e.attr('name').match(/_fakeformerizefield$/)) return; if (e.val() == e.attr('placeholder')) { e.removeClass('formerize-placeholder'); e.val(''); } }); _form.find('input[type=password]').each(function() { var e = $(this); var x = $($('<div>').append(e.clone()).remove().html().replace(/type="password"/i, 'type="text"').replace(/type=password/i, 'type=text')); if (e.attr('id') != '') x.attr('id', e.attr('id') + '_fakeformerizefield'); if (e.attr('name') != '') x.attr('name', e.attr('name') + '_fakeformerizefield'); x.addClass('formerize-placeholder').val(x.attr('placeholder')).insertAfter(e); if (e.val() == '') e.hide(); else x.hide(); e.blur(function(event) { event.preventDefault(); var e = $(this); var x = e.parent().find('input[name=' + e.attr('name') + '_fakeformerizefield]'); if (e.val() == '') { e.hide(); x.show(); } }); x.focus(function(event) { event.preventDefault(); var x = $(this); var e = x.parent().find('input[name=' + x.attr('name').replace('_fakeformerizefield', '') + ']'); x.hide(); e.show().focus(); }); x.keypress(function(event) { event.preventDefault(); x.val(''); }); });  _form.submit(function() { $(this).find('input[type=text],input[type=password],textarea').each(function(event) { var e = $(this); if (e.attr('name').match(/_fakeformerizefield$/)) e.attr('name', ''); if (e.val() == e.attr('placeholder')) { e.removeClass('formerize-placeholder'); e.val(''); } }); }).bind("reset", function(event) { event.preventDefault(); $(this).find('select').val($('option:first').val()); $(this).find('input,textarea').each(function() { var e = $(this); var x; e.removeClass('formerize-placeholder'); switch (this.type) { case 'submit': case 'reset': break; case 'password': e.val(e.attr('defaultValue')); x = e.parent().find('input[name=' + e.attr('name') + '_fakeformerizefield]'); if (e.val() == '') { e.hide(); x.show(); } else { e.show(); x.hide(); } break; case 'checkbox': case 'radio': e.attr('checked', e.attr('defaultValue')); break; case 'text': case 'textarea': e.val(e.attr('defaultValue')); if (e.val() == '') { e.addClass('formerize-placeholder'); e.val(e.attr('placeholder')); } break; default: e.val(e.attr('defaultValue')); break; } }); window.setTimeout(function() { for (x in _fakes) _fakes[x].trigger('formerize_sync'); }, 10); }); return _form; };
					$form.n33_formerize();
				}

			}

		// Scrolly.
			$('.scrolly').scrolly({
				speed: 1500,
				offset: 100
			});

		// Banner.
			var $banner = $('#banner');

			if ($banner.length > 0) {

				// Parallax background.
					if (skel.vars.browser != 'ie'
					&&	!skel.vars.isMobile) {

						skel.change(function() {

							if (skel.isActive('medium')) {

								$window.off('scroll.px');
								$banner.css('background-position', '');

							}
							else {

								$banner.css('background-position', 'center 0px');

								$window.on('scroll.px', function() {
									$banner.css('background-position', 'center ' + (parseInt($window.scrollTop()) * -0.5) + 'px');
								});

							}

						});

					}

			}

	});

})(jQuery);
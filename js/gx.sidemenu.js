;(function() {

	$.fn.gxSideMenu = function(options) {

		'use strict';

		this.VERSION = '1.0.01';
		
		this.options = {
			mode: 'normal', // normal | tiny
			interval: 300,
			openOnHover: true, // true | false
			clickTrigger: true, // true | false
			trigger: '.menu-trigger',
			followURLs: true, // true | false
			direction: 'left', // left | right
			tipItem: '#gx-sidemenu-tip',
			startFrom: 60,
			startClosed: true,
			scrolling: true,
			urlBase: '',
			backText: 'Back',
			onOpen: function() {},
			onClose: function() {}
		};

		$.extend(this.options, options);
		
		this.inAction = false;
		this.myScroll = false;
		
		var 
			URL = window.location.href.replace(window.location.origin, ''),
			sideMenu = $(this),
			sideMenuLogin = sideMenu.find('#gx-sidemenu-login').length ? sideMenu.find('#gx-sidemenu-login') : false,
			Side = false,
			Active = false,
			t = this;
		
		if (t.options.direction !== 'right') {
			sideMenu.css({
				right: 'auto', 
				left: -sideMenu.width(), 
				height: (t.options.mode != 'tiny' ? $(window).height() : 'auto'),
				top: (sideMenu.height() < $(window).height() && t.options.mode != 'normal') ? (($(window).height()-sideMenu.height()) / 2) : 0
			});
		} else {
			sideMenu.css({
				left: 'auto', 
				right: -sideMenu.width(), 
				height: (t.options.mode != 'tiny' ? $(window).height() : 'auto'),
				top: (sideMenu.height() < $(window).height() && t.options.mode != 'normal') ? (($(window).height()-sideMenu.height()) / 2) : 0
			});
		}

		if (t.options.openOnHover != false) {
			sideMenu.bind('mouseenter tap', function() {
				Side = true;
				Active = true;
			}).bind('mouseleave', function() {
				Side = false;
				Active = false;
				if (t.options.openOnHover != false) {
					t.close();
				}
			});
		}

		if (this.options.mode != 'normal') {
			sideMenu.addClass('tiny');
		}

		var sideMenuInner = sideMenu.find('.gx-sidemenu-inner:first');
		sideMenuInner.css({
			top: 0
		});

		sideMenu.append(sideMenuInner);

		sideMenu.find('ul').find('li').each(function() {
			if ($(this).find('ul').length > 0) {
				if ($(this).find('.arrow').length == 0) {
					$(this).find('>a').append('<span class="arrow">&#59238;</span>');
				}
			}
			$(this).after('<li class="divider"></li>');
		});

		sideMenu.find('ul').find('li > a').each(function(i, e) {
			$(this).prop('tabindex', i);
			$(this).prop('data-valami', 'false');
		});
		
		if (t.options.mode != 'normal') {
			if (!$(t.options.tipItem).length) {
				var tip = $('<div></div>').hide();
				tip.appendTo('body');
				if (t.options.tipItem.indexOf('#') == -1) {
					tip.addClass(t.options.tipItem.replace('.', ''));
				} else {
					tip.prop('id', t.options.tipItem.replace('#', ''));
				}
			} else {
				var tip = $(t.options.tipItem);
			}

			tip.bind('mouseenter', function() { $(this).hide(); });

			sideMenu.find('li').bind('mouseenter', function(e) {
				$(t.options.tipItem).html($(this).find('.text:first').text()).css({
					left: (t.options.direction != 'right' ? (sideMenu.width()+5) : 'auto'),
					right: (t.options.direction != 'right' ? 'auto' : (sideMenu.width()+5)),
					top: $(this).offset().top+5,
					position: 'fixed'
				}).fadeIn(100);
			}).bind('mouseleave', function(e) {
				$(t.options.tipItem).hide();
			});
		}

		sideMenuInner.find('ul.gx-menu ul').hide().parent('li').find('a:first, a:first span').bind('click tap', function(e) {
			e.preventDefault();
			var parentsLength = $(this).parents('ul').length,
				itemParent = $(this).parents('ul:first'),
				backBtn = $('<li><a href="javascript:" class="back"><span class="icon entypo chevron-left '+(isMobile.any() ? 'mobile' : '' )+'"></span><span class="text">'+t.options.backText+'</span></a></li><li class="divider"></li>');
			
			var itemLI = $(this).parents('li:first').addClass('active-menu');

			if ($(this).next('ul').find('a.back').length == 0)
				$(this).next('ul').prepend(backBtn);

			var UL = $(this).next('ul').css({
				position: 'absolute',
				background: 'transparent',
				width: itemParent.width(),
				top: 0,
				right: -itemParent.width(),
				height: 'auto'
				//height: itemParent.height()
			}).show().addClass('active-sub');
			
			UL.insertAfter(itemParent);
			
			itemParent.fadeOut(t.options.interval);
			UL.show().animate({
				right: 0,
				opacity: 1
			}, t.options.interval); 

			if (t.options.scrolling == true && t.myScroll) {
				var activeUL = sideMenu.find('ul.active-sub:last').length ? sideMenu.find('ul.active-sub:last') : sideMenu.find('ul:first');
				sideMenuInner.find('div.scroll').css({ height: activeUL.height() });
				t.myScroll.refresh();
			}

			backBtn.bind('click tap', function() {
				UL.removeClass('active-sub').stop().animate({right: -UL.width(), left: 'auto', opacity: 0 }, t.options.interval, function() {
					$(this).appendTo(itemLI);
					itemLI.removeClass('active-menu');
				});
				itemParent.fadeIn(t.options.interval);
				if (t.options.scrolling == true && t.myScroll) {
					var activeUL = sideMenu.find('ul.active-sub:last').length ? sideMenu.find('ul.active-sub:last') : sideMenu.find('ul:first');
					sideMenuInner.find('div.scroll').css({ height: activeUL.height() });
					t.myScroll.refresh();
				}
			});
		});
	
		if (this.options.followURLs != false) {
			URL = URL.replace(/https?:\/\//gi, '').replace(window.location.hostname, '').replace(this.options.urlBase, '');
			sideMenuInner.find('ul').find('a[href="'+URL+'"]').each(function() {
				$(this).parent('li:first').addClass('active-link');
				var toHide = $(this).parents('li').not('.active-link');
				$(toHide.get().reverse()).each(function() {
					var oldInterval = t.options.interval;
					t.options.interval = 0;
					$(this).find('>a').trigger('click');
					t.options.interval = oldInterval;
				});
			});
		}


		// BIND MOUSE ON CORNERS
		
		if (t.options.openOnHover != false) {
			$(document).bind('mousemove', function(e,o) {
				if (t.inAction != true) {
					var ww = t.options.startFrom; // sideMenu.width() * 0.2;
					if (!Active) {
						if (t.options.direction != 'right') {
							if (e.pageX < ww) { Side = true;  } else { Side = false; }
						} else {
							if (e.pageX > $(window).width()-ww) { Side = true; } else { Side = false; }
						}
					}
					!Side ? t.close() : t.open();
				}
			});
			
			if (isMobile.any()) {
				$.event.special.swipe.horizontalDistanceThreshold = 100;

				$( document ).on( "swipeleft", function() {
					if (t.options.direction != 'left') { // RIGHT case
						if (!sideMenu.hasClass('opened')) {
							t.open();
						}
					} else { // LEFT case
						if (sideMenu.hasClass('opened')) {
							t.close();
						}
					}
				});
				$( document ).on( "swiperight", function() {
					if (t.options.direction != 'left') { // RIGHT case
						if (sideMenu.hasClass('opened')) {
							t.close();
						}
					} else { // LEFT case
						if (!sideMenu.hasClass('opened')) {
							t.open();
						}
					}
				});
				$('body').on('tap', function() {
					if (sideMenu.hasClass('opened') && Active == false) {
						t.close();
					}
					Active = false;
				});
			}
		}

		this.open = function() {
			t.inAction = true;
			if (t.options.direction != 'right') {
				if (!sideMenu.hasClass('opened')) {
					sideMenu.stop().animate({left: 0}, t.options.interval, function() {
						sideMenu.addClass('opened');
						t.inAction = false;
						t.options.onOpen();
					});
				}
			} else {
				if (!sideMenu.hasClass('opened')) {
					sideMenu.stop().animate({right: 0}, t.options.interval, function() {
						sideMenu.addClass('opened');
						t.inAction = false;
						t.options.onOpen();
					});
				}
			}
		};

		this.close = function() {
			if (t.options.direction !== 'right') {
				if (sideMenu.hasClass('opened')) {
					t.inAction = true;
					sideMenu.stop().animate({left: -sideMenu.width() }, t.options.interval, function() {
						sideMenu.removeClass('opened');
						t.inAction = false;
						t.options.onClose();
					}); 
				}
			} else {
				if (sideMenu.hasClass('opened')) {
					t.inAction = true;
					sideMenu.stop().animate({right: -sideMenu.width() }, t.options.interval, function() {
						sideMenu.removeClass('opened');
						t.inAction = false;
						t.options.onClose();
					}); 
				}
			}
		};

		this.openClose = function() {
			var ww = t.options.startFrom; //sideMenu.width() * 0.2;
			if (!Active) {
				if (t.options.direction != 'right') {
					if (sideMenu.offset().left <= 0) { Side = true; } else { Side = false; }
				} else {
					if (sideMenu.offset().left >= ww) { Side = true; } else { Side = false; }
				}
			}
			if (Side == true && !sideMenu.hasClass('opened')) {
				t.open();
			} else { 
				t.close();
				$(t.options.tipItem).hide();
			}
		};

		$(window).resize(function() {
			if (!sideMenu.hasClass('opened')) {
				sideMenu.css({
					height: t.options.mode != 'tiny' ? $(window).height() : 'auto',
					left: t.options.direction != 'right' ? -sideMenu.width() : 'auto',
					right: t.options.direction != 'left' ? -sideMenu.width() : 'auto',
					top: (sideMenu.height() < $(window).height() && t.options.mode != 'normal') ? (($(window).height()-sideMenu.height()) / 2) : 0
				});
			} else {
				sideMenu.css({
					height: t.options.mode != 'tiny' ? $(window).height() : 'auto',
					top: (sideMenu.height() < $(window).height() && t.options.mode != 'normal') ? (($(window).height()-sideMenu.height()) / 2) : 0
				});
			}

			sideMenuInner.css({
				height: t.options.mode != 'normal' ? 'auto' : (sideMenu.innerHeight()  - (sideMenuLogin!=false ? sideMenuLogin.innerHeight() : 0)),
				paddingBottom: 0
			});

			if (t.options.scrolling == true && t.myScroll) {
				sideMenuInner.children('div.scroll').css({ height: sideMenu.find('ul.active-sub:last').height() });
				t.myScroll.refresh();
			}
		});

		sideMenuInner.css({
			height: t.options.mode != 'normal' ? 'auto' : (sideMenu.innerHeight()  - (sideMenuLogin!=false ? sideMenuLogin.innerHeight() : 0))
		});

		if (t.options.startClosed != true) {
			if (t.options.openOnHover != false)
				t.open();
		}
		
		if (t.options.clickTrigger != false) {
			$(t.options.trigger).bind('click', function() {
				t.openClose();
			});
		} 

		if (t.options.scrolling != false) {
			if (!t.myScroll && sideMenuLogin != false) {
				var activeUL = sideMenu.find('ul.active-sub:last').length ? sideMenu.find('ul.active-sub:last') : sideMenu.find('ul:first');
				sideMenuInner.find('div.scroll').css({ height: activeUL.height() });
				setTimeout(function() {
					t.myScroll = new IScroll('#'+sideMenuInner.prop('id'), { 
						mouseWheel: true,
						scrollbars: true,
						swipe: true,
						click: true,
						keyBindings: true,
						tap: true
					});
				}, 500);
			}
		}


		if (isMobile.any() !== false) {
			$('.icon, .entypo').addClass('mobile');
		}	
	}

})(jQuery);

var isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i) ? true : false;
	},
	BlackBerry: function() {
		return navigator.userAgent.match(/BlackBerry/i) ? true : false;
	},
	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
	},
	Opera: function() {
		return navigator.userAgent.match(/Opera Mini/i) ? true : false;
	},
	Windows: function() {
		return navigator.userAgent.match(/IEMobile/i) ? true : false;
	},
	any: function() {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
};
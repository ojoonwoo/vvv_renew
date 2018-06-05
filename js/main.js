(function($){
	'use strict';

	var $win = $(window),
		$doc = $(document),
		$html = $('html');

	window.vvv = {};

	vvv.ieMode = document.documentMode;

	
	$doc.on('click', '.button-search', function() {
		$html.addClass('search-layer-opened');
	});
	$doc.on('click', '.search-layer-close', function() {
		$html.removeClass('search-layer-opened');
	});
	$doc.on('click', '.button-menu', function() {
		burgerMotion();
	});
	$win.on('scroll', function() {
		if(150 < $(this).scrollTop()) {
			$('.side-nav .search-wrap').css({
				opacity: 1
			});
		} else {
			$('.side-nav .search-wrap').css({
				opacity: 0
			});
		}
	});
	
	function burgerMotion() {
		if($html.hasClass('menu-opened')) {
//			메뉴 오픈 상태
			var cMotion = new TimelineMax();
			TweenMax.to('#gnb .line.top', 0.47, {rotation: 0, ease: Back.easeOut.config(1.7)}, 'action1');
			TweenMax.to('#gnb .line.bot', 0.47, {rotation: 0, ease: Back.easeOut.config(1.7)}, 'action1');
			TweenMax.to($('#gnb .line.top'), 0.3, {y: 0, delay: 0.3}, 'action2');
			TweenMax.to($('#gnb .line.bot'), 0.3, {y: 0, delay: 0.3}, 'action2');
			TweenMax.to($('#gnb .line.mid'), 0.2, {autoAlpha: 1, delay: 0.3}, 'action2');

		} else {
//			메뉴 클로즈 상태
			var oMotion = new TimelineMax();
			TweenMax.to($('#gnb .line.mid'), 0.2, {autoAlpha: 0, delay: 0.2}, 'action1');
			TweenMax.to($('#gnb .line.top'), 0.3, {y: 6}, 'action1');
			TweenMax.to('#gnb .line.top', 0.47, {rotation: 45, delay: 0.3, ease: Back.easeOut.config(1.7)}, 'action2');
			TweenMax.to($('#gnb .line.bot'), 0.3, {y: -6}, 'action1');
			TweenMax.to('#gnb .line.bot', 0.47, {rotation: -45, delay: 0.3, ease: Back.easeOut.config(1.7)}, 'action2');

		}
		$html.toggleClass('menu-opened');
	}
	
	//popup
	vvv.popup = {
		bind : function(){
			$doc
				.on('click', '[data-popup]', function(e){
				var $this = $(this),
					$html = $('html'),
					val = $this.attr('data-popup');

				if (val.match('@close')){
					vvv.popup.close($this.closest('.popup'));
			  	} else {
					vvv.popup.show($(val));
				}

				if ($this.is('a')){
					e.preventDefault();
				}
			})
				.on('click', '[data-popup-close]', function(e){
				var $this = $(this),
					val = $this.attr('data-popup-close');

				vvv.popup.close($(val));

				if ($this.is('a')){
					e.preventDefault();
				}
			});
		},
		show : function($popup){
			if ($popup.length){
				var $wrap = $popup.parent(),
					$html = $('html');
				

				if (!$wrap.hasClass('popup-wrap')){
					$popup.wrap('<div class="popup-wrap"></div>');
					$wrap = $popup.parent();
				}

				if (!$wrap.hasClass('is-opened')){
					$wrap
						.stop().fadeIn(10, function(){
						$popup.trigger('afterPopupOpened', $wrap);
					})
						.addClass('is-opened');
				}

				if (!$html.hasClass('popup-opened')){
					$html.addClass('popup-opened');
				}

				$popup.trigger('popupOpened', $wrap);
			}
		},
		close : function($popup){
			if ($popup.length){
				var $wrap = $popup.parent(),
					$html = $('html');

				$wrap.stop().fadeOut(10, function(){
					$wrap.removeClass('is-opened');

					if (!$('.popup-wrap.is-opened').length){
						$html.removeClass('popup-opened');
					}

//					$popup.trigger('afterpopupClosed', $wrap);
				});

				$popup.trigger('popupClosed', $wrap);
			}
		}
	};
	vvv.popup.bind();
	vvv.layer = {
		bind : function(){
			$doc
				.on('click', '[data-layer]', function(e){
				var $this = $(this),
					$html = $('html'),
					val = $this.attr('data-layer');

				if (val.match('@close')){
					vvv.layer.close($this.closest('.layer'));
				} else {
					vvv.layer.show($(val));
				}

				if ($this.is('a')){
					e.preventDefault();
				}
			})
				.on('click', '[data-layer-close]', function(e){
				var $this = $(this),
					val = $this.attr('data-layer-close');

				vvv.layer.close($(val));

				if ($this.is('a')){
					e.preventDefault();
				}
			});
		},
		show : function($layer){
			if ($layer.length){
				var $html = $('html'),
					$this = $layer;

				if (!$this.hasClass('is-opened')){
					$this
						.stop().fadeIn(10, function(){
						$layer.trigger('afterlayerOpened', $this);
					})
						.addClass('is-opened');
				}

				if (!$html.hasClass('layer-opened')){
					$html.addClass('layer-opened');
				}

				$layer.trigger('layerOpened', $this);
			}
		},
		close : function($layer) {
			if ($layer.length){
				var	$html = $('html'),
					$this = $layer;

				$this.stop().fadeOut(10, function(){
					$this.removeClass('is-opened');

					if (!$('.layer.is-opened').length){
						$html.removeClass('layer-opened');
					}

					//					$layer.trigger('afterpopupClosed', $this);
				});

				$layer.trigger('layerClosed', $this);
			}
		}
	};
	vvv.layer.bind();
	vvv.toggle = {
		bind: function() {
			$doc
				.on('click', '.toggle-trigger', function() {
				$(this).closest('.toggle').toggleClass('is-active');
			})
			
		}
	}
	vvv.toggle.bind();

	$(window).on('scroll', function() {
		var currentScroll = $(this).scrollTop();

		if(currentScroll > 1500) {
			TweenMax.to($('#go-top'), 0.3, {css:{autoAlpha: 1}});
		} else {
			TweenMax.to($('#go-top'), 0.3, {css:{autoAlpha: 0}});
		}
	});

	// 위로 가기
	$doc.on('click', '#go-top', function() {
		$('html, body').animate({scrollTop :  0}, 1000);
	});
	

	// checkbox
//	ui.checkbox = {
//		bind : function(){
//			$doc.on('change.uiCheckbox', '.ui-checkbox', function(e){
//				var $this = $(this);
//				ui.checkbox.toggleClass($this);
//			});
//		},
//		toggleClass : function($target){
//			var id = $target.attr('id'),
//				$label = $('label[for="'+id+'"]');
//
//			if ($target.is(':checked')){
//				$target.addClass('is-checked');
//				$label.addClass('is-checked');
//			} else {
//				$target.removeClass('is-checked');
//				$label.removeClass('is-checked');
//			}
//		},
//		load : function(){
//			$('.ui-checkbox').each(function(i){
//				var $this = $(this);
//				ui.checkbox.toggleClass($this);
//			});
//		}
//	}
//	ui.checkbox.bind();

	// agree
	
	// ready
//	$(function(){
//		
//	});

	$doc.on('mousemove', function(e) {
		var $cursor = $('#cursor'),
			$dot = $('#cursor .dot'),
			$backDot = $('#cursor .backDot');
		var xPos = e.pageX,
			yPos = e.pageY;
		TweenMax.to($cursor, 0, {x: xPos-6, y: yPos-6, scale: 1});
	});
	var mouseType = "";
	var mouseText = "";
	$doc.on('mouseenter', '[data-mouse-type]', function(e) {
		e.stopPropagation();
		mouseType = $(this).data('mouse-type');
		(mouseType=='text') ?  mouseText = $(this).data('text') : mouseText = "";
		if(!($('#cursor').hasClass(mouseType))) {
			$('#cursor').addClass(mouseType);
		}
		$('#cursor .guideT').text(mouseText);
		
	}).on('mouseleave', '[data-mouse-type]', function(e) {
		$('#cursor').removeClass(mouseType);
		$('#cursor .guideT').text('');

	});
	$doc.on('mouseleave', function() {
		var $cursor = $('#cursor');
		TweenMax.to($cursor, 0.13, {scale: 0});
	});
	$win.on('scroll', function() {
		var $cursor = $('#cursor');
		TweenMax.to($cursor, 0.13, {scale: 0});
	});

})(jQuery);
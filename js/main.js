(function($){
	'use strict';

	var $win = $(window),
		$doc = $(document);

	window.vvv = {};

	vvv.ieMode = document.documentMode;

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


})(jQuery);
var besley_lightbox = function () {
    if(jQuery('.tplBesley').length > 0) {
        jQuery('body').append('<div class="pswp besleylightbox" tabindex="-1" role="dialog" aria-hidden="true"> <div class="pswp__bg"></div><div class="pswp__scroll-wrap"> <div class="pswp__container"> <div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"> <div class="pswp__top-bar"> <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title="Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button> <div class="pswp__preloader"> <div class="pswp__preloader__icn"> <div class="pswp__preloader__cut"> <div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"> <div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"> </button> <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"> </button> <div class="pswp__caption"> <div class="pswp__caption__center"></div></div></div></div></div>');

        var $pswp = document.querySelectorAll('.besleylightbox')[0];

        jQuery('.tplBesley .popup-item').on('click', function(event) {
            var image = [];
            var $pic     = jQuery('.tplBesley');

            console.log('1');
            var getItems = function() {
                var items = [],
                    $el = '';
                $el = $pic.find('a.popup-item');
                $el.each(function() {
                    var $href   = jQuery(this).attr('href'),
                        $size   = jQuery(this).data('size').split('x'),
                        $width  = $size[0],
                        $height = $size[1];

                    if(jQuery(this).data('type') == 'video') {
                        var item = {
                            html: jQuery(this).data('video')
                        };
                    } else {
                        var item = {
                            src : $href,
                            w   : $width,
                            h   : $height
                        }
                    }

                    items.push(item);
                });
                return items;
            }

            var items = getItems();

            // jQuery.each(items, function(index, value) {
            //     image[index]     = new Image();
            //     if(value['src']) {
            //         image[index].src = value['src'];
            //     }
            // });

            event.preventDefault();

            var $index = jQuery('.tplBesley .popup-item').index(jQuery(this));
            var options = {
                index: $index,
                bgOpacity: 0.7,
                showHideOpacity: true
            }

            var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
            lightBox.init();

            lightBox.listen('beforeChange', function() {
                var currItem = jQuery(lightBox.currItem.container);
                jQuery('.pswp__video').removeClass('active');
                var currItemIframe = currItem.find('.pswp__video').addClass('active');
                jQuery('.pswp__video').each(function() {
                    if (!jQuery(this).hasClass('active')) {
                        jQuery(this).attr('src', jQuery(this).attr('src'));
                    }
                });
            });

            lightBox.listen('close', function() {

                jQuery('.pswp__video').each(function() {
                    jQuery(this).attr('src', jQuery(this).attr('src'));
                });
            });
        });
    }
}
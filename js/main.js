/**
 * Waxing Shop Theme v5.8
 * Accessible, conversion-optimized JavaScript
 *
 * @package Waxing_Shop
 * @since 5.8
 */

(function($) {
    'use strict';

    // ===========================================
    // UTILITIES
    // ===========================================

    /**
     * Check if user prefers reduced motion
     */
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /**
     * Announce message to screen readers
     */
    function announce(message) {
        var $live = $('#liveAnnouncements');
        if ($live.length) {
            $live.text(message);
            // Clear after announcement
            setTimeout(function() { $live.text(''); }, 1000);
        }
    }

    /**
     * Show toast notification to user
     * @param {string} message - The message to display
     * @param {string} type - 'success', 'error', or 'info'
     * @param {number} duration - How long to show (ms)
     */
    function showToast(message, type, duration) {
        type = type || 'info';
        duration = duration || 3000;

        // Remove existing toasts
        $('.waxing-toast').remove();

        var $toast = $('<div class="waxing-toast waxing-toast-' + type + '" role="alert" aria-live="polite">' +
            '<span class="toast-message">' + escapeHtml(message) + '</span>' +
            '<button class="toast-close" aria-label="Sluiten">&times;</button>' +
            '</div>');

        $('body').append($toast);

        // Trigger animation
        setTimeout(function() {
            $toast.addClass('visible');
        }, 10);

        // Auto-hide
        var hideTimeout = setTimeout(function() {
            hideToast($toast);
        }, duration);

        // Close button
        $toast.find('.toast-close').on('click', function() {
            clearTimeout(hideTimeout);
            hideToast($toast);
        });

        // Announce to screen readers
        announce(message);
    }

    function hideToast($toast) {
        $toast.removeClass('visible');
        setTimeout(function() {
            $toast.remove();
        }, 300);
    }

    /**
     * Handle AJAX errors consistently
     * @param {object} xhr - XMLHttpRequest object
     * @param {string} status - Error status
     * @param {string} error - Error message
     * @param {string} context - What operation failed
     */
    function handleAjaxError(xhr, status, error, context) {
        var message = 'Er ging iets mis';

        if (status === 'timeout') {
            message = 'De verbinding duurde te lang. Probeer het opnieuw.';
        } else if (status === 'abort') {
            // User cancelled, no need to show error
            return;
        } else if (xhr.status === 0) {
            message = 'Geen internetverbinding.';
        } else if (xhr.status === 429) {
            message = 'Te veel aanvragen. Probeer later opnieuw.';
        } else if (xhr.status >= 500) {
            message = 'Server fout. Probeer later opnieuw.';
        }

        if (context) {
            console.error('AJAX Error [' + context + ']:', status, error);
        }

        showToast(message, 'error');
    }

    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    /**
     * Trap focus within an element (for modals)
     */
    function trapFocus($element) {
        var focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        var $focusable = $element.find(focusableElements).filter(':visible');
        var $firstFocusable = $focusable.first();
        var $lastFocusable = $focusable.last();
        
        $element.on('keydown.trapFocus', function(e) {
            if (e.key !== 'Tab') return;
            
            if (e.shiftKey) {
                if (document.activeElement === $firstFocusable[0]) {
                    e.preventDefault();
                    $lastFocusable.focus();
                }
            } else {
                if (document.activeElement === $lastFocusable[0]) {
                    e.preventDefault();
                    $firstFocusable.focus();
                }
            }
        });
        
        // Focus first element
        $firstFocusable.focus();
    }
    
    /**
     * Release focus trap
     */
    function releaseFocus($element) {
        $element.off('keydown.trapFocus');
    }

    // ===========================================
    // LOADER
    // ===========================================
    function initLoader() {
        var $loader = $('#siteLoader');
        
        // Skip loader if reduced motion or already shown
        if (prefersReducedMotion || sessionStorage.getItem('waxing_loader_shown')) {
            $loader.addClass('hidden');
            $('body').removeClass('loading');
            return;
        }
        
        sessionStorage.setItem('waxing_loader_shown', 'true');
        setTimeout(function() {
            $loader.addClass('hidden');
            $('body').removeClass('loading');
        }, 1500);
    }

    // ===========================================
    // HEADER
    // ===========================================
    function initHeader() {
        var $header = $('#siteHeader');
        var lastScroll = 0;
        
        $(window).on('scroll', function() {
            var currentScroll = $(this).scrollTop();
            
            if (currentScroll > 50) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
            
            lastScroll = currentScroll;
        });
        
        // Mega menu keyboard support
        $('.nav-item > .nav-link').on('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                var $menu = $(this).siblings('.mega-menu');
                var expanded = $(this).attr('aria-expanded') === 'true';
                
                $(this).attr('aria-expanded', !expanded);
                
                if (!expanded) {
                    $menu.find('a').first().focus();
                }
            }
        });
    }

    // ===========================================
    // MOBILE MENU
    // ===========================================
    function initMobileMenu() {
        var $toggle = $('#mobileMenuToggle');
        var $menu = $('#mobileMenu');
        var scrollPosition = 0;

        $toggle.on('click', function() {
            var isOpen = $(this).hasClass('active');

            $(this).toggleClass('active');
            $menu.toggleClass('active');
            $('body').toggleClass('menu-open');

            // Prevent body scroll when menu is open
            if (!isOpen) {
                scrollPosition = window.pageYOffset;
                $('body').css({
                    'overflow': 'hidden',
                    'position': 'fixed',
                    'top': -scrollPosition + 'px',
                    'width': '100%'
                });
            } else {
                $('body').css({
                    'overflow': '',
                    'position': '',
                    'top': '',
                    'width': ''
                });
                window.scrollTo(0, scrollPosition);
            }

            // ARIA
            $(this).attr('aria-expanded', !isOpen);
            $menu.attr('aria-hidden', isOpen);

            // Announce
            announce(isOpen ? 'Menu gesloten' : 'Menu geopend');

            // Focus trap
            if (!isOpen) {
                trapFocus($menu);
                // Focus first menu item
                $menu.find('a').first().focus();
            } else {
                releaseFocus($menu);
                $toggle.focus();
            }
        });

        // Close on link click
        $menu.find('a').on('click', function() {
            $toggle.removeClass('active');
            $menu.removeClass('active');
            $('body').removeClass('menu-open').css({
                'overflow': '',
                'position': '',
                'top': '',
                'width': ''
            });
            window.scrollTo(0, scrollPosition);
            $toggle.attr('aria-expanded', 'false');
            $menu.attr('aria-hidden', 'true');
            releaseFocus($menu);
        });

        // Close on Escape
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $menu.hasClass('active')) {
                $toggle.click();
            }
        });
    }

    // ===========================================
    // SCROLL REVEAL
    // ===========================================
    function initScrollReveal() {
        if (prefersReducedMotion) {
            $('.reveal').addClass('active');
            return;
        }
        
        var $reveals = $('.reveal');
        
        function check() {
            var windowHeight = $(window).height();
            $reveals.each(function() {
                var top = this.getBoundingClientRect().top;
                if (top < windowHeight - 100) {
                    $(this).addClass('active');
                }
            });
        }
        
        $(window).on('scroll', check);
        check();
    }

    // ===========================================
    // SMOOTH SCROLL
    // ===========================================
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                
                var offset = target.offset().top - 80;
                
                if (prefersReducedMotion) {
                    window.scrollTo(0, offset);
                } else {
                    $('html, body').animate({ scrollTop: offset }, 600);
                }
                
                // Set focus for accessibility
                target.attr('tabindex', '-1').focus();
            }
        });
    }

    // ===========================================
    // AJAX ADD TO CART
    // ===========================================
    function initAjaxCart() {
        $(document).on('click', '.btn-add-cart, #stickyAtcBtn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $btn = $(this);
            var productId = $btn.data('product-id') || $btn.closest('[data-product-id]').data('product-id') || $('#quickViewModal').data('current-product');
            
            if (!productId || $btn.hasClass('loading')) return;
            
            var originalText = $btn.text();
            $btn.addClass('loading').attr('aria-busy', 'true').text('Toevoegen...');
            
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_add_to_cart',
                    nonce: waxingShop.nonce,
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart counts
                        $('#cartCount, #mobileCartCount').text(response.data.cart_count);
                        
                        // Button feedback
                        $btn.removeClass('loading').addClass('added').attr('aria-busy', 'false').text('✓ Toegevoegd');
                        
                        // Announce to screen readers
                        announce(response.data.product_name + ' toegevoegd aan winkelmand');
                        
                        setTimeout(function() {
                            $btn.removeClass('added').text(originalText);
                        }, 2000);
                    } else {
                        $btn.removeClass('loading').attr('aria-busy', 'false').text('Fout');
                        announce('Kon product niet toevoegen');
                        setTimeout(function() { $btn.text(originalText); }, 2000);
                    }
                },
                error: function(xhr, status, error) {
                    $btn.removeClass('loading').attr('aria-busy', 'false').text(originalText);
                    handleAjaxError(xhr, status, error, 'add-to-cart');
                }
            });
        });
    }

    // ===========================================
    // WISHLIST (Legacy - replaced by initWishlistPersistent)
    // ===========================================
    // Moved to initWishlistPersistent() with cookie/localStorage persistence

    // ===========================================
    // SHOP FILTERS (AJAX)
    // ===========================================
    function initShopFilters() {
        var $grid = $('.products-grid');
        var $resultsCount = $('.results-count');
        
        if (!$grid.length) return;
        
        var currentFilters = {
            category: 'all',
            variant: '',
            skintype: [],
            min_price: 0,
            max_price: 150,
            orderby: 'popularity',
            page: 1
        };
        
        function loadProducts() {
            $grid.addClass('loading').attr('aria-busy', 'true');
            announce('Producten laden...');
            
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_filter_products',
                    nonce: waxingShop.nonce,
                    ...currentFilters
                },
                success: function(response) {
                    if (response.success) {
                        $grid.html(response.data.html).removeClass('loading').attr('aria-busy', 'false');
                        $resultsCount.text(response.data.count + ' producten');
                        announce(response.data.count + ' producten gevonden');
                    }
                },
                error: function(xhr, status, error) {
                    $grid.removeClass('loading').attr('aria-busy', 'false');
                    handleAjaxError(xhr, status, error, 'filter-products');
                }
            });
        }

        // Toolbar filter buttons
        $('.filter-btn').on('click', function() {
            var filter = $(this).data('filter');
            $('.filter-btn').removeClass('active').attr('aria-pressed', 'false');
            $(this).addClass('active').attr('aria-pressed', 'true');
            
            if (filter === 'all') {
                currentFilters.category = 'all';
                currentFilters.variant = '';
            } else if (['rose', 'gold', 'sunset', 'nacree'].includes(filter)) {
                currentFilters.variant = filter;
                currentFilters.category = 'all';
            } else {
                currentFilters.category = filter;
                currentFilters.variant = '';
            }
            
            currentFilters.page = 1;
            loadProducts();
        });
        
        // Color options
        $('.color-option').on('click', function() {
            var $this = $(this);
            if ($this.hasClass('active')) {
                $this.removeClass('active').attr('aria-pressed', 'false');
                currentFilters.variant = '';
            } else {
                $('.color-option').removeClass('active').attr('aria-pressed', 'false');
                $this.addClass('active').attr('aria-pressed', 'true');
                currentFilters.variant = $this.data('filter') || $this.attr('title').toLowerCase();
            }
            loadProducts();
        });

        // Skin type filter
        $('#skinTypeFilter .sidebar-option').on('click', function() {
            var $this = $(this);
            var skintype = $this.data('skintype');

            $this.toggleClass('active');

            if ($this.hasClass('active')) {
                if (currentFilters.skintype.indexOf(skintype) === -1) {
                    currentFilters.skintype.push(skintype);
                }
            } else {
                var index = currentFilters.skintype.indexOf(skintype);
                if (index > -1) {
                    currentFilters.skintype.splice(index, 1);
                }
            }

            loadProducts();
        });

        // Sort select
        $('#shopSort').on('change', function() {
            currentFilters.orderby = $(this).val();
            loadProducts();
        });
        
        // Price inputs (debounced)
        var priceTimeout;
        $('#priceInputMin, #priceInputMax').on('change', function() {
            clearTimeout(priceTimeout);
            priceTimeout = setTimeout(function() {
                currentFilters.min_price = parseFloat($('#priceInputMin').val().replace('€', '')) || 0;
                currentFilters.max_price = parseFloat($('#priceInputMax').val().replace('€', '')) || 150;
                updatePriceSlider();
                loadProducts();
            }, 500);
        });

        // Price Range Slider
        var $slider = $('#priceSlider');
        var $handleMin = $('#priceHandleMin');
        var $handleMax = $('#priceHandleMax');
        var $track = $('#priceTrack');
        var isDragging = null;

        function getSliderWidth() {
            return $slider.width() || 200; // fallback to 200px
        }

        function initPriceSlider() {
            if (!$slider.length) return;

            $handleMin.on('mousedown touchstart', function(e) {
                e.preventDefault();
                isDragging = 'min';
                $(document).on('mousemove touchmove', handleDrag);
                $(document).on('mouseup touchend', stopDrag);
            });

            $handleMax.on('mousedown touchstart', function(e) {
                e.preventDefault();
                isDragging = 'max';
                $(document).on('mousemove touchmove', handleDrag);
                $(document).on('mouseup touchend', stopDrag);
            });

            // Keyboard support
            $handleMin.on('keydown', function(e) {
                handleKeyboard(e, 'min');
            });
            $handleMax.on('keydown', function(e) {
                handleKeyboard(e, 'max');
            });

            // Recalculate on window resize
            $(window).on('resize', function() {
                updatePriceSlider();
            });

            updatePriceSlider();
        }

        function handleDrag(e) {
            if (!isDragging) return;

            var sliderWidth = getSliderWidth();
            var clientX = e.type.includes('touch') ? e.originalEvent.touches[0].clientX : e.clientX;
            var sliderLeft = $slider.offset().left;
            var pos = Math.max(0, Math.min(sliderWidth, clientX - sliderLeft));
            var percent = pos / sliderWidth;
            var price = Math.round(percent * 150);

            if (isDragging === 'min') {
                price = Math.min(price, currentFilters.max_price - 5);
                currentFilters.min_price = price;
            } else {
                price = Math.max(price, currentFilters.min_price + 5);
                currentFilters.max_price = price;
            }

            updatePriceSlider();
        }

        function stopDrag() {
            if (isDragging) {
                isDragging = null;
                $(document).off('mousemove touchmove', handleDrag);
                $(document).off('mouseup touchend', stopDrag);
                loadProducts();
            }
        }

        function handleKeyboard(e, handle) {
            var step = 5;
            if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') {
                e.preventDefault();
                if (handle === 'min') {
                    currentFilters.min_price = Math.max(0, currentFilters.min_price - step);
                } else {
                    currentFilters.max_price = Math.max(currentFilters.min_price + step, currentFilters.max_price - step);
                }
                updatePriceSlider();
                loadProducts();
            } else if (e.key === 'ArrowRight' || e.key === 'ArrowUp') {
                e.preventDefault();
                if (handle === 'min') {
                    currentFilters.min_price = Math.min(currentFilters.max_price - step, currentFilters.min_price + step);
                } else {
                    currentFilters.max_price = Math.min(150, currentFilters.max_price + step);
                }
                updatePriceSlider();
                loadProducts();
            }
        }

        function updatePriceSlider() {
            var minPercent = (currentFilters.min_price / 150) * 100;
            var maxPercent = (currentFilters.max_price / 150) * 100;

            $handleMin.css('left', minPercent + '%').attr('aria-valuenow', currentFilters.min_price);
            $handleMax.css('left', maxPercent + '%').attr('aria-valuenow', currentFilters.max_price);
            $track.css({
                'left': minPercent + '%',
                'width': (maxPercent - minPercent) + '%'
            });

            $('#priceMinLabel').text('€' + currentFilters.min_price);
            $('#priceMaxLabel').text('€' + currentFilters.max_price);
            $('#priceInputMin').val('€' + currentFilters.min_price);
            $('#priceInputMax').val('€' + currentFilters.max_price);
        }

        // Initialize price slider
        initPriceSlider();
    }

    // ===========================================
    // QUICK VIEW MODAL
    // ===========================================
    function initQuickView() {
        var $modal = $('#quickViewModal');
        var $previousFocus = null;
        var currentProduct = null;
        var currentQuantity = 1;
        var currentVariation = null;
        
        // Open Quick View
        $(document).on('click', '.btn-quick-view', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var productId = $(this).data('product-id');
            $previousFocus = $(this);
            currentQuantity = 1;
            currentVariation = null;
            
            // Reset modal
            $('#quickViewQty').val(1);
            $('#quickViewVariants').hide();
            $('#quickViewThumbnails').hide().empty();
            $('#quickViewRating').hide();
            $('#quickViewPriceOld').hide();
            $('#quickViewImage').html('<div class="quick-view-loader"><div class="loader-spinner"></div></div>');
            
            // Open modal immediately for better UX
            $modal.addClass('active').attr('aria-hidden', 'false');
            $('body').addClass('modal-open');
            
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'GET',
                data: {
                    action: 'waxing_quick_view',
                    product_id: productId,
                    nonce: waxingShop.nonce
                },
                success: function(response) {
                    if (response.success) {
                        var data = response.data;
                        currentProduct = data;
                        
                        // Basic info
                        $('#quickViewCategory').text(data.category);
                        $('#quickViewTitle').text(data.name);
                        $('#quickViewPrice').html(data.price);
                        $('#quickViewDesc').html(data.short_description);
                        $('#quickViewLink').attr('href', data.permalink);
                        
                        // Sale price
                        if (data.on_sale && data.regular_price) {
                            $('#quickViewPriceOld').html(data.regular_price).show();
                        }
                        
                        // Rating
                        if (data.rating_count > 0) {
                            var stars = '★'.repeat(Math.round(data.rating)) + '☆'.repeat(5 - Math.round(data.rating));
                            $('#quickViewRating .stars').text(stars);
                            $('#quickViewRating .count').text('(' + data.rating_count + ')');
                            $('#quickViewRating').show();
                        }
                        
                        // Image
                        if (data.image) {
                            $('#quickViewImage').html('<img src="' + data.image + '" alt="' + data.name + '">');
                        } else {
                            $('#quickViewImage').css('background', data.color).html('');
                        }
                        
                        // Gallery thumbnails
                        if (data.gallery && data.gallery.length > 0) {
                            var thumbsHtml = '<div class="quick-view-thumb active" data-full="' + data.image + '"><img src="' + data.image_thumb + '" alt=""></div>';
                            data.gallery.forEach(function(img) {
                                thumbsHtml += '<div class="quick-view-thumb" data-full="' + img.full + '"><img src="' + img.thumb + '" alt=""></div>';
                            });
                            $('#quickViewThumbnails').html(thumbsHtml).show();
                        }
                        
                        // Variations
                        if (data.variations && data.variations.length > 0) {
                            var varHtml = '';
                            data.variations.forEach(function(v, i) {
                                var stockClass = v.in_stock ? '' : ' out-of-stock';
                                var activeClass = i === 0 ? ' active' : '';
                                varHtml += '<button class="variant-btn' + activeClass + stockClass + '" data-id="' + v.id + '" data-price="' + v.price_raw + '"' + (!v.in_stock ? ' disabled' : '') + '>' + v.name + '</button>';
                            });
                            $('#variantOptions').html(varHtml);
                            $('#quickViewVariants').show();
                            currentVariation = data.variations[0];
                        }
                        
                        // Stock status
                        updateStockDisplay(data);
                        
                        // Delivery
                        if (data.delivery) {
                            $('#quickViewDelivery span').text(data.delivery);
                        }
                        
                        // Update button price
                        updateButtonPrice();
                        
                        // Focus trap
                        trapFocus($modal.find('.modal-content'));
                        announce('Quick view geopend voor ' + data.name);
                    }
                },
                error: function(xhr, status, error) {
                    closeQuickView();
                    handleAjaxError(xhr, status, error, 'quick-view');
                }
            });
        });

        // Thumbnail click - scoped to quick view modal
        $(document).on('click', '#quickViewModal .quick-view-thumb', function(e) {
            e.preventDefault();
            var $thumb = $(this);
            var fullImg = $thumb.data('full');

            $('#quickViewModal .quick-view-thumb').removeClass('active');
            $thumb.addClass('active');
            $('#quickViewImage').html('<img src="' + fullImg + '" alt="">');
        });

        // Variant selection - scoped to quick view modal
        $(document).on('click', '#quickViewModal .variant-btn:not(.out-of-stock)', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var varId = $btn.data('id');

            $('#quickViewModal .variant-btn').removeClass('active');
            $btn.addClass('active');

            // Find the variation
            if (currentProduct && currentProduct.variations) {
                currentProduct.variations.forEach(function(v) {
                    if (v.id == varId) {
                        currentVariation = v;
                        $('#quickViewPrice').html(v.price);
                        if (v.image) {
                            $('#quickViewImage').html('<img src="' + v.image + '" alt="">');
                        }
                    }
                });
            }

            updateButtonPrice();
        });
        
        // Quantity controls - scoped to quick view modal
        $(document).on('click', '#quickViewModal .qty-minus', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $input = $('#quickViewQty');
            var val = parseInt($input.val()) || 1;
            if (val > 1) {
                $input.val(val - 1);
                currentQuantity = val - 1;
                updateButtonPrice();
            }
        });

        $(document).on('click', '#quickViewModal .qty-plus', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $input = $('#quickViewQty');
            var val = parseInt($input.val()) || 1;
            if (val < 99) {
                $input.val(val + 1);
                currentQuantity = val + 1;
                updateButtonPrice();
            }
        });

        $(document).on('change', '#quickViewQty', function() {
            currentQuantity = parseInt($(this).val()) || 1;
            updateButtonPrice();
        });
        
        function updateButtonPrice() {
            var price = currentVariation ? currentVariation.price_raw : (currentProduct ? currentProduct.price_raw : 0);
            var total = price * currentQuantity;
            $('#quickViewBtnPrice').text('€' + total.toFixed(2).replace('.', ','));
        }
        
        function updateStockDisplay(data) {
            var $stock = $('#quickViewStock');
            var stockData = currentVariation || data;
            
            $stock.removeClass('low out');
            
            if (!stockData.in_stock) {
                $stock.addClass('out');
                $stock.find('.stock-text').text('Uitverkocht');
            } else if (stockData.stock_qty && stockData.stock_qty <= 5) {
                $stock.addClass('low');
                $stock.find('.stock-text').text('Nog ' + stockData.stock_qty + ' op voorraad');
            } else {
                $stock.find('.stock-text').text('Op voorraad');
            }
        }
        
        // Add to Cart from Quick View
        $(document).on('click', '#quickViewAddCart', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var productId = currentVariation ? currentVariation.id : (currentProduct ? currentProduct.id : null);

            if (!productId) {
                showToast('Selecteer eerst een product', 'error');
                return;
            }

            if ($btn.hasClass('loading')) return;

            $btn.addClass('loading').prop('disabled', true).find('.btn-text').text('Bezig...');

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_add_to_cart',
                    product_id: productId,
                    quantity: currentQuantity || 1,
                    nonce: waxingShop.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart counts
                        $('#cartCount, #mobileCartCount, .cart-count, .header-cart-count').text(response.data.cart_count);

                        // Show success toast
                        showToast(response.data.product_name + ' toegevoegd aan winkelmand', 'success');

                        // Close Quick View
                        closeQuickView();

                        // Open Mini Cart
                        setTimeout(function() {
                            openMiniCart();
                        }, 200);

                        announce(response.data.message);
                    } else {
                        showToast(response.data.message || 'Er ging iets mis', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, 'quick-view-add-to-cart');
                },
                complete: function() {
                    $btn.removeClass('loading').prop('disabled', false).find('.btn-text').text('Toevoegen aan winkelmand');
                }
            });
        });
        
        function closeQuickView() {
            $modal.removeClass('active').attr('aria-hidden', 'true');
            $('body').removeClass('modal-open');
            releaseFocus($modal.find('.modal-content'));
            
            if ($previousFocus) {
                $previousFocus.focus();
            }
            
            currentProduct = null;
            currentVariation = null;
            announce('Quick view gesloten');
        }
        
        $(document).on('click', '#quickViewClose', closeQuickView);
        $(document).on('click', '#quickViewModal', function(e) {
            if (e.target === this) closeQuickView();
        });
        
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $modal.hasClass('active')) {
                closeQuickView();
            }
        });
    }
    
    // ===========================================
    // MINI CART SLIDE-IN
    // ===========================================
    function initMiniCart() {
        var $overlay = $('#miniCartOverlay');
        var $cart = $('#miniCart');
        var canClose = true;

        // Open mini cart (called after add to cart)
        window.openMiniCart = function() {
            loadMiniCart();
            $overlay.addClass('active');
            $('body').addClass('modal-open');
            trapFocus($cart);

            // Prevent immediate closing after opening
            canClose = false;
            setTimeout(function() {
                canClose = true;
            }, 300);
        };

        // Close mini cart
        function closeMiniCart() {
            if (!canClose) return;
            $overlay.removeClass('active');
            $('body').removeClass('modal-open');
            releaseFocus($cart);
        }

        $('#miniCartClose').on('click', closeMiniCart);

        // Close when clicking on overlay (but not on cart content)
        $overlay.on('click', function(e) {
            if (e.target === this) closeMiniCart();
        });
        
        // Load cart contents
        function loadMiniCart() {
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'GET',
                data: { action: 'waxing_get_cart' },
                success: function(response) {
                    if (response.success) {
                        updateMiniCartUI(response.data);
                        // Load suggestions if cart has items
                        if (response.data.cart_items && response.data.cart_items.length > 0) {
                            loadCartSuggestions();
                        } else {
                            $('#miniCartSuggestions').hide();
                        }
                    }
                }
            });
        }

        // Load product suggestions
        function loadCartSuggestions() {
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'GET',
                data: { action: 'waxing_get_cart_suggestions' },
                success: function(response) {
                    if (response.success && response.data.products && response.data.products.length > 0) {
                        renderSuggestions(response.data.products);
                    } else {
                        $('#miniCartSuggestions').hide();
                    }
                }
            });
        }

        // Render suggestions in UI
        function renderSuggestions(products) {
            var $container = $('#suggestionsList');
            var html = '';

            products.forEach(function(product) {
                html += '<div class="suggestion-item" data-product-id="' + product.id + '">';
                html += '<div class="suggestion-image">';
                if (product.image) {
                    html += '<img src="' + product.image + '" alt="" loading="lazy">';
                }
                html += '</div>';
                html += '<div class="suggestion-info">';
                html += '<a href="' + product.permalink + '" class="suggestion-name">' + escapeHtml(product.name) + '</a>';
                html += '<div class="suggestion-price">' + product.price + '</div>';
                html += '</div>';
                html += '<button class="suggestion-add" data-product-id="' + product.id + '" aria-label="Toevoegen aan winkelmand">';
                html += '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>';
                html += '</button>';
                html += '</div>';
            });

            $container.html(html);
            $('#miniCartSuggestions').show();
        }

        // Add suggestion to cart - scoped to mini cart suggestions
        $(document).on('click', '#miniCart .suggestion-add', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $btn = $(this);
            var productId = $btn.data('product-id');

            if (!productId || $btn.hasClass('loading')) return;

            $btn.prop('disabled', true).addClass('loading');

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_add_to_cart',
                    nonce: waxingShop.nonce,
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart counts
                        $('#cartCount, #mobileCartCount, .cart-count').text(response.data.cart_count);
                        $('#miniCartCount').text('(' + response.data.cart_count + ')');

                        // Show success feedback
                        $btn.removeClass('loading').addClass('added');
                        $btn.html('<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>');

                        showToast(response.data.product_name + ' toegevoegd', 'success');

                        // Reload cart to update
                        setTimeout(function() {
                            loadMiniCart();
                        }, 500);
                    } else {
                        $btn.prop('disabled', false).removeClass('loading');
                        showToast(response.data.message || 'Kon niet toevoegen', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    $btn.prop('disabled', false).removeClass('loading');
                    handleAjaxError(xhr, status, error, 'suggestion-add-to-cart');
                }
            });
        });
        
        function updateMiniCartUI(data) {
            var $items = $('#miniCartItems');
            var $footer = $('#miniCartFooter');
            
            $('#miniCartCount').text('(' + data.cart_count + ')');
            
            if (data.cart_items && data.cart_items.length > 0) {
                var html = '';
                data.cart_items.forEach(function(item) {
                    html += '<div class="mini-cart-item" data-key="' + item.key + '">';
                    html += '<div class="mini-cart-item-image">';
                    if (item.image) {
                        html += '<img src="' + item.image + '" alt="">';
                    }
                    html += '</div>';
                    html += '<div class="mini-cart-item-info">';
                    html += '<div class="mini-cart-item-name"><a href="' + item.permalink + '">' + item.name + '</a></div>';
                    html += '<div class="mini-cart-item-price">' + item.price + '</div>';
                    html += '<div class="mini-cart-item-qty">';
                    html += '<button class="mini-cart-qty-btn" data-action="minus">−</button>';
                    html += '<span>' + item.quantity + '</span>';
                    html += '<button class="mini-cart-qty-btn" data-action="plus">+</button>';
                    html += '<button class="mini-cart-item-remove">Verwijder</button>';
                    html += '</div></div></div>';
                });
                $items.html(html);
                
                $('#miniCartSubtotal').html(data.cart_total);
                $footer.show();
                
                // Shipping indicator
                var subtotal = parseFloat(data.cart_total.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
                if (subtotal >= 50) {
                    $('#miniCartShipping').html('✓ Gratis verzending!');
                } else {
                    var remaining = (50 - subtotal).toFixed(2).replace('.', ',');
                    $('#miniCartShipping').html('Nog €' + remaining + ' voor gratis verzending');
                }
            } else {
                $items.html('<div class="mini-cart-empty"><div class="empty-icon">🛒</div><p>Je winkelmand is leeg</p></div>');
                $footer.hide();
            }
        }
        
        // Update quantity - scoped to mini cart
        $(document).on('click', '#miniCart .mini-cart-qty-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $btn = $(this);
            var $item = $btn.closest('.mini-cart-item');
            var key = $item.data('key');
            var $qty = $item.find('.mini-cart-item-qty span');
            var currentQty = parseInt($qty.text()) || 1;
            var newQty = $btn.data('action') === 'plus' ? currentQty + 1 : currentQty - 1;

            if (newQty < 1) newQty = 0;

            $btn.prop('disabled', true);

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_update_cart_qty',
                    cart_item_key: key,
                    quantity: newQty,
                    nonce: waxingShop.nonce
                },
                success: function(response) {
                    if (response.success) {
                        updateMiniCartUI(response.data);
                        $('.header-cart-count, #mobileCartCount').text(response.data.cart_count);
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false);
                }
            });
        });

        // Remove item - scoped to mini cart
        $(document).on('click', '#miniCart .mini-cart-item-remove', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $btn = $(this);
            var $item = $btn.closest('.mini-cart-item');
            var key = $item.data('key');

            $btn.prop('disabled', true).text('Bezig...');

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_remove_cart_item',
                    cart_item_key: key,
                    nonce: waxingShop.nonce
                },
                success: function(response) {
                    if (response.success) {
                        updateMiniCartUI(response.data);
                        $('.header-cart-count, #mobileCartCount').text(response.data.cart_count);
                        announce('Product verwijderd');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Verwijder');
                }
            });
        });
        
        // Header cart click opens mini cart
        $(document).on('click', '.header-cart, .cart-btn', function(e) {
            e.preventDefault();
            openMiniCart();
        });

        // Close on Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $overlay.hasClass('active')) {
                closeMiniCart();
            }
        });
    }

    // ===========================================
    // FAQ ACCORDION
    // ===========================================
    function initFaq() {
        $(document).on('click', '.faq-question', function() {
            var $item = $(this).closest('.faq-item');
            var $answer = $item.find('.faq-answer');
            var wasActive = $item.hasClass('active');
            
            // Close others
            $('.faq-item').not($item).removeClass('active').find('.faq-question').attr('aria-expanded', 'false');
            
            // Toggle current
            $item.toggleClass('active');
            $(this).attr('aria-expanded', !wasActive);
            
            announce(wasActive ? 'Antwoord verborgen' : 'Antwoord getoond');
        });
        
        // Keyboard support
        $(document).on('keydown', '.faq-question', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                $(this).click();
            }
        });
        
        // Make focusable
        $('.faq-question').attr('tabindex', '0').attr('role', 'button').attr('aria-expanded', 'false');
    }

    // ===========================================
    // QUIZ
    // ===========================================
    function initQuiz() {
        var $quiz = $('#waxQuiz');
        if (!$quiz.length) return;
        
        var currentStep = 1;
        var totalSteps = 4;
        var answers = {};
        
        var products = {
            rose:   { name: 'Rose Hotwax', desc: 'Speciaal voor gevoelige huid met verzorgende ingrediënten.', price: '€24,95', color: '#F5E4E6' },
            gold:   { name: 'Gold Hotwax', desc: 'Perfecte all-rounder voor normaal haar en huid.', price: '€22,95', color: '#F2E8D5' },
            sunset: { name: 'Sunset Hotwax', desc: 'Krachtige formule voor sterk en dik haar.', price: '€26,95', color: '#F7DFD0' },
            nacree: { name: 'Nacrée Hotwax', desc: 'Universele wax geschikt voor alle huidtypes.', price: '€21,95', color: '#F9F9F7' }
        };
        
        function showStep(step) {
            $('.quiz-step').removeClass('active').hide().attr('aria-hidden', 'true');
            var $step = $('.quiz-step[data-step="' + step + '"]');
            $step.addClass('active').show().attr('aria-hidden', 'false');
            
            // Update progress
            $('.quiz-progress-step').removeClass('active completed');
            for (var i = 1; i <= totalSteps; i++) {
                if (i < step) $('.quiz-progress-step[data-step="' + i + '"]').addClass('completed');
                if (i === step) $('.quiz-progress-step[data-step="' + i + '"]').addClass('active');
            }
            
            // Update buttons
            $('.quiz-prev').css('visibility', step > 1 ? 'visible' : 'hidden');
            $('.quiz-next').prop('disabled', !answers[step]).text(step === totalSteps ? 'Bekijk resultaat' : 'Volgende →');
            $('.quiz-nav').toggle(step !== 'result');
            
            announce('Vraag ' + step + ' van ' + totalSteps);
        }
        
        // Option click and keyboard
        $(document).on('click keydown', '.quiz-option', function(e) {
            if (e.type === 'keydown' && e.key !== 'Enter' && e.key !== ' ') return;
            if (e.type === 'keydown') e.preventDefault();
            
            var $step = $(this).closest('.quiz-step');
            var key = $(this).data('key');
            var value = $(this).data('value');
            
            $step.find('.quiz-option').removeClass('selected').attr('aria-checked', 'false');
            $(this).addClass('selected').attr('aria-checked', 'true');
            
            answers[currentStep] = { key: key, value: value };
            answers[key] = value;
            
            $('.quiz-next').prop('disabled', false);
            
            announce($(this).find('.quiz-option-title').text() + ' geselecteerd');
        });
        
        // Make options keyboard accessible
        $('.quiz-option').attr('tabindex', '0').attr('role', 'radio').attr('aria-checked', 'false');
        
        // Next button
        $(document).on('click', '.quiz-next', function() {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            } else {
                showResult();
            }
        });
        
        // Prev button
        $(document).on('click', '.quiz-prev', function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
        
        function showResult() {
            var rec = getRecommendation();
            var product = products[rec];
            
            var html = '<div class="quiz-result-icon" aria-hidden="true">🎉</div>';
            html += '<h3 class="quiz-result-title">Jouw perfecte match!</h3>';
            html += '<p style="color:#666;margin-bottom:20px;">Op basis van jouw antwoorden raden we aan:</p>';
            html += '<a href="' + waxingShop.shopUrl + '?s=' + encodeURIComponent(product.name) + '" class="quiz-result-product">';
            html += '<div class="quiz-result-image" style="background:' + product.color + '" aria-hidden="true">';
            html += '<div style="display:flex;flex-wrap:wrap;gap:4px;width:60px;">';
            for (var i = 0; i < 6; i++) html += '<div style="width:16px;height:11px;border-radius:6px;background:rgba(255,255,255,0.6)"></div>';
            html += '</div></div>';
            html += '<div class="quiz-result-info">';
            html += '<h4 class="quiz-result-name">' + product.name + '</h4>';
            html += '<p class="quiz-result-desc">' + product.desc + '</p>';
            html += '<span class="quiz-result-price">' + product.price + '</span>';
            html += '</div></a>';
            html += '<div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:24px">';
            html += '<a href="' + waxingShop.shopUrl + '?s=' + encodeURIComponent(product.name) + '" class="btn btn-sage">Bekijk product</a>';
            html += '<button class="btn btn-secondary quiz-reset">Opnieuw</button>';
            html += '</div>';
            
            $('.quiz-result').html(html).addClass('active').attr('aria-hidden', 'false');
            $('.quiz-step').hide().attr('aria-hidden', 'true');
            $('.quiz-nav').hide();
            
            announce('Jouw aanbevolen product is ' + product.name);
        }
        
        function getRecommendation() {
            var skin = answers.skin || 'normal';
            var hair = answers.hair || 'medium';
            
            if (skin === 'sensitive') return 'rose';
            if (hair === 'coarse') return 'sunset';
            if (skin === 'normal' && hair === 'medium') return 'gold';
            return 'nacree';
        }
        
        // Reset
        $(document).on('click', '.quiz-reset', function() {
            currentStep = 1;
            answers = {};
            $('.quiz-result').removeClass('active').empty().attr('aria-hidden', 'true');
            $('.quiz-option').removeClass('selected').attr('aria-checked', 'false');
            showStep(1);
        });
        
        // Init
        showStep(1);
    }

    // ===========================================
    // NEWSLETTER
    // ===========================================
    function initNewsletter() {
        function submit($form, source) {
            var $input = $form.find('input[type="email"]');
            var $btn = $form.find('button[type="submit"]');
            var email = $input.val();
            
            $btn.prop('disabled', true).attr('aria-busy', 'true').text('Bezig...');
            
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_newsletter',
                    nonce: waxingShop.nonce,
                    email: email,
                    source: source
                },
                success: function(response) {
                    var message = response.data ? response.data.message : 'Er ging iets mis';
                    var $msg = $form.siblings('.newsletter-message, #newsletterMessage');
                    if (!$msg.length) $msg = $('<p class="newsletter-message"></p>').insertAfter($form);
                    
                    $msg.show().text(message);
                    $msg.css('color', response.success ? 'white' : '#ffcdd2');
                    
                    announce(message);
                    
                    if (response.success) {
                        $input.val('');
                        if (source === 'popup') {
                            setTimeout(function() {
                                closeNewsletterPopup();
                            }, 2000);
                        }
                    }
                    
                    $btn.prop('disabled', false).attr('aria-busy', 'false').text(source === 'popup' ? 'Ontvang mijn korting' : 'Inschrijven');
                },
                error: function(xhr, status, error) {
                    $btn.prop('disabled', false).attr('aria-busy', 'false').text(source === 'popup' ? 'Ontvang mijn korting' : 'Inschrijven');
                    handleAjaxError(xhr, status, error, 'newsletter');
                }
            });
        }

        $('#newsletterForm').on('submit', function(e) {
            e.preventDefault();
            submit($(this), 'footer');
        });
        
        $('#newsletterPopupForm').on('submit', function(e) {
            e.preventDefault();
            submit($(this), 'popup');
        });
        
        // Popup logic
        var $popup = $('#newsletterPopup');
        var popupDismissed = localStorage.getItem('waxing_popup_dismissed');
        
        if (!popupDismissed) {
            setTimeout(function() {
                $popup.addClass('active').attr('aria-hidden', 'false');
                trapFocus($popup.find('.newsletter-popup-content'));
            }, 30000);
        }
        
        function closeNewsletterPopup() {
            $popup.removeClass('active').attr('aria-hidden', 'true');
            releaseFocus($popup.find('.newsletter-popup-content'));
            localStorage.setItem('waxing_popup_dismissed', 'true');
        }
        
        $('#newsletterPopupClose').on('click', closeNewsletterPopup);
        $popup.on('click', function(e) {
            if (e.target === this) closeNewsletterPopup();
        });
        
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $popup.hasClass('active')) {
                closeNewsletterPopup();
            }
        });
    }

    // ===========================================
    // CONVERSION: SHIPPING COUNTDOWN
    // ===========================================
    function initShippingCountdown() {
        var $countdown = $('.shipping-countdown');
        if (!$countdown.length) return;
        
        function update() {
            var now = new Date();
            var cutoff = new Date();
            cutoff.setHours(17, 0, 0, 0);
            
            if (now >= cutoff || now.getDay() === 0 || now.getDay() === 6) {
                $countdown.hide();
                return;
            }
            
            var diff = cutoff - now;
            var hours = Math.floor(diff / (1000 * 60 * 60));
            var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            
            $countdown.find('.countdown-hours').text(hours);
            $countdown.find('.countdown-minutes').text(minutes.toString().padStart(2, '0'));
        }
        
        update();
        setInterval(update, 60000);
    }

    // ===========================================
    // SEARCH MODAL
    // ===========================================
    function initSearch() {
        var $modal = $('#searchModal');
        var $input = $('#searchInput');
        var $results = $('#searchResults');
        var $close = $('#searchClose');
        var searchTimeout;

        // Open search modal
        $('#headerSearch, #mobileSearchBtn').on('click', function() {
            // Close mobile menu if open
            $('#mobileMenu').removeClass('active');
            $('#mobileMenuToggle').removeClass('active');

            $modal.addClass('active').attr('aria-hidden', 'false');
            $('body').addClass('modal-open');
            setTimeout(function() {
                $input.focus();
            }, 100);
            // Show popular products on open
            loadPopularProducts();
            announce('Zoekvenster geopend');
        });

        // Close search modal
        function closeSearch() {
            $modal.removeClass('active').attr('aria-hidden', 'true');
            $('body').removeClass('modal-open');
            $input.val('');
            announce('Zoekvenster gesloten');
        }

        $close.on('click', closeSearch);
        $modal.on('click', function(e) {
            if (e.target === this) closeSearch();
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $modal.hasClass('active')) {
                closeSearch();
            }
            // Ctrl/Cmd + K to open search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                $('#headerSearch').click();
            }
        });

        // Live search
        $input.on('input', function() {
            var query = $(this).val().trim();

            clearTimeout(searchTimeout);

            if (query.length < 2) {
                loadPopularProducts();
                return;
            }

            $results.html('<div class="search-loading"><div class="loader-spinner"></div></div>');

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: waxingShop.ajaxUrl,
                    type: 'GET',
                    data: {
                        action: 'waxing_live_search',
                        s: query
                    },
                    success: function(response) {
                        if (response.success && response.data.total > 0) {
                            var html = '';

                            // Products section (first)
                            if (response.data.products && response.data.products.length > 0) {
                                html += '<div class="search-section search-section-products">';
                                html += '<p class="search-results-title"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Producten (' + response.data.products.length + ')</p>';
                                html += '<div class="search-products-grid">';
                                response.data.products.forEach(function(product) {
                                    html += '<div class="search-result-item" data-product-id="' + product.id + '">';
                                    html += '<a href="' + escapeHtml(product.permalink) + '" class="search-result-link">';
                                    html += '<div class="search-result-image">';
                                    if (product.image) {
                                        html += '<img src="' + escapeHtml(product.image) + '" alt="" loading="lazy">';
                                    }
                                    html += '</div>';
                                    html += '<div class="search-result-info">';
                                    html += '<p class="search-result-name">' + escapeHtml(product.name) + '</p>';
                                    html += '<p class="search-result-price">' + product.price + '</p>';
                                    html += '</div></a>';
                                    html += '<button class="search-add-cart" data-product-id="' + product.id + '" aria-label="Toevoegen aan winkelmand">';
                                    html += '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>';
                                    html += '</button>';
                                    html += '</div>';
                                });
                                html += '</div></div>';
                            }

                            // Articles section (second)
                            if (response.data.articles && response.data.articles.length > 0) {
                                html += '<div class="search-section search-section-articles">';
                                html += '<p class="search-results-title"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg> Artikelen (' + response.data.articles.length + ')</p>';
                                html += '<div class="search-articles-list">';
                                response.data.articles.forEach(function(article) {
                                    html += '<a href="' + escapeHtml(article.permalink) + '" class="search-article-item">';
                                    if (article.image) {
                                        html += '<div class="search-article-image"><img src="' + escapeHtml(article.image) + '" alt="" loading="lazy"></div>';
                                    }
                                    html += '<div class="search-article-info">';
                                    html += '<p class="search-article-name">' + escapeHtml(article.name) + '</p>';
                                    html += '<p class="search-article-excerpt">' + escapeHtml(article.excerpt) + '</p>';
                                    html += '<span class="search-article-date">' + article.date + '</span>';
                                    html += '</div></a>';
                                });
                                html += '</div></div>';
                            }

                            // Pages section (third)
                            if (response.data.pages && response.data.pages.length > 0) {
                                html += '<div class="search-section search-section-pages">';
                                html += '<p class="search-results-title"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg> Pagina\'s (' + response.data.pages.length + ')</p>';
                                html += '<div class="search-pages-list">';
                                response.data.pages.forEach(function(page) {
                                    html += '<a href="' + escapeHtml(page.permalink) + '" class="search-page-item">';
                                    html += '<p class="search-page-name">' + escapeHtml(page.name) + '</p>';
                                    if (page.excerpt) {
                                        html += '<p class="search-page-excerpt">' + escapeHtml(page.excerpt) + '</p>';
                                    }
                                    html += '</a>';
                                });
                                html += '</div></div>';
                            }

                            // View all link
                            html += '<a href="' + waxingShop.homeUrl + '?s=' + encodeURIComponent(query) + '" class="btn btn-secondary btn-block" style="margin-top:16px;">Alle ' + response.data.total + ' resultaten bekijken</a>';

                            $results.html(html);
                        } else {
                            $results.html('<div class="search-no-results"><p>Geen resultaten gevonden voor "' + escapeHtml(query) + '"</p><p class="search-no-results-hint">Probeer een andere zoekterm of bekijk onze <a href="' + waxingShop.shopUrl + '">producten</a></p></div>');
                        }
                    }
                });
            }, 300);
        });

        // Load popular/featured products
        function loadPopularProducts() {
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'GET',
                data: { action: 'waxing_get_popular_products' },
                success: function(response) {
                    if (response.success && response.data.products.length > 0) {
                        var html = '<p class="search-results-title">Populaire producten</p>';
                        html += '<div class="search-products-grid">';
                        response.data.products.forEach(function(product) {
                            html += '<div class="search-result-item" data-product-id="' + product.id + '">';
                            html += '<a href="' + escapeHtml(product.permalink) + '" class="search-result-link">';
                            html += '<div class="search-result-image">';
                            if (product.image) {
                                html += '<img src="' + escapeHtml(product.image) + '" alt="" loading="lazy">';
                            }
                            html += '</div>';
                            html += '<div class="search-result-info">';
                            html += '<p class="search-result-name">' + escapeHtml(product.name) + '</p>';
                            html += '<p class="search-result-price">' + product.price + '</p>';
                            html += '</div></a>';
                            html += '<button class="search-add-cart" data-product-id="' + product.id + '" aria-label="Toevoegen aan winkelmand">';
                            html += '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>';
                            html += '</button>';
                            html += '</div>';
                        });
                        html += '</div>';

                        // Add popular search tags
                        html += '<div class="search-popular"><p class="search-popular-title">Populaire zoekopdrachten</p>';
                        html += '<div class="search-popular-tags">';
                        html += '<button class="search-tag" data-search="hotwax">Hotwax</button>';
                        html += '<button class="search-tag" data-search="starterset">Startersets</button>';
                        html += '<button class="search-tag" data-search="rose">Rose</button>';
                        html += '<button class="search-tag" data-search="gold">Gold</button>';
                        html += '</div></div>';

                        $results.html(html);
                    } else {
                        showFallbackSearches();
                    }
                },
                error: function() {
                    showFallbackSearches();
                }
            });
        }

        function showFallbackSearches() {
            var html = '<div class="search-popular"><p class="search-popular-title">Populaire zoekopdrachten</p>';
            html += '<div class="search-popular-tags">';
            html += '<button class="search-tag" data-search="hotwax">Hotwax</button>';
            html += '<button class="search-tag" data-search="starterset">Startersets</button>';
            html += '<button class="search-tag" data-search="rose">Rose</button>';
            html += '<button class="search-tag" data-search="gold">Gold</button>';
            html += '</div></div>';
            $results.html(html);
        }

        // Handle search tag click
        $(document).on('click', '.search-tag', function() {
            var searchTerm = $(this).data('search');
            $input.val(searchTerm).trigger('input');
        });

        // Add to cart from search results
        $(document).on('click', '.search-add-cart', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $btn = $(this);
            var productId = $btn.data('product-id');
            var productName = $btn.closest('.search-result-item').find('.search-result-name').text();

            $btn.prop('disabled', true).addClass('loading');

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_add_to_cart',
                    nonce: waxingShop.nonce,
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart counts
                        $('#cartCount, #mobileCartCount, .cart-count').text(response.data.cart_count);
                        $('#miniCartCount').text('(' + response.data.cart_count + ')');

                        // Show success
                        $btn.removeClass('loading').addClass('added');
                        $btn.html('<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>');

                        showToast(productName + ' toegevoegd aan winkelmand', 'success');

                        // Reset button after delay
                        setTimeout(function() {
                            $btn.removeClass('added').prop('disabled', false);
                            $btn.html('<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>');
                        }, 2000);
                    } else {
                        $btn.prop('disabled', false).removeClass('loading');
                        showToast(response.data.message || 'Kon niet toevoegen', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    $btn.prop('disabled', false).removeClass('loading');
                    handleAjaxError(xhr, status, error, 'search-add-to-cart');
                }
            });
        });
    }

    // ===========================================
    // IMPROVED WISHLIST WITH PERSISTENCE
    // ===========================================
    function initWishlistPersistent() {
        var wishlist = getWishlist();

        // Mark existing wishlist items on page load
        $('.product-wishlist').each(function() {
            var productId = $(this).closest('[data-product-id]').data('product-id');
            if (wishlist.indexOf(productId) !== -1) {
                $(this).addClass('active').text('♥').attr('aria-pressed', 'true');
            }
        });

        // Handle wishlist toggle
        $(document).on('click', '.product-wishlist', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $btn = $(this);
            var productId = $btn.closest('[data-product-id]').data('product-id');

            if (!productId) return;

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_wishlist_toggle',
                    product_id: productId,
                    nonce: waxingShop.nonce
                },
                success: function(response) {
                    if (response.success) {
                        if (response.data.action === 'added') {
                            $btn.addClass('active').text('♥').attr('aria-pressed', 'true');
                        } else {
                            $btn.removeClass('active').text('♡').attr('aria-pressed', 'false');
                        }
                        // Update all buttons for this product
                        $('[data-product-id="' + productId + '"] .product-wishlist').each(function() {
                            if (response.data.action === 'added') {
                                $(this).addClass('active').text('♥').attr('aria-pressed', 'true');
                            } else {
                                $(this).removeClass('active').text('♡').attr('aria-pressed', 'false');
                            }
                        });
                        saveWishlist(response.data.wishlist);
                        announce(response.data.message);
                        // Update header wishlist count
                        $('#wishlistCount').text(response.data.count).attr('data-count', response.data.count);
                        $('#wishlistHeaderCount').text('(' + response.data.count + ')');
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, 'wishlist-toggle');
                }
            });
        });

        function getWishlist() {
            try {
                var stored = localStorage.getItem('waxing_wishlist');
                return stored ? JSON.parse(stored) : [];
            } catch (e) {
                return [];
            }
        }

        function saveWishlist(list) {
            try {
                localStorage.setItem('waxing_wishlist', JSON.stringify(list));
            } catch (e) {}
        }
    }

    // ===========================================
    // NEWSLETTER POPUP TRIGGER
    // ===========================================
    function initNewsletterPopupTrigger() {
        var $popup = $('#newsletterPopup');
        var popupShown = localStorage.getItem('waxing_popup_shown');
        var hasShownThisSession = false;

        if (popupShown) return; // Already shown before

        // Timer trigger - show after 30 seconds
        var timerTrigger = setTimeout(function() {
            if (!hasShownThisSession) {
                showNewsletterPopup();
            }
        }, 30000);

        // Exit intent trigger (desktop only)
        if (window.innerWidth > 768) {
            $(document).on('mouseleave', function(e) {
                if (e.clientY < 10 && !hasShownThisSession) {
                    clearTimeout(timerTrigger);
                    showNewsletterPopup();
                }
            });
        }

        // Scroll trigger - after scrolling 50% of page
        $(window).on('scroll.newsletter', function() {
            var scrollPercent = ($(window).scrollTop() / ($(document).height() - $(window).height())) * 100;
            if (scrollPercent > 50 && !hasShownThisSession) {
                clearTimeout(timerTrigger);
                showNewsletterPopup();
                $(window).off('scroll.newsletter');
            }
        });

        function showNewsletterPopup() {
            if (hasShownThisSession) return;
            hasShownThisSession = true;

            $popup.addClass('active').attr('aria-hidden', 'false');
            trapFocus($popup.find('.newsletter-popup-content'));
            announce('Nieuwsbrief aanmelding popup geopend');

            // Mark as shown for 7 days
            localStorage.setItem('waxing_popup_shown', Date.now());
        }
    }

    // ===========================================
    // WISHLIST SIDEBAR
    // ===========================================
    function initWishlistSidebar() {
        var $overlay = $('#wishlistOverlay');
        var $sidebar = $('#wishlistSidebar');
        var $items = $('#wishlistItems');
        var $empty = $('#wishlistEmpty');
        var $footer = $('#wishlistFooter');
        var $count = $('#wishlistCount');
        var $headerCount = $('#wishlistHeaderCount');

        // Open wishlist sidebar
        $('#headerWishlist').on('click', function() {
            loadWishlistItems();
            $overlay.addClass('active').attr('aria-hidden', 'false');
            $('body').addClass('modal-open');
            trapFocus($sidebar);
            announce('Favorieten geopend');
        });

        // Close wishlist sidebar
        function closeWishlist() {
            $overlay.removeClass('active').attr('aria-hidden', 'true');
            $('body').removeClass('modal-open');
            releaseFocus($sidebar);
        }

        $('#wishlistClose').on('click', closeWishlist);

        // Close when clicking on overlay (but not on sidebar content)
        $overlay.on('click', function(e) {
            if (e.target === this) closeWishlist();
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $overlay.hasClass('active')) {
                closeWishlist();
            }
        });

        // Load wishlist items
        function loadWishlistItems() {
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'GET',
                data: {
                    action: 'waxing_get_wishlist_items'
                },
                success: function(response) {
                    if (response.success && response.data.items.length > 0) {
                        var html = '';
                        response.data.items.forEach(function(item) {
                            html += '<div class="wishlist-item" data-product-id="' + item.id + '">';
                            html += '<div class="wishlist-item-image">';
                            if (item.image) {
                                html += '<img src="' + escapeHtml(item.image) + '" alt="" loading="lazy">';
                            }
                            html += '</div>';
                            html += '<div class="wishlist-item-info">';
                            html += '<p class="wishlist-item-name"><a href="' + escapeHtml(item.permalink) + '">' + escapeHtml(item.name) + '</a></p>';
                            html += '<p class="wishlist-item-price">' + item.price + '</p>';
                            html += '<div class="wishlist-item-actions">';
                            html += '<button class="wishlist-item-add" data-product-id="' + item.id + '">In winkelmand</button>';
                            html += '</div>';
                            html += '</div>';
                            html += '<button class="wishlist-item-remove" data-product-id="' + item.id + '" aria-label="Verwijderen">×</button>';
                            html += '</div>';
                        });
                        $items.html(html);
                        $footer.show();
                        updateWishlistCount(response.data.items.length);
                    } else {
                        $items.html($empty.prop('outerHTML'));
                        $footer.hide();
                        updateWishlistCount(0);
                    }
                }
            });
        }

        // Remove item from wishlist - scoped to wishlist sidebar
        $(document).on('click', '#wishlistSidebar .wishlist-item-remove', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var productId = $btn.data('product-id');
            var $item = $btn.closest('.wishlist-item');

            $item.fadeOut(200, function() {
                $(this).remove();
                // Check if empty
                if ($('.wishlist-item').length === 0) {
                    $items.html($empty.clone().show());
                    $footer.hide();
                }
            });

            // Update via AJAX
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_wishlist_toggle',
                    product_id: productId,
                    nonce: waxingShop.nonce
                },
                success: function(response) {
                    if (response.success) {
                        updateWishlistCount(response.data.count);
                        // Update product card buttons
                        $('[data-product-id="' + productId + '"] .product-wishlist').removeClass('active').text('♡');
                        announce('Verwijderd uit favorieten');
                    }
                }
            });
        });

        // Add item to cart from wishlist - scoped to wishlist sidebar
        $(document).on('click', '#wishlistSidebar .wishlist-item-add', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $btn = $(this);
            var productId = $btn.data('product-id');
            var productName = $btn.closest('.wishlist-item').find('.wishlist-item-name').text() || 'Product';

            if (!productId || $btn.prop('disabled')) return;

            $btn.prop('disabled', true).text('Toevoegen...');

            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_add_to_cart',
                    nonce: waxingShop.nonce,
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.success) {
                        $btn.addClass('added').text('Toegevoegd!');

                        // Update all cart count elements
                        $('#cartCount, #mobileCartCount, .cart-count').text(response.data.cart_count);
                        $('#miniCartCount').text('(' + response.data.cart_count + ')');

                        // Show success toast
                        showToast(productName + ' toegevoegd aan winkelmand', 'success');

                        // Close wishlist and open mini cart after brief delay
                        setTimeout(function() {
                            closeWishlist();
                            openMiniCart();
                            $btn.removeClass('added').prop('disabled', false).text('In winkelmand');
                        }, 800);
                    } else {
                        $btn.prop('disabled', false).text('In winkelmand');
                        showToast(response.data.message || 'Kon niet toevoegen', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    $btn.prop('disabled', false).text('In winkelmand');
                    handleAjaxError(xhr, status, error, 'wishlist-add-to-cart');
                }
            });
        });

        function updateWishlistCount(count) {
            $count.text(count).attr('data-count', count);
            $headerCount.text('(' + count + ')');
            if (count === 0) {
                $count.hide();
            } else {
                $count.show();
            }
        }

        // Initial count setup
        var initialCount = parseInt($count.text()) || 0;
        if (initialCount === 0) {
            $count.hide();
        }
    }

    // ===========================================
    // HELPER: ESCAPE HTML FOR XSS PREVENTION
    // ===========================================
    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // ===========================================
    // INIT
    // ===========================================
    $(document).ready(function() {
        initLoader();
        initHeader();
        initMobileMenu();
        initScrollReveal();
        initSmoothScroll();
        initAjaxCart();
        initWishlistPersistent(); // Replaced initWishlist
        initShopFilters();
        initQuickView();
        initMiniCart();
        initFaq();
        initQuiz();
        initNewsletter();
        initShippingCountdown();
        initSearch();
        initNewsletterPopupTrigger();
        initWishlistSidebar();
        initSetConfigurator();
        initWaxenGids();
    });

    // ===========================================
    // WAXEN GIDS PAGE
    // ===========================================
    function initWaxenGids() {
        // Only run on waxen gids page
        if (!$('.waxen-gids-page').length) return;

        // Tab functionality
        $('.waxen-tab').on('click', function() {
            var $this = $(this);
            var tabId = $this.data('tab');

            // Update tab buttons
            $('.waxen-tab').removeClass('active');
            $this.addClass('active');

            // Update tab content
            $('.waxen-tab-content').removeClass('active');
            $('#' + tabId).addClass('active');
        });

        // FAQ Accordion
        $('.waxen-gids-page .faq-question').on('click', function() {
            var $item = $(this).closest('.faq-item');
            $item.toggleClass('active');
        });

        // Handle anchor links from navigation
        if (window.location.hash) {
            var hash = window.location.hash.substring(1);

            // Check if it's a tab
            var $tab = $('.waxen-tab[data-tab="' + hash + '"]');
            if ($tab.length) {
                $tab.trigger('click');
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $('#content').offset().top - 100
                    }, 500);
                }, 100);
            } else {
                // Check if it's a section (academy, faq, etc.)
                var $section = $('#' + hash);
                if ($section.length) {
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $section.offset().top - 100
                        }, 500);
                    }, 300);
                }
            }
        }

        // Smooth scroll for internal anchor links
        $('.waxen-gids-page a[href^="#"]').on('click', function(e) {
            var target = $(this).attr('href');
            if (target.length > 1) {
                var $target = $(target);
                if ($target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $target.offset().top - 100
                    }, 500);
                }
            }
        });
    }

    // ===========================================
    // SET CONFIGURATOR
    // ===========================================
    function initSetConfigurator() {
        var $modal = $('#configuratorModal');
        var $content = $modal.find('.configurator-content');
        var COMPLETE_SET_PRICE = 79.95;

        // Open configurator from set buttons
        $(document).on('click', '.set-configure-btn, .open-configurator', function(e) {
            e.preventDefault();
            var setType = $(this).data('set');
            openConfigurator(setType);
        });

        function openConfigurator(presetType) {
            // Reset to default selections
            $modal.find('input[name="warmer"][value="400ml"]').prop('checked', true);
            $modal.find('input[name="wax[]"]').prop('checked', false);
            $modal.find('input[name="wax[]"][value="nacree"]').prop('checked', true);
            $modal.find('input[name="accessory[]"]').prop('checked', false);
            $modal.find('input[name="accessory[]"][value="spatels50"]').prop('checked', true);

            // Apply preset if specified
            if (presetType === 'starter') {
                $modal.find('input[name="warmer"][value="400ml"]').prop('checked', true);
            } else if (presetType === 'complete') {
                $modal.find('input[name="warmer"][value="800ml"]').prop('checked', true);
                $modal.find('input[name="accessory[]"][value="spatels100"]').prop('checked', true);
                $modal.find('input[name="accessory[]"][value="spatels50"]').prop('checked', false);
                $modal.find('input[name="accessory[]"][value="preoil"]').prop('checked', true);
                $modal.find('input[name="accessory[]"][value="afterlotion"]').prop('checked', true);
            } else if (presetType === 'pro') {
                $modal.find('input[name="warmer"][value="800ml"]').prop('checked', true);
                $modal.find('input[name="wax[]"][value="rose"]').prop('checked', true);
                $modal.find('input[name="accessory[]"][value="spatels100"]').prop('checked', true);
                $modal.find('input[name="accessory[]"][value="spatels50"]').prop('checked', false);
                $modal.find('input[name="accessory[]"][value="preoil"]').prop('checked', true);
                $modal.find('input[name="accessory[]"][value="afterlotion"]').prop('checked', true);
            }

            $modal.addClass('active').attr('aria-hidden', 'false');
            $('body').addClass('modal-open');
            updateConfiguratorTotal();
            announce('Set samensteller geopend');
        }

        // Close configurator
        function closeConfigurator() {
            $modal.removeClass('active').attr('aria-hidden', 'true');
            $('body').removeClass('modal-open');
        }

        $(document).on('click', '#configuratorClose', closeConfigurator);

        // Close when clicking on overlay (the overlay is a sibling to content, so no stopPropagation needed)
        $(document).on('click', '.configurator-overlay', closeConfigurator);

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $modal.hasClass('active')) {
                closeConfigurator();
            }
        });

        // Limit wax selection to max 3
        $(document).on('change', 'input[name="wax[]"]', function() {
            var checkedWax = $modal.find('input[name="wax[]"]:checked').length;
            if (checkedWax > 3) {
                $(this).prop('checked', false);
                showToast('Je kunt maximaal 3 wax soorten kiezen', 'warning');
                return;
            }
            updateConfiguratorTotal();
        });

        // Update on any input change
        $(document).on('change', '#configuratorModal input', function() {
            updateConfiguratorTotal();
        });

        function updateConfiguratorTotal() {
            var total = 0;
            var summaryItems = [];

            // Warmer
            var $warmer = $modal.find('input[name="warmer"]:checked');
            var warmerPrice = parseFloat($warmer.data('price')) || 0;
            total += warmerPrice;
            if (warmerPrice > 0) {
                var warmerName = $warmer.closest('.option-card').find('.option-name').text();
                summaryItems.push(warmerName);
            }

            // Wax types
            $modal.find('input[name="wax[]"]:checked').each(function() {
                var price = parseFloat($(this).data('price')) || 0;
                var name = $(this).data('name');
                total += price;
                summaryItems.push(name);
            });

            // Accessories
            $modal.find('input[name="accessory[]"]:checked').each(function() {
                var price = parseFloat($(this).data('price')) || 0;
                var name = $(this).data('name');
                total += price;
                summaryItems.push(name);
            });

            // Update UI
            var formattedTotal = '€' + total.toFixed(2).replace('.', ',');
            $('#configTotalPrice').text(formattedTotal);
            $('#configBtnTotal').text(formattedTotal);

            // Update comparison
            var savings = total - COMPLETE_SET_PRICE;
            if (savings > 0) {
                $('#configSavings').text('(Bespaar €' + savings.toFixed(2).replace('.', ',') + ')').show();
            } else if (savings < 0) {
                $('#configSavings').text('(€' + Math.abs(savings).toFixed(2).replace('.', ',') + ' duurder)').hide();
            } else {
                $('#configSavings').text('').hide();
            }

            // Update summary
            var summaryHtml = '';
            summaryItems.forEach(function(item) {
                summaryHtml += '<span class="summary-item">' + escapeHtml(item) + '</span>';
            });
            $('#configSummary').html(summaryHtml);

            // Enable/disable add to cart
            var hasWax = $modal.find('input[name="wax[]"]:checked').length > 0;
            $('#configAddToCart').prop('disabled', !hasWax);
        }

        // Add configured items to cart
        $(document).on('click', '#configAddToCart', function(e) {
            e.preventDefault();
            var $btn = $(this);

            if ($btn.prop('disabled')) return;

            // Collect all selected items
            var items = [];

            // Note: In a real implementation, these would map to actual WooCommerce product IDs
            // For now, we'll show a success message and redirect to shop

            $btn.prop('disabled', true).text('Toevoegen...');

            // Simulate adding items (in production, this would be multiple AJAX calls)
            setTimeout(function() {
                showToast('Producten toegevoegd aan je winkelmand!', 'success');
                closeConfigurator();

                // Open mini cart or redirect
                if (typeof openMiniCart === 'function') {
                    openMiniCart();
                }

                $btn.prop('disabled', false).html('Toevoegen aan winkelmand <span class="btn-total" id="configBtnTotal">€0,00</span>');
            }, 800);
        });

        // Initialize totals on page load
        updateConfiguratorTotal();
    }

    // ===========================================
    // STARTER SETS ADD TO CART
    // ===========================================
    function initStarterSets() {
        // Handle starter set add to cart
        $(document).on('click', '.set-add-to-cart', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $card = $btn.closest('.set-card');
            var setId = $btn.data('set-id');
            var productId = $btn.data('product-id');

            // Collect wax choices from dropdowns
            var waxChoices = [];
            var allSelected = true;

            $card.find('.wax-select').each(function() {
                var value = $(this).val();
                if (!value) {
                    allSelected = false;
                } else {
                    waxChoices.push(value);
                }
            });

            // Validate all wax options selected
            if (!allSelected) {
                showToast('Selecteer alle wax opties', 'warning');
                $card.find('.wax-select:not(:valid)').first().focus();
                return;
            }

            // Show loading state
            $btn.addClass('loading').prop('disabled', true);

            // Send AJAX request
            $.ajax({
                url: waxingShop.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'waxing_add_starter_set',
                    nonce: waxingShop.nonce,
                    set_id: setId,
                    product_id: productId,
                    wax_choices: waxChoices
                },
                success: function(response) {
                    if (response.success) {
                        showToast(response.data.message, 'success');

                        // Update cart count
                        $('.cart-count').text(response.data.cart_count);

                        // Trigger WooCommerce cart fragment refresh
                        $(document.body).trigger('wc_fragment_refresh');

                        // Open mini cart if available
                        if (typeof openMiniCart === 'function') {
                            openMiniCart();
                        }
                    } else {
                        showToast(response.data.message || 'Er ging iets mis', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, 'adding set to cart');
                },
                complete: function() {
                    $btn.removeClass('loading').prop('disabled', false);
                }
            });
        });
    }

    // ===========================================
    // SAVINGS CALCULATOR
    // ===========================================
    function initCalculator() {
        var $calcZones = $('#calcZones');
        var $calcFreq = $('#calcFreq');
        var $calcSalon = $('#calcSalon');
        var $calcHome = $('#calcHome');
        var $calcSaving = $('#calcSaving');
        var $calcSaving5Year = $('#calcSaving5Year');

        // Only run if calculator exists
        if (!$calcZones.length) return;

        var HOME_COST = 132; // Complete Set (€79.95) + 1 refill (€51.90)
        var YEARLY_REFILL_COST = 52; // Extra refill cost per year after first year

        function calculate() {
            var totalZonePrice = 0;
            var checkedCount = 0;

            // Sum up all checked zones
            $calcZones.find('input[type="checkbox"]:checked').each(function() {
                totalZonePrice += parseInt($(this).val()) || 0;
                checkedCount++;
            });

            // Get frequency
            var frequency = parseInt($calcFreq.val()) || 8;

            // Calculate salon cost per year
            var salonCostPerYear = totalZonePrice * frequency;

            // Calculate home cost (increases slightly with more zones)
            var homeFirstYearCost = HOME_COST;
            if (checkedCount > 2) {
                // Add a bit more for extra wax needed
                homeFirstYearCost += (checkedCount - 2) * 20;
            }

            // Calculate yearly savings (first year)
            var yearlySaving = salonCostPerYear - homeFirstYearCost;

            // Calculate 5-year totals
            var salonCost5Year = salonCostPerYear * 5;
            var homeCost5Year = homeFirstYearCost + (YEARLY_REFILL_COST * 4); // First year + 4 refills
            if (checkedCount > 2) {
                homeCost5Year += (checkedCount - 2) * 15 * 4; // Extra wax for more zones
            }
            var saving5Year = salonCost5Year - homeCost5Year;

            // Update display
            $calcSalon.text('€' + salonCostPerYear);
            $calcHome.text('€' + homeFirstYearCost);
            $calcSaving.text('€' + Math.max(0, yearlySaving));

            // Update 5-year display if element exists
            if ($calcSaving5Year.length) {
                $calcSaving5Year.text('€' + Math.max(0, saving5Year));
            }

            // Add animation effect
            $calcSaving.addClass('highlight');
            if ($calcSaving5Year.length) {
                $calcSaving5Year.addClass('highlight');
            }
            setTimeout(function() {
                $calcSaving.removeClass('highlight');
                if ($calcSaving5Year.length) {
                    $calcSaving5Year.removeClass('highlight');
                }
            }, 300);
        }

        // Bind events
        $calcZones.on('change', 'input[type="checkbox"]', calculate);
        $calcFreq.on('change', calculate);

        // Initial calculation
        calculate();
    }

    // Add to document ready
    $(document).ready(function() {
        initStarterSets();
        initCalculator();
    });

})(jQuery);

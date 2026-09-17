/**
 * Food Junction - Custom Frontend Scripts
 * Dedicated JavaScript for interactive landing pages, special offers, order calculations, and modals.
 */

(function (window, document, $) {
    'use strict';

    // Digit mapping for Bengali language conversion
    const ENGLISH_TO_BANGLA = {
        '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪',
        '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'
    };

    /**
     * Convert English digits to Bengali digits
     * @param {number|string} num
     * @returns {string}
     */
    window.toBanglaNum = function (num) {
        if (num === null || num === undefined) return '';
        return num.toString().replace(/\d/g, function (digit) {
            return ENGLISH_TO_BANGLA[digit] || digit;
        });
    };

    /**
     * Adjust order quantity on special offer landing page
     * @param {number} delta (+1 or -1)
     */
    window.changeOrderQty = function (delta) {
        let input = document.getElementById('order-qty');
        if (!input) return;

        let currentVal = parseInt(input.value, 10) || 1;
        let newVal = Math.max(1, Math.min(50, currentVal + delta));
        input.value = newVal;

        let formQty = document.getElementById('form-quantity');
        if (formQty) {
            formQty.value = newVal;
        }

        window.calculateOrderTotal();
    };

    /**
     * Calculate subtotal, delivery fees, and grand total for direct order form
     */
    window.calculateOrderTotal = function () {
        let orderForm = document.getElementById('baklava-direct-order-form');
        let unitPriceDisplay = document.getElementById('unit-price-display');

        let unitPrice = 1350;
        let defaultDeliveryFee = 80;
        let whatsappNumber = '8801672756634';
        let packageName = '২০ পিস বাকলাভা + হাফকেজি পেরা সন্দেশ ফ্রী';

        if (orderForm) {
            if (orderForm.dataset.unitPrice) {
                unitPrice = parseFloat(orderForm.dataset.unitPrice) || unitPrice;
            }
            if (orderForm.dataset.defaultDelivery) {
                defaultDeliveryFee = parseFloat(orderForm.dataset.defaultDelivery) || defaultDeliveryFee;
            }
            if (orderForm.dataset.whatsapp) {
                whatsappNumber = orderForm.dataset.whatsapp;
            }
            if (orderForm.dataset.packageName) {
                packageName = orderForm.dataset.packageName;
            }
        } else if (unitPriceDisplay) {
            let extractedPrice = parseFloat(unitPriceDisplay.innerText.replace(/[^\d.]/g, ''));
            if (!isNaN(extractedPrice) && extractedPrice > 0) {
                unitPrice = extractedPrice;
            }
        }

        let qtyInput = document.getElementById('order-qty');
        let qty = parseInt(qtyInput ? qtyInput.value : 1, 10) || 1;

        let zoneSelect = document.getElementById('delivery_zone');
        let deliveryFee = defaultDeliveryFee;
        if (zoneSelect && zoneSelect.selectedIndex >= 0) {
            let selectedOption = zoneSelect.options[zoneSelect.selectedIndex];
            let optFee = selectedOption.getAttribute('data-fee');
            if (optFee !== null && !isNaN(parseFloat(optFee))) {
                deliveryFee = parseFloat(optFee);
            }
        }

        let subtotal = unitPrice * qty;
        let grandTotal = subtotal + deliveryFee;

        let summaryQty = document.getElementById('summary-qty');
        let summarySubtotal = document.getElementById('summary-subtotal');
        let summaryDelivery = document.getElementById('summary-delivery');
        let summaryGrandTotal = document.getElementById('summary-grand-total');
        let stickyPriceEl = document.getElementById('sticky-price-display');
        let whatsappLink = document.getElementById('whatsapp-order-link');

        if (summaryQty) summaryQty.innerText = window.toBanglaNum(qty);
        if (summarySubtotal) summarySubtotal.innerText = window.toBanglaNum(subtotal);
        if (summaryDelivery) summaryDelivery.innerText = window.toBanglaNum(deliveryFee);
        if (summaryGrandTotal) summaryGrandTotal.innerText = window.toBanglaNum(grandTotal);
        if (stickyPriceEl) stickyPriceEl.innerText = window.toBanglaNum(subtotal);

        if (whatsappLink) {
            let waText = encodeURIComponent(`হ্যালো Food Junction, আমি ${qty}টি বাকলাভা অফার প্যাকেজ (${packageName} - মোট ৳${grandTotal}) অর্ডার করতে চাই।`);
            whatsappLink.href = `https://wa.me/${whatsappNumber}?text=${waText}`;
        }
    };

    /**
     * Open Zoom Modal for Customer Review Screenshots
     * @param {string} imgSrc
     */
    window.openReviewModal = function (imgSrc) {
        let modalImg = document.getElementById('modalReviewImg');
        let modalEl = document.getElementById('reviewZoomModal');
        if (modalImg && modalEl && typeof bootstrap !== 'undefined') {
            modalImg.src = imgSrc;
            let reviewModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            reviewModal.show();
        }
    };

    /**
     * Initialize Live Countdown Urgency Timer
     */
    window.initCountdownTimer = function () {
        let timerWidget = document.querySelector('.custom-timer-widget');
        if (!timerWidget) return;

        let endTimeStr = timerWidget.dataset.endTime;
        let targetTimestamp = 0;
        let hasFixedEndTime = false;

        if (endTimeStr && endTimeStr.trim() !== '') {
            let parsed = new Date(endTimeStr).getTime();
            if (!isNaN(parsed) && parsed > Date.now()) {
                hasFixedEndTime = true;
                targetTimestamp = parsed;
            }
        }

        // Fallback rolling urgency duration: 24 hours
        let fallbackDuration = 24 * 3600;
        let fallbackSeconds = fallbackDuration;

        let daysBoxEl = document.getElementById('timer-days-box');
        let colonDayEl = document.getElementById('timer-colon-day');
        let daysEl = document.getElementById('timer-days');
        let hrsEl = document.getElementById('timer-hours');
        let minsEl = document.getElementById('timer-minutes');
        let secsEl = document.getElementById('timer-seconds');

        function updateTimerDisplay() {
            let remaining = 0;

            if (hasFixedEndTime) {
                remaining = Math.max(0, Math.floor((targetTimestamp - Date.now()) / 1000));
            } else {
                if (fallbackSeconds <= 0) {
                    fallbackSeconds = fallbackDuration;
                }
                remaining = fallbackSeconds;
                fallbackSeconds--;
            }

            let days = Math.floor(remaining / 86400);
            let hrs = Math.floor((remaining % 86400) / 3600);
            let mins = Math.floor((remaining % 3600) / 60);
            let secs = remaining % 60;

            // If day > 0, show day box and day colon; if remaining <= 23h 59m 59s, hide day box
            if (days > 0) {
                if (daysBoxEl) daysBoxEl.style.display = 'flex';
                if (colonDayEl) colonDayEl.style.display = 'inline';
                if (daysEl) daysEl.innerText = window.toBanglaNum(String(days).padStart(2, '0'));
            } else {
                if (daysBoxEl) daysBoxEl.style.display = 'none';
                if (colonDayEl) colonDayEl.style.display = 'none';
            }

            if (hrsEl) hrsEl.innerText = window.toBanglaNum(String(hrs).padStart(2, '0'));
            if (minsEl) minsEl.innerText = window.toBanglaNum(String(mins).padStart(2, '0'));
            if (secsEl) secsEl.innerText = window.toBanglaNum(String(secs).padStart(2, '0'));
        }

        updateTimerDisplay();
        setInterval(updateTimerDisplay, 1000);
    };

    /**
     * Initialize Sticky Bottom Floating Order Bar
     */
    window.initStickyBottomBar = function () {
        const stickyBar = document.getElementById('stickyBottomBar');
        const orderSection = document.getElementById('order-section');
        if (!stickyBar) return;

        function handleScroll() {
            const scrollY = window.scrollY || window.pageYOffset;
            if (scrollY > 350) {
                if (orderSection) {
                    const rect = orderSection.getBoundingClientRect();
                    if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                        stickyBar.classList.remove('show-bar');
                        return;
                    }
                }
                stickyBar.classList.add('show-bar');
            } else {
                stickyBar.classList.remove('show-bar');
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    };

    /**
     * Smooth scrolling for internal anchor links
     */
    window.initSmoothScroll = function () {
        document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });
    };

    /**
     * Initialize Direct Order AJAX form submission with validation
     */
    window.initDirectOrderForm = function () {
        let orderForm = $('#baklava-direct-order-form');
        if (!orderForm.length) return;

        orderForm.on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let name = $('#name').val() ? $('#name').val().trim() : '';
            let phone = $('#number').val() ? $('#number').val().trim() : '';
            let address = $('#address').val() ? $('#address').val().trim() : '';
            let deliveryZone = $('#delivery_zone').val();
            let terms = $('#all_terms').is(':checked');

            if (!name) {
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('Please enter your full name (আপনার নাম লিখুন)।');
                } else {
                    alert('Please enter your full name (আপনার নাম লিখুন)।');
                }
                $('#name').focus();
                return;
            }

            if (!phone) {
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('Please enter your phone number (মোবাইল নম্বর লিখুন)।');
                } else {
                    alert('Please enter your phone number (মোবাইল নম্বর লিখুন)।');
                }
                $('#number').focus();
                return;
            }

            if (!/^\d{11}$/.test(phone)) {
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('The phone number must be exactly 11 digits (১১ ডিজিটের ফোন নম্বর দিন, যেমন: 017XXXXXXXX)।');
                } else {
                    alert('The phone number must be exactly 11 digits (১১ ডিজিটের ফোন নম্বর দিন, যেমন: 017XXXXXXXX)।');
                }
                $('#number').focus();
                return;
            }

            if (!address) {
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('Please enter your delivery address (সম্পূর্ণ ডেলিভারি ঠিকানা লিখুন)।');
                } else {
                    alert('Please enter your delivery address (সম্পূর্ণ ডেলিভারি ঠিকানা লিখুন)।');
                }
                $('#address').focus();
                return;
            }

            if (!deliveryZone) {
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('Please select your delivery zone (ডেলিভারি এরিয়া নির্বাচন করুন)।');
                } else {
                    alert('Please select your delivery zone (ডেলিভারি এরিয়া নির্বাচন করুন)।');
                }
                $('#delivery_zone').focus();
                return;
            }

            if (!terms) {
                if (typeof window.showErrorToast === 'function') {
                    window.showErrorToast('Please accept the Terms and Conditions (শর্তাবলীতে সম্মতি দিন)।');
                } else {
                    alert('Please accept the Terms and Conditions (শর্তাবলীতে সম্মতি দিন)।');
                }
                $('#all_terms').focus();
                return;
            }

            let submitBtn = $('#submit-order-btn');
            submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Placing Order... / অর্ডার প্রসেস হচ্ছে...');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        if (typeof window.showSuccessToast === 'function') {
                            window.showSuccessToast(res.message || 'Order placed successfully! Redirecting...');
                        }
                        setTimeout(function () {
                            window.location.href = res.redirect_url || '/order-confirmed';
                        }, 500);
                    } else {
                        submitBtn.prop('disabled', false).html('<i class="fa-solid fa-circle-check me-1"></i> Place Order — অর্ডার কনফার্ম করুন (ক্যাশ অন ডেলিভারি)');
                        if (typeof window.showErrorToast === 'function') {
                            window.showErrorToast(res.message || 'Failed to place order. Please try again.');
                        } else {
                            alert(res.message || 'Failed to place order. Please try again.');
                        }
                    }
                },
                error: function (xhr) {
                    submitBtn.prop('disabled', false).html('<i class="fa-solid fa-circle-check me-1"></i> Place Order — অর্ডার কনফার্ম করুন (ক্যাশ অন ডেলিভারি)');
                    let errMsg = 'Failed to place order. Please check all required fields.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    if (typeof window.showErrorToast === 'function') {
                        window.showErrorToast(errMsg);
                    } else {
                        alert(errMsg);
                    }
                }
            });
        });
    };

    /**
     * Show / Hide Password Input Toggle
     * @param {string} inputId
     * @param {HTMLElement} btn
     */
    window.togglePasswordVisibility = function (inputId, btn) {
        let input = document.getElementById(inputId);
        if (!input) return;

        let icon = btn ? btn.querySelector('i') : null;
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    };

    // Auto-run on DOM Ready
    $(function () {
        window.calculateOrderTotal();
        window.initCountdownTimer();
        window.initStickyBottomBar();
        window.initSmoothScroll();
        window.initDirectOrderForm();
    });

})(window, document, jQuery);

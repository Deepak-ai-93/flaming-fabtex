document.addEventListener('DOMContentLoaded', function () {
    var page = document.querySelector('[data-product-page]');
    if (!page) return;

    var minimum = Number(page.dataset.minQuantity) || 25;
    var productName = page.dataset.productName;
    var quantityInput = document.getElementById('pd-order-qty');
    var totalElement = document.getElementById('pd-est-total');
    var tiers = Array.prototype.slice.call(page.querySelectorAll('.pd-slab-item'));
    var selectedColor = 'Navy Blue';
    var selectedSize = 'L';
    var currentQuantity = minimum;
    var pinCode = '';

    function currentTier(quantity) {
        var activeTier = tiers[0];
        tiers.forEach(function (tier) {
            if (quantity >= Number(tier.dataset.minQty)) activeTier = tier;
        });
        return activeTier;
    }

    function quoteUrl() {
        var message = "Hi Fleming Fabtex, I'd like a bulk quote for " + productName +
            '. Quantity: ' + currentQuantity + ' pcs, size: ' + selectedSize +
            ', color: ' + selectedColor + '.';
        if (pinCode) message += ' Delivery PIN: ' + pinCode + '.';
        return 'https://wa.me/917990718742?text=' + encodeURIComponent(message);
    }

    function updateQuoteLinks() {
        var href = quoteUrl();
        document.querySelectorAll('.product-whatsapp-link').forEach(function (link) {
            link.href = href;
        });
    }

    function updateEstimate() {
        var rawQuantity = parseInt(quantityInput.value, 10);
        var quantity = Number.isFinite(rawQuantity) ? rawQuantity : minimum;
        quantity = Math.max(minimum, quantity);

        quantityInput.setAttribute('aria-invalid', 'false');

        var tier = currentTier(quantity);
        var unitPrice = Number(tier.dataset.unitPrice);
        currentQuantity = quantity;
        totalElement.textContent = '₹' + (quantity * unitPrice).toLocaleString('en-IN');

        tiers.forEach(function (item) {
            var active = item === tier;
            item.classList.toggle('active', active);
            item.setAttribute('aria-pressed', active ? 'true' : 'false');
        });

        var stickyPrice = document.getElementById('pd-sticky-price');
        if (stickyPrice) stickyPrice.textContent = '₹' + unitPrice.toLocaleString('en-IN');
        updateQuoteLinks();
    }

    page.querySelectorAll('.pd-thumb-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var mainImage = document.getElementById('pd-main-img');
            var stickyImage = document.querySelector('.pd-sticky-thumb');
            var source = button.dataset.gallerySrc;

            if (!mainImage || !source) return;
            mainImage.src = source;
            if (stickyImage) stickyImage.src = source;

            page.querySelectorAll('.pd-thumb-btn').forEach(function (thumbnail) {
                var active = thumbnail === button;
                thumbnail.classList.toggle('active', active);
                thumbnail.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
        });
    });

    page.querySelectorAll('.pd-swatch').forEach(function (button) {
        button.addEventListener('click', function () {
            selectedColor = button.dataset.color;
            document.getElementById('pd-active-color').textContent = selectedColor;
            page.querySelectorAll('.pd-swatch').forEach(function (swatch) {
                var active = swatch === button;
                swatch.classList.toggle('selected', active);
                swatch.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
            updateQuoteLinks();
        });
    });

    function selectSize(size) {
        selectedSize = size;
        document.getElementById('pd-active-size').textContent = size;
        page.querySelectorAll('.pd-size-btn').forEach(function (button) {
            var active = button.dataset.size === size;
            button.classList.toggle('selected', active);
            button.setAttribute('aria-pressed', active ? 'true' : 'false');
        });
        page.querySelectorAll('#pd-main-size-table tbody tr').forEach(function (row) {
            row.classList.toggle('highlight-row', row.dataset.size === size);
        });
        updateQuoteLinks();
    }

    page.querySelectorAll('.pd-size-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            selectSize(button.dataset.size);
        });
    });

    if (quantityInput) {
        quantityInput.addEventListener('input', updateEstimate);
        quantityInput.addEventListener('change', function () {
            var requested = parseInt(quantityInput.value, 10);
            if (!Number.isFinite(requested)) requested = minimum;
            requested = Math.ceil(Math.max(minimum, requested) / minimum) * minimum;
            quantityInput.value = String(Math.min(Math.floor(Number.MAX_SAFE_INTEGER / minimum) * minimum, requested));
            updateEstimate();
        });
    }

    document.getElementById('pd-qty-minus').addEventListener('click', function () {
        var quantity = parseInt(quantityInput.value, 10) || minimum;
        quantityInput.value = String(Math.max(minimum, quantity - minimum));
        updateEstimate();
    });
    document.getElementById('pd-qty-plus').addEventListener('click', function () {
        var quantity = parseInt(quantityInput.value, 10) || minimum;
        quantityInput.value = String(Math.min(Math.floor(Number.MAX_SAFE_INTEGER / minimum) * minimum, quantity + minimum));
        updateEstimate();
    });

    tiers.forEach(function (tier) {
        tier.addEventListener('click', function () {
            quantityInput.value = String(Number(tier.dataset.minQty));
            updateEstimate();
        });
    });

    var tabButtons = Array.prototype.slice.call(page.querySelectorAll('.pd-tab-btn'));
    function activateTab(button, scrollToPanel) {
        var activePanelId = button.dataset.tab;
        tabButtons.forEach(function (tab) {
            var active = tab === button;
            tab.classList.toggle('active', active);
            tab.setAttribute('aria-selected', active ? 'true' : 'false');
            tab.tabIndex = active ? 0 : -1;

            var panel = document.getElementById(tab.dataset.tab);
            panel.classList.toggle('active', active);
            panel.setAttribute('aria-hidden', active ? 'false' : 'true');
        });

        if (scrollToPanel) {
            var panel = document.getElementById(activePanelId);
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    tabButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            activateTab(button, false);
        });
        button.addEventListener('keydown', function (event) {
            var index = tabButtons.indexOf(button);
            if (event.key === 'ArrowRight') index = (index + 1) % tabButtons.length;
            else if (event.key === 'ArrowLeft') index = (index - 1 + tabButtons.length) % tabButtons.length;
            else if (event.key === 'Home') index = 0;
            else if (event.key === 'End') index = tabButtons.length - 1;
            else return;

            event.preventDefault();
            tabButtons[index].focus();
            activateTab(tabButtons[index], false);
        });
    });
    if (tabButtons.length) activateTab(tabButtons[0], false);

    var sizeChartButton = document.querySelector('[data-open-size-chart]');
    if (sizeChartButton) {
        sizeChartButton.addEventListener('click', function () {
            var sizeTab = document.getElementById('tab-size-chart-button');
            if (sizeTab) {
                activateTab(sizeTab, true);
                sizeTab.focus();
            }
        });
    }

    page.querySelectorAll('.pd-unit-toggle .unit-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var unit = button.dataset.unit;
            page.querySelectorAll('.pd-unit-toggle .unit-btn').forEach(function (unitButton) {
                var active = unitButton === button;
                unitButton.classList.toggle('active', active);
                unitButton.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
            page.querySelectorAll('#pd-main-size-table .cell-val').forEach(function (cell) {
                cell.textContent = cell.dataset[unit];
            });
        });
    });

    var pinInput = document.getElementById('pd-pincode');
    var pinButton = document.getElementById('pd-check-pin-btn');
    var pinResult = document.getElementById('pd-pin-res');
    pinInput.addEventListener('input', function () {
        pinCode = '';
        pinInput.setAttribute('aria-invalid', 'false');
        updateQuoteLinks();
    });
    pinButton.addEventListener('click', function () {
        var value = pinInput.value.trim();
        if (!/^\d{6}$/.test(value)) {
            pinCode = '';
            pinInput.setAttribute('aria-invalid', 'true');
            pinResult.textContent = 'Enter a valid 6-digit PIN to include it in your quote.';
            updateQuoteLinks();
            pinInput.focus();
            return;
        }

        pinCode = value;
        pinInput.setAttribute('aria-invalid', 'false');
        pinResult.textContent = 'PIN added. Use “Request a Bulk Quote” to ask the team to confirm delivery.';
        updateQuoteLinks();
    });

    var actionBox = document.getElementById('pd-action-box');
    var stickyBar = document.getElementById('pd-sticky-bar');
    if (actionBox && stickyBar && 'IntersectionObserver' in window) {
        var actionWasVisible = false;
        var observer = new IntersectionObserver(function (entries) {
            var visible = entries[0].isIntersecting;
            if (visible) actionWasVisible = true;
            var show = actionWasVisible && !visible;
            stickyBar.classList.toggle('show', show);
            stickyBar.setAttribute('aria-hidden', show ? 'false' : 'true');
            stickyBar.inert = !show;
            document.body.classList.toggle('pd-sticky-show', show);
        });
        observer.observe(actionBox);
    }

    updateEstimate();

    var stockFab = document.getElementById('pd-stock-fab');
    var stockToggle = document.getElementById('pd-stock-toggle');
    var stockPanel = document.getElementById('pd-stock-panel');
    var stockClose = document.getElementById('pd-stock-close');

    if (stockFab && stockToggle && stockPanel) {
        var openStockPanel = function (open) {
            stockPanel.hidden = !open;
            stockToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            stockFab.classList.toggle('is-open', open);
            if (open) {
                var firstButton = stockPanel.querySelector('.pd-stock-panel-close');
                if (firstButton) firstButton.focus();
            }
        };

        stockToggle.addEventListener('click', function () {
            openStockPanel(stockPanel.hidden);
        });

        if (stockClose) {
            stockClose.addEventListener('click', function () {
                openStockPanel(false);
                stockToggle.focus();
            });
        }

        document.addEventListener('click', function (event) {
            if (stockPanel.hidden) return;
            if (!stockFab.contains(event.target)) openStockPanel(false);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !stockPanel.hidden) {
                openStockPanel(false);
                stockToggle.focus();
            }
        });
    }
});

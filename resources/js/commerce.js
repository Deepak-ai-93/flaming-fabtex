document.addEventListener('DOMContentLoaded', function () {
    var storageKey = 'fleming.bulk-quote.v1';
    var minimumQuantity = 25;

    function showStorageError(message) {
        var target = document.querySelector('[data-storage-error]');
        if (target) {
            target.textContent = message;
            target.hidden = false;
        } else {
            notify(message, 'error');
        }
    }

    function isValidItem(item) {
        return item &&
            typeof item.slug === 'string' &&
            /^[a-z0-9-]+$/.test(item.slug) &&
            typeof item.name === 'string' &&
            typeof item.image === 'string' &&
            /^\/assets\/img\/[a-zA-Z0-9._-]+$/.test(item.image) &&
            Number.isFinite(Number(item.price)) &&
            Number(item.price) > 0 &&
            Number.isFinite(Number(item.quantity)) &&
            Number(item.quantity) >= minimumQuantity;
    }

    function loadItems() {
        try {
            var stored = localStorage.getItem(storageKey);
            if (!stored) return [];

            var items = JSON.parse(stored);
            if (!Array.isArray(items) || !items.every(isValidItem)) {
                throw new TypeError('The saved quote list has an invalid format.');
            }
            return items;
        } catch (error) {
            showStorageError('We could not read your saved quote list. Clear it and add the products again.');
            console.error('Unable to read the saved quote list.', error);
            return [];
        }
    }

    function saveItems(items) {
        try {
            localStorage.setItem(storageKey, JSON.stringify(items));
            return true;
        } catch (error) {
            showStorageError('Your browser could not save this quote list. Enable local storage and try again.');
            console.error('Unable to save the quote list.', error);
            return false;
        }
    }

    function formatCurrency(amount) {
        return '₹' + Math.round(amount).toLocaleString('en-IN');
    }

    function unitPrice(item, quantity) {
        var price = Number(item.price);
        if (quantity >= 1000) return Math.round(price * 0.8);
        if (quantity >= 300) return Math.round(price * 0.88);
        if (quantity >= 100) return Math.round(price * 0.94);
        return price;
    }

    function quantityStep(value) {
        var maxQuantity = Math.floor(Number.MAX_SAFE_INTEGER / minimumQuantity) * minimumQuantity;
        var requested = parseInt(value, 10);
        if (!Number.isFinite(requested)) requested = minimumQuantity;
        requested = Math.ceil(Math.max(minimumQuantity, requested) / minimumQuantity) * minimumQuantity;
        return Math.min(maxQuantity, requested);
    }

    function itemKey(item) {
        return [item.slug, item.size || 'L', item.color || 'Navy Blue'].join('|');
    }

    function updateBadges(items) {
        var count = String(items.length);
        var quoteBadge = document.getElementById('fleming-quote-count');
        var cartBadge = document.getElementById('fleming-bag-count');
        if (quoteBadge) quoteBadge.textContent = count;
        if (cartBadge) cartBadge.textContent = count;
    }

    function notify(message, type) {
        var toast = document.getElementById('fleming-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'fleming-toast';
            toast.setAttribute('role', 'status');
            document.body.appendChild(toast);
        }
        toast.textContent = message;
        toast.className = 'fq-toast show' + (type === 'error' ? ' err' : '');
        window.clearTimeout(toast._timeout);
        toast._timeout = window.setTimeout(function () {
            toast.className = 'fq-toast';
        }, 3200);
    }

    function createTextElement(tagName, className, text) {
        var element = document.createElement(tagName);
        if (className) element.className = className;
        element.textContent = text;
        return element;
    }

    function renderCart(items) {
        var list = document.querySelector('[data-cart-items]');
        if (!list) return;

        list.textContent = '';
        var totalPieces = 0;
        var estimate = 0;

        items.forEach(function (item, index) {
            var quantity = quantityStep(item.quantity);
            var itemTotal = unitPrice(item, quantity) * quantity;
            totalPieces += quantity;
            estimate += itemTotal;

            var row = document.createElement('li');
            row.className = 'fcart-item';
            row.dataset.cartKey = itemKey(item);

            var imageLink = document.createElement('a');
            imageLink.className = 'fcart-thumb';
            imageLink.href = '/product/' + encodeURIComponent(item.slug);
            var image = document.createElement('img');
            image.src = item.image;
            image.alt = '';
            image.loading = index === 0 ? 'eager' : 'lazy';
            imageLink.appendChild(image);

            var info = document.createElement('div');
            info.className = 'fcart-info';
            var nameLink = createTextElement('a', 'fcart-name', item.name);
            nameLink.href = '/product/' + encodeURIComponent(item.slug);
            info.appendChild(nameLink);
            info.appendChild(createTextElement('div', 'fcart-unit', formatCurrency(unitPrice(item, quantity)) + ' /piece'));
            info.appendChild(createTextElement('div', 'fcart-hint', [item.color, item.size, item.category].filter(Boolean).join(' · ')));

            var quantityControl = document.createElement('label');
            quantityControl.className = 'fcart-qty';
            quantityControl.appendChild(createTextElement('span', 'fcart-qty-lbl', 'Quantity · minimum 25'));
            var input = document.createElement('input');
            input.type = 'number';
            input.min = String(minimumQuantity);
            input.step = String(minimumQuantity);
            input.value = String(quantity);
            input.setAttribute('aria-label', 'Quantity for ' + item.name);
            input.dataset.cartQuantity = '';
            quantityControl.appendChild(input);

            var subtotal = document.createElement('div');
            subtotal.className = 'fcart-sub-wrap';
            subtotal.appendChild(createTextElement('span', 'fcart-sub-lbl', 'Line estimate'));
            subtotal.appendChild(createTextElement('div', 'fcart-sub', formatCurrency(itemTotal)));

            var remove = document.createElement('button');
            remove.type = 'button';
            remove.className = 'fcart-remove';
            remove.textContent = '×';
            remove.setAttribute('aria-label', 'Remove ' + item.name);
            remove.dataset.removeQuoteItem = '';

            row.append(imageLink, info, quantityControl, subtotal, remove);
            list.appendChild(row);
        });

        var hasItems = items.length > 0;
        var empty = document.querySelector('[data-cart-empty]');
        var content = document.querySelector('[data-cart-content]');
        if (empty) empty.hidden = hasItems;
        if (content) content.hidden = !hasItems;

        document.querySelectorAll('[data-cart-pieces]').forEach(function (element) {
            element.textContent = totalPieces.toLocaleString('en-IN');
        });
        document.querySelectorAll('[data-cart-estimate]').forEach(function (element) {
            element.textContent = formatCurrency(estimate);
        });
        document.querySelectorAll('[data-cart-lines]').forEach(function (element) {
            element.textContent = String(items.length);
        });
    }

    function renderQuotePreview(items) {
        var list = document.querySelector('[data-quote-items]');
        if (!list) return;

        list.textContent = '';
        items.forEach(function (item) {
            var row = document.createElement('div');
            row.className = 'fq-item';

            var image = document.createElement('div');
            image.className = 'fq-thumb';
            var thumbnail = document.createElement('img');
            thumbnail.src = item.image;
            thumbnail.alt = '';
            thumbnail.loading = 'lazy';
            image.appendChild(thumbnail);

            var info = document.createElement('div');
            info.className = 'fq-info';
            info.appendChild(createTextElement('b', 'fq-name', item.name));
            info.appendChild(createTextElement('span', 'fq-price', [item.color, item.size, item.category].filter(Boolean).join(' · ')));

            var quantity = quantityStep(item.quantity);
            row.append(image, info, createTextElement('b', 'fq-line', quantity.toLocaleString('en-IN') + ' pcs'));
            list.appendChild(row);
        });

        var empty = document.querySelector('[data-quote-empty]');
        var submitButton = document.querySelector('[data-quote-submit]');
        if (empty) empty.hidden = items.length > 0;
        if (submitButton) submitButton.disabled = items.length === 0;
    }

    function quoteMessage(items, formData) {
        var lines = [
            'Bulk quote request for Fleming Fabtex',
            'Name: ' + formData.get('name'),
            'Company: ' + (formData.get('company') || 'Not provided'),
            'Phone: ' + formData.get('phone'),
            'Email: ' + (formData.get('email') || 'Not provided'),
            '',
            'Requested products:',
        ];

        items.forEach(function (item) {
            var quantity = quantityStep(item.quantity);
            lines.push('- ' + item.name + ' · ' + item.color + ' · ' + item.size + ' · ' + quantity + ' pcs');
        });

        var notes = formData.get('notes');
        if (notes) lines.push('', 'Notes: ' + notes);
        return lines.join('\n');
    }

    var items = loadItems();
    updateBadges(items);
    renderCart(items);
    renderQuotePreview(items);

    document.addEventListener('click', function (event) {
        var addButton = event.target.closest('[data-add-to-quote]');
        if (addButton) {
            event.preventDefault();
            var productPage = addButton.closest('[data-product-page]');
            var source = productPage || addButton;
            var imageSource = productPage
                ? (productPage.querySelector('#pd-main-img') || {}).src
                : source.dataset.productImage;
            var imageUrl;
            try {
                imageUrl = new URL(imageSource, window.location.origin);
            } catch (error) {
                notify('This product image could not be added. Please reload the page and try again.', 'error');
                console.error('Invalid product image URL.', error);
                return;
            }

            if (!/^https?:$/.test(imageUrl.protocol) || !/^\/assets\/img\/[a-zA-Z0-9._-]+$/.test(imageUrl.pathname)) {
                notify('This product could not be added. Please reload the page and try again.', 'error');
                return;
            }

            var slug = productPage ? productPage.dataset.productSlug : source.dataset.productSlug;
            var product = {
                slug: slug,
                name: productPage ? productPage.dataset.productName : source.dataset.productName,
                category: productPage ? productPage.dataset.productCategory : source.dataset.productCategory,
                image: imageUrl.pathname,
                price: Number(productPage ? productPage.dataset.basePrice : source.dataset.productPrice),
                quantity: productPage ? (document.getElementById('pd-order-qty') || {}).value : minimumQuantity,
                size: productPage ? (document.getElementById('pd-active-size') || {}).textContent : 'L',
                color: productPage ? (document.getElementById('pd-active-color') || {}).textContent : 'Navy Blue',
            };

            if (!isValidItem(product) || !Number.isFinite(product.price) || product.price <= 0) {
                notify('This product could not be added. Please reload the page and try again.', 'error');
                return;
            }

            product.quantity = quantityStep(product.quantity);
            var key = itemKey(product);
            var existing = items.find(function (item) { return itemKey(item) === key; });
            if (existing) {
                existing.quantity = quantityStep(Number(existing.quantity) + product.quantity);
            } else {
                items.push(product);
            }

            if (!saveItems(items)) return;
            updateBadges(items);
            renderCart(items);
            renderQuotePreview(items);
            notify(product.name + ' added to your bulk quote list.');
            addButton.classList.add('is-added');
            window.setTimeout(function () { addButton.classList.remove('is-added'); }, 1600);
            return;
        }

        var removeButton = event.target.closest('[data-remove-quote-item]');
        if (removeButton) {
            var row = removeButton.closest('[data-cart-key]');
            items = items.filter(function (item) { return itemKey(item) !== row.dataset.cartKey; });
            if (!saveItems(items)) return;
            updateBadges(items);
            renderCart(items);
            renderQuotePreview(items);
            return;
        }

        var clearButton = event.target.closest('[data-clear-quote]');
        if (clearButton) {
            items = [];
            if (!saveItems(items)) return;
            updateBadges(items);
            renderCart(items);
            renderQuotePreview(items);
        }
    });

    document.addEventListener('change', function (event) {
        var input = event.target.closest('[data-cart-quantity]');
        if (!input) return;

        var row = input.closest('[data-cart-key]');
        var item = items.find(function (entry) { return itemKey(entry) === row.dataset.cartKey; });
        if (!item) return;

        item.quantity = quantityStep(input.value);
        if (!saveItems(items)) return;
        renderCart(items);
        renderQuotePreview(items);
        updateBadges(items);
    });

    var quoteForm = document.querySelector('[data-quote-request-form]');
    if (quoteForm) {
        quoteForm.addEventListener('submit', function (event) {
            event.preventDefault();
            var formMessage = document.querySelector('[data-quote-message]');
            var sendLink = document.querySelector('[data-quote-send-link]');
            var currentItems = loadItems();

            if (!quoteForm.reportValidity()) return;
            if (!currentItems.length) {
                formMessage.className = 'fq-msg err';
                formMessage.textContent = 'Add at least one product to your quote list first.';
                return;
            }

            var message = quoteMessage(currentItems, new FormData(quoteForm));
            sendLink.href = 'https://wa.me/917990718742?text=' + encodeURIComponent(message);
            sendLink.hidden = false;
            formMessage.className = 'fq-msg ok';
            formMessage.textContent = 'Your request is ready. Review it in WhatsApp and press Send when you are ready; nothing is sent until you do.';
            sendLink.focus();
        });
    }

    var contactForm = document.querySelector('[data-contact-form]');
    if (contactForm) {
        contactForm.addEventListener('submit', function (event) {
            event.preventDefault();
            if (!contactForm.reportValidity()) return;

            var formData = new FormData(contactForm);
            var lines = [
                'Contact request for Fleming Fabtex',
                'Name: ' + formData.get('name'),
                'Email: ' + formData.get('email'),
                'Phone: ' + formData.get('phone'),
                'Subject: ' + formData.get('subject'),
                '',
                String(formData.get('message') || ''),
            ];
            var sendLink = document.querySelector('[data-contact-send-link]');
            sendLink.href = 'https://wa.me/917990718742?text=' + encodeURIComponent(lines.join('\n'));
            sendLink.hidden = false;

            var formMessage = document.querySelector('[data-contact-message]');
            formMessage.className = 'fq-msg ok';
            formMessage.textContent = 'Your message is ready. Review it in WhatsApp and press Send to contact us.';
            sendLink.focus();
        });
    }

    window.addEventListener('storage', function (event) {
        if (event.key !== storageKey) return;
        items = loadItems();
        updateBadges(items);
        renderCart(items);
        renderQuotePreview(items);
    });
});

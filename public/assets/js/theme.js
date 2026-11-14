// Fleming theme — Myntra header: hoverIntent mega-menu + search typeahead + cart drawer
document.addEventListener('DOMContentLoaded', function () {
// Cart drawer — owned by the inline header script (works even if theme.js is
// cached/blocked). This file intentionally does NOT bind open/close here to
// avoid double-handling; badge pop on added_to_cart lives in motion.js.

  // Myntra mega-menu hoverIntent 120ms open / 150ms close
  var pills = document.querySelectorAll('.myntra-pill[data-mega]');
  pills.forEach(function(pill){
    var openT, closeT;
    pill.addEventListener('mouseenter', function(){
      clearTimeout(closeT);
      openT = setTimeout(function(){ pills.forEach(function(p){ p.classList.remove('is-open'); }); pill.classList.add('is-open'); }, 120);
    });
    pill.addEventListener('mouseleave', function(){
      clearTimeout(openT);
      closeT = setTimeout(function(){ pill.classList.remove('is-open'); }, 150);
    });
    // keyboard
    var link = pill.querySelector('.myntra-pill-link');
    if(link){
      link.addEventListener('focus', function(){ pills.forEach(function(p){ p.classList.remove('is-open'); }); pill.classList.add('is-open'); });
      link.addEventListener('blur', function(){ setTimeout(function(){ if(!pill.contains(document.activeElement)) pill.classList.remove('is-open'); }, 200); });
    }
  });
  // close on outside click
  document.addEventListener('click', function(e){
    if(!e.target.closest('.myntra-pill')) pills.forEach(function(p){ p.classList.remove('is-open'); });
    if(!e.target.closest('#myntra-search')){ var dd=document.getElementById('myntra-search-dd'); if(dd) dd.style.display='none'; }
  });

  // Search typeahead
  var q = document.getElementById('myntra-q');
  var dd = document.getElementById('myntra-search-dd');
  if(q && dd){
    function shopUrl(s){ return (window.flemingShopUrl || '/shop/') + '?s=' + encodeURIComponent(s); }
    // expose shop url via wp_localize or fallback
    var shopLink = document.querySelector('.myntra-pill a[href*="shop"]');
    if(shopLink) window.flemingShopUrl = shopLink.getAttribute('href').split('?')[0];
    q.addEventListener('focus', function(){ dd.style.display='block'; });
    q.addEventListener('keydown', function(e){
      if(e.key==='Enter'){ e.preventDefault(); location.href = shopUrl(q.value.trim() || q.value); }
      if(e.key==='Escape'){ dd.style.display='none'; q.blur(); }
    });
    // pill clicks
    dd.querySelectorAll('.dd-pill').forEach(function(btn){
      btn.addEventListener('click', function(){ q.value = btn.getAttribute('data-q'); location.href = shopUrl(q.value); });
    });
    // simple debounce search suggestion filter
    var t;
    q.addEventListener('input', function(){
      clearTimeout(t);
      t=setTimeout(function(){
        var v=q.value.toLowerCase().trim();
        if(!v){ dd.style.display='block'; return; }
        // filter pills visibility as simple client feedback
        dd.style.display='block';
      }, 180);
    });
  }

  // Mobile burger (minimal drawer) — v1.6.3: distinct vars (no cart collision) + skip if inline fallback bound it
  var mobBtn = document.getElementById('burger-toggle');
  var mobDrawer = document.getElementById('mobile-menu');
  if(mobBtn && mobDrawer && !mobBtn.dataset.mobBound){
    mobBtn.dataset.mobBound = 'theme';
    var closeMobMenu = function(){
      mobDrawer.classList.remove('is-open');
      mobDrawer.setAttribute('aria-hidden', 'true');
      mobDrawer.style.display = '';
      document.body.style.overflow = '';
      mobBtn.textContent = '☰';
      mobBtn.setAttribute('aria-expanded', 'false');
    };
    mobBtn.addEventListener('click', function(e){
      e.stopPropagation();
      var opening = !mobDrawer.classList.contains('is-open');
      if (opening) {
        // Anchor the drawer directly under the sticky header, wherever the user is scrolled
        var header = document.getElementById('main-header');
        if (header) {
          var bottom = header.getBoundingClientRect().bottom;
          if (bottom < 0 || bottom > window.innerHeight) bottom = 70;
          mobDrawer.style.top = Math.round(bottom) + 'px';
          mobDrawer.style.maxHeight = Math.max(220, window.innerHeight - bottom) + 'px';
        }
        mobDrawer.style.display = '';
        mobDrawer.classList.add('is-open');
        mobDrawer.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        mobBtn.textContent = '✕';
        mobBtn.setAttribute('aria-expanded', 'true');
      } else {
        closeMobMenu();
      }
    });
    // Close on outside tap
    document.addEventListener('click', function(e){
      if (!mobDrawer.classList.contains('is-open')) return;
      if (e.target.closest('#mobile-menu') || e.target.closest('#burger-toggle')) return;
      closeMobMenu();
    });
    // Close when a menu link is tapped (feels instant on same-page anchors too)
    mobDrawer.addEventListener('click', function(e){
      if (e.target.closest('.mob-link, .mob-cart, .mob-quote, .mob-search input')) {
        if (!e.target.closest('.mob-search input')) closeMobMenu();
      }
    });
    // Close on Escape and when the viewport grows to desktop
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape') closeMobMenu(); });
    window.addEventListener('resize', function(){ if (window.innerWidth >= 960) closeMobMenu(); });
    mobBtn.setAttribute('aria-expanded', 'false');
  }
  // legacy burger fallback
  var oldBurger = document.getElementById('fleming-burger');
  var oldMobile = document.getElementById('fleming-mobile');
  if(oldBurger && oldMobile){
    oldBurger.addEventListener('click', function(){ oldMobile.classList.toggle('is-open'); });
  }

  // Shop facets — checkbox URL toggle + accordion + mobile sheet
  document.querySelectorAll('.facet-cb').forEach(function(cb){
    cb.addEventListener('click', function(){
      var k = cb.getAttribute('data-k'), v = cb.getAttribute('data-v');
      var url = new URL(location.href);
      if(url.searchParams.get(k)===v) url.searchParams.delete(k); else url.searchParams.set(k,v);
      location.href = url.toString();
    });
  });
  // color swatch selected state
  document.querySelectorAll('.color-swatch.facet-cb').forEach(function(sw){
    sw.addEventListener('click', function(){
      var k = sw.getAttribute('data-k'), v = sw.getAttribute('data-v');
      if(new URLSearchParams(location.search).get(k)===v) sw.classList.add('selected');
    });
  });
  // facet accordion toggle (FIX 2026-10-16: guard missing <span> — unguarded querySelector crashed the click handler on custom facet buttons)
  document.querySelectorAll('[data-facet-toggle]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var body = btn.nextElementSibling;
      if(!body) return;
      body.classList.toggle('collapsed');
      var lbl = btn.querySelector('span');
      if(lbl) lbl.textContent = body.classList.contains('collapsed') ? '+' : '−';
    });
  });
  // active filter tag remove
  document.querySelectorAll('.tag-remove').forEach(function(btn){
    btn.addEventListener('click', function(){
      var key = btn.getAttribute('data-key');
      var u = new URL(location.href);
      u.searchParams.delete(key);
      location.href = u.toString();
    });
  });
  // mobile filter sheet
  var sheet = document.getElementById('shop-filter-sheet');
  var ft = document.getElementById('shop-filter-toggle');
  function openSheet(){ if(!sheet) return; sheet.classList.add('open'); document.body.classList.add('shop-sheet-open'); }
  function closeSheet(){ if(!sheet) return; sheet.classList.remove('open'); document.body.classList.remove('shop-sheet-open'); }
  if(ft && sheet){
    ft.addEventListener('click', function(){ openSheet(); });
  }
  document.querySelectorAll('.sheet-close').forEach(function(btn){
    btn.addEventListener('click', function(){ closeSheet(); });
  });
  if(sheet){
    // close by tapping the dimmed backdrop (not the panel)
    sheet.addEventListener('click', function(e){ if(e.target === sheet) closeSheet(); });
    // close on Escape
    document.addEventListener('keydown', function(e){ if(e.key === 'Escape' && sheet.classList.contains('open')) closeSheet(); });
  }
  document.querySelectorAll('.sheet-clear').forEach(function(btn){
    btn.addEventListener('click', function(){
      var href = btn.getAttribute('data-href') || '/';
      location.href = href;
    });
  });
});
/* ==========================================================================
   Phase 2 — Bulk Quote (RFQ) + Shared Size Guide + Toasts (v1.6.0)
   ========================================================================== */
(function () {
  'use strict';
  var AJAX = (typeof flemingAjax !== 'undefined' && flemingAjax.ajaxUrl) ? flemingAjax.ajaxUrl : '/wp-admin/admin-ajax.php';
  var NONCE = (typeof flemingAjax !== 'undefined' && flemingAjax.quoteNonce) ? flemingAjax.quoteNonce : '';

  // ---- Toast helper ----
  function toast(msg, type) {
    var t = document.getElementById('fleming-toast');
    if (!t) {
      t = document.createElement('div');
      t.id = 'fleming-toast';
      t.setAttribute('role', 'status');
      document.body.appendChild(t);
    }
    t.textContent = msg;
    t.className = 'fq-toast show ' + (type || 'ok');
    clearTimeout(t._tm);
    t._tm = setTimeout(function () { t.className = 'fq-toast'; }, 3200);
  }

  function setQuoteCount(n) {
    var el = document.getElementById('fleming-quote-count');
    if (el) el.textContent = n;
  }

  function quoteCall(action, data, onOk, onFail) {
    var fd = new FormData();
    fd.append('action', action);
    fd.append('nonce', NONCE);
    Object.keys(data || {}).forEach(function (k) { fd.append(k, data[k]); });
    fetch(AJAX, { method: 'POST', credentials: 'same-origin', body: fd })
      .then(function (r) { if (!r.ok) throw new Error('bad status'); return r.json(); })
      .then(function (j) {
        if (j && j.success) {
          if (typeof j.data.count !== 'undefined') setQuoteCount(j.data.count);
          if (onOk) onOk(j.data);
        } else {
          toast((j && j.data && (j.data.msg || j.data.error)) || 'Something went wrong. Please try again.', 'err');
          if (onFail) onFail(j && j.data);
        }
      })
      .catch(function () {
        toast('Network error. Please check your connection and try again.', 'err');
        if (onFail) onFail(null);
      });
  }

  // ---- Step tracker (1 styles → 2 details → 3 sent) ----
  function setSteps(state) {
    // state: 1 = editing styles, 2 = filling details, 3 = sent
    document.querySelectorAll('.fq-step-item').forEach(function (li) {
      var n = parseInt(li.getAttribute('data-fq-step'), 10);
      li.classList.toggle('is-done', n < state);
      li.classList.toggle('is-active', n === state);
      if (n < state) li.querySelector('.fq-dot').textContent = '✓';
    });
  }
  function initSteps() {
    if (!document.querySelector('.fq-page')) return;
    var empty = document.querySelector('.fq-page').getAttribute('data-fq-empty') === '1';
    setSteps(empty ? 1 : 2);
    // typing details completes step 1 visually
    document.addEventListener('input', function (e) {
      if (e.target.closest && e.target.closest('#fq-submit-form')) setSteps(2);
    });
  }
  initSteps();

  // ---- Add to Quote (product cards, single product, sticky bar, quote-page suggestions) ----
  document.addEventListener('click', function (e) {
    var btn = e.target.closest ? e.target.closest('.fleming-quote-add') : null;
    if (!btn || btn.disabled) return;
    e.preventDefault();
    var pid = btn.getAttribute('data-pid');
    var qty = 25;
    var qtyInput = document.getElementById('pd-order-qty');
    if (qtyInput && qtyInput.value) qty = Math.max(25, parseInt(qtyInput.value, 10) || 25);
    var orig = btn.innerHTML;
    btn.disabled = true; btn.innerHTML = 'Adding…';
    quoteCall('fleming_quote_add', { pid: pid, qty: qty }, function (d) {
      if (d.msg) toast(d.msg, 'ok');
      btn.innerHTML = 'Added ✓'; btn.classList.add('is-added');
      if (btn.getAttribute('data-after') === 'reload') {
        setTimeout(function () { window.location.reload(); }, 900);
      } else {
        setTimeout(function () { btn.disabled = false; btn.innerHTML = orig; btn.classList.remove('is-added'); }, 1600);
      }
    });
    // re-enable on failure (quoteCall toasts); success path restores above
    setTimeout(function () { if (btn.innerHTML === 'Adding…') { btn.disabled = false; btn.innerHTML = orig; } }, 6000);
  });
// ---- Quote page: steppers, remove, clear, submit ----
  var qPage = document.getElementById('fq-submit-form');

  function refreshQuoteTotals() {
    var total = 0, pcs = 0;
    document.querySelectorAll('.fq-item').forEach(function (item) {
      var qty = parseInt((item.querySelector('.fq-qty-input') || {}).value, 10) || 0;
      pcs += qty;
      var price = 0;
      var m = (item.querySelector('.fq-price') || {}).textContent || '';
      var pm = m.match(/Rs\.?\s?([\d,]+)/) || m.match(/\u20B9\s?([\d,]+)/);
      if (pm) price = parseInt(pm[1].replace(/,/g, ''), 10) || 0;
      var line = item.querySelector('.fq-line');
      if (line) line.textContent = '\u20B9' + (price * qty).toLocaleString('en-IN');
      total += price * qty;
    });
    var hint = document.getElementById('fq-pcs-hint');
    if (hint) hint.textContent = pcs + ' pcs';
    setQuoteCount(pcs);
    var est = document.getElementById('fq-est-total');
    if (est) {
      var from = parseInt((est.getAttribute('data-value') || '0'), 10) || 0;
      est.setAttribute('data-value', total);
      est.classList.remove('fq-total-tick');
      void est.offsetWidth; // restart tick animation
      // count-up animation
      var t0 = null, dur = 450;
      function frame(t) {
        if (!t0) t0 = t;
        var p = Math.min(1, (t - t0) / dur);
        var v = Math.round(from + (total - from) * (1 - Math.pow(1 - p, 3)));
        est.textContent = '\u20B9' + v.toLocaleString('en-IN');
        if (p < 1) requestAnimationFrame(frame);
      }
      if (window.requestAnimationFrame && from !== total) requestAnimationFrame(frame);
      else est.textContent = '\u20B9' + total.toLocaleString('en-IN');
      est.classList.add('fq-total-tick');
    }
  }

  function setItemBusy(item, busy) {
    if (!item) return;
    item.classList.toggle('is-busy', !!busy);
    item.querySelectorAll('.fq-step, .fq-remove, .fq-qty-input').forEach(function (b) { b.disabled = !!busy; });
  }

  document.addEventListener('click', function (e) {
    var step = e.target.closest ? e.target.closest('.fq-step') : null;
    if (step && !step.disabled) {
      e.preventDefault();
      var pid = step.getAttribute('data-pid');
      var input = document.querySelector('.fq-qty-input[data-pid="' + pid + '"]');
      if (!input) return;
      var cur = parseInt(input.value, 10) || 25;
      var next = cur + parseInt(step.getAttribute('data-delta'), 10);
      if (next < 25) {
        toast('Minimum 25 pcs per style — bulk factory pricing starts there.', 'err');
        next = 25;
      }
      if (next === cur) return; // no-op at the floor — skip the roundtrip
      input.value = next;
      var item = step.closest('.fq-item');
      setItemBusy(item, true);
      quoteCall('fleming_quote_update', { pid: pid, qty: next }, function () {
        setItemBusy(item, false);
        refreshQuoteTotals();
      }, function () {
        input.value = cur; // revert optimistic change
        setItemBusy(item, false);
        refreshQuoteTotals();
      });
      setTimeout(function () { setItemBusy(item, false); }, 6000); // safety re-enable
      return;
    }
    var rm = e.target.closest ? e.target.closest('.fq-remove') : null;
    if (rm && !rm.disabled) {
      e.preventDefault();
      var rpid = rm.getAttribute('data-pid');
      var ritem = rm.closest('.fq-item');
      if (ritem) ritem.classList.add('is-removing');
      quoteCall('fleming_quote_update', { pid: rpid, qty: 0 }, function () {
        if (ritem) ritem.remove();
        refreshQuoteTotals();
        var left = document.querySelectorAll('.fq-item').length;
        if (left === 0 && qPage) window.location.reload();
      }, function () {
        if (ritem) ritem.classList.remove('is-removing'); // undo fade — item still quoted
      });
      return;
    }
    var clear = e.target.closest ? e.target.closest('#fq-clear') : null;
    if (clear) {
      e.preventDefault();
      if (!window.confirm('Remove all styles from your quote list?')) return;
      clear.disabled = true;
      quoteCall('fleming_quote_clear', {}, function () { window.location.reload(); });
      setTimeout(function () { clear.disabled = false; }, 4000);
    }
  });

  document.addEventListener('change', function (e) {
    var input = e.target.closest ? e.target.closest('.fq-qty-input') : null;
    if (!input || input.disabled) return;
    var pid = input.getAttribute('data-pid');
    var raw = parseInt(input.value, 10) || 25;
    var qty = Math.max(25, Math.round(raw / 25) * 25); // snap manual entry to 25-pc steps
    input.value = qty;
    var item = input.closest('.fq-item');
    setItemBusy(item, true);
    quoteCall('fleming_quote_update', { pid: pid, qty: qty }, function () { setItemBusy(item, false); refreshQuoteTotals(); }, function () { setItemBusy(item, false); });
  });
if (qPage) {
    // clear invalid styling as the buyer types
    qPage.addEventListener('input', function (e) {
      var f = e.target.closest ? e.target.closest('.fq-field') : null;
      if (f) f.classList.remove('is-err');
    });
    qPage.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn = qPage.querySelector('.fq-submit');
      // inline validation before the roundtrip
      var ok = true;
      var nameI = qPage.querySelector('[name="fq_name"]');
      var emailI = qPage.querySelector('[name="fq_email"]');
      [[nameI, function (v) { return v.trim().length >= 2; }], [emailI, function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); }]].forEach(function (pair) {
        var input = pair[0], valid = pair[1];
        if (!input) return;
        var field = input.closest('.fq-field');
        var good = valid(input.value || '');
        if (field) field.classList.toggle('is-err', !good);
        if (!good) ok = false;
      });
      if (!ok) {
        var firstBad = qPage.querySelector('.fq-field.is-err input');
        if (firstBad) firstBad.focus();
        toast('Please add your name and a valid work email.', 'err');
        return;
      }
      if (btn) { btn.disabled = true; btn.classList.add('is-loading'); btn.setAttribute('data-label', btn.textContent); btn.textContent = 'Sending…'; }
      // snapshot for the success panel (list is cleared server-side)
      var snapCount = document.querySelectorAll('.fq-item').length;
      var snapPcs = 0;
      document.querySelectorAll('.fq-qty-input').forEach(function (i) { snapPcs += parseInt(i.value, 10) || 0; });
      var est = document.getElementById('fq-est-total');
      var snapTotal = est ? est.textContent : '';
      var fd = new FormData(qPage);
      fd.append('action', 'fleming_quote_submit');
      fetch(AJAX, { method: 'POST', credentials: 'same-origin', body: fd })
        .then(function (r) { if (!r.ok) throw new Error('bad status'); return r.json(); })
        .then(function (j) {
          if (j && j.success) {
            setSteps(3);
            setQuoteCount(0);
            showQuoteSuccess(snapCount, snapPcs, snapTotal);
          } else {
            var err = document.getElementById('fq-msg');
            if (err) { err.className = 'fq-msg err'; err.textContent = (j && j.data && (j.data.msg || j.data.error)) || 'Could not send. Check your details.'; }
            if (btn) { btn.disabled = false; btn.classList.remove('is-loading'); btn.textContent = 'Request Quote →'; }
          }
        })
        .catch(function () {
          var err = document.getElementById('fq-msg');
          if (err) { err.className = 'fq-msg err'; err.textContent = 'Network error. Please try again.'; }
          if (btn) { btn.disabled = false; btn.classList.remove('is-loading'); btn.textContent = 'Request Quote →'; }
        });
    });
  }

  // Success panel replaces the items+form grid — no confusing reload
  function showQuoteSuccess(styles, pcs, total) {
    var grid = document.querySelector('.fq-grid');
    if (!grid) { window.location.reload(); return; }
    var wa = 'https://wa.me/917990718742?text=' + encodeURIComponent('Hi Fleming Fabtex, I just sent a bulk quote request on the website.');
    grid.innerHTML =
      '<div class="co-section fq-success">' +
        '<div class="fq-check"><svg viewBox="0 0 24 24" width="36" height="36" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12.5l5 5L20 6.5"/></svg></div>' +
        '<h3>Quote request sent!</h3>' +
        '<p>Thanks — our sales team is preparing your firm quote (GST invoice &amp; freight included) and will email you within <b>4–6 business hours</b>.</p>' +
        '<div class="fq-success-meta"><span>' + styles + ' style' + (styles === 1 ? '' : 's') + '</span><span>' + pcs.toLocaleString('en-IN') + ' pcs</span><span>Est. ' + total + '</span></div>' +
        '<ol class="fq-success-steps">' +
          '<li>📧 <b>Firm quote by email</b> — pricing slabs, GSM &amp; timeline</li>' +
          '<li>📦 <b>Free samples</b> — dispatched in 48 hrs on approval</li>' +
          '<li>🏭 <b>Production &amp; dispatch</b> — Pan-India in 24–48 hrs</li>' +
        '</ol>' +
        '<div class="fq-success-actions">' +
          '<a class="btn btn-p" href="' + (window.flemingShopUrl || '/shop/') + '">Browse More Styles</a>' +
          '<a class="btn btn-o" target="_blank" rel="noopener" href="' + wa + '">Ping us on WhatsApp</a>' +
        '</div>' +
      '</div>';
    grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    var msg = document.getElementById('fq-msg');
    if (msg) { msg.className = 'fq-msg'; msg.textContent = ''; }
  }

  // ---- Shared Size Guide modal (shop cards)) ----
  // NOTE: resolve lazily — the modal div sits AFTER wp_footer() in footer.php,
  // so it is not in the DOM when theme.js first executes.
  function openSize() {
    var sm = document.getElementById('fleming-size-modal');
    if (!sm) return;
    sm.classList.add('open');
    sm.setAttribute('aria-hidden', 'false');
    document.body.classList.add('sc-lock');
  }
  function closeSize() {
    var sm = document.getElementById('fleming-size-modal');
    if (sm) { sm.classList.remove('open'); sm.setAttribute('aria-hidden', 'true'); }
    document.body.classList.remove('sc-lock');
  }
  document.addEventListener('click', function (e) {
    var link = e.target.closest ? e.target.closest('.p-size-link') : null;
    if (link) { e.preventDefault(); openSize(); return; }
    var sm = document.getElementById('fleming-size-modal');
    if (sm) {
      if (e.target.closest && e.target.closest('.fsm-close')) { closeSize(); return; }
      if (e.target === sm) { closeSize(); return; }
    }
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') { closeSize(); }
  });
})();

// Floating dock — back-to-top visibility + smooth scroll (v1.6.9)
(function () {
  var btn = document.getElementById('fab-to-top');
  if (!btn) return;
  function onScroll() {
    if (window.scrollY > 600) btn.classList.add('is-show');
    else btn.classList.remove('is-show');
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
  btn.addEventListener('click', function () {
    var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    window.scrollTo({ top: 0, behavior: reduced ? 'auto' : 'smooth' });
  });
})();
// Contact hero: live IST clock + open-now status (Mon–Sat, 9:30–19:00 IST)
(function () {
  var clock = document.getElementById('fhero-clock');
  var txt = document.getElementById('fhero-status-text');
  var dot = document.getElementById('fhero-dot');
  if (!clock || !txt || !dot) return;
  function tick() {
    try {
      var now = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Kolkata' }));
      var hh = now.getHours(), mm = now.getMinutes();
      clock.textContent = (hh < 10 ? '0' : '') + hh + ':' + (mm < 10 ? '0' : '') + mm + ' IST';
      var day = now.getDay();
      var mins = hh * 60 + mm;
      var open = day >= 1 && day <= 6 && mins >= 570 && mins < 1140; // 9:30–19:00
      dot.className = 'fhero-dot ' + (open ? 'on' : 'off');
      txt.textContent = open ? 'Open now · replies in ~4 hrs' : 'Currently closed · we reply within 4–6 business hrs';
    } catch (e) { txt.textContent = 'Replies within 4–6 business hours'; }
  }
  tick();
  setInterval(tick, 30000);
})();
// Animated counters — [data-countup="N"] counts up once when scrolled into view (v1.9.7)
(function () {
  var els = document.querySelectorAll('[data-countup]');
  if (!els.length) return;
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  function run(el) {
    var target = parseInt(el.getAttribute('data-countup'), 10) || 0;
    if (reduced) { el.textContent = target; return; }
    var t0 = null, dur = 1100;
    function frame(t) {
      if (!t0) t0 = t;
      var p = Math.min(1, (t - t0) / dur);
      el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
      if (p < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { run(en.target); io.unobserve(en.target); }
      });
    }, { threshold: 0.4 });
    els.forEach(function (el) { io.observe(el); });
  } else {
    els.forEach(run);
  }
})();
(function () {
  var dock = document.getElementById('fab-dock');
  var toggle = document.getElementById('fab-toggle');
  if (!dock || !toggle) return;

  function setOpen(open) {
    dock.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    toggle.setAttribute('aria-label', open ? 'Close contact options' : 'Open contact options');
    var menu = document.getElementById('fab-menu');
    if (menu) menu.setAttribute('aria-hidden', open ? 'false' : 'true');
  }

  toggle.addEventListener('click', function (e) {
    e.stopPropagation();
    setOpen(!dock.classList.contains('is-open'));
  });

  // close on outside click
  document.addEventListener('click', function (e) {
    if (dock.classList.contains('is-open') && !dock.contains(e.target)) setOpen(false);
  });

  // close on Escape (and hand focus back to the toggle)
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && dock.classList.contains('is-open')) {
      setOpen(false);
      toggle.focus();
    }
  });

  // close after choosing an option (link or back-to-top)
  dock.addEventListener('click', function (e) {
    if (e.target.closest('a[href], .fab-top')) setOpen(false);
  });
})();

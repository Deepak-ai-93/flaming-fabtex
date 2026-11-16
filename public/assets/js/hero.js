/**
 * Fleming Fabtex — Cinematic hero animation (v2.1)
 * Word rotator · GSAP mask-reveal heading · floating stat pills with mouse parallax ·
 * spinning mill stamp · scroll parallax on media + backdrop.
 * Progressive enhancement only: with JS off / reduced-motion, everything stays visible —
 * only the decorative motion drops out.
 */
(function () {
  'use strict';
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- A. Word rotator ---------- */
  var rotEl = document.querySelector('[data-rotator] .rot-word');
  if (rotEl && rotEl.dataset && rotEl.dataset.words) {
    var words = rotEl.dataset.words.split('|').map(function (s) { return s.trim(); });
    var idx = 0;
    if (words.length > 1) {
      // reserve width so swapping the word never reflows the line
      var probe = document.createElement('span');
      var bs = getComputedStyle(rotEl);
      probe.style.cssText = 'position:absolute;visibility:hidden;white-space:nowrap;';
      probe.style.font = bs.font;
      var maxW = 52;
      for (var i = 0; i < words.length; i++) {
        probe.textContent = words[i];
        var w = Math.ceil(probe.getBoundingClientRect().width + 8);
        if (w > maxW) maxW = w;
      }
      document.body.appendChild(probe);
      document.body.removeChild(probe);
      rotEl.style.minWidth = maxW + 'px';

      function swap() {
        idx = (idx + 1) % words.length;
        rotEl.classList.add('is-swap');
        setTimeout(function () {
          rotEl.textContent = words[idx];
          rotEl.classList.remove('is-swap');
        }, 240);
      }
      if (!reduced) setInterval(swap, 2400);
    }
  }

  /* ---------- B. Cinematic hero entrance (GSAP timeline) ---------- */
  var stage = document.querySelector('.hero-stage[data-hero-v2]');
  var G = window.gsap;
  var ST = window.ScrollTrigger;
  if (stage && G && ST && !reduced && typeof G.registerPlugin === 'function') {
    G.registerPlugin(ST);
    var tl = G.timeline({ defaults: { ease: 'power3.out' } });
    var eyebrow = stage.querySelector('.hero-copy .eyebrow');
    if (eyebrow) tl.from(eyebrow, { y: 14, opacity: 0, duration: 0.5 }, 0.05);
    stage.querySelectorAll('.hero-h1 .hw-in').forEach(function (ln, i) {
      tl.from(ln, { yPercent: 120, duration: 0.9, ease: 'power4.out' }, 0.18 + i * 0.12);
    });
    var lede = stage.querySelector('.lede');
    if (lede) tl.from(lede, { y: 18, opacity: 0, duration: 0.6 }, 0.45);
    var rot = stage.querySelector('.hero-rot');
    if (rot) tl.from(rot, { y: 14, opacity: 0, duration: 0.5 }, 0.53);
    var btns = stage.querySelector('.hero-btns');
    if (btns) tl.from(btns, { y: 16, opacity: 0, duration: 0.55 }, 0.6);
    var trust = stage.querySelector('.hero-trust');
    if (trust) tl.from(trust, { y: 16, opacity: 0, duration: 0.55 }, 0.67);
    var media = stage.querySelector('.hero-media');
    if (media) {
      tl.fromTo(media, { clipPath: 'inset(0 0 100% 0)', scale: 1.12 }, { clipPath: 'inset(0 0 0% 0)', scale: 1, duration: 1.15, ease: 'power3.inOut' }, 0.2);
    }
    var badge = stage.querySelector('.hero-badge-float');
    if (badge) tl.from(badge, { y: 12, opacity: 0, duration: 0.5, ease: 'back.out(1.6)' }, 0.95);
    stage.querySelectorAll('[data-pill]').forEach(function (p, i) {
      tl.from(p, { scale: 0.4, opacity: 0, duration: 0.55, ease: 'back.out(1.9)' }, 0.98 + i * 0.12);
    });
  }

  /* ---------- C. Pills parallax + scroll depth ---------- */
  if (stage && G && !reduced) {
    var pills = Array.prototype.slice.call(stage.querySelectorAll('[data-pill]'));
    var hp = stage.querySelector('.hero-media-wrap[data-hero], .hero-stage[data-hero-slider]');
    if (hp && pills.length) {
      hp.addEventListener('mousemove', function (e) {
        var r = hp.getBoundingClientRect();
        if (!r.width) return;
        var nx = (e.clientX - r.left) / r.width - 0.5;
        var ny = (e.clientY - r.top) / r.height - 0.5;
        for (var i = 0; i < pills.length; i++) {
          var d = parseFloat(pills[i].dataset.depth || 0.3);
          G.to(pills[i], { x: nx * -24 * d, y: ny * -18 * d, duration: 0.4, overwrite: 'auto' });
        }
      });
      hp.addEventListener('mouseleave', function () {
        for (var i = 0; i < pills.length; i++) { G.to(pills[i], { x: 0, y: 0, duration: 0.5 }); }
      });
    }
    var m = stage.querySelector('.hero-media, .hero-slider');
    if (m && ST) {
      G.to(m, { yPercent: 7, ease: 'none', scrollTrigger: { trigger: stage, start: 'top top', end: 'bottom top', scrub: 0.6 } });
      var bg = stage.querySelector('.hero-bg');
      if (bg) G.to(bg, { yPercent: -9, ease: 'none', scrollTrigger: { trigger: stage, start: 'top top', end: 'bottom top', scrub: 0.6 } });
    }
  }

  /* ---------- D. Hero simple slider — parallax glide (track + drift layers) ---------- */
  function initHeroSlider(sliderWrap) {
    if (!sliderWrap || sliderWrap.dataset.heroInit) return; // init once per node
    sliderWrap.dataset.heroInit = '1';
    var track = sliderWrap.querySelector('[data-track]');
    var slides = Array.prototype.slice.call(sliderWrap.querySelectorAll('[data-slide]'));
    // Clear pre-JS off-screen transforms so the track translation can position slides correctly.
    Array.prototype.forEach.call(slides, function (s) { s.style.transform = ''; });
    var dots = Array.prototype.slice.call(sliderWrap.querySelectorAll('[data-dot]'));
    var prevBtns = Array.prototype.slice.call(sliderWrap.querySelectorAll('[data-prev]'));
    var nextBtns = Array.prototype.slice.call(sliderWrap.querySelectorAll('[data-next]'));
    var count = sliderWrap.querySelector('[data-count]');
    var bar = sliderWrap.querySelector('[data-progress]');
    var cur = 0, timer = null, AUTOPLAY_MS = 5000;
    // Broken-image guard: if a slide photo 404s, fall back to the first
    // slide's photo so the hero never shows an empty frame.
    var firstSrc = (slides[0] && slides[0].querySelector('img')) ? slides[0].querySelector('img').getAttribute('src') : '';
    slides.forEach(function (s) {
      var im = s.querySelector('img');
      if (!im) return;
      im.addEventListener('error', function handler() {
        im.removeEventListener('error', handler);
        if (firstSrc && im.getAttribute('src') !== firstSrc) im.setAttribute('src', firstSrc);
        else s.style.display = 'none';
      });
    });

    function paintProgress() {
      if (!bar) return;
      bar.style.transition = 'none';
      bar.style.width = '0%';
      void bar.offsetWidth; // restart CSS transition
      if (!reduced && slides.length > 1) {
        bar.style.transition = 'width ' + AUTOPLAY_MS + 'ms linear';
        bar.style.width = '100%';
      }
    }
    // Parallax: track glides a full frame while each banner drifts slower inside
    // its own frame (neighbors pre-shift opposite) — classic depth effect.
    function render(user) {
      if (!slides.length) return;
      if (track) track.style.transform = 'translateX(-' + (cur * 100) + '%)';
      for (var i = 0; i < slides.length; i++) {
        var on = i === cur;
        var img = slides[i].querySelector('img');
        var off = i - cur;
        // wrap offset so ends glide correctly (no long rewind jump feel)
        if (off > slides.length / 2) off -= slides.length;
        if (off < -slides.length / 2) off += slides.length;
        slides[i].classList.toggle('is-active', on);
        if (on) slides[i].removeAttribute('aria-hidden');
        else slides[i].setAttribute('aria-hidden', 'true');
        var lnk = slides[i].querySelector('.hero-full-link');
        if (lnk) lnk.tabIndex = on ? 0 : -1;
        if (img) img.style.transform = 'translateX(' + (off * 4) + '%) scale(1.04)';
        if (dots[i]) {
          dots[i].classList.toggle('is-active', on);
          dots[i].setAttribute('aria-selected', on ? 'true' : 'false');
        }
      }
      if (count) {
        var padCur = (cur + 1 < 10 ? '0' : '') + (cur + 1);
        var padTotal = (slides.length < 10 ? '0' : '') + slides.length;
        count.textContent = padCur + ' / ' + padTotal;
      }
      paintProgress();
      if (user) restart();
    }
    function show(n, user) {
      if (!slides.length) return;
      cur = (n + slides.length) % slides.length;
      render(user);
    }
    function restart() {
      if (timer) clearInterval(timer);
      timer = null;
      if (reduced || slides.length < 2) { paintProgress(); return; }
      if (document.hidden) return;
      paintProgress();
      timer = setInterval(function () { show(cur + 1, false); }, AUTOPLAY_MS);
    }
    prevBtns.forEach(function (btn) {
      btn.addEventListener('click', function () { show(cur - 1, true); });
    });
    nextBtns.forEach(function (btn) {
      btn.addEventListener('click', function () { show(cur + 1, true); });
    });
    dots.forEach(function (d, i) {
      d.addEventListener('click', function () { show(i, true); });
    });
    // pause on hover / focus, resume on leave
    sliderWrap.addEventListener('mouseenter', function () { if (timer) { clearInterval(timer); timer = null; } if (bar) { bar.style.transition = 'none'; } });
    sliderWrap.addEventListener('mouseleave', restart);
    sliderWrap.addEventListener('focusin', function () { if (timer) { clearInterval(timer); timer = null; } });
    sliderWrap.addEventListener('focusout', restart);
    document.addEventListener('visibilitychange', function () {
      if (document.hidden) { if (timer) { clearInterval(timer); timer = null; } }
      else restart();
    });
    // touch swipe
    var tx = null;
    sliderWrap.addEventListener('touchstart', function (e) {
      if (e.touches && e.touches.length === 1) tx = e.touches[0].clientX;
    }, { passive: true });
    sliderWrap.addEventListener('touchend', function (e) {
      if (tx === null) return;
      var dx = (e.changedTouches[0].clientX - tx);
      tx = null;
      if (Math.abs(dx) < 32) return;
      show(cur + (dx < 0 ? 1 : -1), true);
    }, { passive: true });
    // keyboard
    sliderWrap.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') { e.preventDefault(); show(cur - 1, true); }
      else if (e.key === 'ArrowRight') { e.preventDefault(); show(cur + 1, true); }
    });
    render(false);
    restart();
  }
  // Boot every slider on the page…
  function bootAllSliders() {
    Array.prototype.forEach.call(document.querySelectorAll('[data-hero-slider]'), initHeroSlider);
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootAllSliders);
  } else {
    bootAllSliders();
  }
  // …and re-boot after a Customizer selective-refresh re-renders the hero,
  // so live-preview edits keep auto-playing without a full page reload.
  if (window.jQuery) {
    window.jQuery(document).on('partial-content-rendered', function (e, placement) {
      var node = placement && placement.container && placement.container[0];
      if (node && node.hasAttribute && node.hasAttribute('data-hero-slider')) {
        delete node.dataset.heroInit;
        initHeroSlider(node);
      } else {
        Array.prototype.forEach.call(document.querySelectorAll('[data-hero-slider]'), initHeroSlider);
      }
    });
  }
})();
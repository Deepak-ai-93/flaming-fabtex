/**
 * Fleming Fabtex — GSAP motion engine
 * Reference: DESIGN.md v2 — GSAP 3.12.5 + ScrollTrigger (marquee, heroIn, reveal, lift, pop/shake).
 * Progressive enhancement only: without JS (or with reduced motion) ALL content stays visible —
 * hidden initial states are set by GSAP at runtime, never by CSS.
 */
(function () {
  'use strict';

  var hasGsap = typeof window.gsap !== 'undefined';
  var hasST = typeof window.ScrollTrigger !== 'undefined';
  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var docEl = document.documentElement;

  docEl.classList.add('js');
  if (!hasGsap || !hasST || reduced) {
    docEl.classList.add('gsap-off');
    return; // no-JS / reduced motion → everything visible, no animations
  }

  document.addEventListener('DOMContentLoaded', function () {
    var gsap = window.gsap;
    var ScrollTrigger = window.ScrollTrigger;
    if (typeof gsap.registerPlugin === 'function') { gsap.registerPlugin(ScrollTrigger); }

    /* ---------- 1. Nav stuck state ---------- */
    var nav = document.getElementById('main-header');
    if (nav) {
      ScrollTrigger.create({
        start: 8,
        end: 'max',
        onUpdate: function (self) { nav.classList.toggle('js-stuck', self.scroll() > 8); }
      });
      window.addEventListener('scroll', function () {
        nav.classList.toggle('js-stuck', window.scrollY > 8);
      }, { passive: true });
    }

    /* ---------- 2. Hero entrance + parallax (reference heroIn) ---------- */
    var hero = document.querySelector('.hero-stage');
    if (hero && !hero.hasAttribute('data-hero-v2')) {
      var heroEls = hero.querySelectorAll(
        '.eyebrow, h1, h2, .lede, .wp-block-paragraph, .wp-block-button, .wp-block-buttons'
      );
      var tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
      tl.fromTo(heroEls, { opacity: 0, y: 26 }, { opacity: 1, y: 0, duration: 0.7, stagger: 0.09, clearProps: 'transform,opacity' }, 0.05);
      var media = hero.querySelector('.hero-media, .hero-frame, .wp-block-image');
      if (media) {
        tl.fromTo(media, { opacity: 0, scale: 1.08 }, { opacity: 1, scale: 1, duration: 1.3, ease: 'power2.out', clearProps: 'transform,opacity' }, 0.15);
        gsap.to(media, {
          yPercent: 8, ease: 'none',
          scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: 0.6 }
        });
      }
    }

    /* ---------- 3. Marquee ticker (infinite) ---------- */
    var track = document.querySelector('.marquee-track');
    if (track) {
      var spans = track.querySelectorAll('span');
      if (spans.length === 1) { track.innerHTML += spans[0].outerHTML; }
      gsap.to(track, { xPercent: -50, duration: 28, ease: 'none', repeat: -1 });
    }

    /* ---------- 4. Count-up stats (reference stats echo) ---------- */
    function parseText(txt) {
      var m = String(txt).trim().match(/^([\d,\.]+)\s*(.*)$/);
      if (!m) return null;
      return { num: parseFloat(m[1].replace(/,/g, '')), suffix: m[2].length > 0 ? ' ' + m[2] : '' };
    }
    var statEls = gsap.utils.toArray('.stat-num, [data-count]');
    gsap.utils.toArray('.section.stats .wp-block-column').forEach(function (col) {
      var h = col.querySelector('h3, h2');
      if (h) statEls.push(h);
    });
    statEls.forEach(function (el) {
      var isData = el.hasAttribute('data-count');
      var parsed;
      if (isData) {
        parsed = parseText(el.getAttribute('data-count') + ' ' + (el.getAttribute('data-suffix') || ''));
      } else {
        parsed = parseText(el.textContent);
      }
      if (!parsed) return;
      var num = parsed.num;
      var suffix = isData ? ' ' + (el.getAttribute('data-suffix') || '') : parsed.suffix;
      var obj = { v: 0 };
      gsap.to(obj, {
        v: num, duration: 1.8, ease: 'power1.out',
        scrollTrigger: { trigger: el, start: 'top 88%', once: true },
        onUpdate: function () {
          el.textContent = Math.round(obj.v).toLocaleString('en-IN') + suffix;
        },
        onComplete: function () {
          el.textContent = num.toLocaleString('en-IN') + suffix;
        }
      });
    });
    /* ---------- 5. Cart badge pop ---------- */
    var bag = document.getElementById('fleming-bag-count');
    document.body.addEventListener('added_to_cart', function () {
      if (!bag) return;
      gsap.fromTo(bag,
        { scale: 0.7 },
        { scale: 1, duration: 0.45, ease: 'back.out(2.5)', clearProps: 'transform' }
      );
    });

    /* ---------- 6. Refresh triggers after full load (images shift layout) ---------- */
    window.addEventListener('load', function () { ScrollTrigger.refresh(); });
  });
})();
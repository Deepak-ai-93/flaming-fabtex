/**
 * Fleming landing — GSAP high-end motion.
 * Hero entrance timeline, parallax/float cards, marquee, count-up stats,
 * ScrollTrigger reveals for cards/sections. Degrades gracefully.
 */
(function () {
  if (typeof window.gsap === 'undefined') { return; }

  var $ = window.gsap;
  var ST = window.ScrollTrigger || null;

  document.addEventListener('DOMContentLoaded', function () {
    if (typeof $.registerPlugin === 'function' && ST) { $.registerPlugin(ST); }

    /* ---------- 1. Nav sticky — creative header shrink ---------- */
    var nav = document.getElementById('nav') || document.getElementById('myntra-header');
    if (nav && ST) {
      ST.create({
        start: 8,
        onUpdate: function (self) {
          nav.classList.toggle('stuck', self.scroll() > 8);
          nav.classList.toggle('is-shrink', self.scroll() > 24);
        }
      });
    }
    // fallback without ScrollTrigger
    var ch = document.getElementById('myntra-header');
    if (ch && !ST) {
      window.addEventListener('scroll', function(){ ch.classList.toggle('is-shrink', window.scrollY > 24); }, {passive:true});
    }

    /* ---------- 2. Hero entrance ---------- */
    var heroWrap = document.querySelector('.hero');
    if (heroWrap) {
      var tl = $.timeline({ defaults: { ease: 'power3.out' } });
      tl.set('.hero-elem', { autoAlpha: 1 })
        .from('.hero-elem', { y: 34, opacity: 0, duration: 0.8, stagger: 0.1 }, 0.05)
        .from('.hero-media', { scale: 0.92, opacity: 0, duration: 1.1, ease: 'power2.out' }, 0.25)
        .from('.hero-float', { y: -18, opacity: 0, duration: 0.7, stagger: 0.15, ease: 'back.out(1.6)' }, 0.7);

      /* floating cards idle bob */
      if ($.utils) {
        $.utils.toArray('.hero-float').forEach(function (el, i) {
          $.to(el, { y: i % 2 ? -10 : 10, duration: 2.6 + i * 0.5, yoyo: true, repeat: -1, ease: 'sine.inOut' });
        });
      }
      /* parallax hero media on scroll */
      if (ST) {
        $.to('.hero-media', { yPercent: 12, ease: 'none', scrollTrigger: { trigger: heroWrap, start: 'top top', end: 'bottom top', scrub: 0.6 } });
        $.to('.hero-blob', { yPercent: -18, xPercent: 14, ease: 'none', scrollTrigger: { trigger: heroWrap, start: 'top top', end: 'bottom top', scrub: 0.8 } });
      }
    }

    /* ---------- 3. Marquee ---------- */
    var marquee = document.querySelector('.marquee-track');
    if (marquee) {
      var dup = marquee.innerHTML;
      marquee.innerHTML += dup;
      $.to(marquee, { xPercent: -50, duration: 28, ease: 'none', repeat: -1 });
    }

    /* ---------- 4. Count-up stats ---------- */
    // FIX 2026-10-16: was ST.utils.toArray — ScrollTrigger has no .utils (TypeError killed the rest of this handler). Use gsap.utils.
    if (ST && $.utils) {
      $.utils.toArray('[data-count]').forEach(function (el) {
        var end = parseFloat(el.getAttribute('data-count')) || 0;
        var suffix = el.getAttribute('data-suffix') || '';
        var obj = { v: 0 };
        ST.create({
          trigger: el, start: 'top 88%', once: true,
          onEnter: function () {
            $.to(obj, {
              v: end, duration: 1.8, ease: 'power1.out',
              onUpdate: function () {
                el.textContent = Math.round(obj.v).toLocaleString('en-IN') + suffix;
              }
            });
          }
        });
      });
    }

    /* ---------- 5. Scroll reveals ---------- */
    // FIX 2026-10-16: was ST.utils.toArray — same TypeError as above. Use gsap.utils.
    if (ST && $.utils) {
      var revealSel = '.p-card, .cat-tile, .look, .step, .slab, .tier-card, .sec-head, .stat';
      $.utils.toArray(revealSel).forEach(function (el) {
        if (el.closest('.hero')) { return; }
        $.from(el, {
          y: 28, opacity: 0, duration: 0.65, ease: 'power2.out', clearProps: 'transform',
          scrollTrigger: { trigger: el, start: 'top 92%', once: true }
        });
      });
      /* big band + steps stagger */
      var head = document.querySelector('.sec-head');
      if (head) {
        $.from('.band', { y: 40, opacity: 0, duration: 0.9, ease: 'power2.out', scrollTrigger: { trigger: '.band', start: 'top 88%', once: true } });
      }
    }

    /* ---------- 6. Hover tilt on category tiles ---------- */
    if ($.matchMedia) {
      var mm = $.matchMedia('(hover: hover) and (min-width:900px)');
      mm.add(function () {
        document.querySelectorAll('.cat-tile').forEach(function (el) {
          el.addEventListener('mousemove', function (e) {
            var r = el.getBoundingClientRect();
            var x = ((e.clientX - r.left) / r.width - 0.5) * 6;
            var y = ((e.clientY - r.top) / r.height - 0.5) * 6;
            $.to(el, { rotationY: x, rotationX: -y, duration: 0.3, transformPerspective: 600 });
          });
          el.addEventListener('mouseleave', function () {
            $.to(el, { rotationY: 0, rotationX: 0, duration: 0.5, ease: 'power2.out' });
          });
        });
      });
    }
  });
})();
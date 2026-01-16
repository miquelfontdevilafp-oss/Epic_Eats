(() => {
    const initTrack = (track) => {
        const key = track.getAttribute('data-scroll-dots');
        if (!key) return;

        const dotsHost = document.querySelector(`[data-dots-for="${key}"]`);
        if (!dotsHost) return;

        // Elements que considerem "slides"
        const items = Array.from(track.children).filter((el) =>
            el.classList.contains('hero-card') || el.classList.contains('product-card')
        );
        if (items.length <= 1) {
            dotsHost.innerHTML = '';
            return;
        }

        dotsHost.innerHTML = '';
        const dots = items.map((_, i) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'dot';
            btn.setAttribute('aria-label', `Anar al slide ${i + 1}`);
            btn.addEventListener('click', () => {
                items[i].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
            });
            dotsHost.appendChild(btn);
            return btn;
        });

        const setActive = () => {
            const left = track.scrollLeft;

            let idx = 0;
            let best = Number.POSITIVE_INFINITY;
            for (let i = 0; i < items.length; i++) {
                const d = Math.abs(items[i].offsetLeft - left);
                if (d < best) {
                    best = d;
                    idx = i;
                }
            }

            dots.forEach((d, i) => d.classList.toggle('is-active', i === idx));
        };

        let raf = 0;
        const onScroll = () => {
            if (raf) return;
            raf = window.requestAnimationFrame(() => {
                raf = 0;
                setActive();
            });
        };

        track.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', setActive);
        setActive();
    };

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-scroll-dots]').forEach(initTrack);
    });
})();

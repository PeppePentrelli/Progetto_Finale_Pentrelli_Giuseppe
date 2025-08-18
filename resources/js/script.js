document.addEventListener("DOMContentLoaded", function () {
    const overlay = document.getElementById('overlay');
    const dropdowns = document.querySelectorAll('.custom-dropdown');
    const helperBtn = document.getElementById('helperBtn');
    const helperMenu = document.getElementById('helperMenu');
    const themeSelector = document.getElementById('themeSelector');

    /* ========== Gestione Dropdown Navbar ========== */
    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const menu = dropdown.querySelector('.dropdown-menu');

        if (button && menu) {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = menu.classList.contains('show');

                dropdowns.forEach(d => {
                    d.classList.remove('show');
                    const dm = d.querySelector('.dropdown-menu');
                    if (dm) dm.classList.remove('show');
                });

                if (!isOpen) {
                    dropdown.classList.add('show');
                    menu.classList.add('show');
                    if (overlay) overlay.style.display = 'block';
                } else {
                    if (overlay) overlay.style.display = 'none';
                }
            });
        }
    });

    /* ========== Gestione Menu Accessibilità ========== */
    if (helperBtn && helperMenu) {
        helperBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = helperMenu.classList.contains('show');

            dropdowns.forEach(d => {
                d.classList.remove('show');
                const dm = d.querySelector('.dropdown-menu');
                if (dm) dm.classList.remove('show');
            });

            helperMenu.classList.toggle('show');
            if (overlay) overlay.style.display = isOpen ? 'none' : 'block';
        });
    }

    /* ========== Gestione Dropdown Specifico ========== */
    const dropdownBtn = document.getElementById('btnToggleDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = dropdownMenu.style.display === 'block';

            dropdownMenu.style.display = isOpen ? 'none' : 'block';
            if (overlay) overlay.style.display = isOpen ? 'none' : 'block';

            if (!isOpen) {
                dropdownMenu.style.zIndex = 1055;
                overlay.style.zIndex = 1040;
            }
        });
    }

    /* ========== Chiusura Overlay e Click Fuori ========== */
    if (overlay) {
        overlay.addEventListener('click', () => {
            closeAllMenus();
        });
    }

    document.addEventListener('click', (e) => {
        const target = e.target;
        let clickInsideDropdown = false;

        dropdowns.forEach(dropdown => {
            const menu = dropdown.querySelector('.dropdown-menu');
            if (dropdown.contains(target) || (menu && menu.contains(target))) {
                clickInsideDropdown = true;
            }
        });

        const clickInsideBtnDropdown = dropdownMenu && (dropdownMenu.contains(target) || target === dropdownBtn);
        const clickInsideAccessibility = helperMenu && (
            helperMenu.contains(target) || (helperBtn && helperBtn.contains(target))
        );
        const clickInsideFormElement = target.closest('input, form, textarea, select');

        if (!clickInsideDropdown && !clickInsideAccessibility && !clickInsideFormElement && !clickInsideBtnDropdown) {
            closeAllMenus();
        }
    });

    function closeAllMenus() {
        dropdowns.forEach(d => {
            d.classList.remove('show');
            const dm = d.querySelector('.dropdown-menu');
            if (dm) dm.classList.remove('show');
        });
        if (helperMenu) helperMenu.classList.remove('show');
        if (dropdownMenu) dropdownMenu.style.display = 'none';
        if (overlay) overlay.style.display = 'none';
    }

    /* ========== Gestione Tema e Loghi ========== */
    function applyTheme(theme) {
        document.body.className = document.body.className
            .split(' ')
            .filter(c => !c.startsWith('theme-'))
            .join(' ');
        if (theme) document.body.classList.add(theme);
    }
const logoMap = {
    '.logo-nav': {
        'theme-Aulab-Lovers': '/media/loghi-nav/logo_presto_nero.png',
        'theme-energia': '/media/loghi-nav/logo_presto_rosso.png',
        'theme-fiducia': '/media/loghi-nav/logo_presto_bianco.png',
        'theme-natura': '/media/loghi-nav/logo_presto_bianco.png',
    },
    '.logo-main': {
        'theme-Aulab-Lovers': '/media/loghi-nav/logo_presto_bianco.png',
        'theme-energia': '/media/loghi-nav/logo_presto_rosso.png',
        'theme-fiducia': '/media/loghi-nav/logo_presto_blu.png',
        'theme-natura': '/media/loghi-nav/logo_presto_bianco.png',
    }
};

    function changeLogo(selector, themeClass) {
        const logoImgs = document.querySelectorAll(selector);
        if (!logoImgs.length) return;

        const logos = logoMap[selector];
        logoImgs.forEach(logoImg => {
            const newSrc = logos[themeClass] || '/media/img-logo/logo_presto_nero.png';
            if (logoImg.src !== newSrc) {
                logoImg.src = newSrc;
            }
        });
    }

    /* ========== Lazy Load Logos with Intersection Observer ========== */
    function lazyLoadLogos(selector) {
        const logos = document.querySelectorAll(selector);
        if (!('IntersectionObserver' in window)) {
            logos.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
            });
            return;
        }

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        });

        logos.forEach(img => {
            if (img.dataset.src) {
                observer.observe(img);
            }
        });
    }

    if (themeSelector) {
        const savedTheme = localStorage.getItem('selectedTheme');
        if (savedTheme) {
            themeSelector.value = savedTheme;
            applyTheme(savedTheme);
            changeLogo('.logo-nav', savedTheme);
            // Per le logo-main usiamo lazy load:
            document.querySelectorAll('.logo-main').forEach(img => {
                const logosForMain = logoMap['.logo-main'];
                if (logosForMain[savedTheme]) {
                    img.dataset.src = logosForMain[savedTheme];
                }
            });
            lazyLoadLogos('.logo-main');
        }

        themeSelector.addEventListener('change', function () {
            const selectedTheme = themeSelector.value;
            localStorage.setItem('selectedTheme', selectedTheme);
            applyTheme(selectedTheme);
            changeLogo('.logo-nav', selectedTheme);

            document.querySelectorAll('.logo-main').forEach(img => {
                const logosForMain = logoMap['.logo-main'];
                if (logosForMain[selectedTheme]) {
                    img.dataset.src = logosForMain[selectedTheme];
                    img.removeAttribute('src');
                }
            });
            lazyLoadLogos('.logo-main');
        });
    }
});


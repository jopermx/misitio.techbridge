/* TBCS Core */
const TBCS_BASE_PATH = typeof window !== 'undefined' && typeof window.TBCS_BASE_PATH === 'string'
  ? window.TBCS_BASE_PATH
  : '';

const TBCS = {
  phone1: '',
  phone1Href: 'tel:',
  phone2: '',
  phone2Href: 'tel:',
  email: '',
  emailHref: 'mailto:',
  location: '',
  logoMain: 'img/tbcs.png',
  logoIcon: 'img/favicon_tbcs.png',
  waNumber: '',
  waMessage: 'Hola, me interesa conocer mas sobre los servicios de TechBridge Consulting Systems',
  year: String(new Date().getFullYear()),
  navItems: [
    { label: 'Inicio', href: 'index.php' },
    { label: 'Nosotros', href: 'nosotros.php' },
    { label: 'Servicios', href: 'index.php#servicios' }
  ],
  footerServices: [
    { label: 'Infraestructura & Redes', href: 'infraestructura-conectividad.php' },
    { label: 'Transformacion Digital', href: 'transformacion-digital.php' },
    { label: 'Capacitacion', href: 'cursos.php' },
    { label: 'Consultoria Estrategica', href: 'consultoria-estrategica.php' },
    { label: 'HeadHunting', href: 'headhunting.php' },
    { label: 'Servicios Contables', href: 'servicios_contables.php' },
    { label: 'Diseno de Software', href: 'diseno-software.php', badge: 'NUEVO' },
    { label: 'Invitaciones Digitales', href: 'invitaciones-digitales.php', badge: 'NUEVO' }
  ],
  footerCompany: [
    { label: 'Quienes somos', href: 'nosotros.php' },
    { label: 'Metodologia', href: 'nosotros.php#metodologia' },
    { label: 'Cursos', href: 'cursos.php' },
    { label: 'Contacto', href: 'contacto.php' }
  ]
};

async function loadSiteConfig() {
  try {
    const res = await fetch(resolvePath('site-config.php'), { cache: 'no-store' });
    if (!res.ok) return;
    const cfg = await res.json();
    if (cfg.contact) {
      TBCS.phone1 = cfg.contact.phone1 || TBCS.phone1;
      TBCS.phone1Href = cfg.contact.phone1Href || TBCS.phone1Href;
      TBCS.phone2 = cfg.contact.phone2 || TBCS.phone2;
      TBCS.phone2Href = cfg.contact.phone2Href || TBCS.phone2Href;
      TBCS.email = cfg.contact.email || TBCS.email;
      TBCS.emailHref = cfg.contact.emailHref || TBCS.emailHref;
      TBCS.location = cfg.contact.location || TBCS.location;
    }
    if (cfg.branding) {
      TBCS.logoMain = cfg.branding.logoMain || TBCS.logoMain;
      TBCS.logoIcon = cfg.branding.logoIcon || TBCS.logoIcon;
    }
    if (cfg.whatsapp) {
      TBCS.waNumber = cfg.whatsapp.number || TBCS.waNumber;
      TBCS.waMessage = cfg.whatsapp.message || TBCS.waMessage;
    }
  } catch (_) {
    // no-op
  }
}

function currentPage() {
  if (typeof window !== 'undefined' && typeof window.TBCS_PAGE_ID === 'string' && window.TBCS_PAGE_ID) {
    return window.TBCS_PAGE_ID;
  }

  const path = window.location.pathname;
  const file = path.substring(path.lastIndexOf('/') + 1) || 'index.php';
  return file;
}

function resolvePath(href) {
  if (
    !href ||
    href.startsWith('#') ||
    /^(?:[a-z]+:)?\/\//i.test(href) ||
    href.startsWith('mailto:') ||
    href.startsWith('tel:')
  ) {
    return href;
  }

  return TBCS_BASE_PATH + href;
}

function renderNav() {
  const placeholder = document.getElementById('tbcs-nav');
  if (!placeholder) return;

  const page = currentPage();
  const links = TBCS.navItems.map((item) => {
    const itemPage = item.href.split('#')[0];
    const isActive = itemPage === page;
    return `<a href="${resolvePath(item.href)}" class="nav-link${isActive ? ' active' : ''}">${item.label}</a>`;
  }).join('');

  const mobileLinks = TBCS.navItems.map((item) =>
    `<a href="${resolvePath(item.href)}" class="nav-mobile-link">${item.label}</a>`
  ).join('');

  placeholder.innerHTML = `
    <header id="tbcs-header">
      <div class="container">
        <div class="nav-inner">
          <a href="${resolvePath('index.php')}" class="nav-logo">
            <img src="${resolvePath(TBCS.logoMain)}" alt="TechBridge Consulting Systems" class="nav-logo-main">
            <img src="${resolvePath(TBCS.logoIcon)}" alt="TBCS" class="nav-logo-icon">
          </a>
          <nav class="nav-links">
            ${links}
            <a href="${resolvePath('contacto.php')}" class="nav-cta">Contactanos</a>
          </nav>
          <button class="nav-mobile-btn" id="tbcs-mobile-btn" aria-label="Abrir menu">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </div>
      <nav class="nav-mobile-menu" id="tbcs-mobile-menu">
        <div class="nav-mobile-inner">
          ${mobileLinks}
          <a href="${resolvePath('contacto.php')}" class="nav-mobile-cta">Contactanos</a>
        </div>
      </nav>
    </header>
  `;
}

function renderFooter() {
  const placeholder = document.getElementById('tbcs-footer');
  if (!placeholder) return;

  const services = TBCS.footerServices.map((s) => {
    const badge = s.badge ? `<span class="badge-new">${s.badge}</span>` : '';
    const cls = s.badge ? ' footer-link--accent' : '';
    return `<a href="${resolvePath(s.href)}" class="footer-link${cls}">${s.label}${badge}</a>`;
  }).join('');

  const company = TBCS.footerCompany.map((c) =>
    `<a href="${resolvePath(c.href)}" class="footer-link">${c.label}</a>`
  ).join('');

  placeholder.innerHTML = `
    <div class="container">
      <div class="footer-grid">
        <div>
          <img src="${resolvePath(TBCS.logoMain)}" alt="TechBridge Consulting Systems" class="footer-logo">
          <p class="footer-tagline">"Sistemas que conectan, consultoría que transforma"</p>
          <p class="footer-copy">&copy; ${TBCS.year} TechBridge Consulting Systems<br>Todos los derechos reservados</p>
        </div>
        <div class="footer-col">
          <h4>Servicios</h4>
          ${services}
        </div>
        <div class="footer-col">
          <h4>Empresa</h4>
          ${company}
        </div>
        <div class="footer-col">
          <h4>Contacto</h4>
          <span class="footer-link">${TBCS.location}</span>
          <a href="${TBCS.phone1Href}" class="footer-link">${TBCS.phone1}</a>
          <a href="${TBCS.phone2Href}" class="footer-link">${TBCS.phone2}</a>
          <a href="${TBCS.emailHref}" class="footer-link">${TBCS.email}</a>
        </div>
      </div>
      <div class="footer-bottom">TechBridge Consulting Systems &mdash; ${TBCS.location} &mdash; ${TBCS.year}</div>
    </div>
  `;
}

function renderWhatsApp() {
  const placeholder = document.getElementById('tbcs-whatsapp');
  if (!placeholder || !TBCS.waNumber) return;

  const url = `https://wa.me/${TBCS.waNumber}?text=${encodeURIComponent(TBCS.waMessage)}`;
  placeholder.innerHTML = `
    <div class="whatsapp-fab">
      <span class="whatsapp-label">Escribenos</span>
      <a href="${url}" target="_blank" rel="noopener noreferrer" class="whatsapp-btn" aria-label="Contactar por WhatsApp">
        <img src="${resolvePath('img/whatsapp.svg')}" alt="WhatsApp">
      </a>
    </div>
  `;
}

function initMobileMenu() {
  const btn = document.getElementById('tbcs-mobile-btn');
  const menu = document.getElementById('tbcs-mobile-menu');
  if (!btn || !menu) return;

  btn.addEventListener('click', () => menu.classList.toggle('open'));
  menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => menu.classList.remove('open')));
}

function initFadeUp() {
  const els = document.querySelectorAll('.fade-up');
  if (!els.length) return;

  const obs = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });

  els.forEach((el) => obs.observe(el));
  setTimeout(() => {
    document.querySelectorAll('.hero .fade-up, .hero--sub .fade-up').forEach((el) => el.classList.add('visible'));
  }, 80);
}

function initCounters() {
  const counters = document.querySelectorAll('[data-count]');
  if (!counters.length) return;

  const obs = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = parseInt(el.dataset.count, 10);
      const suffix = el.dataset.suffix || '';
      let current = 0;
      const step = Math.ceil(target / 45);

      const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current + suffix;
        if (current >= target) clearInterval(timer);
      }, 35);

      observer.unobserve(el);
    });
  }, { threshold: 0.6 });

  counters.forEach((el) => obs.observe(el));
}

function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
}

document.addEventListener('DOMContentLoaded', async () => {
  await loadSiteConfig();
  renderNav();
  renderFooter();
  renderWhatsApp();
  initMobileMenu();
  initFadeUp();
  initCounters();
  initSmoothScroll();
});

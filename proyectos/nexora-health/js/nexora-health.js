const TAB_DATA = [
  { title: 'Dashboard', desc: 'Vista general del sistema y acceso r\u00e1pido a los m\u00f3dulos principales del consultorio.', image: './img/dashboard-demo.jpg' },
  { title: 'Pacientes', desc: 'Acceso al registro, identificaci\u00f3n y expediente del paciente.', image: './img/pacientes-demo.jpg' },
  { title: 'Consulta', desc: 'Flujo de atenci\u00f3n con captura cl\u00ednica, receta y seguimiento.', image: './img/consulta-demo.jpg' },
  { title: 'Expediente', desc: 'Organizaci\u00f3n documental y estructura del expediente cl\u00ednico.', image: './img/expediente-demo.jpg' }
];

const JOURNEY_DATA = [
  {
    title: 'Consulta',
    desc: 'La consulta se presenta como un flujo ordenado, \u00e1gil y f\u00e1cil de seguir durante la atenci\u00f3n m\u00e9dica.',
    bullets: [
      'Captura estructurada de la consulta cl\u00ednica.',
      'Registro claro de signos vitales, observaciones e indicaciones.',
      'Continuidad hacia receta, cobro y seguimiento del paciente.'
    ]
  },
  {
    title: 'Expediente',
    desc: 'El expediente concentra la informaci\u00f3n relevante del paciente en una vista clara, ordenada y f\u00e1cil de consultar.',
    bullets: [
      'Resumen del paciente en una sola vista.',
      'Acceso r\u00e1pido a antecedentes, notas y documentos.',
      'Mayor control para continuidad cl\u00ednica y seguimiento del caso.'
    ]
  },
  {
    title: 'Administraci\u00f3n',
    desc: 'La operaci\u00f3n diaria del consultorio se integra en un mismo entorno para reducir fricci\u00f3n y mejorar control.',
    bullets: [
      'Agenda y gesti\u00f3n de pacientes en una sola plataforma.',
      'Cobro y tareas operativas conectadas al flujo de trabajo.',
      'Mayor orden para recepci\u00f3n, consulta y control interno.'
    ]
  },
  {
    title: 'Seguimiento',
    desc: 'El seguimiento refuerza continuidad, trazabilidad y una mejor lectura del proceso completo de atenci\u00f3n.',
    bullets: [
      'Visi\u00f3n m\u00e1s clara del recorrido completo del paciente.',
      'Mejor continuidad cl\u00ednica y control documental.',
      'M\u00e1s consistencia en el historial y en la toma de decisiones.'
    ]
  }
];

const DEFAULT_DEMO_VIDEO = './img/nexora-health-demo.mp4';

function refreshIcons() {
  if (window.lucide && typeof window.lucide.createIcons === 'function') {
    window.lucide.createIcons();
  }
}

function setTab(index) {
  const tabs = document.querySelectorAll('.tab-btn');
  tabs.forEach((btn, i) => btn.classList.toggle('active', i === index));

  const data = TAB_DATA[index] || TAB_DATA[0];
  const shot = document.getElementById('preview-shot');
  const visual = document.getElementById('preview-visual');

  document.getElementById('carousel-title').textContent = data.title;
  document.getElementById('carousel-desc').textContent = data.desc;
  shot.alt = data.title;

  shot.onload = () => {
    shot.classList.add('is-visible', 'zoomable');
    visual.classList.add('is-hidden');
  };

  shot.onerror = () => {
    shot.classList.remove('is-visible', 'zoomable');
    visual.classList.remove('is-hidden');
    shot.removeAttribute('src');
  };

  if (data.image) {
    shot.src = data.image;
  }
}

function setJourney(index) {
  const data = JOURNEY_DATA[index] || JOURNEY_DATA[0];
  document.querySelectorAll('.journey-step').forEach((step, i) => step.classList.toggle('active', i === index));
  document.getElementById('journey-title').textContent = data.title;
  document.getElementById('journey-desc').textContent = data.desc;
  document.getElementById('journey-list').innerHTML = data.bullets.map((item, i) => (
    '<div class="journey-list-item"><span>' + (i + 1) + '</span><div>' + item + '</div></div>'
  )).join('');
}

function openImageModal(src, altText) {
  if (!src) return;
  const modal = document.getElementById('imageModal');
  const img = document.getElementById('imageModalImg');
  img.src = src;
  img.alt = altText || 'Vista ampliada';
  modal.classList.add('open');
  modal.setAttribute('aria-hidden', 'false');
}

function closeImageModal() {
  const modal = document.getElementById('imageModal');
  const img = document.getElementById('imageModalImg');
  modal.classList.remove('open');
  modal.setAttribute('aria-hidden', 'true');
  img.removeAttribute('src');
}

function toggleMenu() {
  document.getElementById('mobileMenu').classList.toggle('open');
}

function closeMenu() {
  document.getElementById('mobileMenu').classList.remove('open');
}
function animateCount(el) {
  const target = parseInt(el.dataset.target, 10);
  const suffix = el.dataset.suffix || '';
  let start = null;

  function step(timestamp) {
    if (!start) start = timestamp;
    const progress = Math.min((timestamp - start) / 1800, 1);
    el.textContent = Math.floor(progress * target) + suffix;
    if (progress < 1) requestAnimationFrame(step);
  }

  requestAnimationFrame(step);
}

const revealItems = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.12 });

const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) return;
    const number = entry.target.querySelector('.stat-num');
    if (number) animateCount(number);
    statsObserver.unobserve(entry.target);
  });
}, { threshold: 0.3 });

function dragOver(event) {
  event.preventDefault();
  document.getElementById('videoDrop').classList.add('dragover');
}

function dragLeave() {
  document.getElementById('videoDrop').classList.remove('dragover');
}

function showVideoFromFile(file) {
  if (!file || !file.type.startsWith('video/')) return;
  const url = URL.createObjectURL(file);
  const video = document.getElementById('videoEl');
  video.src = url;
  document.getElementById('videoDrop').style.display = 'none';
  document.getElementById('videoPlayer').style.display = 'block';
}

function dropFile(event) {
  event.preventDefault();
  dragLeave();
  const file = event.dataTransfer && event.dataTransfer.files ? event.dataTransfer.files[0] : null;
  showVideoFromFile(file);
}

function loadVideo(event) {
  const file = event.target && event.target.files ? event.target.files[0] : null;
  showVideoFromFile(file);
}

function loadDefaultVideo() {
  const video = document.getElementById('videoEl');
  if (!video) return;
  video.src = encodeURI(DEFAULT_DEMO_VIDEO);
  document.getElementById('videoDrop').style.display = 'none';
  document.getElementById('videoPlayer').style.display = 'block';
}

function isEmailValid(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function submitForm() {
  const name = document.getElementById('fname').value.trim();
  const email = document.getElementById('femail').value.trim();
  const specialty = document.getElementById('fspecialty').value;

  const errName = document.getElementById('err-name');
  const errEmail = document.getElementById('err-email');
  const errSpecialty = document.getElementById('err-specialty');
  errName.style.display = name ? 'none' : 'block';
  errEmail.style.display = isEmailValid(email) ? 'none' : 'block';
  errSpecialty.style.display = specialty ? 'none' : 'block';

  if (!name || !isEmailValid(email) || !specialty) return;
  document.getElementById('successBox').style.display = 'block';
}

document.addEventListener('DOMContentLoaded', () => {
  setTab(0);
  setJourney(0);
  loadDefaultVideo();
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 18);
  });
  revealItems.forEach((item) => revealObserver.observe(item));
  document.querySelectorAll('.stat-item').forEach((item) => statsObserver.observe(item));

  document.addEventListener('click', (event) => {
    const target = event.target;
    if (target && target.id === 'preview-shot' && target.getAttribute('src')) {
      openImageModal(target.getAttribute('src'), target.getAttribute('alt'));
    }
    if (target && target.id === 'imageModal') {
      closeImageModal();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeImageModal();
  });

  refreshIcons();
});




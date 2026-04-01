const TAB_DATA = [
  { title: 'Dashboard', desc: 'Vista general del sistema y acceso rapido a los modulos principales del consultorio.', image: './img/dashboard-demo.jpg' },
  { title: 'Pacientes', desc: 'Acceso al registro, identificacion y expediente del paciente.', image: './img/pacientes-demo.jpg' },
  { title: 'Consulta', desc: 'Flujo de atencion con captura clinica, receta y seguimiento.', image: './img/consulta-demo.jpg' },
  { title: 'Expediente', desc: 'Organizacion documental y estructura del expediente clinico.', image: './img/expediente-demo.jpg' }
];

const JOURNEY_DATA = [
  {
    title: 'Consulta',
    desc: 'La consulta se presenta como un flujo ordenado, agil y facil de seguir durante la atencion medica.',
    bullets: [
      'Captura estructurada de la consulta clinica.',
      'Registro claro de signos vitales, observaciones e indicaciones.',
      'Continuidad hacia receta, cobro y seguimiento del paciente.'
    ]
  },
  {
    title: 'Expediente',
    desc: 'El expediente concentra la informacion relevante del paciente en una vista clara, ordenada y facil de consultar.',
    bullets: [
      'Resumen del paciente en una sola vista.',
      'Acceso rapido a antecedentes, notas y documentos.',
      'Mayor control para continuidad clinica y seguimiento del caso.'
    ]
  },
  {
    title: 'Administracion',
    desc: 'La operacion diaria del consultorio se integra en un mismo entorno para reducir friccion y mejorar control.',
    bullets: [
      'Agenda y gestion de pacientes en una sola plataforma.',
      'Cobro y tareas operativas conectadas al flujo de trabajo.',
      'Mayor orden para recepcion, consulta y control interno.'
    ]
  },
  {
    title: 'Seguimiento',
    desc: 'El seguimiento refuerza continuidad, trazabilidad y una mejor lectura del proceso completo de atencion.',
    bullets: [
      'Vision mas clara del recorrido completo del paciente.',
      'Mejor continuidad clinica y control documental.',
      'Mas consistencia en el historial y en la toma de decisiones.'
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




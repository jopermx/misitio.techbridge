<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Curso Excel Básico Intermedio - TechBridge Consulting Systems</title>
  <meta name="description" content="Curso de Excel Básico a Intermedio para equipos de negocio con enfoque práctico y certificación.">
  <link rel="icon" type="image/png" href="img/favicon_tbcs_black.png?v=4">
  <link rel="shortcut icon" href="img/favicon_tbcs_black.png?v=4" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/tbcs.css">
  <link rel="stylesheet" href="css/tbcs-pages.css">
</head>
<body>
<div id="tbcs-nav"></div>

<main>
  <section class="hero hero--sub">
    <div class="hero-grid-bg"></div>
    <div class="hero-glow"></div>
    <div class="container hero-content">
      <div style="max-width:760px;">
        <div class="label fade-up" style="margin-bottom:1.5rem;">Curso especializado</div>
        <h1 class="t-display fade-up delay-1">Excel Básico a Intermedio para equipos productivos</h1>
        <p class="t-body fade-up delay-2" style="margin:1.25rem 0 2rem;">
          Lleva a tu equipo de tareas manuales a análisis con estructura, fórmulas y visualización efectiva de datos.
        </p>
        <div class="btn-group fade-up delay-3">
          <a href="#inscripcion" class="btn btn--primary">Inscribirme</a>
          <a href="#programa" class="btn btn--outline">Ver programa</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section section--surface">
    <div class="container">
      <div class="kpi-strip fade-up">
        <div class="kpi-item"><div class="value">10 horas</div><div class="t-small">Duración total</div></div>
        <div class="kpi-item"><div class="value">100% online</div><div class="t-small">Modalidad en vivo</div></div>
        <div class="kpi-item"><div class="value">70-20-10</div><div class="t-small">Método de aprendizaje</div></div>
        <div class="kpi-item"><div class="value">Certificado</div><div class="t-small">Al completar evaluación</div></div>
      </div>
    </div>
  </section>

  <section id="programa" class="section">
    <div class="container">
      <div class="section-header fade-up">
        <div class="rule"></div>
        <h2 class="t-h2">Programa del curso</h2>
      </div>
      <div class="timeline">
        <div class="step fade-up" data-step="1">
          <h3 class="t-h3" style="margin-bottom:.5rem;">Semana 1: Fundamentos sólidos</h3>
          <ul class="check-list">
            <li>Interfaz de Excel, formato y buenas prácticas</li>
            <li>Fórmulas esenciales y referencias relativas/absolutas</li>
            <li>Funciones de texto, fecha y condición</li>
          </ul>
        </div>
        <div class="step fade-up delay-1" data-step="2">
          <h3 class="t-h3" style="margin-bottom:.5rem;">Semana 2: Análisis y visualización</h3>
          <ul class="check-list">
            <li>Tablas, filtros avanzados y validación de datos</li>
            <li>Tablas dinámicas para reporteo</li>
            <li>Gráficas ejecutivas para toma de decisiones</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section section--surface">
    <div class="container">
      <div class="grid-2">
        <article class="card fade-up">
          <h3 class="t-h3" style="margin-bottom:.75rem;">Lo que lograrás</h3>
          <ul class="check-list">
            <li>Automatizar reportes recurrentes</li>
            <li>Reducir errores manuales en captura</li>
            <li>Mejorar lectura de información clave</li>
          </ul>
        </article>
        <article class="card fade-up delay-1">
          <h3 class="t-h3" style="margin-bottom:.75rem;">Perfil ideal</h3>
          <ul class="check-list">
            <li>Equipos administrativos y operativos</li>
            <li>Analistas junior y coordinadores</li>
            <li>Personas sin base técnica avanzada</li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section id="inscripcion" class="section">
    <div class="container">
      <div class="section-header fade-up">
        <div class="rule"></div>
        <h2 class="t-h2">Inscripción al curso</h2>
      </div>
      <div class="card fade-up" style="max-width:760px;margin:0 auto;">
        <form id="enrollmentForm" action="api/contact.php" method="POST" novalidate>
          <input type="hidden" name="form_type" value="course_enrollment">
          <input type="hidden" name="source_page" value="curso-excel-basico-intermedio.php">
          <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;opacity:0;" aria-hidden="true">

          <div class="form-group">
            <label class="form-label" for="enroll_name">Nombre completo</label>
            <input class="form-input" id="enroll_name" name="nombre" type="text" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="enroll_email">Correo</label>
            <input class="form-input" id="enroll_email" name="email" type="email" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="enroll_phone">Teléfono</label>
            <input class="form-input" id="enroll_phone" name="telefono" type="tel" pattern="[0-9]{10,15}" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="enroll_company">Empresa</label>
            <input class="form-input" id="enroll_company" name="empresa" type="text" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="enroll_message">Objetivo del participante</label>
            <textarea class="form-textarea" id="enroll_message" name="desafio" maxlength="500" required></textarea>
          </div>

          <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center;">Enviar inscripción</button>
          <div id="enrollment-form-status-message" class="form-message"></div>
        </form>
      </div>
    </div>
  </section>
</main>

<div id="tbcs-footer"></div>
<div id="tbcs-whatsapp"></div>
<script src="js/tbcs.js"></script>
<script src="js/forms.js"></script>
</body>
</html>


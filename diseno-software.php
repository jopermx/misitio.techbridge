<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diseño & Desarrollo de Software — TechBridge Consulting Systems</title>
  <meta name="description" content="Desarrollamos sistemas ERP, aplicaciones web, bases de datos y automatizaciones a la medida de tu negocio. Ciudad de México.">
  <link rel="icon" type="image/png" href="img/favicon_tbcs_black.png?v=4">
  <link rel="shortcut icon" href="img/favicon_tbcs_black.png?v=4" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/tbcs.css">
</head>
<body>

<div id="tbcs-nav"></div>

<main>

  <!-- ═══════ HERO ═══════ -->
  <section class="hero hero--sub">
    <div class="hero-grid-bg"></div>
    <div class="hero-glow"></div>
    <div class="container hero-content">
      <div style="max-width:700px;">
        <div class="label fade-up" style="margin-bottom:1.5rem;">
          <svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          Diseño & Desarrollo de Software
        </div>
        <h1 class="t-display fade-up delay-1">
          Software que trabaja<br>para tu negocio
        </h1>
        <p class="t-body fade-up delay-2" style="max-width:520px;margin:1.25rem 0 2.5rem;">
          Creamos sistemas, plataformas web y herramientas digitales a la medida.
          Soluciones reales, con resultados visibles desde el primer día.
        </p>
        <div class="btn-group fade-up delay-3">
          <a href="contacto.php" class="btn btn--primary">
            Cotiza tu proyecto
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="#portafolio" class="btn btn--outline">Ver proyectos</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════ PORTAFOLIO ═══════ -->
  <section id="portafolio" class="section section--surface">
    <div class="container">
      <div class="section-header fade-up">
        <div class="rule"></div>
        <h2 class="t-h2">Proyectos que hemos construido</h2>
        <p>Software real, funcionando hoy en negocios como el tuyo.</p>
      </div>

      <div class="grid-3">

        <!-- Nexora Health — destacado -->
        <div class="portfolio-card portfolio-card--accent fade-up">
          <span class="badge-live">Nuevo</span>
          <div class="portfolio-thumb">
            <img src="img/software/erp-medico.jpg" alt="Sistema ERP Médico Nexora Health">
          </div>
          <div class="portfolio-body">
            <h4>Sistema ERP Médico — Nexora Health</h4>
            <p>Expediente electrónico, agenda, pacientes, cobros y panel de control para clínicas.</p>
            <div style="margin-bottom:.75rem;"><span class="tech-tag">PHP</span><span class="tech-tag">MySQL</span><span class="tech-tag">Bootstrap</span></div>
            <a href="proyectos/nexora-health/" class="arrow-link">
              Ver demo completa
              <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>

        <div class="portfolio-card fade-up delay-1">
          <div class="portfolio-thumb">
            <img src="img/software/valentina-nails.jpg" alt="Sistema Valentina Nails">
          </div>
          <div class="portfolio-body">
            <h4>Sistema Salón de Belleza</h4>
            <p>Gestión de citas, clientes, servicios e ingresos para salón de belleza.</p>
            <div><span class="tech-tag">MySQL</span><span class="tech-tag">JavaScript</span></div>
          </div>
        </div>

        <div class="portfolio-card fade-up delay-2">
          <div class="portfolio-thumb">
            <img src="img/software/dashboard.jpg" alt="Dashboard Ejecutivo de KPIs">
          </div>
          <div class="portfolio-body">
            <h4>Dashboard de KPIs</h4>
            <p>Tablero de indicadores en tiempo real conectado a múltiples fuentes de datos.</p>
            <div><span class="tech-tag">Power BI</span><span class="tech-tag">SQL Server</span></div>
          </div>
        </div>

        <div class="portfolio-card fade-up">
          <div class="portfolio-thumb">
            <img src="img/software/web-tbcs.jpg" alt="Sitio Web Corporativo TechBridge">
          </div>
          <div class="portfolio-body">
            <h4>TechBridge Consulting</h4>
            <p>Sitio web corporativo con diseño oscuro profesional, animaciones y sistema de componentes.</p>
            <div><span class="tech-tag">HTML5</span><span class="tech-tag">CSS</span><span class="tech-tag">PHP</span></div>
          </div>
        </div>

        <div class="portfolio-card fade-up delay-1">
          <div class="portfolio-thumb">
            <img src="img/software/automatizacion.jpg" alt="Automatización Excel y Power Automate">
          </div>
          <div class="portfolio-body">
            <h4>Automatización Excel & Power Automate</h4>
            <p>Flujos automáticos para reportes, notificaciones y generación de documentos.</p>
            <div><span class="tech-tag">Power Automate</span><span class="tech-tag">VBA</span></div>
          </div>
        </div>

        <div class="portfolio-card portfolio-card--dashed fade-up delay-2">
          <div class="portfolio-thumb" style="background:rgba(37,99,235,0.03);">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tu proyecto aquí</span>
          </div>
          <div class="portfolio-body">
            <h4>¿Tu próximo proyecto?</h4>
            <p>Cuéntanos qué necesitas y creamos la solución ideal para tu empresa.</p>
            <a href="contacto.php" class="arrow-link">
              Cuéntanos tu idea
              <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════ QUÉ DESARROLLAMOS ═══════ -->
  <section class="section">
    <div class="container">
      <div class="section-header fade-up">
        <div class="rule"></div>
        <h2 class="t-h2">¿Qué desarrollamos?</h2>
        <p>Soluciones tecnológicas que se adaptan exactamente a cómo funciona tu empresa.</p>
      </div>

      <div class="grid-3">

        <div class="card fade-up">
          <div class="icon-box">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <h3 class="t-h3" style="margin-bottom:.4rem;">Sistemas ERP / CRM</h3>
          <p class="t-small" style="margin-bottom:1rem;">Gestión integral de ventas, inventario, clientes, finanzas y operaciones desde un solo lugar.</p>
          <div><span class="tech-tag">MySQL</span><span class="tech-tag">PHP</span><span class="tech-tag">React</span></div>
        </div>

        <div class="card fade-up delay-1">
          <div class="icon-box">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
          </div>
          <h3 class="t-h3" style="margin-bottom:.4rem;">Aplicaciones Web</h3>
          <p class="t-small" style="margin-bottom:1rem;">Portales, tiendas en línea, dashboards y plataformas web completas con interfaces modernas.</p>
          <div><span class="tech-tag">HTML/CSS</span><span class="tech-tag">JavaScript</span><span class="tech-tag">Node.js</span></div>
        </div>

        <div class="card fade-up delay-2">
          <div class="icon-box">
            <svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
          </div>
          <h3 class="t-h3" style="margin-bottom:.4rem;">Bases de Datos & Reportes</h3>
          <p class="t-small" style="margin-bottom:1rem;">Diseño eficiente de bases de datos, reportes automatizados y dashboards de indicadores clave.</p>
          <div><span class="tech-tag">MySQL</span><span class="tech-tag">Power BI</span><span class="tech-tag">SQL Server</span></div>
        </div>

        <div class="card fade-up">
          <div class="icon-box">
            <svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
          </div>
          <h3 class="t-h3" style="margin-bottom:.4rem;">Integraciones entre Sistemas</h3>
          <p class="t-small" style="margin-bottom:1rem;">Conectamos tus herramientas con APIs, webhooks y sincronización de datos en tiempo real.</p>
          <div><span class="tech-tag">APIs REST</span><span class="tech-tag">Webhooks</span><span class="tech-tag">JSON</span></div>
        </div>

        <div class="card fade-up delay-1">
          <div class="icon-box">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          </div>
          <h3 class="t-h3" style="margin-bottom:.4rem;">Páginas Web Corporativas</h3>
          <p class="t-small" style="margin-bottom:1rem;">Sitios modernos, rápidos y optimizados para SEO que generan confianza y convierten visitas en clientes.</p>
          <div><span class="tech-tag">Tailwind</span><span class="tech-tag">HTML5</span><span class="tech-tag">SEO</span></div>
        </div>

        <div class="card fade-up delay-2">
          <div class="icon-box">
            <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <h3 class="t-h3" style="margin-bottom:.4rem;">Automatizaciones</h3>
          <p class="t-small" style="margin-bottom:1rem;">Flujos automáticos para tareas repetitivas: correos, documentos, alertas y reportes periódicos.</p>
          <div><span class="tech-tag">Power Automate</span><span class="tech-tag">Python</span><span class="tech-tag">VBA</span></div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════ PROCESO ═══════ -->
  <section class="section section--surface">
    <div class="container">
      <div class="section-header fade-up">
        <div class="rule"></div>
        <h2 class="t-h2">Cómo trabajamos</h2>
        <p>Un proceso claro y transparente, de principio a fin.</p>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1.5rem;">
        <div class="step fade-up"><div class="step-num">01</div><h4>Levantamiento</h4><p>Entendemos tu negocio y procesos actuales</p></div>
        <div class="step fade-up delay-1"><div class="step-num">02</div><h4>Propuesta</h4><p>Alcance, tiempos y costo definidos</p></div>
        <div class="step fade-up delay-2"><div class="step-num">03</div><h4>Diseño UI</h4><p>Mockups y flujo de pantallas para validar</p></div>
        <div class="step fade-up delay-3"><div class="step-num">04</div><h4>Desarrollo</h4><p>Programación con revisiones iterativas</p></div>
        <div class="step fade-up delay-4"><div class="step-num">05</div><h4>Entrega & Soporte</h4><p>Capacitación y acompañamiento post-entrega</p></div>
      </div>
    </div>
  </section>

  <!-- ═══════ CTA ═══════ -->
  <section class="section">
    <div class="container">
      <div class="cta-box fade-up">
        <div class="label" style="margin-bottom:1.5rem;">Sin costo — Sin compromiso</div>
        <h2 class="t-h2">¿Tienes un proyecto en mente?</h2>
        <p>Cuéntanos qué necesitas y preparamos una propuesta detallada sin ningún compromiso.</p>
        <a href="contacto.php" class="btn btn--primary btn--lg">
          Cuéntanos tu proyecto
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </section>

</main>

<div id="tbcs-footer"></div>
<div id="tbcs-whatsapp"></div>
<script src="js/tbcs.js"></script>
</body>
</html>

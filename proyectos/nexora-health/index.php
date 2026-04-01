  <?php
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  $requestPath = strtok($_SERVER['REQUEST_URI'] ?? '/tbcs/proyectos/nexora-health/index.php', '?');
  $currentUrl = $scheme . '://' . $host . $requestPath;
  $basePath = rtrim(str_replace('\\', '/', dirname($requestPath)), '/');
  $shareImageUrl = $scheme . '://' . $host . $basePath . '/img/dashboard-demo.jpg';
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nexora Health | ERP Medico para Consultorio | TechBridge Consulting Systems</title>
  <meta name="description" content="Nexora Health: ERP medico para consultorios con expediente digital, agenda, consulta y cobro en una sola plataforma."/>
    <link rel="canonical" href="<?php echo htmlspecialchars($currentUrl, ENT_QUOTES, 'UTF-8'); ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="es_MX"/>
    <meta property="og:site_name" content="TechBridge Consulting Systems"/>
    <meta property="og:title" content="Nexora Health | ERP medico para consultorio"/>
    <meta property="og:description" content="Gestiona consulta, expediente, agenda y cobro en una sola plataforma con Nexora Health."/>
    <meta property="og:url" content="<?php echo htmlspecialchars($currentUrl, ENT_QUOTES, 'UTF-8'); ?>"/>
    <meta property="og:image" content="<?php echo htmlspecialchars($shareImageUrl, ENT_QUOTES, 'UTF-8'); ?>"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:image:alt" content="Dashboard de Nexora Health ERP medico"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="Nexora Health | ERP medico para consultorio"/>
    <meta name="twitter:description" content="Gestiona consulta, expediente, agenda y cobro en una sola plataforma con Nexora Health."/>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($shareImageUrl, ENT_QUOTES, 'UTF-8'); ?>"/>
  <link rel="icon" type="image/png" href="../../img/favicon_tbcs_black.png?v=4"/>
  <link rel="shortcut icon" href="../../img/favicon_tbcs_black.png?v=4" type="image/png"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;900&family=Bricolage+Grotesque:wght@700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../../css/tbcs.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.383.0/umd/lucide.min.js"></script>
  <link rel="stylesheet" href="./css/nexora-health.css"/>
  </head>
  <body class="nh-page">
  <script>window.TBCS_BASE_PATH='../../'; window.TBCS_PAGE_ID='diseno-software.php';</script>
  <nav class="demo-nav" id="navbar">
    <div class="demo-nav-inner">
      <a class="logo" href="#solucion">
        <span class="logo-mark"><i data-lucide="stethoscope" style="width:18px;height:18px"></i></span>
        <span>Nexora Health</span>
      </a>
      <div class="links">
        <a href="#solucion">Solucion</a>
        <a href="#video">Video</a>
        <a href="#demo">Demo</a>
        <a href="../../diseno-software.php#portafolio">Portafolio</a>
        <a href="#demo" class="demo-nav-cta">Solicitar demo</a>
      </div>
      <button class="hamburger" type="button" onclick="toggleMenu()"><i data-lucide="menu" style="width:24px;height:24px"></i></button>
    </div>
    <div class="mobile-menu" id="mobileMenu">
      <a href="#solucion" onclick="closeMenu()">Solucion</a>
      <a href="#video" onclick="closeMenu()">Video</a>
      <a href="#demo" onclick="closeMenu()">Demo</a>
      <a href="../../diseno-software.php#portafolio" onclick="closeMenu()">Portafolio</a>
    </div>
  </nav>

  <section class="hero container" id="solucion">
    <div class="hero-stage">
      <div class="hero-main">
        <div class="hero-title-block reveal">
          <div class="hero-badge"><span class="pulse-dot"></span>ERP Medico · demo activa · alineado a criterios NOM-004</div>
          <h1>ERP Medico para consulta y expediente en una sola plataforma</h1>
        </div>

        <div class="hero-copy reveal">
          <p>Nexora Health centraliza consulta, expediente, agenda y cobro en un flujo clinico continuo para operar con mayor control y menos carga administrativa.</p>
          <div class="hero-actions">
            <a href="#demo" class="hero-btn primary">Solicita una demo <i data-lucide="arrow-right" style="width:18px;height:18px"></i></a>
            <a href="#video" class="hero-btn secondary"><i data-lucide="play-circle" class="icon-accent icon-md"></i>Ver sistema</a>
          </div>
          <div class="hero-checks">
            <span class="hero-check"><i data-lucide="check-circle-2" class="icon-accent icon-sm"></i>Sin instalacion</span>
            <span class="hero-check"><i data-lucide="check-circle-2" class="icon-accent icon-sm"></i>Soporte en espanol</span>
            <span class="hero-check"><i data-lucide="check-circle-2" class="icon-accent icon-sm"></i>Acceso multidispositivo</span>
          </div>
          <div class="hero-proof" aria-label="Credenciales del demo">
            <div class="hero-proof-item">
              <strong>24h</strong>
              <span>Respuesta inicial</span>
            </div>
            <div class="hero-proof-item">
              <strong>8 modulos</strong>
              <span>Flujo clinico completo</span>
            </div>
            <div class="hero-proof-item">
              <strong>NOM-004</strong>
              <span>Criterios documentales</span>
            </div>
          </div>
        </div>
      </div>

      <div class="hero-side">
        <div class="hero-panel card">
          <h2>Vista del sistema</h2>
          <div class="tab-wrap">
            <button class="tab-btn active" type="button" onclick="setTab(0)">Dashboard</button>
            <button class="tab-btn" type="button" onclick="setTab(1)">Pacientes</button>
            <button class="tab-btn" type="button" onclick="setTab(2)">Consulta</button>
            <button class="tab-btn" type="button" onclick="setTab(3)">Expediente</button>
          </div>
          <div class="preview preview--compact">
            <img id="preview-shot" class="preview-shot" alt="Vista del sistema"/>
            <div id="preview-visual" class="preview-visual">
              <div class="preview-pane">
                <div class="preview-caption">Vista del modulo</div>
                <div class="preview-metric">
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
              </div>
              <div class="preview-side">
                <div class="preview-line"></div>
                <div class="preview-line"></div>
                <div class="preview-line"></div>
                <div class="preview-line"></div>
              </div>
            </div>
            <strong id="carousel-title">Dashboard</strong>
            <p id="carousel-desc">Vista general del sistema y acceso rapido a los modulos principales del consultorio.</p>
            <div class="preview-hint">Haz clic en la imagen para verla mas grande.</div>
          </div>
        </div>

        <div class="hero-panel card hero-panel--video" id="video">
          <h2>Demo en video</h2>
          <div class="video-drop video-drop--compact" id="videoDrop" ondragover="dragOver(event)" ondragleave="dragLeave()" ondrop="dropFile(event)" onclick="document.getElementById('videoInput').click()">
            Arrastra un video o haz clic para seleccionar
          </div>
          <input id="videoInput" type="file" accept="video/*" style="display:none" onchange="loadVideo(event)"/>
          <div id="videoPlayer" style="display:none">
            <video id="videoEl" controls></video>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="metrics">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item reveal">
          <div class="stat-num" data-target="8">0</div>
          <div class="stat-label">Modulos principales</div>
        </div>
        <div class="stat-item reveal" style="transition-delay:.08s">
          <div class="stat-num" data-target="6">0</div>
          <div class="stat-label">Bloques del expediente</div>
        </div>
        <div class="stat-item reveal" style="transition-delay:.16s">
          <div class="stat-num" data-target="2">0</div>
          <div class="stat-label">Entornos demo</div>
        </div>
        <div class="stat-item reveal" style="transition-delay:.24s">
          <div class="stat-num" data-target="100" data-suffix="%">0%</div>
          <div class="stat-label">Enfoque documental</div>
        </div>
      </div>
    </div>
  </section>

  <section class="container">
    <div class="section-head reveal">
      <div class="section-kicker">Retos operativos</div>
      <h2>Problemas que frenan la operacion del consultorio</h2>
      <p>Cuando los procesos clinicos y administrativos estan separados, se pierde tiempo, control y continuidad en la atencion del paciente.</p>
    </div>
    <div class="problem-grid">
      <div class="problem-card reveal">
        <div class="problem-icon red"><i data-lucide="alert-circle" style="width:20px;height:20px"></i></div>
        <h3>Expedientes dispersos</h3>
        <p>Cuando la informacion se dispersa en varios canales, el seguimiento del paciente se vuelve lento y vulnerable.</p>
      </div>
      <div class="problem-card reveal" style="transition-delay:.06s">
        <div class="problem-icon red"><i data-lucide="files" style="width:20px;height:20px"></i></div>
        <h3>Procesos poco claros</h3>
        <p>Sin una vista ordenada del sistema, se dificulta explicar valor, flujo operativo y trazabilidad documental.</p>
      </div>
      <div class="problem-card reveal" style="transition-delay:.12s">
        <div class="problem-icon red"><i data-lucide="shield-alert" style="width:20px;height:20px"></i></div>
        <h3>Presentacion poco convincente</h3>
        <p>Si el producto no se comunica con claridad, cuesta convertir el interes inicial en una reunion comercial efectiva.</p>
      </div>
      <div class="problem-card reveal" style="transition-delay:.18s">
        <div class="problem-icon red"><i data-lucide="clock-3" style="width:20px;height:20px"></i></div>
        <h3>Tiempo perdido</h3>
        <p>La operacion se vuelve lenta cuando la consulta, el expediente y el cobro no siguen un mismo flujo de trabajo.</p>
      </div>
      <div class="problem-card reveal" style="transition-delay:.24s">
        <div class="problem-icon red"><i data-lucide="file-warning" style="width:20px;height:20px"></i></div>
        <h3>Control dificil de sostener</h3>
        <p>Sin trazabilidad continua, es dificil mantener orden documental y seguimiento consistente entre consultas.</p>
      </div>
      <div class="problem-card highlight reveal" style="transition-delay:.30s">
        <div class="problem-icon dark"><i data-lucide="check-circle-2" style="width:20px;height:20px"></i></div>
        <h3>Nexora Health lo integra</h3>
        <p>Reduce tiempos de captura, mejora la continuidad clinica y refuerza el control documental en cada consulta.</p>
      </div>
    </div>
  </section>

  <section class="container" id="recorrido">
    <div class="two-col">
      <div class="reveal">
        <div class="section-kicker">La solucion</div>
        <h2 style="font-size:clamp(30px,4vw,46px);line-height:1.08;margin-bottom:16px">Capacidades clave para la operacion diaria</h2>
        <p style="color:var(--muted);font-size:17px;line-height:1.72">El sistema habilita al equipo clinico y administrativo para registrar, consultar y dar seguimiento a cada caso con informacion conectada.</p>
        <div class="feature-grid">
          <div class="feature-card"><i data-lucide="users" class="icon-accent icon-sm-md"></i><span>Alta y perfil de pacientes</span></div>
          <div class="feature-card"><i data-lucide="clipboard-check" class="icon-accent icon-sm-md"></i><span>Evolucion clinica por consulta</span></div>
          <div class="feature-card"><i data-lucide="activity" class="icon-accent icon-sm-md"></i><span>Control de signos y hallazgos</span></div>
          <div class="feature-card"><i data-lucide="file-text" class="icon-accent icon-sm-md"></i><span>Indicaciones y receta digital</span></div>
          <div class="feature-card"><i data-lucide="calendar-days" class="icon-accent icon-sm-md"></i><span>Agenda y seguimiento de citas</span></div>
          <div class="feature-card"><i data-lucide="folder-open" class="icon-accent icon-sm-md"></i><span>Documentacion centralizada</span></div>
          <div class="feature-card"><i data-lucide="shield-check" class="icon-accent icon-sm-md"></i><span>Trazabilidad del caso clinico</span></div>
          <div class="feature-card"><i data-lucide="credit-card" class="icon-accent icon-sm-md"></i><span>Cobro y cierre de atencion</span></div>
        </div>
      </div>
      <div class="visual-box reveal" style="transition-delay:.12s">
        <div class="section-kicker" style="margin-bottom:10px">Recorrido del producto</div>
        <h3 style="font-size:28px;line-height:1.02;letter-spacing:-.03em;margin-bottom:10px">Explora el sistema por etapas</h3>
        <p style="color:var(--muted);font-size:16px;line-height:1.72;max-width:680px">Cada etapa del sistema conecta consulta, expediente y seguimiento para mantener continuidad clinica y control operativo en el dia a dia.</p>
        <div class="journey-grid">
          <div class="journey-nav">
            <button class="journey-step active" type="button" onclick="setJourney(0)">
              <div class="journey-step-top">
                <strong>Consulta</strong>
                <span class="journey-badge">01</span>
              </div>
              <small>Atencion clinica, captura estructurada y continuidad de consulta.</small>
            </button>
            <button class="journey-step" type="button" onclick="setJourney(1)">
              <div class="journey-step-top">
                <strong>Expediente</strong>
                <span class="journey-badge">02</span>
              </div>
              <small>Informacion del paciente organizada en una vista mas clara.</small>
            </button>
            <button class="journey-step" type="button" onclick="setJourney(2)">
              <div class="journey-step-top">
                <strong>Administracion</strong>
                <span class="journey-badge">03</span>
              </div>
              <small>Agenda, pacientes, cobro y operacion diaria en un mismo entorno.</small>
            </button>
            <button class="journey-step" type="button" onclick="setJourney(3)">
              <div class="journey-step-top">
                <strong>Seguimiento</strong>
                <span class="journey-badge">04</span>
              </div>
              <small>Revision continua, trazabilidad del caso y control del historial clinico.</small>
            </button>
          </div>
          <div class="journey-panel">
            <h3 id="journey-title">Consulta</h3>
            <p id="journey-desc">La consulta se presenta como un flujo ordenado, agil y facil de seguir durante la atencion medica.</p>
            <div class="journey-list" id="journey-list">
              <div class="journey-list-item"><span>1</span><div>Registro estructurado de la atencion clinica.</div></div>
              <div class="journey-list-item"><span>2</span><div>Espacio para signos vitales, observaciones e indicaciones.</div></div>
              <div class="journey-list-item"><span>3</span><div>Transicion natural hacia receta, cobro o seguimiento.</div></div>
            </div>
            <div class="journey-foot">
              <span class="journey-pill"><i data-lucide="shield-check" class="icon-accent icon-xs"></i>Trazabilidad del proceso</span>
              <span class="journey-pill"><i data-lucide="clock-3" class="icon-accent icon-xs"></i>Menos friccion operativa</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="nom-section">
    <div class="container">
      <div class="two-col">
        <div class="reveal">
          <div class="section-kicker">Normativa NOM</div>
          <h2 style="font-size:clamp(30px,4vw,46px);line-height:1.08;margin-bottom:16px">Disenado para reforzar orden clinico y trazabilidad</h2>
          <p style="color:#b8cadb;font-size:17px;line-height:1.72">La estructura del sistema prioriza registro ordenado, continuidad de notas y control documental para una operacion clinica mas consistente.</p>
        </div>
        <div class="nom-list reveal" style="transition-delay:.12s">
          <div class="nom-item">
            <div class="nom-icon"><i data-lucide="file-check-2" style="width:18px;height:18px"></i></div>
            <div class="nom-body">
              <h3>Identificacion y contexto del paciente</h3>
              <p>Centraliza datos clave del paciente en un expediente digital facil de consultar y actualizar.</p>
            </div>
            <div class="nom-check"><i data-lucide="check" style="width:18px;height:18px"></i></div>
          </div>
          <div class="nom-item">
            <div class="nom-icon"><i data-lucide="notebook-pen" style="width:18px;height:18px"></i></div>
            <div class="nom-body">
              <h3>Notas clinicas con mejor narrativa</h3>
              <p>Motivo de consulta, evolucion y seguimiento quedan integrados en un mismo flujo de trabajo.</p>
            </div>
            <div class="nom-check"><i data-lucide="check" style="width:18px;height:18px"></i></div>
          </div>
          <div class="nom-item">
            <div class="nom-icon"><i data-lucide="pill" style="width:18px;height:18px"></i></div>
            <div class="nom-body">
              <h3>Receta y salida del paciente</h3>
              <p>Conecta consulta, indicaciones y continuidad del tratamiento en una misma secuencia operativa.</p>
            </div>
            <div class="nom-check"><i data-lucide="check" style="width:18px;height:18px"></i></div>
          </div>
          <div class="nom-item">
            <div class="nom-icon"><i data-lucide="archive" style="width:18px;height:18px"></i></div>
            <div class="nom-body">
              <h3>Documentos y soporte digital</h3>
              <p>Concentra documentos clinicos y soporte digital para mantener control y acceso rapido al historial.</p>
            </div>
            <div class="nom-check"><i data-lucide="check" style="width:18px;height:18px"></i></div>
          </div>
        </div>
      </div>
      <p class="nom-disclaimer reveal">Nota: Nexora Health se alinea a criterios documentales de NOM-004. La validacion de cumplimiento normativo formal depende de la implementacion operativa y de la evaluacion legal de cada institucion.</p>
    </div>
  </section>

  <section class="container">
    <div class="section-head reveal">
      <div class="section-kicker">Beneficios</div>
      <h2>Beneficios directos para el consultorio</h2>
      <p>Nexora Health mejora la continuidad de atencion, reduce tiempos operativos y fortalece el control documental del equipo.</p>
    </div>
    <div class="benefits-grid">
      <div class="benefit-card reveal">
        <div class="benefit-icon"><i data-lucide="sparkles" style="width:22px;height:22px"></i></div>
        <h3>Mas control clinico</h3>
        <p>La informacion del paciente permanece conectada entre consulta, expediente y seguimiento.</p>
      </div>
      <div class="benefit-card reveal" style="transition-delay:.08s">
        <div class="benefit-icon"><i data-lucide="monitor-smartphone" style="width:22px;height:22px"></i></div>
        <h3>Operacion mas agil</h3>
        <p>Reduce tiempos administrativos con flujos mas cortos en recepcion, consulta y seguimiento.</p>
      </div>
      <div class="benefit-card reveal" style="transition-delay:.16s">
        <div class="benefit-icon"><i data-lucide="image-up" style="width:22px;height:22px"></i></div>
        <h3>Mejor trazabilidad</h3>
        <p>Facilita seguimiento de notas, documentos y eventos clinicos con historial centralizado.</p>
      </div>
    </div>
    <div class="pill-row reveal">
      <span class="pill">Gestion de pacientes</span>
      <span class="pill">Expediente digital</span>
      <span class="pill">Normativa NOM</span>
      <span class="pill">Agenda medica</span>
      <span class="pill">Control documental</span>
      <span class="pill">Trazabilidad clinica</span>
    </div>
  </section>

  <section class="container" id="demo" style="padding-bottom:42px">
    <div class="card" style="max-width:760px;margin:0 auto">
      <h2>Solicita una demo</h2>
      <label>Nombre completo</label>
      <input id="fname" type="text" placeholder="Nombre de contacto"/>
      <p id="err-name" class="form-error">Requerido</p>

      <label>Correo electronico</label>
      <input id="femail" type="email" placeholder="dr@consultorio.com"/>
      <p id="err-email" class="form-error">Email invalido</p>

      <label>Especialidad</label>
      <select id="fspecialty">
        <option value="">Selecciona una opcion...</option>
        <option>Medicina General</option>
        <option>Pediatria</option>
        <option>Ginecologia</option>
        <option>Cardiologia</option>
      </select>
      <p id="err-specialty" class="form-error">Selecciona una especialidad</p>

      <button class="primary" type="button" onclick="submitForm()">Enviar solicitud</button>
      <p class="success" id="successBox">Solicitud enviada. Te contactaremos pronto para coordinar la demo.</p>
    </div>
  </section>

  <div class="image-modal" id="imageModal" aria-hidden="true">
    <div class="image-modal-inner">
      <button type="button" aria-label="Cerrar imagen" onclick="closeImageModal()">X</button>
      <img id="imageModalImg" alt="Vista ampliada"/>
    </div>
  </div>

  <div id="tbcs-footer"></div>
  <div id="tbcs-whatsapp"></div>

  <script src="./js/nexora-health.js"></script>
  <script src="../../js/tbcs.js"></script>
  </body>
  </html>










(function () {
  function setMessage(el, msg, type) {
    if (!el) return;
    el.textContent = msg;
    el.className = 'form-message';
    if (type) el.classList.add(type);
  }

  function cssEscapeValue(value) {
    return String(value).replace(/\\/g, '\\\\').replace(/"/g, '\\"');
  }

  function applyContactPrefill(form) {
    var params = new URLSearchParams(window.location.search);
    var mappings = [
      ['form_type', 'form_type'],
      ['source_page', 'source_page'],
      ['source_campaign', 'source_campaign'],
      ['nombre', 'nombre'],
      ['email', 'email'],
      ['telefono', 'telefono'],
      ['empresa', 'empresa'],
      ['desafio', 'desafio']
    ];

    mappings.forEach(function (pair) {
      var param = params.get(pair[0]);
      var field = form.elements[pair[1]];
      if (param && field && !field.value) {
        field.value = param;
      }
    });

    var ayuda = params.get('ayuda');
    if (ayuda) {
      var ayudaField = form.querySelector('input[name="ayuda"][value="' + cssEscapeValue(ayuda) + '"]');
      if (ayudaField) ayudaField.checked = true;
    }

    var otroAyuda = params.get('otroAyuda');
    var otroCheckbox = document.getElementById('otroCheckbox');
    var otroInput = document.getElementById('otroInput');
    if (otroAyuda && otroCheckbox && otroInput) {
      otroCheckbox.checked = true;
      otroInput.disabled = false;
      if (!otroInput.value) otroInput.value = otroAyuda;
    }
  }

  function bindContactForm() {
    var form = document.getElementById('contactForm');
    if (!form) return;

    var status = document.getElementById('form-status-message');
    var otroCheckbox = document.getElementById('otroCheckbox');
    var otroInput = document.getElementById('otroInput');

    applyContactPrefill(form);

    function showError(id, msg) {
      var el = document.getElementById('error-' + id);
      if (!el) return;
      el.textContent = msg;
      el.classList.add('visible');
    }

    function hideError(id) {
      var el = document.getElementById('error-' + id);
      if (el) el.classList.remove('visible');
    }

    if (otroCheckbox && otroInput) {
      otroCheckbox.addEventListener('change', function () {
        otroInput.disabled = !otroCheckbox.checked;
        if (!otroCheckbox.checked) otroInput.value = '';
      });
    }

    form.addEventListener('submit', async function (e) {
      e.preventDefault();
      var valid = true;

      var nombre = document.getElementById('nombre');
      var email = document.getElementById('email');
      var telefono = document.getElementById('telefono');
      var desafio = document.getElementById('desafio');

      if (!nombre || !nombre.value.trim()) {
        showError('nombre', 'El nombre completo es obligatorio.'); valid = false;
      } else hideError('nombre');

      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        showError('email', 'Ingresa un correo valido.'); valid = false;
      } else hideError('email');

      if (!telefono || !/^[0-9]{10,15}$/.test(telefono.value.trim())) {
        showError('telefono', 'Ingresa teléfono de 10 a 15 dígitos.'); valid = false;
      } else hideError('telefono');

      var ayudaChecked = !!document.querySelector('input[name="ayuda"]:checked');
      if (!ayudaChecked) {
        showError('ayuda', 'Selecciona al menos una opción.'); valid = false;
      } else hideError('ayuda');

      if (!desafio || !desafio.value.trim()) {
        showError('desafio', 'Describe brevemente tu desafio.'); valid = false;
      } else hideError('desafio');

      if (!valid) {
        setMessage(status, 'Corrige los campos marcados para continuar.', 'error');
        return;
      }

      var fd = new FormData(form);
      var params = new URLSearchParams();

      fd.forEach(function (value, key) {
        if (key === 'ayuda') return;
        if (key === 'otroAyuda' && otroCheckbox && !otroCheckbox.checked) return;
        params.append(key, String(value).trim());
      });

      var selectedAyuda = Array.from(document.querySelectorAll('input[name="ayuda"]:checked')).map(function (el) {
        if (el.value === 'Otro' && otroInput && otroInput.value.trim()) {
          return 'Otro: ' + otroInput.value.trim();
        }
        return el.value;
      });
      params.append('ayuda', selectedAyuda.join(', '));

      setMessage(status, 'Enviando mensaje...');

      try {
        var res = await fetch(form.action, {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: params.toString()
        });
        var json = await res.json().catch(function () { return {}; });
        if (!res.ok || !json.ok) {
          setMessage(status, json.message || 'No fue posible enviar el formulario.', 'error');
          return;
        }
        setMessage(status, 'Recibimos tu información. Te contactaremos pronto.', 'success');
        form.reset();
        if (otroInput) otroInput.disabled = true;
        window.setTimeout(function () {
          window.location.href = 'index.php';
        }, 1800);
      } catch (err) {
        setMessage(status, 'Error de conexion. Intenta de nuevo mas tarde.', 'error');
      }
    });
  }

  function bindEnrollmentForm() {
    var form = document.getElementById('enrollmentForm');
    if (!form) return;

    var status = document.getElementById('enrollment-form-status-message');
    form.addEventListener('submit', async function (e) {
      e.preventDefault();
      if (!form.checkValidity()) {
        setMessage(status, 'Completa los campos requeridos.', 'error');
        return;
      }

      var params = new URLSearchParams();
      new FormData(form).forEach(function (v, k) {
        params.append(k, String(v).trim());
      });

      setMessage(status, 'Enviando inscripcion...');
      try {
        var res = await fetch(form.action, {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: params.toString()
        });
        var json = await res.json().catch(function () { return {}; });
        if (!res.ok || !json.ok) {
          setMessage(status, json.message || 'No se pudo registrar la inscripcion.', 'error');
          return;
        }
        setMessage(status, json.message || 'Inscripcion enviada correctamente.', 'success');
        form.reset();
      } catch (err) {
        setMessage(status, 'Error de conexion. Intenta de nuevo mas tarde.', 'error');
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    bindContactForm();
    bindEnrollmentForm();
  });
})();

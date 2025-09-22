// Scripts globales para el sitio

document.addEventListener('DOMContentLoaded', function() {
    // Forzar visibilidad del Hero y depuración de imagen de fondo
    const hero = document.querySelector('.hero-banner');
    if (hero) {
        hero.style.display = 'flex';
        hero.style.minHeight = '600px';
        // Prueba: mostrar mensaje si la imagen no carga
        const img = new Image();
        img.src = 'assets/img/banner_index.png';
        img.onload = function() {
            console.log('Imagen de fondo cargada correctamente.');
        };
        img.onerror = function() {
            console.error('No se pudo cargar la imagen de fondo: assets/img/banner_index.png');
            hero.style.background = '#0a2540';
            hero.innerHTML = '<div style="color:white;text-align:center;width:100%">No se pudo cargar el banner_index.png</div>';
        };
    }
    // ...aquí puedes agregar scripts reutilizables...
});

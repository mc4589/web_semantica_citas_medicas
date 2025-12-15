// resources/js/app.js

document.addEventListener('DOMContentLoaded', function () {
    const path = window.location.pathname;

    // Listados
    if (path === '/citas-web') cargarListado('citas', 'tabla-citas');
    if (path === '/medicos-web') cargarListado('medicos', 'tabla-medicos');
    if (path === '/pacientes-web') cargarListado('pacientes', 'tabla-pacientes');
    if (path === '/especialidades-web') cargarListado('especialidades', 'tabla-especialidades');

    // Detalles
    const matchDetalle = path.match(/^\/(citas|medicos|pacientes|especialidades)-web\/(\d+)$/);
    if (matchDetalle) {
        const recurso = matchDetalle[1];
        const id = matchDetalle[2];
        cargarDetalle(recurso, id);
    }
});

function cargarListado(recurso, tablaId) {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 1;

    fetch(`/api/v1/${recurso}?page=${page}`)
        .then(response => {
            if (!response.ok) throw new Error('Respuesta no OK');
            return response.json();
        })
        .then(data => {
            renderizarTabla(recurso, data.data, tablaId);
            renderizarPaginacion(data.pagination, recurso);
            mostrarJsonLdListado(data.data, recurso);
        })
        .catch(err => {
            console.error('Error cargando listado:', err);
            const tbody = document.querySelector(`#${tablaId} tbody`);
            if (tbody) {
                tbody.innerHTML = '<tr><td colspan="10" style="text-align:center; color:red; padding:30px;">Error al cargar datos desde la API</td></tr>';
            }
        });
}

function cargarDetalle(recursoSingular, id) {
    fetch(`/api/v1/${recursoSingular}/${id}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            return response.json();
        })
        .then(data => {
            const entidad = data.data; // Objeto directo de la entidad

            // Función robusta para obtener valor anidado
            function obtenerValor(obj, path) {
                return path.split('.').reduce((acc, key) => {
                    return acc && acc[key] !== undefined ? acc[key] : null;
                }, obj);
            }

            // Rellenar todos los campos con data-campo
            document.querySelectorAll('[data-campo]').forEach(el => {
                const valor = obtenerValor(entidad, el.dataset.campo);
                el.textContent = (valor !== null && valor !== undefined && valor !== '') ? valor : '-';
            });

            // Mostrar JSON-LD del detalle
            mostrarJsonLdDetalle(data.json_ld);
        })
        .catch(err => {
            console.error('Error cargando detalle:', err);
            document.querySelectorAll('[data-campo]').forEach(el => {
                el.textContent = 'Error al cargar';
            });
        });
}

function renderizarTabla(recurso, items, tablaId) {
    const tbody = document.querySelector(`#${tablaId} tbody`);
    if (!tbody) return;

    tbody.innerHTML = '';

    if (items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="10" style="text-align:center; padding:40px; color:#666;">No hay registros</td></tr>';
        return;
    }

    items.forEach(item => {
        let entidad;
        if (recurso === 'citas') entidad = item.cita;
        else if (recurso === 'medicos') entidad = item.medico;
        else if (recurso === 'pacientes') entidad = item.paciente;
        else if (recurso === 'especialidades') entidad = item.especialidad;

        if (!entidad) return;

        const tr = document.createElement('tr');

        if (recurso === 'citas') {
            tr.innerHTML = `
                <td>${entidad.id}</td>
                <td>${entidad.fecha} ${entidad.hora}</td>
                <td>${entidad.medico?.nombre || '—'}</td>
                <td>${entidad.paciente?.nombre || '—'}</td>
                <td><a href="/citas-web/${entidad.id}" class="action-link">Ver Detalle</a></td>
            `;
        } else if (recurso === 'medicos') {
            tr.innerHTML = `
                <td>${entidad.id}</td>
                <td>${entidad.nombre}</td>
                <td>${entidad.email}</td>
                <td>${entidad.especialidad?.nombre || 'General'}</td>
                <td><a href="/medicos-web/${entidad.id}" class="action-link">Ver Detalle</a></td>
            `;
        } else if (recurso === 'pacientes') {
            tr.innerHTML = `
                <td>${entidad.id}</td>
                <td>${entidad.nombre}</td>
                <td>${entidad.email}</td>
                <td>${entidad.telefono || '—'}</td>
                <td><a href="/pacientes-web/${entidad.id}" class="action-link">Ver Detalle</a></td>
            `;
        } else if (recurso === 'especialidades') {
            tr.innerHTML = `
                <td>${entidad.id}</td>
                <td>${entidad.nombre || '—'}</td>
                <td><a href="/especialidades-web/${entidad.id}" class="action-link">Ver Detalle</a></td>
            `;
        }

        tbody.appendChild(tr);
    });
}

function renderizarPaginacion(pagination, recurso) {
    const container = document.getElementById('paginacion-api');
    if (!container || !pagination) return;

    let html = `<strong>Página ${pagination.current_page} de ${pagination.last_page}</strong> | `;

    if (pagination.current_page > 1) {
        html += `<a href="/${recurso}-web?page=${pagination.current_page - 1}">« Anterior</a> `;
    }
    if (pagination.current_page < pagination.last_page) {
        html += `<a href="/${recurso}-web?page=${pagination.current_page + 1}">Siguiente »</a>`;
    }

    container.innerHTML = html;
}

function mostrarJsonLdListado(items, recurso) {
    const container = document.getElementById('jsonld-api-listado');
    if (!container) return;

    container.innerHTML = `<h3>JSON-LD devueltos por la API (${items.length} elementos)</h3>`;

    items.forEach(item => {
        const jsonLd = item.json_ld;
        if (jsonLd) {
            const pre = document.createElement('pre');
            pre.textContent = JSON.stringify(jsonLd, null, 2);
            container.appendChild(pre);
        }
    });
}

function mostrarJsonLdDetalle(jsonLd) {
    const container = document.getElementById('jsonld-api-detalle');
    if (!container || !jsonLd) return;

    container.innerHTML = `<h3>JSON-LD único recibido desde la API</h3>`;
    const pre = document.createElement('pre');
    pre.textContent = JSON.stringify(jsonLd, null, 2);
    container.appendChild(pre);
                                                      }

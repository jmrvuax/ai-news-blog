## Creación de una Página Web Sencilla

### Unidad didáctica 2 (HTML y CSS)

En este proyecto he trabajado para garantizar una estructura HTML correcta y semántica, así como estilos CSS coherentes y un diseño responsivo básico.

#### Estructura HTML correcta y semántica

- He utilizado un archivo `layout.php` como plantilla principal, estructurando etiquetas esenciales como `<header>`, `<main>` y `<footer>`, lo que asegura modularidad y semántica.
- Reutilizo componentes como el header y el footer mediante templates independientes.
- El contenido dinámico se gestiona desde los controllers, permitiendo que cada página renderice únicamente lo necesario, sin duplicar código HTML.

#### Aplicación de estilos CSS coherentes

- He definido un archivo CSS principal con variables globales (`:root`) para colores y estilos clave, lo que mantiene consistencia visual en toda la web.
- Los estilos están organizados por secciones con clases descriptivas como `.post-list`, `.slider`, y `.common-form`, asegurando un diseño claro y mantenible.

#### Diseño responsivo básico

- **Media queries**: He implementado media queries para adaptar el diseño a distintos tamaños de pantalla, ajustando fuentes, paddings y la disposición de los elementos.
- **Flexbox**: Uso flexbox en menús, sliders y listas, lo que permite una distribución adecuada incluso en resoluciones pequeñas.
- **Formularios**: Están diseñados para ajustarse dinámicamente gracias a `width: 100%` y `max-width`. Además, uso media queries para reducir padding y tamaños en dispositivos pequeños.
- **Tablas**: Las tablas están configuradas para transformarse en formato vertical con `td::before`, mostrando etiquetas descriptivas en pantallas pequeñas.
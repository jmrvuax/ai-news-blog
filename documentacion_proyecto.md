## Creación de una Página Web Sencilla - Blog AI News

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

### Unidad didáctica 3 (JavaScript y DOM)

En este proyecto he implementado interactividad y validaciones en el lado del cliente, así como el uso adecuado de eventos y manipulación del DOM.

#### Implementación de interactividad y validaciones en el lado del cliente

- **contact.js**:
  Este archivo valida los formularios de contacto antes de enviarlos al servidor. Verifica que los campos obligatorios estén completos, valida el formato del email utilizando una expresión regular, y muestra mensajes claros al usuario en caso de errores. 

- **login.js**:
  Realiza validaciones en el formulario de inicio de sesión, asegurando que los campos de email y contraseña estén completos y que el email tenga un formato válido. Además, gestiona la respuesta del servidor para mostrar mensajes personalizados de éxito o error, lo que añade una capa adicional de interactividad.

- **register.js**:
  Valida los datos del formulario de registro, como nombres, correos y contraseñas, para evitar que se envíen datos incompletos o incorrectos al servidor. 

#### Uso adecuado de eventos y manipulación del DOM

- **slider.js**:
  Este archivo implementa eventos de clic para los botones de navegación (previo y siguiente) del slider, permitiendo al usuario desplazarse entre diapositivas. Además, utiliza manipulación del DOM para cambiar dinámicamente la posición del slider mediante transformaciones CSS y actualiza la vista en tiempo real.

- **scripts.js**:
  Contiene la funcionalidad para gestionar diversos eventos en la interfaz, como clics en botones, cambios en inputs y otras interacciones del usuario. 

- **contact.js, login.js y register.js**:
  Todos estos archivos escuchan eventos como `submit` para prevenir comportamientos por defecto de los formularios, validar datos y manipular el DOM dinámicamente para mostrar mensajes o actualizar elementos visibles en la página.

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



### Unidad didáctica 4 (PHP y SQLite)

En este proyecto he trabajado con una base de datos SQLite, lo cual fue previamente justificado y aprobado con el profesor de la asignatura debido al alcance académico del proyecto. Decidí utilizar SQLite para simplificar la implementación, garantizando que el sitio web pueda funcionar con un solo comando. Esto facilita la evaluación y el acceso a los datos en este entorno académico. Cabe destacar que en un entorno profesional esta práctica sería distinta, pero en este caso es válida por los motivos mencionados.

#### Conexión correcta a la base de datos

- La conexión a la base de datos la implementé en el archivo `init.php` mediante la función `getDbConnection()`. Esta función retorna una instancia de SQLite3 conectada al archivo de base de datos localizado en el directorio `database`:
  ```php
  function getDbConnection() {
      return new SQLite3('/var/www/html/database/ai_news_blog.db');
  }
  ```
- De esta forma, todas las operaciones con la base de datos están centralizadas y consistentes.

#### Procesamiento seguro de formularios y almacenamiento de datos

- En los modelos (`POST`, `USER`, y `CONTACT`), procesé los datos provenientes de formularios de manera segura utilizando consultas parametrizadas (`prepare` y `bindValue`). Esto asegura que los datos del usuario se gestionen correctamente y evita inyecciones SQL.
- Además, he validado y sanitizado los datos antes de procesarlos o almacenarlos. Por ejemplo, utilizo la función `sanitize_input()` en `init.php` para proteger contra ataques XSS limpiando los datos de entrada:
  ```php
  function sanitize_input($data) {
      return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
  }
  ```

#### Implementación de medidas de seguridad básicas

- **Protección contra inyección SQL**: Todas las consultas a la base de datos usan sentencias preparadas y parámetros vinculados, lo que protege contra posibles inyecciones SQL.
- **Protección contra XSS**:
  - Implementé `htmlspecialchars()` en todas las salidas dinámicas de las vistas para proteger contra ataques XSS reflejados o almacenados.
  - Esto lo aplico en elementos como títulos, contenido, autores y fechas. Por ejemplo:
    ```php
    <h3 class="news-title"><?php echo htmlspecialchars($post['title']); ?></h3>
    ```
  - En textos más largos que requieren mantener saltos de línea, utilizo `nl2br()` junto con `htmlspecialchars()` para garantizar que el contenido sea seguro y legible:
    ```php
    <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
    ```
  - En URLs generadas dinámicamente, uso `urlencode()` en combinación con `htmlspecialchars()` para evitar que caracteres especiales comprometan la seguridad:
    ```php
    <a href="/posts/<?php echo urlencode($post['id']); ?>" aria-label="View post <?php echo htmlspecialchars($post['title']); ?>">View</a>
    ```
- **Almacenamiento seguro de contraseñas**: En el modelo `USER`, implementé el cifrado de contraseñas utilizando `password_hash()` antes de almacenarlas. Esto asegura que las contraseñas de los usuarios estén protegidas:
  ```php
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  ```

## Creación de una Página Web Sencilla - Blog AI News


## Criterios:

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


### Unidad didáctica 5 (PHP avanzado y Node.js)

En este proyecto he implementado características avanzadas de PHP utilizando Programación Orientada a Objetos (POO) para mejorar la estructura del código y garantizar su escalabilidad y mantenimiento. Aunque la implementación de Node.js no era un requisito, todas las funcionalidades requeridas se han cubierto con PHP.

#### Uso de POO en PHP para mejorar la estructura del código

- **Modelos**:
  - He utilizado POO para implementar modelos que representan las entidades principales del proyecto, como `Contact`, `Post` y `User`. Cada modelo incluye métodos específicos para interactuar con la base de datos, como crear, leer, actualizar y eliminar registros (CRUD).
  - Por ejemplo, el modelo `Post` encapsula toda la lógica relacionada con los posts, permitiendo que los controladores trabajen de manera limpia y ordenada:
    ```php
    class Post {
        public function getAllPosts() {
            $db = getDbConnection();
            $result = $db->query("SELECT * FROM posts");
            return $result->fetchArray(SQLITE3_ASSOC);
        }
    }
    ```

- **Controladores**:
  - Los controladores (`About`, `Auth`, `Contact`, `Home`, `Post`, `Register`) siguen el patrón **Model-View-Controller (MVC)**, donde cada controlador maneja la lógica de negocio y delega las interacciones con la base de datos a los modelos.
  - Por ejemplo, en el controlador `Contact`, se utilizan métodos del modelo `Contact` para procesar formularios de contacto y enviar respuestas adecuadas a las vistas.

- **Ventajas de la POO**:
  - Mejora la reutilización del código: Métodos y propiedades pueden ser reutilizados entre controladores y modelos.
  - Claridad y mantenimiento: La estructura POO permite separar claramente la lógica de negocio (modelos), las acciones (controladores) y la presentación (vistas).

#### Opcional: Implementación de funcionalidades con Node.js

- En este proyecto, no se ha requerido la implementación de funcionalidades con Node.js.


### Unidad Didáctica 6 (Diseño Responsivo y AJAX):

#### Uso de la API Fetch en el proyecto

En este proyecto, la API Fetch se utiliza para manejar la comunicación asíncrona entre el cliente y el servidor en distintos formularios, mejorando la experiencia del usuario al evitar recargas de página y proporcionando retroalimentación inmediata.

#### Formularios que utilizan la API Fetch

Los siguientes formularios implementan `fetch` para enviar datos al servidor y manejar la respuesta:

- **Registro de usuarios** (`js/register.js`)
- **Inicio de sesión** (`js/login.js`)
- **Formulario de contacto** (`js/contact.js`)

#### Funcionamiento general:
En cada caso, la lógica sigue los mismos pasos:
1. Captura el evento de envío del formulario.
2. Previene el comportamiento predeterminado del formulario para evitar la recarga de la página.
3. Envía los datos al servidor utilizando `fetch`.
4. Maneja la respuesta del servidor para mostrar mensajes de éxito o error y realizar acciones adicionales según el caso, como redirigir al usuario o restablecer el formulario.


### Técnicas avanzadas utilizadas en el CSS del proyecto

#### Uso de media queries

- Se implementan **múltiples media queries** para adaptar el diseño a diferentes tamaños de pantalla.
- Se ajustan elementos como el **menú de navegación**, el `main`, los formularios y listas (`.post-list`, `.news-list`).
- Se realizan cambios en **tipografía, padding y estructura de los contenedores** para mejorar la adaptación.


#### Uso de flexbox

- Se usa `display: flex` en varias partes del diseño para una **organización flexible**.
- Se aplica en elementos clave como la **navegación (`nav ul`), listas (`.post-list`) y paginación (`.pagination`)**.
- Se asegura **alineación y distribución de espacio eficiente** en diferentes dispositivos.


#### Uso de unidades relativas

- Se emplean **rem y %** en lugar de `px` para mejorar la escalabilidad y accesibilidad.
- **La tipografía, márgenes y paddings** están definidos con unidades flexibles.
- Facilita que el diseño sea **más adaptable** sin necesidad de ajustes manuales.


#### Implementación de box-sizing

- Se usa **`box-sizing: border-box` en todo el proyecto**, evitando problemas de cálculo de dimensiones.
- Mejora la gestión del **padding y los bordes** dentro del ancho total de los elementos.


#### Uso de transiciones y transformaciones

- Se implementan **animaciones suaves** con `transition` en elementos interactivos.
- El menú tiene **efectos de transformación (`transform: translateY`)** para mejorar la experiencia del usuario.
- Se aplican transiciones en **botones y efectos hover** para una navegación más fluida.


#### Optimización de imágenes responsivas

- Se utiliza **`max-width: 100%` y `object-fit: cover`** para garantizar que las imágenes se adapten sin deformarse.
- Se evita el uso de **dimensiones fijas**, asegurando compatibilidad con distintas resoluciones de pantalla.

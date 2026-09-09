# Agenda de Contactos en PHP

> **PHP. 04/09/26** &mdash; Metodología *Learn by doing*.  
> **Autora:** Blanca &bull; [LinkedIn](https://linkedin.com/in/blancadum)

---

## 1. Descripción del Proyecto

Aplicación web desarrollada en **PHP 8** y **HTML5 Semántico** para la gestión completa de una agenda de contactos personal, con operaciones CRUD:

1. Create: Crear contactos.
2. Read: Consultar o Buscar contactos.
3. Update: Actualizar contactos.
4. Delete: Eliminar contactos.

Como todavía no usamos bases de datos como MySQL o MariaDB, los contactos se guardan temporalmente en la variable especial **`$_SESSION`** (Superarray, para los amigos). De esta forma practicamos cómo funcionan las sesiones en PHP: 

Una sesión permite guardar información del usuario mientras navega por varias páginas. PHP utiliza normalmente una cookie llamada `PHPSESSID` para identificar la sesión. La cookie no guarda los contactos; solo contiene el identificador que permite a PHP encontrar los datos guardados en `$_SESSION`.


---

## 2. Estructura de la Aplicación

El flujo de navegación y la interacción entre páginas sigue el organigrama diseñado para la aplicación:

![Estructura de la aplicación](estructura.png)

```
agenda.html (Login)
    │
    ▼ (POST)
procesar_agenda.php ──[Credenciales Incorrectas]──► agenda.html
    │
    ▼ [Credenciales Correctas]
contactos.php (Página Principal - Listado)
    ├──► agregar.php ──► procesar_datosContacto.php ──► contactos.php
    ├──► buscar.php
    ├──► actualizar.php ──► contactos.php
    ├──► eliminar.php ──► contactos.php
    └──► logout.php ──► agenda.html
```

---

## 3. ¿Qué hace cada archivo?

A continuación se detalla la función y responsabilidad de cada uno de los ficheros del proyecto:

![Tabla de funciones](tabla-funciones-ficheros.png)

| Archivo | Tipo | Descripción |
| :--- | :---: | :--- |
| **`agenda.html`** | HTML5 | Formulario de acceso al sistema con dos campos: **Username** y **Contraseña**. Envía los datos por `POST` a `procesar_agenda.php`. |
| **`procesar_agenda.php`** | PHP | Valida las credenciales. Si son correctas, almacena los datos del usuario en `$_SESSION`, inicializa los arrays de contactos si no existen y redirige a `contactos.php`. Si son incorrectas, devuelve al usuario a `agenda.html`. |
| **`contactos.php`** | PHP | Menú y pantalla principal. Verifica la sesión activa y muestra los contactos guardados en tarjetas semánticas `<article>`. Ofrece botones directos para editar y eliminar cada contacto. |
| **`agregar.php`** | PHP | Formulario para dar de alta un nuevo contacto (recoge nombre, teléfono y correo electrónico) y enviarlo a procesar. |
| **`procesar_datosContacto.php`** | PHP | Recibe los datos del nuevo contacto por `POST`, los añade a los arrays correspondientes de la sesión y redirige inmediatamente a `contactos.php`. |
| **`buscar.php`** | PHP | Formulario y lógica de búsqueda por coincidencia exacta (`$nombreBuscado`) dentro del array de la sesión, mostrando los datos del contacto encontrado. |
| **`actualizar.php`** | PHP | Permite editar los datos de un contacto existente a partir de su índice `$id`, actualizando la sesión. |
| **`eliminar.php`** | PHP | Elimina un contacto mediante `array_splice()`, asegurando que los índices numéricos (0, 1, 2...) se reordenen sin huecos. |
| **`logout.php`** | PHP | Vía de cierre de sesión: limpia el array `$_SESSION`, destruye la sesión con `session_destroy()` y redirige a `agenda.html`. |
| **`css/estilosAgenda.css`** | CSS3 | Hoja de estilos compartida que aplica la identidad visual a cabeceras, menús (`nav`), formularios, botones y tarjetas de contacto. |

---

## 4. Almacenamiento de Datos en Sesión

Los datos de los contactos se estructuran en **tres arrays numéricos tradicionales paralelos** dentro de `$_SESSION`:

```php
$_SESSION["nombre"]   = []; // Nombres de los contactos
$_SESSION["telefono"] = []; // Teléfonos de los contactos
$_SESSION["email"]    = []; // Correos electrónicos
```

De este modo, el contacto en la posición `0` está compuesto por:
* `$_SESSION["nombre"][0]`
* `$_SESSION["telefono"][0]`
* `$_SESSION["email"][0]`

Para los datos del usuario autenticado se emplean variables de sesión dedicadas, evitando colisiones con el listado de contactos:
* `$_SESSION["nombre_usuario"]`: Nombre de usuario que aparece en la cabecera (ej: *admin*).
* `$_SESSION["usuario"]`: Nombre de usuario / username (ej: *admin*).
* `$_SESSION["rol"]`: Rol del perfil (ej: *Administrador* o *Usuario*).

### Ciclo de vida de una sesión

Una sesión pasa por varias etapas:

1. **Se inicia:** se utiliza `session_start()` al entrar en una página PHP.
2. **Se guardan datos:** se almacenan el usuario y los contactos en `$_SESSION`.
3. **Se consulta:** las diferentes páginas pueden leer esos datos mientras la sesión siga activa.
4. **Se vacía:** se pueden borrar los datos guardados en `$_SESSION`.
5. **Se destruye:** al cerrar sesión, `session_destroy()` elimina la sesión del servidor. La cookie solo sirve para identificarla y no contiene los contactos.

---

## 5. Cómo ejecutar el proyecto en local

1. Requiere instalación de **WampServer** (o XAMPP) con Apache y PHP 8+ activos (icono en verde).
2. Clona o copia la carpeta `agenda` dentro del directorio web del servidor:
   ```text
   C:\wamp2\www\proyectos\agenda\
   ```
3. Abre tu navegador web y accede a través de la URL de Apache (no uses `file:///`):
   ```text
   http://localhost/proyectos/agenda/agenda.html
   ```

4. Utiliza los datos de acceso de prueba:
   * **Username:** `admin` *(o blanca)*
   * **Contraseña:** `1234`

---

## 6. Buenas Prácticas y Estándares Aplicados

* **Control de Seguridad en cada vista:** Redirección automática al login si no existe una sesión válida iniciada (`!isset($_SESSION["usuario"])`).
* **Web Semántica:** Estructura basada en `<header>`, `<nav>`, `<main>`, `<section>`, `<article>` y `<footer>`.
* **Seguridad Básica:** Sanitización de salidas con `htmlspecialchars()` para prevenir ataques XSS.
* **Documentación PHPDoc:** Todos los archivos PHP incluyen bloques de documentación estándar con etiquetas `@author Blanca` y `@version 1.0`.
* **Reindexación de Arrays:** Uso de `array_splice()` en lugar de `unset()` simple para evitar errores de índice en bucles `for` tras una eliminación.

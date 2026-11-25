# SIGA-AE
## Sistema Integrado de Gestión Académica

**Proyecto:** SIGA-AE  
**Carrera profesional:** Desarrollo de Sistemas de Información  
**Institución:** Instituto de Educación Superior Tecnológico Público Pedro P. Díaz  
**Curso:** EFSRT IV  
**Grupo:** 1  
**Año:** 2026  
**Estado:** Proyecto en desarrollo

---

## 1. Descripción del proyecto

SIGA-AE es un sistema web desarrollado para apoyar la gestión de información académica de una institución de educación superior.

El sistema busca facilitar la administración y consulta de información relacionada con estudiantes, docentes, programas de estudio, unidades didácticas, matrículas, asistencia, evaluaciones y registros académicos.

Su desarrollo busca mejorar la organización de la información, reducir los procesos manuales y facilitar el acceso a los datos de acuerdo con los permisos asignados a cada usuario.

## 2. Objetivos

### Objetivo general

Desarrollar un sistema web que permita gestionar y organizar la información académica mediante módulos que faciliten el registro, consulta y administración de datos.

### Objetivos específicos

- Organizar la información de estudiantes y docentes.
- Gestionar programas de estudio y unidades didácticas.
- Facilitar el registro y consulta de asistencias.
- Apoyar el registro de evaluaciones y calificaciones.
- Generar información académica para su consulta.
- Controlar el acceso mediante usuarios, roles y permisos.

## 3. Tecnologías utilizadas

| Tecnología | Descripción |
|---|---|
| Laravel 12 | Framework de desarrollo web |
| PHP | Lenguaje de programación |
| MySQL | Sistema de gestión de base de datos |
| HTML5 | Estructura de las páginas |
| CSS3 | Diseño y presentación |
| JavaScript | Interactividad |
| Bootstrap 5 | Diseño de interfaces |
| Composer | Administración de dependencias |
| XAMPP | Entorno de desarrollo local |
| Visual Studio Code | Editor de código |

## 4. Requisitos del sistema

Para instalar y ejecutar el proyecto se recomienda contar con:

- Windows 10 o superior.
- PHP 8.2 o superior, compatible con las dependencias del proyecto.
- Composer.
- MySQL o MariaDB.
- XAMPP u otro entorno compatible.
- Navegador web actualizado.
- Visual Studio Code (opcional).

## 5. Instalación del proyecto

### Paso 1. Obtener el proyecto

Copiar o descargar la carpeta del proyecto Laravel en el equipo.

Abrir una terminal dentro de la carpeta principal del proyecto.

### Paso 2. Instalar dependencias

Ejecutar:

```bash
composer install
```

### Paso 3. Configurar el archivo de entorno

Copiar el archivo `.env.example` y crear una copia denominada `.env`.

Configurar los datos de conexión a la base de datos:

```env
APP_NAME="SIGA-AE"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siga_ae
DB_USERNAME=root
DB_PASSWORD=
```

Los valores anteriores corresponden a una configuración local de ejemplo. Deben ajustarse según el entorno donde se instale el sistema.

### Paso 4. Crear la base de datos

Desde phpMyAdmin, crear una base de datos con el nombre:

```text
siga_ae
```

### Paso 5. Importar la base de datos

Si se proporciona el archivo de respaldo `siga_ae.sql`:

1. Ingresar a phpMyAdmin.
2. Seleccionar la base de datos `siga_ae`.
3. Entrar en la opción Importar.
4. Seleccionar el archivo `siga_ae.sql`.
5. Ejecutar la importación.
6. Comprobar que las tablas se hayan creado correctamente.

**Importante:** si se importa el respaldo completo, no ejecutar migraciones a ciegas. Primero se debe comprobar qué tablas y estructuras contiene el respaldo para evitar conflictos.

### Paso 6. Generar la clave de aplicación

Ejecutar:

```bash
php artisan key:generate
```

### Paso 7. Limpiar las cachés

Ejecutar:

```bash
php artisan optimize:clear
```

### Paso 8. Iniciar el servidor

Ejecutar:

```bash
php artisan serve
```

Abrir el navegador e ingresar a:

```text
http://127.0.0.1:8000
```

## 6. Usuarios de prueba

Para realizar las pruebas iniciales del sistema se consideran las siguientes cuentas:

| Usuario | Contraseña inicial |

Rol	        Usuario	       Contraseña
Administrador	admin	        12345678
Coordinador	coordinador	Coord2026!
Docente	        docente	        12345678
Estudiante	estudiante	Estudiante2026!

**Importante:**

- Estas credenciales son para pruebas y demostración.
- Antes de utilizar las cuentas, verificar que las contraseñas coincidan con las registradas en la base de datos.
- Si el cambio obligatorio de contraseña en el primer ingreso está implementado y habilitado para la cuenta, el sistema solicitará actualizarla.
- Se recomienda cambiar las contraseñas antes de utilizar el sistema en un entorno real.
- No utilizar estas credenciales en un servidor público.

## 7. Gestión de usuarios, roles y permisos

SIGA-AE contempla un sistema de acceso mediante usuarios, roles y permisos.

Los roles considerados son:

| ID | Rol |
|---|---|
| 1 | Administrador |
| 2 | Coordinador del Programa de Estudios |
| 3 | Docente |
| 4 | Estudiante |

El acceso a las funciones depende de los permisos asignados a cada rol.

El sistema contempla permisos para visualizar y modificar información, de acuerdo con la matriz de autorización definida para el proyecto.

**Nota:** el administrador no debe considerarse automáticamente autorizado para todas las operaciones. Se debe respetar la matriz de permisos establecida.

## 8. Módulos del sistema

El proyecto contempla los siguientes módulos y funcionalidades:

### 8.1. Inicio de sesión
Permite el ingreso al sistema mediante las credenciales de cada usuario.

### 8.2. Panel principal
Presenta el acceso a las opciones disponibles según el rol del usuario.

### 8.3. Gestión de estudiantes
Permite administrar información de los estudiantes.

### 8.4. Gestión de docentes
Permite administrar información de los docentes.

### 8.5. Programas de estudio
Organiza la información de los programas académicos.

### 8.6. Módulos y unidades didácticas
Permite organizar los módulos formativos y las unidades didácticas correspondientes.

### 8.7. Matrículas y cargas lectivas
Contempla la organización de estudiantes matriculados y las asignaciones académicas.

### 8.8. Asistencia
Contempla el registro y consulta de asistencia de los estudiantes.

### 8.9. Evaluaciones y calificaciones
Contempla el registro y consulta de evaluaciones y notas.

### 8.10. Boleta de notas
Contempla la consulta de información de calificaciones de los estudiantes.

### 8.11. Acta consolidada
Contempla la consulta de información académica consolidada.

### 8.12. Perfil de usuario
Contempla la consulta y actualización de información personal y credenciales, según los permisos disponibles.

**Nota:** la inclusión de un módulo en esta lista describe el alcance previsto del proyecto; su funcionamiento debe comprobarse en la versión entregada.

## 9. Reglas académicas consideradas

El sistema contempla reglas académicas para organizar los registros:

- Registro de asistencia.
- Identificación de estados de asistencia.
- Registro de evaluaciones.
- Calificaciones en una escala de 0 a 20.
- Organización de criterios de evaluación.
- Porcentajes de evaluación que pueden sumar hasta el 100 %.
- Consulta de información académica según el rol del usuario.

Las reglas deben validarse con los requerimientos académicos correspondientes antes de su utilización oficial.

## 10. Estructura general del proyecto

La estructura general de Laravel contiene directorios y archivos como:

```text
SIGA_AE_Laravel12/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
│
├── artisan
├── composer.json
├── composer.lock
├── .env.example
└── README.md
```

Cada directorio cumple una función dentro de la estructura de Laravel.

## 11. Base de datos

**Nombre de la base de datos:** `siga_ae`

**Motor:** MySQL.

El proyecto utiliza una base de datos relacional para almacenar la información de usuarios, roles, permisos y registros académicos.

Se incluye el archivo de respaldo:

```text
siga_ae.sql
```

Este archivo permite recuperar la estructura y los datos que contiene el respaldo exportado desde phpMyAdmin.

## 12. Seguridad

Se consideran las siguientes recomendaciones:

- Utilizar contraseñas personales y seguras.
- Respetar los permisos asignados a cada rol.
- No compartir credenciales de acceso.
- Mantener copias de seguridad de la base de datos.
- No publicar el archivo `.env`.
- No exponer contraseñas ni datos personales.
- Cambiar las credenciales de prueba antes de una instalación real.
- Mantener actualizadas las dependencias del proyecto.

## 13. Estado del proyecto

SIGA-AE se encuentra en etapa de desarrollo y validación.

Las funcionalidades deben probarse para comprobar su correcto funcionamiento, verificar los permisos de acceso y validar la integridad de la información almacenada.

La versión entregada tiene fines académicos y de demostración, por lo que no debe considerarse automáticamente una versión de producción.

## 14. Recomendaciones para la instalación

1. Realizar una copia de seguridad antes de importar o modificar la base de datos.
2. Verificar los requisitos de PHP y Composer.
3. Configurar correctamente el archivo `.env`.
4. Comprobar que MySQL esté funcionando.
5. Importar el respaldo de la base de datos.
6. Verificar las cuentas de prueba.
7. Probar el acceso con los diferentes roles.
8. Comprobar que las funciones respeten los permisos establecidos.

## 15. Autoría y finalidad académica

**Proyecto:** SIGA-AE – Sistema Integrado de Gestión Académica.

**Carrera:** Desarrollo de Sistemas de Información.

**Institución:** Instituto de Educación Superior Tecnológico Público Pedro P. Díaz.

**Finalidad:** Proyecto académico desarrollado como parte de las actividades de EFSRT IV, correspondiente al año 2026.

---

**SIGA-AE – Sistema Integrado de Gestión Académica**  
*Organización, control y gestión de la información académica.*
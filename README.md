# SIGA-AE
## Sistema Integrado de Gestión Académica

**Tecnología:** Laravel 12, PHP y MySQL.

### 1. Descripción del proyecto

SIGA-AE es una aplicación web desarrollada para apoyar la gestión académica mediante el control de asistencia de estudiantes y el registro de evaluaciones y calificaciones.

El sistema permite organizar información académica y facilitar el seguimiento de estudiantes, docentes y actividades formativas.

### 2. Tecnologías utilizadas

- Laravel 12.
- PHP 8.2 o superior.
- MySQL o MariaDB.
- HTML, CSS y Bootstrap 5.
- JavaScript.
- Composer.

### 3. Requisitos del sistema

- Windows 10 o superior.
- XAMPP.
- PHP 8.2 o superior.
- Composer 2.
- MySQL o MariaDB.
- Navegador web actualizado.

### 4. Instalación

1. Descomprimir el proyecto dentro de la carpeta `C:\xampp\htdocs`.
2. Abrir la carpeta del proyecto en Visual Studio Code.
3. Instalar las dependencias:

   ```bash
   composer install
   ```

4. Crear una base de datos llamada `siga_ae` desde phpMyAdmin.
5. Configurar las credenciales de conexión en el archivo `.env`.
6. Generar la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

7. Ejecutar las migraciones:

   ```bash
   php artisan migrate
   ```

8. Ejecutar los datos iniciales, si corresponde:

   ```bash
   php artisan db:seed
   ```

9. Iniciar el servidor:

   ```bash
   php artisan serve
   ```

10. Abrir en el navegador:

   `http://127.0.0.1:8000`

### 5. Módulos principales

- Inicio de sesión y control de acceso.
- Panel principal.
- Gestión de estudiantes.
- Gestión de docentes.
- Programas de estudio y módulos formativos.
- Unidades didácticas e itinerarios.
- Gestión de periodos académicos.
- Asignación de carga lectiva.
- Registro y consulta de asistencia.
- Resumen de inasistencias.
- Criterios de evaluación.
- Registro de calificaciones.
- Consulta de promedios.
- Boleta de notas.
- Acta consolidada.

### 6. Reglas académicas consideradas

- Registro de asistencia mediante los estados P, T, FI y FJ.
- Calificaciones en escala de 0 a 20.
- Control de porcentajes de evaluación.
- Validación de ponderaciones antes del cierre del periodo.
- Seguimiento de inasistencias y alertas académicas.
- Acceso a las funciones según los roles y permisos establecidos.

Las reglas definitivas deben validarse con las disposiciones institucionales correspondientes.

### 7. Estado del proyecto

SIGA-AE se encuentra en etapa de desarrollo e implementación. Sus módulos y funcionalidades requieren pruebas y validación para garantizar su correcto funcionamiento.

### 8. Consideraciones finales

El sistema está orientado a mejorar la organización de la información académica, facilitar el registro de asistencias y evaluaciones y apoyar el seguimiento del rendimiento de los estudiantes.

**Proyecto académico — EFSRT IV**  
**Carrera:** Desarrollo de Sistemas de Información  
**Institución:** IESTP Pedro P. Díaz  
**Año:** 2026
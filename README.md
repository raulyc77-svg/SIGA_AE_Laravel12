# SIGA-AE · Laravel 12

Sistema Integrado Web para el Control de Asistencia y Registro de Evaluaciones Académicas.

## Relación con Sistema Radioenlace
Radioenlace se utiliza únicamente como referencia de organización técnica (separación de modelos, validaciones, servicios y vistas). SIGA-AE tiene una base de datos y reglas académicas independientes.

## Requisitos
- PHP 8.2+
- Composer 2
- MySQL 8 / MariaDB compatible
- Extensiones PHP: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, fileinfo

## Instalación Windows / XAMPP
1. Descomprimir `SIGA_AE_Laravel12.zip` dentro de `C:\xampp\htdocs`.
2. Abrir la carpeta `SIGA_AE_Laravel12` en VS Code.
3. Copiar `.env.example` como `.env`.
4. Crear en phpMyAdmin una base vacía llamada `siga_ae`.
5. Configurar usuario y contraseña MySQL en `.env`.
6. En terminal:
   ```powershell
   composer install
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   php artisan serve
   ```
7. Abrir http://127.0.0.1:8000

## Primer acceso de desarrollo
- Usuario: `admin`
- Contraseña inicial: `Cambiar123!`
- Cambiar la contraseña en el primer ingreso. Para modificar la contraseña inicial antes de sembrar, define `SIGA_ADMIN_PASSWORD` en `.env`.

## Contenido de esta base inicial
- Migración con 20 tablas derivadas del modelo E-R SIGA-AE entregado.
- Roles y permisos con códigos O11-O42, basados en el menú proporcionado.
- Inicio de sesión, cambio obligatorio de contraseña y middleware de roles.
- Panel inicial.
- Gestión inicial de estudiantes.
- Sesiones de clase, pase de lista masivo y resumen de inasistencias.
- Criterios de evaluación, matriz de notas y cálculo ponderado.
- Plantillas de boleta y acta PDF con DomPDF.

## Reglas incluidas / pendientes de validación institucional
- Asistencia: P, T, FI, FJ.
- El plan EFSRT indica alerta DPI cuando se supera el 30% de inasistencias injustificadas. La pantalla inicial alerta desde 30%; confirmar con el docente si el criterio operativo debe ser `>30%` en vez de `>=30%`.
- Notas de 0 a 20.
- Ponderaciones no deben superar 100%; antes de cerrar el periodo deben sumar 100%.
- El redondeo oficial del promedio final debe confirmarse con la normativa y el docente; esta base calcula el promedio ponderado sin aplicar redondeo final especial.

## Estado
Es una base de desarrollo inicial, no una versión validada para producción. Se requiere completar y probar CRUD de todos los catálogos, asignación docente-estudiante, importación masiva de matrícula, autorización granular por permiso, justificaciones con carga de archivos, reglas de cierre de periodo, auditoría y pruebas automatizadas. Ejecutar pruebas con datos ficticios antes de usar datos personales reales.

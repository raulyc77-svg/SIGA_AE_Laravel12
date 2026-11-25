# Matriz inicial de pruebas

| ID | Módulo | Prueba | Resultado esperado |
|---|---|---|---|
| AUT-01 | Login | Credenciales válidas | Acceso y sesión regenerada |
| AUT-02 | Login | Credenciales inválidas | Mensaje sin revelar qué dato falló |
| RBAC-01 | Permisos | Docente intenta administrar periodos | HTTP 403 |
| MAT-01 | Matrícula | Repetir estudiante en misma carga | Rechazo por restricción única |
| ASI-01 | Asistencia | Crear sesión para carga activa | Se genera una fila por matrícula activa |
| ASI-02 | Asistencia | Guardar P/T/FI/FJ | Se conservan estados válidos |
| ASI-03 | DPI | Superar 30% FI | Mostrar alerta según regla institucional confirmada |
| EVA-01 | Notas | Registrar nota 0 | Aceptada |
| EVA-02 | Notas | Registrar nota 20 | Aceptada |
| EVA-03 | Notas | Registrar nota 20.1 | Rechazada |
| EVA-04 | Ponderación | Suma superior a 100% | Rechazada |
| REP-01 | Reportes | Generar boleta | PDF descargable |
| REP-02 | Reportes | Generar acta | PDF consolidado |

Antes de producción añadir pruebas automatizadas, autorización por propiedad de registros, CSRF, XSS, auditoría y pruebas de concurrencia.

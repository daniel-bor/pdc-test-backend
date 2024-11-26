# RRHH Backend

Este proyecto es un sistema backend desarrollado con Laravel 11 para gestionar la información de los colaboradores de diferentes empresas ubicadas en distintos países. El sistema incluye autenticación mediante JSON Web Tokens (JWT) y ofrece funcionalidades CRUD para la gestión de empresas, colaboradores y la geografía asociada (países, departamentos y municipios).

## Características

- Autenticación segura basada en JWT.
- Gestión de empresas con información detallada:
  - NIT, razón social, nombre comercial, teléfono, correo electrónico y ubicación geográfica.
- Gestión de colaboradores:
  - Información personal, empresa asociada y capacidad para pertenecer a múltiples empresas.
- Gestión de datos geográficos:
  - Países, departamentos y municipios interrelacionados.
- Estructura de base de datos escalable y modular.


## Endpoints principales
### Autenticación
- POST /api/auth/login: Inicia sesión y genera un token JWT.
- POST /api/auth/register: Registra un nuevo usuario (administrador).
- POST /api/auth/logout: Cierra sesión y revoca el token.
### Empresas
- GET /api/empresas: Lista todas las empresas.
- POST /api/empresas: Crea una nueva empresa.
- GET /api/empresas/{id}: Muestra detalles de una empresa específica.
- PUT /api/empresas/{id}: Actualiza una empresa.
- DELETE /api/empresas/{id}: Elimina una empresa.
### Colaboradores
- GET /api/colaboradores: Lista todos los colaboradores.
- POST /api/colaboradores: Crea un nuevo colaborador.
- GET /api/colaboradores/{id}: Muestra detalles de un colaborador.
- PUT /api/colaboradores/{id}: Actualiza un colaborador.
- DELETE /api/colaboradores/{id}: Elimina un colaborador.
### Geografía
- GET /api/paises: Lista todos los países.
- GET /api/departamentos: Lista todos los departamentos.
- GET /api/municipios: Lista todos los municipios.

---

### Estructura del Proyecto
- Models: Representan las entidades del sistema (Empresa, Colaborador, Pais, Departamento, Municipio).
- Controllers: Gestionan la lógica de las solicitudes y las respuestas de los endpoints.
- Migrations: Definen la estructura de la base de datos y las relaciones entre las tablas.
- Middlewares: Manejan la autenticación y el acceso a recursos protegidos.
- Routes: Define las rutas del sistema, organizadas por funcionalidad.

---

### Requisitos previos de Instalacion

- PHP >= 8.1
- Composer
- Servidor web (Apache, Nginx o Laravel Sail)
- Base de datos MySQL, PostgreSQL u otra compatible con Laravel
---

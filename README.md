# API de Productos

Esta es una API RESTful básica para la gestión de productos. Permite realizar operaciones CRUD utilizando métodos HTTP estándar. Está desarrollada en PHP y desplegada en Render.

---

## **Características**

- Implementación de operaciones básicas CRUD:
  - **C**rear productos.
  - **R**ecuperar productos.
  - **U**pdate (actualizar) productos.
  - **D**elete (eliminar) productos.
- Basada en PHP con una estructura modular.
- Utiliza MySQL como base de datos.

---

## **Requisitos previos**

Antes de usar esta API, asegúrate de tener lo siguiente configurado:

1. Una base de datos MySQL con las siguientes credenciales (configurables en el archivo `.env`):
   - **DB_HOST**: Dirección del servidor.
   - **DB_NAME**: Nombre de la base de datos.
   - **DB_USER**: Usuario de la base de datos.
   - **DB_PASSWORD**: Contraseña del usuario.

2. Variables de entorno configuradas en Render o en tu entorno local:
   ```plaintext
   DB_HOST=<tu_host>
   DB_NAME=<tu_base_de_datos>
   DB_USER=<tu_usuario>
   DB_PASSWORD=<tu_contraseña>

Proyecto de API para Gestión de Nombres con Docker
Este proyecto es una API desarrollada en PHP que gestiona una lista de nombres almacenados en una base de datos MySQL. 
El frontend interactúa con la API mediante peticiones HTTP, y todo el sistema está configurado con Docker para facilitar el despliegue.

Estructura del Proyecto
docker/
│
├── front/                   # Frontend con HTML y JavaScript
│   ├── Dockerfile           # Dockerfile para el frontend
│   ├── index.php            # Página de inicio con botones para agregar y mostrar nombres
│   └── nombres.js           # Código JS para consumir la API
│
├── back/                    # Backend PHP
│   ├── Dockerfile           # Dockerfile para el backend
│   └── ApiNombre.php        # API PHP para gestionar nombres
│
├── db/                      # Base de datos MySQL
│   ├── init.sql             # Script SQL para inicializar la base de datos
│   └── Dockerfile           # Dockerfile para MySQL
├── docker-compose.yml       # Configuración de Docker Compose
└── README.md                # Documentación del proyecto

Requisitos:
    Docker y Docker Compose instalado.

Instalación y Ejecución:
    Ejecuta el siguiente comando en la raíz del proyecto:
    docker-compose up -d
    Esto levantará los siguientes servicios:

    Frontend: Accesible en http://localhost:8080 donde puedes ver y agregar nombres.
    Backend (API en PHP): En http://localhost:8000, maneja las solicitudes de la API.
    Base de datos (MySQL): Funciona en el puerto 3306, almacena los nombres.

    Para detener los contenedores:
    docker-compose down

Funcionalidades de la API:
    Agregar un nombre (POST):
    URL: /ApiNombre.php
    Método: POST
    Cuerpo: { "nombre": "Nombre" }

    Listar nombres (GET):
    URL: /ApiNombre.php
    Método: GET
    Respuesta: {"success": true, "data": ["Nombre1", "Nombre2", ...]}

Estructura del Docker Compose:
    front: Servidor del frontend expuesto en el puerto 8080.
    back: API PHP expuesta en el puerto 8000 y depende de la base de datos.
    db: Contenedor MySQL, inicializado con el archivo init.sql, mapeado en el puerto 3306.
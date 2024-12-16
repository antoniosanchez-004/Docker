window.addEventListener("load", function() {
    btn_guardar = document.getElementById("guardar");
    btn_todos = document.getElementById("todos");

    // Manejo del botón "guardar"
    btn_guardar.addEventListener("click", function(ev) {
        ev.preventDefault();

        nombre = document.getElementsByName("nombre")[0].value;
        formulario = document.getElementById("form");
        console.log(nombre);

        if (!validarNombre(formulario)) {
            console.log("Nombre no válido. Revisa los datos.");
            return;
        }

        // Enviar la solicitud POST con JSON
        var peticion = new Request("http://localhost:8000/ApiNombre.php", {
            method: "POST",
            body: JSON.stringify({ nombre: nombre }),  // Enviar el nombre como JSON
            headers: {
                "Content-Type": "application/json"  // Asegurarse de que sea JSON
            }
        });

        fetch(peticion)
        .then(respuesta => respuesta.json())  // Parsear la respuesta como JSON
        .then(data => {
            console.log(data);  // Mostrar los datos JSON
            if (data.success === true && data.data) {
                alert("Nombre añadido correctamente");

                // Si la adición fue exitosa, añadir el nuevo nombre directamente a la lista
                agregarNombreALaLista(data.data.nombre);

            } else {
                console.error("No se pudo añadir el nombre:", data.message);
            }
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
        });
    });

    // Manejo del botón "todos" para mostrar los nombres
    btn_todos.addEventListener("click", async function(ev) {
        ev.preventDefault();
        try {
            const nombres = await cargarNombres();  // Espera a que la promesa se resuelva
            console.log(nombres);  // Aquí puedes usar los datos
            console.log(nombres.data);

            // Seleccionar el div donde mostrar los nombres
            lista = document.getElementById("lista");

            // Limpiar la lista antes de agregar los nuevos nombres
            lista.innerHTML = '';

            // Verificar si hay nombres
            if (nombres && nombres.success && nombres.data && nombres.data.length > 0) {
                // Iterar sobre cada nombre y agregarlo al div
                nombres.data.forEach(function(nombre) {
                    const divNombre = document.createElement("div");  // Crear un div para cada nombre
                    divNombre.classList.add("nombre");  // Clase opcional para estilo

                    // Agregar el nombre como texto
                    divNombre.textContent = nombre;

                    // Agregar el div al contenedor lista
                    lista.appendChild(divNombre);
                });
            } else {
                // Si no hay nombres, mostrar un mensaje
                lista.innerHTML = "<p>No se encontraron nombres.</p>";
            }

        } catch (error) {
            console.error("Error al cargar los nombres:", error);
        }
    });

    // Función para cargar todos los nombres desde la API
    async function cargarNombres() {
        try {
            const response = await fetch("http://localhost:8000/ApiNombre.php");
            const nombres = await response.json();
            return nombres;
        } catch (error) {
            console.error("Error al cargar los nombres:", error);
        }
    }

    // Función para agregar un nombre a la lista directamente en el frontend
    function agregarNombreALaLista(nombre) {
        // Seleccionar el div donde mostrar los nombres
        lista = document.getElementById("lista");

        // Crear un nuevo div para el nombre recién añadido
        const divNombre = document.createElement("div");
        divNombre.classList.add("nombre");

        // Agregar el nombre como texto
        divNombre.textContent = nombre;

        // Agregar el div al contenedor lista
        lista.appendChild(divNombre);
    }

    // Función para validar el nombre antes de enviarlo
    function validarNombre(formulario) {
        const input = formulario.getElementsByTagName("input")[0];
        const form_group = formulario.getElementsByClassName("form-group")[0];

        const formData = new FormData(formulario);
        const nombre = formData.get("nombre");

        let esValido = true;

        if (nombre.length < 1) {
            const pToRemove = form_group.querySelector(".error-message");
            if (pToRemove) {
                form_group.removeChild(pToRemove);
            }

            input.style.borderColor = "red";
            const p = document.createElement("p");
            p.innerHTML = "El nombre no puede estar vacío";
            p.style.color = "red";
            p.classList.add("error-message");
            form_group.appendChild(p);

            esValido = false;
        } else {
            const pToRemove = form_group.querySelector(".error-message");
            if (pToRemove) {
                form_group.removeChild(pToRemove);
            }

            input.style.borderColor = "green";
        }

        return esValido;
    }
});

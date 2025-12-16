        
        // acer con botones para canviar la "pagina" 
        // quando entras en el panel de administracion se carga todo solo que no se be lo que no esta "abierto" 
        // en css aremos una clase llamado active-section con display: block i lo que no se muestra poner display none con clase (ej .content-section)
        // podemos poner un attributo "inventado" par conseguir algo parecido a la id siu usar id en egemplo data-target

        // per aixo farem addeventlistener click cojiendo los botones por classe o id
        // acer lo del escrit en document js
    


        const botonesMenu = document.querySelectorAll(".menu-btn");
        const secciones = document.querySelectorAll(".content-section");

        document.addEventListener("DOMContentLoaded", () => {
            setActiveSection("Usuaris");
            cargarUsuaris();
        });

        botonesMenu.forEach(boton => {
            boton.addEventListener("click", () => {
                const target = boton.getAttribute("data-target");
                setActiveSection(target);
            });
        });

        function setActiveSection(target) {
            secciones.forEach(seccion => seccion.classList.remove("active-section"));
            document.getElementById(target).classList.add("active-section");

            if (target === "Usuaris") {
                cargarUsuaris();
            }
        }

        function cargarUsuaris() {
            fetch("api.php?controller=Api&action=getUsers")
                .then(result => result.json())
                .then(data => {
                    const taula = document.getElementById("taula_usuaris");
                    const trs = document.querySelectorAll("#taula_usuaris tr:not(:first-child)");
                    trs.forEach(tr => tr.remove());

                    data.usuarios.forEach(user => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.nomUsuari}</td>
                            <td>${user.contrasenya}</td>
                            <td>${user.nom}</td>
                            <td>${user.cognoms}</td>
                            <td>${user.correu}</td>
                            <td>${user.rol}</td>
                            <td>${user.telefon}</td>
                            <td><button class="editar" data-id="${user.id}">Editar</button></td>
                            <td><button class="eliminar" data-id="${user.id}">Eliminar</button></td>
                        `;
                        taula.appendChild(row);
                    });

                    document.querySelectorAll(".editar").forEach(btn =>
                        btn.addEventListener("click", () => editarUsuari(btn.dataset.id))
                    );

                    document.querySelectorAll(".eliminar").forEach(btn =>
                        btn.addEventListener("click", () => eliminarUsuari(btn.dataset.id))
                    );
                })
                .catch(err => console.error("Error carregant usuaris: ", err));
        }

        document.getElementById("btn_afegirUsuari").addEventListener("click", () => {
            limpiarFormUsuari();
            mostrarFormulario();
        });

        document.getElementById("btnGuardarUsuari").addEventListener("click", guardarUsuari);
        document.getElementById("btnCancelarUsuari").addEventListener("click", ocultarFormulario);

        function mostrarFormulario() {
            document.getElementById("formUsuari").style.display = "block";
        }

        function ocultarFormulario() {
            document.getElementById("formUsuari").style.display = "none";
        }

        function limpiarFormUsuari() {
            document.getElementById("formulariUsuariID").value = "";
            document.getElementById("formulariUsuariNomUsuari").value = "";
            document.getElementById("formulariUsuariContrasenya").value = "";
            document.getElementById("formulariUsuariNom").value = "";
            document.getElementById("formulariUsuariCognom").value = "";
            document.getElementById("formulariUsuariCorreu").value = "";
            document.getElementById("formulariUsuariRol").value = "";
            document.getElementById("formulariUsuariTelefon").value = "";
        }

        function guardarUsuari() {
            const id = document.getElementById("formulariUsuariID").value;

            const data = {
                id,
                nomUsuari: document.getElementById("formulariUsuariNomUsuari").value,
                contrasenya: document.getElementById("formulariUsuariContrasenya").value,
                nom: document.getElementById("formulariUsuariNom").value,
                cognoms: document.getElementById("formulariUsuariCognom").value,
                correu: document.getElementById("formulariUsuariCorreu").value,
                rol: document.getElementById("formulariUsuariRol").value,
                telefon: document.getElementById("formulariUsuariTelefon").value
            };

            let action;

            if (id) {
                action = "updateUser";
            } else {
                action = "addUser";
            }

            fetch(`api.php?controller=Api&action=${action}`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(r => {
                    if (r.success) {
                        ocultarFormulario();
                        cargarUsuaris();
                    } else {
                        alert("Error: " + r.message);
                    }
                });
        }

        function editarUsuari(id) {
            fetch(`api.php?controller=Api&action=getUserById&id=${id}`)
                .then(res => res.json())
                .then(data => {
                    const user = data.usuario;

                    document.getElementById("formulariUsuariID").value = user.id;
                    document.getElementById("formulariUsuariNomUsuari").value = user.nomUsuari;
                    document.getElementById("formulariUsuariContrasenya").value = user.contrasenya;
                    document.getElementById("formulariUsuariNom").value = user.nom;
                    document.getElementById("formulariUsuariCognom").value = user.cognoms;
                    document.getElementById("formulariUsuariCorreu").value = user.correu;
                    document.getElementById("formulariUsuariRol").value = user.rol;
                    document.getElementById("formulariUsuariTelefon").value = user.telefon;

                    mostrarFormulario();
                });
        }

        function eliminarUsuari(id) {
            // if (!alert("Vols eliminar aquest usuari?")) return; //TODO no funciona prova a canviar-ho o treure

            fetch(`api.php?controller=Api&action=deleteUser`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id })
            })
                .then(res => res.json())
                .then(r => {
                    if (r.success) cargarUsuaris();
                    else alert("Error: " + r.message);
                });
        }

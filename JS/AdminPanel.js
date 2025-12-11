        
        // acer con botones para canviar la "pagina" 
        // quando entras en el panel de administracion se carga todo solo que no se be lo que no esta "abierto" 
        // en css aremos una clase llamado active-section con display: block i lo que no se muestra poner display none con clase (ej .content-section)
        // podemos poner un attributo "inventado" par conseguir algo parecido a la id siu usar id en egemplo data-target

        // per aixo farem addeventlistener click cojiendo los botones por classe o id
        // acer lo del escrit en document js
    


        //obtener botones
        const botonesMenu = document.querySelectorAll(".menu-btn");
        //obtener secciones
        const secciones = document.querySelectorAll(".content-section")

        botonesMenu.forEach(boton => {
            boton.addEventListener("click", () => {
                const target = boton.getAttribute("data-target");
                setActiveSection(target);
            })
        });

        function setActiveSection(target){
            secciones.forEach((seccion)=> {
                //eliminar la classe active-session
                seccion.classList.remove("active-section");
                console.log("removing active section");
            });

            document.getElementById(target).classList.add("active-section");
            console.log("Adding active-section " + target);
            if(target == "Usuaris"){
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
                        <td><button class="editar">Editar</button></td>
                        <td><button class="eliminar">Eliminar</button></td>
                    `;
                    taula.appendChild(row);
                });
            })
            .catch(err => console.error("Error no esem cargant usuaris: ", err));
        }
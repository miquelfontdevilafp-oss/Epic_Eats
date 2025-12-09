        
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
                console.log("u clicked");
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
        }
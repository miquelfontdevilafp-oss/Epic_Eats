<section>
    <section class="container-fluid row justify-content-md-center">
    <div class="col-2" id="nav-bar">
        <div class="row">
            <button class="menu-btn" data-target="Usuaris">Usuaris</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Reserva">Reserva</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Comanda">Comanda</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="LineaComandes">LineaComandes</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Productes">Productes</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Ingredients">Ingredients</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Categoria">Categoria</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Ofertes">Ofertes</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Proveidor">Proveidor</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="LineaComandes_Ingredients">LineaComandes_Ingredients</button></div>
        <div class="row">
            <button class="menu-btn" data-target="Producte_Ingredients">Producte_Ingredients</button>
        </div>
        <div class="row">
            <button class="menu-btn" data-target="Ingredients_Proveidor">Ingredients_Proveidor</button>
        </div>        
    </div>
    <div id="panel" class="col-9">
        <section id="Usuaris" class="content-section active-section">
            <h2>Usuaris</h2>
            <button id="Afegir Usuari" class="Afegir">Afegir Usuari</button>
            <table id="taula_usuaris">
                <tr>
                    <td>ID</td>
                    <td>NomUsuari</td>
                    <td>Contrasenya</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </table>
            <form action="" method="get">
                <p>ID</p>
                <p><u>id usuari</u></p>
                <p>Nom Usuari</p>
                <input type="text" name="nomUsuari" id="nomUsuari">
                <p>Contrasenya</p>
                <input type="text" name="contrasenya" id="contrasenya">
                <p>Nom</p>
                <input type="text" name="nom" id="nom">
                <p>Cognom</p>
                <input type="text" name="cognom" id="cognom">
                <p>Correu</p>
                <input type="text" name="correu" id="correu">
                <p>Rol</p>
                <input type="text" name="rol" id="rol">
                <p>Telefon</p>
                <input type="text" name="telefon" id="telefon"><br><br>
                <input type="button" value="Send">
            </form>
        </section>
        <section id="Reserva" class="content-section">
            <h2>Reserva</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Comanda" class="content-section">
            <h2>Comanda</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="LineaComandes" class="content-section">
            <h2>LineaComandes</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Productes" class="content-section">
            <h2>Productes</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Ingredients" class="content-section">
            <h2>Ingredients</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Categoria" class="content-section">
            <h2>Categoria</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Ofertes" class="content-section">
            <h2>Ofertes</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Proveidor" class="content-section">
            <h2>Proveidor</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="LineaComandes_Ingredients" class="content-section">
            <h2>LineaComandes_Ingredients</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Producte_Ingredients" class="content-section">
            <h2>Producte_Ingredients</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
        <section id="Ingredients_Proveidor" class="content-section">
            <h2>Ingredients_Proveidor</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>NombreUsuari</td>
                    <td>Contra</td>
                    <td>Nom</td>
                    <td>Cognom</td>
                    <td>Correu</td>
                    <td>Rol</td>
                    <td>Telefon</td>
                </tr>
            </table>
        </section>
    </div>
</section>

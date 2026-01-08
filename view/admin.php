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
        </div>
        <div id="panel" class="col-9">
            <section id="Usuaris" class="content-section active-section">
                <h2>Usuaris</h2>
                <button id="btn_afegirUsuari" class="afegir usuari">Afegir Usuari</button>
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

                <!-- formulari afegir i editar usuari -->
                <form id="formUsuari" class="afegirUsuariFormulari">
                    <input type="hidden" id="formulariUsuariID">
                    <p>Nom Usuari</p>
                    <input type="text" id="formulariUsuariNomUsuari">
                    <p>Contrasenya</p>
                    <input type="text" id="formulariUsuariContrasenya">
                    <p>Nom</p>
                    <input type="text" id="formulariUsuariNom">
                    <p>Cognom</p>
                    <input type="text" id="formulariUsuariCognom">
                    <p>Correu</p>
                    <input type="email" id="formulariUsuariCorreu">
                    <p>Rol</p>
                    <input type="text" id="formulariUsuariRol">
                    <p>Telefon</p>
                    <input type="text" id="formulariUsuariTelefon"><br><br>
                    <button type="button" id="btnGuardarUsuari">Guardar</button>
                    <button type="button" id="btnCancelarUsuari">Cancelar</button>

                </form>




            </section>
            <section id="Reserva" class="content-section">
                <h2>Reserva</h2>

                <table id="taula_reserves">
                    <tr>
                        <td>ID</td>
                        <td>Data</td>
                        <td>Hora</td>
                        <td>Numero persones</td>
                        <td>ID Usuari</td>
                        <td>Editar</td>
                    </tr>
                </table>

                <form id="formReserva" class="afegirUsuariFormulari" style="display:none;">
                    <input type="hidden" id="formulariReservaID">

                    <p>Data</p>
                    <input type="date" id="formulariReservaData">

                    <p>Hora</p>
                    <input type="time" id="formulariReservaHora">

                    <br><br>
                    <button type="button" id="btnGuardarReserva">Guardar</button>
                    <button type="button" id="btnCancelarReserva">Cancelar</button>
                </form>
            </section>

            <section id="Comanda" class="content-section">
                <h2>Comandes</h2>

                <button type="button" id="btn_afegirComanda">Afegir comanda</button>

                <table id="taula_comandes">
                    <tr>
                        <td>ID</td>
                        <td>Preu total</td>
                        <td>ID Usuari</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                    </tr>
                </table>

                <form id="formComanda" class="afegirUsuariFormulari" style="display:none;">
                    <input type="hidden" id="formulariComandaID">

                    <p>Preu total</p>
                    <input type="number" step="0.01" id="formulariComandaPreuTotal">

                    <p>ID Usuari</p>
                    <select id="formulariComandaIdUsuari"></select>

                    <br><br>
                    <button type="button" id="btnGuardarComanda">Guardar</button>
                    <button type="button" id="btnCancelarComanda">Cancelar</button>
                </form>
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
                <button type="button" id="btn_afegirProducte">Afegir producte</button>

                <table id="taula_productes">
                    <tr>
                        <td>ID</td>
                        <td>Nom</td>
                        <td>Preu</td>
                        <td>En carta</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                    </tr>
                </table>

                <form id="formProducte" class="afegirUsuariFormulari" style="display:none;">
                    <input type="hidden" id="formulariProducteID">

                    <p>Nom</p>
                    <input type="text" id="formulariProducteNom">

                    <p>Preu</p>
                    <input type="number" step="0.01" id="formulariProductePreu">

                    <br><br>
                    <button type="button" id="btnGuardarProducte">Guardar</button>
                    <button type="button" id="btnCancelarProducte">Cancelar</button>
                </form>
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
        </div>
    </section>
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

                <div id="usuarisFilters" style="margin:10px 0 14px 0; display:flex; gap:10px; flex-wrap:wrap; align-items:end;">
                    <div>
                        <label for="filterUsuariText"><strong>Filtre:</strong></label><br>
                        <input id="filterUsuariText" type="text" placeholder="Cerca per ID, nom, correu, rol..." style="min-width:260px;">
                    </div>
                    <div>
                        <label for="sortUsuariField"><strong>Ordenar per:</strong></label><br>
                        <select id="sortUsuariField">
                            <option value="id">ID</option>
                            <option value="nomUsuari">NomUsuari</option>
                            <option value="nom">Nom</option>
                            <option value="cognoms">Cognom</option>
                            <option value="correu">Correu</option>
                            <option value="rol">Rol</option>
                            <option value="telefon">Telefon</option>
                        </select>
                    </div>
                    <div>
                        <label for="sortUsuariDir"><strong>Direcció:</strong></label><br>
                        <select id="sortUsuariDir">
                            <option value="asc">Ascendent</option>
                            <option value="desc">Descendent</option>
                        </select>
                    </div>
                    <div>
                        <button type="button" id="btnClearUsuariFilters">Netejar</button>
                    </div>
                </div>
                <button id="btn_afegirUsuari" class="afegir usuari">Afegir Usuari</button>
                <table id="taula_usuaris">
                    <tr>
                        <td>ID</td>
                        <td>NomUsuari</td>
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

                <div style="margin: 8px 0 14px 0;">
                    <label for="adminComandaCurrency"><strong>Moneda:</strong></label>
                    <select id="adminComandaCurrency">
                        <option value="EUR">EUR (€)</option>
                        <option value="USD">USD ($)</option>
                    </select>
                    <small style="margin-left:8px; opacity:0.8;">Els valors es guarden en EUR; això només canvia la visualització.</small>
                </div>


                
                <div id="comandesFilters" style="margin:10px 0 14px 0; display:flex; gap:10px; flex-wrap:wrap; align-items:end;">
                    <div>
                        <label for="filterComandaId"><strong>Pedido ID:</strong></label><br>
                        <input id="filterComandaId" type="number" min="1" placeholder="Ex: 12" style="width:120px;">
                    </div>
                    <div>
                        <label for="filterComandaUsuari"><strong>Usuari ID:</strong></label><br>
                        <input id="filterComandaUsuari" type="number" min="1" placeholder="Ex: 3" style="width:120px;">
                    </div>
                    <div>
                        <label for="filterComandaDateFrom"><strong>Data (des de):</strong></label><br>
                        <input id="filterComandaDateFrom" type="date">
                    </div>
                    <div>
                        <label for="filterComandaDateTo"><strong>Data (fins a):</strong></label><br>
                        <input id="filterComandaDateTo" type="date">
                    </div>
                    <div>
                        <label for="filterComandaPriceMin"><strong>Preu mín (EUR):</strong></label><br>
                        <input id="filterComandaPriceMin" type="number" step="0.01" placeholder="0.00" style="width:140px;">
                    </div>
                    <div>
                        <label for="filterComandaPriceMax"><strong>Preu màx (EUR):</strong></label><br>
                        <input id="filterComandaPriceMax" type="number" step="0.01" placeholder="99.99" style="width:140px;">
                    </div>
                    <div>
                        <label for="sortComandaField"><strong>Ordenar per:</strong></label><br>
                        <select id="sortComandaField">
                            <option value="id">ID</option>
                            <option value="preu_total">Preu</option>
                            <option value="id_usuaris">Usuari ID</option>
                            <option value="data_comanda">Data</option>
                        </select>
                    </div>
                    <div>
                        <label for="sortComandaDir"><strong>Direcció:</strong></label><br>
                        <select id="sortComandaDir">
                            <option value="desc">Descendent</option>
                            <option value="asc">Ascendent</option>
                        </select>
                    </div>
                    <div>
                        <button type="button" id="btnClearComandaFilters">Netejar</button>
                    </div>
                </div>

                <button type="button" id="btn_afegirComanda">Afegir comanda</button>

                <table id="taula_comandes">
                    <tr>
                        <td>ID</td>
                        <td>Preu total</td>
                        <td>ID Usuari</td>
                        <td>Data</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                    </tr>
                </table>

                <form id="formComanda" class="afegirUsuariFormulari" style="display:none;">
                    <input type="hidden" id="formulariComandaID">

                    <p>Preu total <small style="opacity:0.8;">(valors en EUR)</small></p>
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
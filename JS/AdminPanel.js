
// acer con botones para canviar la "pagina" 
// quando entras en el panel de administracion se carga todo solo que no se be lo que no esta "abierto" 
// en css aremos una clase llamado active-section con display: block i lo que no se muestra poner display none con clase (ej .content-section)
// podemos poner un attributo "inventado" par conseguir algo parecido a la id siu usar id en egemplo data-target

// per aixo farem addeventlistener click cojiendo los botones por classe o id
// acer lo del escrit en document js



const botonesMenu = document.querySelectorAll(".menu-btn");
const secciones = document.querySelectorAll(".content-section");


// -------------------------
// Admin: dataset cache (filters/sort)
// -------------------------
let ADMIN_USERS_ALL = [];
let ADMIN_COMANDES_ALL = [];
let ADMIN_PRODUCTES_ALL = [];
document.addEventListener("DOMContentLoaded", () => {
  setActiveSection("Usuaris");
  cargarUsuaris();
  initUsuariFiltersUI();
  initProducteFiltersUI();

  // Inicialitza listeners del CRUD de Comandes (evita duplicar DOMContentLoaded)
  initComandes();
});


// -------------------------
// FX (Frankfurter) helpers
// -------------------------
const FX_STORAGE_KEY = "checkout_currency"; // compartit amb checkout
const FX_RATE_KEY = "fx_eur_usd";           // cache localStorage
const FX_RATE_TTL_MS = 12 * 60 * 60 * 1000; // 12h

function getSelectedAdminCurrency() {
  const sel = document.getElementById("adminComandaCurrency");
  return (sel && sel.value) ? sel.value : (localStorage.getItem(FX_STORAGE_KEY) || "EUR");
}

function setSelectedAdminCurrency(cur) {
  const sel = document.getElementById("adminComandaCurrency");
  if (sel) sel.value = cur;
  localStorage.setItem(FX_STORAGE_KEY, cur);
}

async function getEurUsdRate() {
  try {
    const cachedRaw = localStorage.getItem(FX_RATE_KEY);
    if (cachedRaw) {
      const cached = JSON.parse(cachedRaw);
      if (cached && cached.rate && cached.ts && (Date.now() - cached.ts) < FX_RATE_TTL_MS) {
        return Number(cached.rate);
      }
    }
  } catch (_) { /* ignore */ }

  const res = await fetch("https://api.frankfurter.app/latest?from=EUR&to=USD", { cache: "no-store" });
  if (!res.ok) throw new Error("No s'ha pogut obtenir el canvi EUR/USD");
  const data = await res.json();
  const rate = Number(data?.rates?.USD);
  if (!rate || !isFinite(rate)) throw new Error("Resposta de Frankfurter invàlida");

  try {
    localStorage.setItem(FX_RATE_KEY, JSON.stringify({ rate, ts: Date.now() }));
  } catch (_) { /* ignore */ }

  return rate;
}

function formatMoney(value, currency) {
  const n = Number(value);
  const safe = isFinite(n) ? n : 0;
  try {
    return new Intl.NumberFormat("es-ES", { style: "currency", currency }).format(safe);
  } catch (_) {
    const symbol = currency === "USD" ? "$" : "€";
    return symbol + safe.toFixed(2);
  }
}
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
  if (target === "Reserva") {
    cargarReserves();
  }
  if (target === "Productes") {
    cargarProductes();
  }
  if (target === "Comanda") {
    cargarComandes();
  }

}

function cargarUsuaris() {
  fetch("api.php?controller=Api&action=getUsers")
    .then(result => result.json())
    .then(data => {
      ADMIN_USERS_ALL = (data && data.usuarios) ? data.usuarios : [];
      applyUsuariFiltersAndSort();
    })
    .catch(err => console.error("Error carregant usuaris: ", err));
}

function normalizeStr(v) {
  return (v === null || v === undefined) ? "" : String(v).toLowerCase();
}

function getUsuariFilterState() {
  const id = document.getElementById("filterUsuariId")?.value || "";
  const nom = document.getElementById("filterUsuariNom")?.value || "";
  const field = document.getElementById("sortUsuariField")?.value || "id";
  const dir = document.getElementById("sortUsuariDir")?.value || "asc";
  return { id: String(id).trim(), nom: String(nom).trim().toLowerCase(), field, dir };
}

function applyUsuariFiltersAndSort() {
  const taula = document.getElementById("taula_usuaris");
  if (!taula) return;

  const { id, nom, field, dir } = getUsuariFilterState();

  let rows = Array.isArray(ADMIN_USERS_ALL) ? [...ADMIN_USERS_ALL] : [];

  // filter: ID (exact)
  if (id) rows = rows.filter(u => String(u?.id) === String(id));

  // filter: Nom (substring; also matches nomUsuari and cognoms for usability)
  if (nom) {
    rows = rows.filter(u => {
      const hay = [u?.nom, u?.cognoms, u?.nomUsuari].map(normalizeStr).join(" ");
      return hay.includes(nom);
    });
  }

  // sort
  const isDesc = dir === "desc";
  rows.sort((a, b) => {
    const va = a?.[field];
    const vb = b?.[field];

    // numeric first when possible
    const na = Number(va);
    const nb = Number(vb);
    if (isFinite(na) && isFinite(nb) && (String(va).trim() !== "" || String(vb).trim() !== "")) {
      return isDesc ? (nb - na) : (na - nb);
    }

    const sa = normalizeStr(va);
    const sb = normalizeStr(vb);
    if (sa < sb) return isDesc ? 1 : -1;
    if (sa > sb) return isDesc ? -1 : 1;
    return 0;
  });

  renderUsuarisTable(rows);
}

function renderUsuarisTable(users) {
  const taula = document.getElementById("taula_usuaris");
  if (!taula) return;

  // limpia filas (excepto cabecera)
  document.querySelectorAll("#taula_usuaris tr:not(:first-child)").forEach(tr => tr.remove());

  users.forEach(user => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${user.id ?? ""}</td>
      <td>${user.nomUsuari ?? ""}</td>
      <td>${user.nom ?? ""}</td>
      <td>${user.cognoms ?? ""}</td>
      <td>${user.correu ?? ""}</td>
      <td>${user.rol ?? ""}</td>
      <td>${user.telefon ?? ""}</td>
      <td><button class="editar" data-id="${user.id}">Editar</button></td>
      <td><button class="eliminar" data-id="${user.id}">Eliminar</button></td>
    `;
    taula.appendChild(row);
  });

  // rebind listeners
  document.querySelectorAll(".editar").forEach(btn =>
    btn.addEventListener("click", () => editarUsuari(btn.dataset.id))
  );
  document.querySelectorAll(".eliminar").forEach(btn =>
    btn.addEventListener("click", () => eliminarUsuari(btn.dataset.id))
  );
}

function initUsuariFiltersUI() {
  const id = document.getElementById("filterUsuariId");
  const nom = document.getElementById("filterUsuariNom");
  const f = document.getElementById("sortUsuariField");
  const d = document.getElementById("sortUsuariDir");
  const clr = document.getElementById("btnClearUsuariFilters");

  [id, nom, f, d].forEach(el => {
    if (!el) return;
    el.addEventListener("input", applyUsuariFiltersAndSort);
    el.addEventListener("change", applyUsuariFiltersAndSort);
  });

  if (clr) clr.addEventListener("click", () => {
    if (id) id.value = "";
    if (nom) nom.value = "";
    if (f) f.value = "id";
    if (d) d.value = "asc";
    applyUsuariFiltersAndSort();
  });
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

//Reserva
document.getElementById("btnGuardarReserva").addEventListener("click", guardarReserva);
document.getElementById("btnCancelarReserva").addEventListener("click", () => {
  document.getElementById("formReserva").style.display = "none";
});

function cargarReserves() {
  fetch("api.php?controller=Api&action=getReserves")
    .then(r => r.json())
    .then(data => {
      const taula = document.getElementById("taula_reserves");
      document.querySelectorAll("#taula_reserves tr:not(:first-child)").forEach(tr => tr.remove());

      data.reserves.forEach(res => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${res.id}</td>
          <td>${res.data}</td>
          <td>${res.hora}</td>
          <td>${res.numeroPersones}</td>
          <td>${res.id_usuari}</td>
          <td><button class="editarReserva" data-id="${res.id}">Editar</button></td>
        `;
        taula.appendChild(row);
      });

      document.querySelectorAll(".editarReserva").forEach(btn =>
        btn.addEventListener("click", () => editarReserva(btn.dataset.id))
      );
    });
}

function editarReserva(id) {
  fetch(`api.php?controller=Api&action=getReservaById&id=${id}`)
    .then(r => r.json())
    .then(data => {
      const res = data.reserva;

      document.getElementById("formulariReservaID").value = res.id;
      document.getElementById("formulariReservaData").value = res.data;
      document.getElementById("formulariReservaHora").value = (res.hora || "").slice(0, 5);

      document.getElementById("formReserva").style.display = "block";
    });
}

function guardarReserva() {
  const payload = {
    id: document.getElementById("formulariReservaID").value,
    data: document.getElementById("formulariReservaData").value,
    hora: document.getElementById("formulariReservaHora").value
  };

  fetch("api.php?controller=Api&action=updateReserva", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  })
    .then(r => r.json())
    .then(resp => {
      if (resp.success) {
        document.getElementById("formReserva").style.display = "none";
        cargarReserves();
      } else {
        alert("Error al guardar reserva");
      }
    });
}

// -------- PRODUCTES --------
document.getElementById("btnGuardarProducte").addEventListener("click", guardarProducte);
document.getElementById("btnCancelarProducte").addEventListener("click", () => {
  document.getElementById("formProducte").style.display = "none";
});

function cargarProductes() {
  fetch("api.php?controller=Api&action=getProductes")
    .then(r => r.json())
    .then(data => {
      ADMIN_PRODUCTES_ALL = (data && data.productes) ? data.productes : [];
      applyProducteFiltersAndSort();

    });
}

function getProducteFilterState() {
  const id = document.getElementById("filterProducteId")?.value || "";
  const nom = document.getElementById("filterProducteNom")?.value || "";
  const pMin = document.getElementById("filterProductePriceMin")?.value || "";
  const pMax = document.getElementById("filterProductePriceMax")?.value || "";
  const enCarta = document.getElementById("filterProducteEnCarta")?.value || "";
  const dir = document.getElementById("sortProducteIdDir")?.value || "asc";
  return {
    id: String(id).trim(),
    nom: String(nom).trim().toLowerCase(),
    pMin,
    pMax,
    enCarta,
    dir
  };
}

function isEnCartaValue(v) {
  const s = String(v ?? "").trim().toLowerCase();
  if (s === "1" || s === "true" || s === "si" || s === "sí") return 1;
  if (s === "0" || s === "false" || s === "no") return 0;
  const n = Number(v);
  return isFinite(n) ? (n ? 1 : 0) : 0;
}

function applyProducteFiltersAndSort() {
  const taula = document.getElementById("taula_productes");
  if (!taula) return;

  const { id, nom, pMin, pMax, enCarta, dir } = getProducteFilterState();

  let rows = Array.isArray(ADMIN_PRODUCTES_ALL) ? [...ADMIN_PRODUCTES_ALL] : [];

  // filter: ID exact
  if (id) rows = rows.filter(p => String(p?.id) === String(id));

  // filter: Nom substring
  if (nom) rows = rows.filter(p => normalizeStr(p?.nom).includes(nom));

  // filter: price range
  const min = (pMin !== "") ? Number(pMin) : null;
  const max = (pMax !== "") ? Number(pMax) : null;
  if (min !== null && isFinite(min)) rows = rows.filter(p => Number(p?.preu_unitat) >= min);
  if (max !== null && isFinite(max)) rows = rows.filter(p => Number(p?.preu_unitat) <= max);

  // filter: en carta
  if (enCarta === "1") rows = rows.filter(p => isEnCartaValue(p?.en_carta) === 1);
  if (enCarta === "0") rows = rows.filter(p => isEnCartaValue(p?.en_carta) === 0);

  // sort: ID asc/desc
  const isDesc = dir === "desc";
  rows.sort((a, b) => {
    const na = Number(a?.id);
    const nb = Number(b?.id);
    if (isFinite(na) && isFinite(nb)) return isDesc ? (nb - na) : (na - nb);
    const sa = normalizeStr(a?.id);
    const sb = normalizeStr(b?.id);
    if (sa < sb) return isDesc ? 1 : -1;
    if (sa > sb) return isDesc ? -1 : 1;
    return 0;
  });

  renderProductesTable(rows);
}

function renderProductesTable(productes) {
  const taula = document.getElementById("taula_productes");
  if (!taula) return;

  document.querySelectorAll("#taula_productes tr:not(:first-child)").forEach(tr => tr.remove());

  productes.forEach(p => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${p?.id ?? ""}</td>
      <td>${p?.nom ?? ""}</td>
      <td>${p?.preu_unitat ?? ""}</td>
      <td>${p?.en_carta ?? ""}</td>
      <td><button class="editarProducte" data-id="${p?.id}">Editar</button></td>
      <td><button class="eliminarProducte" data-id="${p?.id}">Eliminar</button></td>
    `;
    taula.appendChild(row);
  });

  document.querySelectorAll(".editarProducte").forEach(btn =>
    btn.addEventListener("click", () => editarProducte(btn.dataset.id))
  );
  document.querySelectorAll(".eliminarProducte").forEach(btn =>
    btn.addEventListener("click", () => eliminarProducte(btn.dataset.id))
  );
}

function initProducteFiltersUI() {
  const ids = [
    "filterProducteId",
    "filterProducteNom",
    "filterProductePriceMin",
    "filterProductePriceMax",
    "filterProducteEnCarta",
    "sortProducteIdDir"
  ];

  ids.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener("input", applyProducteFiltersAndSort);
    el.addEventListener("change", applyProducteFiltersAndSort);
  });

  const clr = document.getElementById("btnClearProducteFilters");
  if (clr) clr.addEventListener("click", () => {
    ids.forEach(id => {
      const el = document.getElementById(id);
      if (!el) return;
      if (el.tagName === "SELECT") {
        if (id === "filterProducteEnCarta") el.value = "";
        if (id === "sortProducteIdDir") el.value = "asc";
      } else {
        el.value = "";
      }
    });
    applyProducteFiltersAndSort();
  });
}

function editarProducte(id) {
  fetch(`api.php?controller=Api&action=getProducteById&id=${id}`)
    .then(r => r.json())
    .then(data => {
      const p = data.producte;

      document.getElementById("formulariProducteID").value = p.id;
      document.getElementById("formulariProducteNom").value = p.nom;
      document.getElementById("formulariProductePreu").value = p.preu_unitat;

      document.getElementById("formProducte").style.display = "block";
    });
}

function guardarProducte() {
  const id = document.getElementById("formulariProducteID").value;

  const payload = {
    id,
    nom: document.getElementById("formulariProducteNom").value,
    preu_unitat: document.getElementById("formulariProductePreu").value
  };

  const action = id ? "updateProducte" : "addProducte";

  fetch(`api.php?controller=Api&action=${action}`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  })
    .then(r => r.json())
    .then(resp => {
      if (resp.success) {
        document.getElementById("formProducte").style.display = "none";
        cargarProductes();
      } else {
        alert("Error: " + (resp.message || "No s'ha pogut guardar"));
      }
    });
}

document.getElementById("btn_afegirProducte").addEventListener("click", () => {
  limpiarFormProducte();
  document.getElementById("formProducte").style.display = "block";
});

function limpiarFormProducte() {
  document.getElementById("formulariProducteID").value = "";
  document.getElementById("formulariProducteNom").value = "";
  document.getElementById("formulariProductePreu").value = "";
}

function eliminarProducte(id) {
  if (!confirm("Vols eliminar aquest producte?")) return;

  fetch("api.php?controller=Api&action=deleteProducte", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  })
    .then(r => r.json())
    .then(resp => {
      if (resp.success) cargarProductes();
      else alert("Error: " + (resp.message || "No s'ha pogut eliminar"));
    });
}
// ======================
// COMANDES (PEDIDOS)
// ======================

let usuarisCache = null; // para no pedir usuarios 50 veces

function initComandes() {
  const btnAfegir = document.getElementById("btn_afegirComanda");
  const btnGuardar = document.getElementById("btnGuardarComanda");
  const btnCancelar = document.getElementById("btnCancelarComanda");

  if (btnAfegir) btnAfegir.addEventListener("click", () => {
    limpiarFormComanda();
    mostrarFormComanda();
  });

  if (btnGuardar) btnGuardar.addEventListener("click", guardarComanda);
  if (btnCancelar) btnCancelar.addEventListener("click", ocultarFormComanda);

  // Selector de moneda (visualització) per a Comandes
  const curSel = document.getElementById("adminComandaCurrency");
  if (curSel) {
    const saved = localStorage.getItem(FX_STORAGE_KEY) || "EUR";
    curSel.value = saved;
    curSel.addEventListener("change", () => {
      setSelectedAdminCurrency(curSel.value);
      cargarComandes();
    });
  }


  // Filters / sort UI
  initComandaFiltersUI();
}


function limpiarFormComanda() {
  const idEl = document.getElementById("formulariComandaID");
  const preuEl = document.getElementById("formulariComandaPreuTotal");
  const sel = document.getElementById("formulariComandaIdUsuari");

  if (idEl) idEl.value = "";
  if (preuEl) preuEl.value = "";
  if (sel) sel.innerHTML = "";
}



async function cargarComandes() {
  try {
    const r = await fetch("api.php?controller=Api&action=getComandes");
    const data = await r.json();

    if (!data.success) {
      alert("Error: " + (data.message || "No s'han pogut carregar les comandes"));
      return;
    }

    ADMIN_COMANDES_ALL = Array.isArray(data.comandes) ? data.comandes : [];
    await applyComandaFiltersAndSort();
  } catch (_) {
    alert("Error de xarxa carregant comandes");
  }
}

function getComandaFilterState() {
  const id = document.getElementById("filterComandaId")?.value || "";
  const uid = document.getElementById("filterComandaUsuari")?.value || "";
  const dFrom = document.getElementById("filterComandaDateFrom")?.value || "";
  const dTo = document.getElementById("filterComandaDateTo")?.value || "";
  const pMin = document.getElementById("filterComandaPriceMin")?.value || "";
  const pMax = document.getElementById("filterComandaPriceMax")?.value || "";
  const sortField = document.getElementById("sortComandaField")?.value || "id";
  const sortDir = document.getElementById("sortComandaDir")?.value || "desc";
  return { id, uid, dFrom, dTo, pMin, pMax, sortField, sortDir };
}

// Parse a date-ish string into a YYYY-MM-DD (local) key for filtering.
// Accepts 'YYYY-MM-DD', 'YYYY-MM-DD HH:MM:SS', ISO, etc.
function toDateKey(v) {
  if (!v) return "";
  const s = String(v).trim();
  const m = s.match(/^(\d{4}-\d{2}-\d{2})/);
  if (m) return m[1];
  const dt = new Date(s);
  if (isNaN(dt.getTime())) return "";
  const yyyy = dt.getFullYear();
  const mm = String(dt.getMonth() + 1).padStart(2, "0");
  const dd = String(dt.getDate()).padStart(2, "0");
  return `${yyyy}-${mm}-${dd}`;
}

async function applyComandaFiltersAndSort() {
  const taula = document.getElementById("taula_comandes");
  if (!taula) return;

  const { id, uid, dFrom, dTo, pMin, pMax, sortField, sortDir } = getComandaFilterState();

  let rows = Array.isArray(ADMIN_COMANDES_ALL) ? [...ADMIN_COMANDES_ALL] : [];

  // filter: ID
  if (id) rows = rows.filter(c => String(c.id) === String(id));

  // filter: user id
  if (uid) rows = rows.filter(c => String(c.id_usuaris) === String(uid));

  // filter: price range (always in base EUR)
  const min = (pMin !== "") ? Number(pMin) : null;
  const max = (pMax !== "") ? Number(pMax) : null;
  if (min !== null && isFinite(min)) rows = rows.filter(c => Number(c.preu_total) >= min);
  if (max !== null && isFinite(max)) rows = rows.filter(c => Number(c.preu_total) <= max);

  // filter: date range (if API provides data_comanda)
  const hasDate = rows.some(c => c.data_comanda || c.data || c.date);
  const fromK = dFrom || "";
  const toK = dTo || "";
  if ((fromK || toK) && hasDate) {
    rows = rows.filter(c => {
      const key = toDateKey(c.data_comanda || c.data || c.date);
      if (!key) return false;
      if (fromK && key < fromK) return false;
      if (toK && key > toK) return false;
      return true;
    });
  }

  // sort
  const isDesc = sortDir === "desc";
  rows.sort((a, b) => {
    const va = a?.[sortField];
    const vb = b?.[sortField];

    if (sortField === "data_comanda") {
      const ka = toDateKey(va);
      const kb = toDateKey(vb);
      if (ka < kb) return isDesc ? 1 : -1;
      if (ka > kb) return isDesc ? -1 : 1;
      return 0;
    }

    const na = Number(va);
    const nb = Number(vb);
    if (isFinite(na) && isFinite(nb) && (String(va).trim() !== "" || String(vb).trim() !== "")) {
      return isDesc ? (nb - na) : (na - nb);
    }

    const sa = normalizeStr(va);
    const sb = normalizeStr(vb);
    if (sa < sb) return isDesc ? 1 : -1;
    if (sa > sb) return isDesc ? -1 : 1;
    return 0;
  });

  await renderComandesTable(rows);
}

async function renderComandesTable(comandes) {
  const taula = document.getElementById("taula_comandes");
  if (!taula) return;

  // limpia filas (excepto cabecera)
  document.querySelectorAll("#taula_comandes tr:not(:first-child)").forEach(tr => tr.remove());

  const currency = getSelectedAdminCurrency();
  let rate = 1;
  let shownCurrency = "EUR";

  if (currency === "USD") {
    try {
      rate = await getEurUsdRate();
      shownCurrency = "USD";
    } catch (e) {
      console.warn(e);
      alert("No s'ha pogut obtenir el canvi EUR/USD. Es mostraran els valors en EUR.");
      rate = 1;
      shownCurrency = "EUR";
    }
  }

  comandes.forEach(c => {
    const preuEur = Number(c.preu_total);
    const base = isFinite(preuEur) ? preuEur : 0;
    const shownValue = base * rate;

    const dateVal = c.data_comanda || c.data || c.date || "";
    const dateKey = toDateKey(dateVal);

    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${c.id ?? ""}</td>
      <td data-preu-eur="${base}">${formatMoney(shownValue, shownCurrency)}</td>
      <td>${c.id_usuaris ?? ""}</td>
      <td>${dateKey ? dateKey : (dateVal ? dateVal : "-")}</td>
      <td><button class="editarComanda" data-id="${c.id}">Editar</button></td>
      <td><button class="eliminarComanda" data-id="${c.id}">Eliminar</button></td>
    `;
    taula.appendChild(row);
  });

  document.querySelectorAll(".editarComanda").forEach(btn =>
    btn.addEventListener("click", () => editarComanda(btn.dataset.id))
  );

  document.querySelectorAll(".eliminarComanda").forEach(btn =>
    btn.addEventListener("click", () => eliminarComanda(btn.dataset.id))
  );
}

function initComandaFiltersUI() {
  const ids = [
    "filterComandaId",
    "filterComandaUsuari",
    "filterComandaDateFrom",
    "filterComandaDateTo",
    "filterComandaPriceMin",
    "filterComandaPriceMax",
    "sortComandaField",
    "sortComandaDir"
  ];

  ids.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener("input", () => applyComandaFiltersAndSort());
    el.addEventListener("change", () => applyComandaFiltersAndSort());
  });

  const clr = document.getElementById("btnClearComandaFilters");
  if (clr) clr.addEventListener("click", () => {
    ids.forEach(id => {
      const el = document.getElementById(id);
      if (!el) return;
      if (el.tagName === "SELECT") {
        if (id === "sortComandaField") el.value = "id";
        else if (id === "sortComandaDir") el.value = "desc";
      } else {
        el.value = "";
      }
    });
    applyComandaFiltersAndSort();
  });
}




function mostrarFormComanda(comanda = null) {
  const form = document.getElementById("formComanda");
  if (!form) return;

  form.style.display = "block";

  document.getElementById("formulariComandaID").value = comanda ? comanda.id : "";
  document.getElementById("formulariComandaPreuTotal").value = comanda ? comanda.preu_total : "";

  // cargar select de usuarios y seleccionar el actual si existe
  cargarSelectUsuaris(comanda ? comanda.id_usuaris : null);
}

function ocultarFormComanda() {
  const form = document.getElementById("formComanda");
  if (!form) return;

  form.style.display = "none";
  limpiarFormComanda();
}

function editarComanda(id) {
  fetch(`api.php?controller=Api&action=getComandaById&id=${id}`)
    .then(r => r.json())
    .then(data => {
      if (!data.success) {
        alert("Error: " + (data.message || "No s'ha pogut carregar la comanda"));
        return;
      }
      mostrarFormComanda(data.comanda);
    })
    .catch(() => alert("Error de xarxa carregant la comanda"));
}

function guardarComanda() {
  const id = document.getElementById("formulariComandaID").value;

  const preuTotalRaw = document.getElementById("formulariComandaPreuTotal").value;
  const idUsuariRaw = document.getElementById("formulariComandaIdUsuari").value;

  const payload = {
    id: id ? parseInt(id, 10) : null,
    preu_total: parseFloat(preuTotalRaw),
    id_usuaris: parseInt(idUsuariRaw, 10)
  };

  if (Number.isNaN(payload.preu_total) || payload.preu_total < 0) {
    alert("Preu total invàlid");
    return;
  }
  if (Number.isNaN(payload.id_usuaris) || payload.id_usuaris <= 0) {
    alert("Selecciona un usuari vàlid");
    return;
  }

  const action = id ? "updateComanda" : "addComanda";

  fetch(`api.php?controller=Api&action=${action}`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  })
    .then(r => r.json())
    .then(resp => {
      if (resp.success) {
        ocultarFormComanda();
        cargarComandes();
      } else {
        alert("Error: " + (resp.message || "No s'ha pogut guardar"));
      }
    })
    .catch(() => alert("Error de xarxa guardant la comanda"));
}

function eliminarComanda(id) {
  if (!confirm("Segur que vols eliminar aquesta comanda?")) return;

  fetch("api.php?controller=Api&action=deleteComanda", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: parseInt(id, 10) })
  })
    .then(r => r.json())
    .then(resp => {
      if (resp.success) cargarComandes();
      else alert("Error: " + (resp.message || "No s'ha pogut eliminar"));
    })
    .catch(() => alert("Error de xarxa eliminant la comanda"));
}

function cargarSelectUsuaris(selectedIdUsuari = null) {
  const sel = document.getElementById("formulariComandaIdUsuari");
  if (!sel) return;

  const pintar = (usuarios) => {
    sel.innerHTML = "";

    const ph = document.createElement("option");
    ph.value = "";
    ph.textContent = "-- Selecciona un usuari --";
    sel.appendChild(ph);

    usuarios.forEach(u => {
      const opt = document.createElement("option");
      opt.value = u.id;
      opt.textContent = `${u.id} - ${u.nomUsuari}`;
      sel.appendChild(opt);
    });

    if (selectedIdUsuari) {
      sel.value = String(selectedIdUsuari);
    }
  };

  if (usuarisCache) {
    pintar(usuarisCache);
    return;
  }

  fetch("api.php?controller=Api&action=getUsers")
    .then(r => r.json())
    .then(data => {
      if (!data.usuarios) {
        alert("No s'han pogut carregar usuaris per al selector");
        return;
      }
      usuarisCache = data.usuarios;
      pintar(usuarisCache);
    })
    .catch(() => alert("Error de xarxa carregant usuaris"));
}





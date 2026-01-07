<?php
// Autenticació d'usuaris (login/register/logout)
// - Login per correu
// - Password: suporta hashes de password_hash (bcrypt/argon/etc.) i també text pla (rehash al primer login)

include_once __DIR__ . '/../model/Usuari/UsuariDAO.php';
include_once __DIR__ . '/../database/DataBase.php';

class AuthController
{
    public function login()
    {
        $view = 'Login.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    public function register()
    {
        $view = 'register.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    public function logout()
    {
        // Neteja de sessió
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header('Location: ' . BASE_URL . '/?controller=Home&action=Home');
        exit;
    }

    public function doLogin()
    {
        $correu = trim($_POST['correu'] ?? '');
        $contrasenya = (string)($_POST['contrasenya'] ?? '');

        if ($correu === '' || $contrasenya === '') {
            $_SESSION['flash_error'] = 'Introdueix correu i contrasenya.';
            header('Location: ' . BASE_URL . '/?controller=Auth&action=login');
            exit;
        }

        // Obté usuari per correu (el teu DAO ja consulta WHERE correu = ?)
        $usuari = usuariDAO::getUsuariByUserName($correu);

        // Missatge genèric per no revelar si existeix o no
        if (!$usuari) {
            $_SESSION['flash_error'] = 'Credencials incorrectes.';
            header('Location: ' . BASE_URL . '/?controller=Auth&action=login');
            exit;
        }

        $stored = (string)($usuari->contrasenya ?? '');
        $ok = false;

        // Detecta si $stored és un hash suportat per password_* (bcrypt/argon/etc.)
        $info = password_get_info($stored);
        if ($stored !== '' && ($info['algo'] ?? 0) !== 0) {
            $ok = password_verify($contrasenya, $stored);

            // Opcional: si algun dia canvies l'algo/cost, rehash automàtic
            if ($ok && password_needs_rehash($stored, PASSWORD_BCRYPT)) {
                $this->upgradePasswordHash((int)$usuari->id, $contrasenya);
            }
        } else {
            // Compatibilitat: contrasenya en text pla (projecte antic)
            $ok = hash_equals($stored, $contrasenya);
            if ($ok) {
                $this->upgradePasswordHash((int)$usuari->id, $contrasenya);
            }
        }

        if (!$ok) {
            $_SESSION['flash_error'] = 'Credencials incorrectes.';
            header('Location: ' . BASE_URL . '/?controller=Auth&action=login');
            exit;
        }

        // Sessió segura: regenera ID per evitar session fixation
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }

        $_SESSION['usuario'] = $usuari;

        header('Location: ' . BASE_URL . '/?controller=Home&action=Home');
        exit;
    }

    public function doRegister()
    {
        $nomUsuari = trim($_POST['nomUsuari'] ?? '');
        $nom = trim($_POST['nom'] ?? '');
        $cognoms = trim($_POST['cognoms'] ?? '');
        $correu = trim($_POST['correu'] ?? '');
        $telefon = trim($_POST['telefon'] ?? '');
        $contrasenya = (string)($_POST['contrasenya'] ?? '');

        // Normalitza username (evita espais/caràcters raros)
        $nomUsuari = preg_replace('/[^a-zA-Z0-9_]/', '_', $nomUsuari);
        $nomUsuari = substr($nomUsuari, 0, 50);

        if ($nomUsuari === '' || $nom === '' || $cognoms === '' || $correu === '' || $contrasenya === '') {
            $_SESSION['flash_error'] = 'Revisa els camps obligatoris.';
            header('Location: ' . BASE_URL . '/?controller=Auth&action=register');
            exit;
        }

        // Ja existeix per correu?
        $existing = usuariDAO::getUsuariByUserName($correu);
        if ($existing) {
            $_SESSION['flash_error'] = 'Ja existeix un usuari amb aquest correu.';
            header('Location: ' . BASE_URL . '/?controller=Auth&action=register');
            exit;
        }

        // Hash robust (bcrypt)
        $hash = password_hash($contrasenya, PASSWORD_BCRYPT);
        $rol = 'client';

        $newId = usuariDAO::setUsuari($nomUsuari, $hash, $nom, $cognoms, $correu, $telefon, $rol);

        if (!$newId) {
            $_SESSION['flash_error'] = 'No s\'ha pogut crear el compte.';
            header('Location: ' . BASE_URL . '/?controller=Auth&action=register');
            exit;
        }

        // Auto-login
        $usuari = usuariDAO::getUsuariByUserName($correu);

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
        $_SESSION['usuario'] = $usuari;

        header('Location: ' . BASE_URL . '/?controller=Home&action=Home');
        exit;
    }

    private function upgradePasswordHash(int $idUsuari, string $plainPassword): void
    {
        try {
            $con = DataBase::connect();
            $hash = password_hash($plainPassword, PASSWORD_BCRYPT);

            $stmt = $con->prepare('UPDATE usuaris SET contrasenya=? WHERE id=?');
            if (!$stmt) {
                $con->close();
                return;
            }

            $stmt->bind_param('si', $hash, $idUsuari);
            $stmt->execute();
            $stmt->close();
            $con->close();
        } catch (Throwable $e) {
            // silent
        }
    }
}

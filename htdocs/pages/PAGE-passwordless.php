<?php
// (A) PAGE META & SCRIPTS
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-wa-helper.js", "defer"],
  ["s", HOST_ASSETS."PAGE-wa.js", "defer"]
]];

// (B) HAS REGISTERED
$_CORE->load("Users");
$regged = is_array($_CORE->Users->hashGet($_SESSION["user"]["user_id"], "PL"));

// (C) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 bg-white border">
<div class="row">
  <div class="col-8 p-4">
    <!-- (C1) HEADER -->
    <h3 class="mt-4 mb-2">PASSWORTLOSES ANMELDEN</h3>
    <div class="mb-4 text-secondary"><small>
      Melden Sie sich mit Fingerabdruck, Gesichtserkennung, PIN-Code oder USB-Keypass an.
      Bitte beachten Sie - Dies kann nur auf einem Gerät und einem Modus der passwortlosen Anmeldung registriert werden.
    </small></div>

    <!-- (C2) REGISTER & UNREGISTER -->
    <button type="button" id="wa-unreg" class="my-1 btn btn-danger d-flex-inline"
            onclick="wa.unreg()"<?=$regged?"":" disabled"?>>
      <i class="ico-sm icon-cross"></i> Abmelden
    </button>
    <button type="button" id="wa-reg" class="my-1 btn btn-primary d-flex-inline"
            onclick="wa.regA()" disabled>
      <i class="ico-sm icon-key"></i> Registrieren
    </button>

    <!-- (C3) NOTES -->
    <div id="wa-txt" class="p-3 mt-3 text-white bg-danger d-none"></div>
  </div>
  <div class="col-4" id="login-r" style="background:url('<?=HOST_ASSETS?>users.webp') center;"></div>
</div>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
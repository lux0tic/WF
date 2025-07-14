<?php
// (A) PAGE META
$_CORE->Settings->defineN("STOCK_MVT", true);
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."PAGE-scanner.css"],
  ["s", HOST_ASSETS."html5-qrcode.min.js", "defer"],
  ["s", HOST_ASSETS."PAGE-nfc.js", "defer"],
  ["s", HOST_ASSETS."CB-autocomplete.js", "defer"],
  ["s", HOST_ASSETS."PAGE-qrscan.js", "defer"],
  ["s", HOST_ASSETS."PAGE-move.js", "defer"]
]];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="mb-3">BESTAND BEWEGUNG</h3>

<!-- (B) ITEM MOVEMENT -->
<div class="fw-bold text-danger mb-2">RICHTUNG &amp; QUANTITÄT</div>
<form id="mvt-form" autocomplete="off" class="bg-white border p-4 mb-4" onsubmit="return move.save()">
  <div class="form-floating mb-4">
    <select class="form-select" id="mvt-direction"><?php
      foreach (STOCK_MVT as $c=>$m) {
        echo "<option value='$c'>$m</option>";
      }
    ?></select>
    <label>Direction</label>
  </div>

  <div class="form-floating mb-4">
    <input type="number" class="form-control" id="mvt-qty" min="0.01" step="0.01" required>
    <label>Quantität</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" id="mvt-notes">
    <label>Notizen (Falls vorhanden)</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" id="mvt-sku" required>
    <label>Artikel SKU</label>
  </div>

  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-checkmark"></i> Speichern
  </button>
  <button type="button" class="my-1 btn btn-primary d-flex-inline" onclick="move.qron()">
    <i class="ico-sm icon-qrcode"></i> Scannen
  </button>
  <button id="nfc-btn" type="button" disabled class="my-1 btn btn-primary d-flex-inline" onclick="nfc.scan()">
    <i class="ico-sm icon-feed"></i> Scannen
  </button>
</form>

<!-- (C) LAST ENTRY -->
<div class="fw-bold text-danger mb-2">LETZTER EINTRAG</div>
<div class="d-flex align-items-center bg-white border p-4">
  <div class="me-4 text-center display-6" id="last-qty">MENGE</div>
  <div class="text-secondary">
    <div id="last-sku" class="fw-bold">ARTIKEL</div>
    <div id="last-mvt">RICHTUNG</div>
    <div id="last-notes">NOTIZEN</div>
  </div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
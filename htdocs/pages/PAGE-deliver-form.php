<?php
// (A) GET DELIVERY
$_CORE->Settings->defineN("DELIVER_STAT", true);
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) { $dlv = $_CORE->autoCall("Delivery", "get"); }

// (B) DELIVERY FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"HINZUFÜGEN"?> LIEFERUNG</h3>
<form onsubmit="return dlv.save()">
  <!-- (B1) CUSTOMER -->
  <div class="fw-bold text-danger mb-2">KUNDE &amp; BESTELLUNG</div>
  <div class="bg-white border p-4 mb-3">
    <input type="hidden" id="d-id" value="<?=$edit?$dlv["d_id"]:""?>">

    <div class="form-floating">
      <input type="text" id="cus-name" class="form-control" <?=$edit?" disabled ":""?>value="<?=$edit?$dlv["cus_name"]:""?>">
      <label>Firmenname</label>
    </div>
    <div id="cus-change" class="d-none text-secondary" onclick="dlv.ccus(true)">* Click here to change customer</div>
    <input type="hidden" id="cus-id" value="<?=$edit?$dlv["cus_id"]:""?>">

    <?php if ($edit) { ?>
    <div class="form-floating mt-4 mb-1">
      <select id="d-stat" class="form-select"><?php
        foreach (DELIVER_STAT as $i=>$n) {
          printf("<option %svalue='%s'>%s</option>",
            $i==$dlv["d_status"] ? " selected " : "",
            $i, $n
          );
        }
      ?></select>
      <label>Status</label>
    </div>
    <div class="text-secondary">
      * Order cannot be edited once completed or cancelled.<br>
      * Stock will be automatically deducted on complete.
    </div>
    <?php } ?>
  </div>

  <!-- (B2) DELIVER TO -->
  <div class="fw-bold text-danger mb-2">VERSENDEN AN</div>
  <div class="bg-white border p-4 mb-3">
    <div class="form-floating mb-4">
      <input type="text" id="d-name" class="form-control" required value="<?=$edit?$dlv["d_name"]:""?>">
      <label>Name</label>
    </div>

    <div class="form-floating mb-4">
      <input type="text" id="d-tel" class="form-control" required value="<?=$edit?$dlv["d_tel"]:""?>">
      <label>Telefon</label>
    </div>

    <div class="form-floating mb-4">
      <input type="email" id="d-email" class="form-control" required value="<?=$edit?$dlv["d_email"]:""?>">
      <label>Mail</label>
    </div>

    <div class="form-floating mb-4">
      <textarea id="d-address" class="form-control" required><?=$edit?$dlv["d_address"]:""?></textarea>
      <label>Adresse</label>
    </div>

    <div class="form-floating mb-4">
      <input type="date" id="d-date" class="form-control" required value="<?=$edit?$dlv["d_date"]:""?>">
      <label>Datum</label>
    </div>

    <div class="form-floating">
      <textarea id="d-notes" class="form-control"><?=$edit?$dlv["d_notes"]:""?></textarea>
      <label>Notizen (Falls vorhanden)</label>
    </div>
  </div>

  <!-- (B3) ITEMS LIST -->
  <div class="fw-bold text-danger">ARTIKEL</div>
  <div class="text-secondary mb-2">* Drag-and-drop to sort.</div>
  <div id="dlv-items" class="bg-white border p-4 mb-3 zebra">
    <?php
    if ($edit) {
      printf("<div id='dlv-items-data' class='d-none'>%s</div>", json_encode($dlv["items"]));
    }
    ?>
  </div>

  <div class="fw-bold text-danger mb-2">ARTIKEL HINZUFÜGEN</div>
  <div class="bg-white border p-4 mb-3">
    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="add-item">
      <label>Artikel SKU/Name</label>
    </div>
    <button type="button" class="btn btn-primary d-flex-inline" onclick="dlv.addQR()">
      <i class="ico-sm icon-qrcode"></i> Scannen
    </button>
    <button id="nfc-btn" type="button" disabled class="btn btn-primary d-flex-inline" onclick="nfc.scan()">
      <i class="ico-sm icon-feed"></i> Scannen
    </button>
  </div>

  <button type="button" class="my-1 btn btn-danger d-flex-inline" onclick="cb.page(1)">
    <i class="ico-sm icon-undo2"></i> Zurück
  </button>
  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-checkmark"></i> Speichern
  </button>
</form>
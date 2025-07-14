<?php
// (A) GET CUSTOMER
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) { $cus = $_CORE->autoCall("Customers", "get"); }

// (B) CUSTOMER FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"HINZUFÜGEN"?> KUNDE</h3>
<form onsubmit="return cus.save()">
  <div class="bg-white border p-4 mb-3">
    <input type="hidden" id="cus-id" value="<?=isset($cus)?$cus["cus_id"]:""?>">

    <div class="form-floating mb-4">
      <input type="text" id="cus-name" class="form-control" required value="<?=$edit?$cus["cus_name"]:""?>">
      <label>Firmenname</label>
    </div>

    <div class="form-floating mb-4">
      <input type="text" id="cus-tel" class="form-control" required value="<?=$edit?$cus["cus_tel"]:""?>">
      <label>Telefon</label>
    </div>

    <div class="form-floating mb-4">
      <input type="email" id="cus-email" class="form-control" required value="<?=$edit?$cus["cus_email"]:""?>">
      <label>Mail</label>
    </div>

    <div class="form-floating">
      <textarea id="cus-address" class="form-control"><?=$edit?$cus["cus_address"]:""?></textarea>
      <label>Adresse (Falls vorhanden)</label>
    </div>
  </div>

  <button type="button" class="my-1 btn btn-danger d-flex-inline" onclick="cb.page(1)">
    <i class="ico-sm icon-undo2"></i> Zurück
  </button>
  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-checkmark"></i> Speichern
  </button>
</form>
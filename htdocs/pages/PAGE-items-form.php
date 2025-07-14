<?php
// (A) GET ITEM
$edit = isset($_POST["sku"]) && $_POST["sku"]!="";
if ($edit) { $item = $_CORE->autoCall("Items", "get"); }

// (B) ITEM FORM ?>
<h3 class="m-0"><?=$edit?"BEARBEITEN":"HINZUFÜGEN"?> ARTIKEL</h3>
<div class="text-danger fw-bold mb-3">
  <?php if ($edit) { ?>
  * Wenn Sie die SKU/Name/Einheit ändern -
  Alle Bewegungsverläufe, Lieferantenartikel und Bestellungen werden ebenfalls aktualisiert.
  Dies kann potenziell Probleme verursachen, gehen Sie daher mit äußerster Vorsicht vor.
  <?php } ?>
</div>

<form onsubmit="return item.save()">
  <div class="bg-white border p-4 mb-2">

    <div class="form-floating my-4">
      <input type="text" id="item-name" class="form-control" required value="<?=$edit?$item["item_name"]:""?>">
      <label>Artikelname</label>
    </div>

        <div class="form-floating my-4">
      <input type="text" id="item-name" class="form-control" required value="<?=$edit?$item["item_name"]:""?>">
      <label>Lager Artikelnummer</label>
    </div>

    <div class="form-floating my-4">
      <input type="text" id="item-name" class="form-control" required value="<?=$edit?$item["item_name"]:""?>">
      <label>Lieferantenartikelnummer</label>
    </div>

        <div class="form-floating my-4">
      <input type="text" id="item-name" class="form-control" required value="<?=$edit?$item["item_name"]:""?>">
      <label>Lieferant</label>
    </div>

    <div class="form-floating mb-4">
      <input type="text" id="item-desc" class="form-control" value="<?=$edit?$item["item_desc"]:""?>">
      <label>Artikelbezeichnung</label>
    </div>

        <div class="form-floating mb-4">
      <input type="text" id="item-comm" class="form-control" value="<?=$edit?$item["item_comm"]:""?>">
      <label>Kommentar</label>
    </div>

            <div class="form-floating mb-4">
      <input type="text" id="item-desc" class="form-control" value="<?=$edit?$item["item_desc"]:""?>">
      <label>Bestand</label>
    </div>

        <div class="form-floating mb-4">
      <input type="number" step="0.01" class="form-control" id="item-low" required value="<?=$edit?$item["item_low"]:""?>">
      <label>Mindestbestand</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-order" class="form-control" value="<?=$edit?$item["item_order"]:""?>">
      <label>Bestellen</label>
    </div>


            <div class="form-floating mb-4">
      <input type="date" id="item-eingangdate" class="form-control" value="<?=$edit?$item["item_eingangdate"]:""?>">
      <label>Letzter Wareneingang Datum</label>
    </div>

                <div class="form-floating mb-4">
      <input type="number" id="item-eingangqty" class="form-control" value="<?=$edit?$item["item_eingangqty"]:""?>">
      <label>Alternativartikel</label>
    </div>

            <div class="form-floating mb-4">
      <input type="number" id="item-eingangqty" class="form-control" value="<?=$edit?$item["item_eingangqty"]:""?>">
      <label>Letzter Wareneingang Menge</label>
    </div>

                        <div class="form-floating mb-4">
      <input type="text" id="item-ruckstand" class="form-control" value="<?=$edit?$item["item_ruckstand"]:""?>">
      <label>Rückstandmenge</label>
    </div>

                <div class="form-floating mb-4">
      <input type="text" id="item-fake" class="form-control" value="<?=$edit?$item["item_fake"]:""?>">
      <label>Fakebestand</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-eknetto" class="form-control" value="<?=$edit?$item["item_eknetto"]:""?>">
      <label>EK-Wert Netto</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-ekgesamt" class="form-control" value="<?=$edit?$item["item_ekgesamt"]:""?>">
      <label>EK-Wert Gesamt</label>
    </div>

                <div class="form-floating mb-4">
      <input type="text" id="item-vpe" class="form-control" value="<?=$edit?$item["item_vpe"]:""?>">
      <label>VPE</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-gewichst" class="form-control" value="<?=$edit?$item["item_gewichst"]:""?>">
      <label>Gewicht pro St.</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-zoll" class="form-control" value="<?=$edit?$item["item_zoll"]:""?>">
      <label>Zolltarifnummer</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-herkunft" class="form-control" value="<?=$edit?$item["item_herkunft"]:""?>">
      <label>Herkunftsland</label>
    </div>

                    <div class="form-floating mb-4">
      <input type="text" id="item-ean" class="form-control" value="<?=$edit?$item["item_ean"]:""?>">
      <label>EAN</label>
    </div>

                <div class="form-floating mb-4">
      <input type="text" id="item-lagerplatz" class="form-control" value="<?=$edit?$item["item_lagerplatz"]:""?>">
      <label>Lagerplatz</label>
    </div>




    <div class="form-floating mb-4">
      <input type="text" class="form-control" id="item-unit" list="item-units" required value="<?=$edit?$item["item_unit"]:""?>">
      <label>Einheit</label>
      <datalist id="item-units">
        <option value="BAG"> <option value="BIN"> <option value="BOX">
        <option value="CAN"> <option value="CAS"> <option value="CNT">
        <option value="CRT"> <option value="CSK"> <option value="CTN">
        <option value="PCS"> <option value="PKG"> <option value="ROL">
      </datalist>
    </div>

    <div class="form-floating mb-4">
      <input type="number" step="0.01" class="form-control" id="item-price" required value="<?=$edit?$item["item_price"]:""?>">
      <label>Einzelpreis</label>
    </div>

    <div class="text-secondary">
      * Geben Sie "0" ein, wenn Sie diesen Artikel nicht überwachen möchten.
      Geben Sie eine Menge von mehr als 0 ein, um ihn im Dashboard zu überwachen.
    </div>
  </div>

      <div class="form-floating mb-1">
      <input type="hidden" id="item-osku" value="<?=$edit?$item["item_sku"]:""?>">
      <input type="text" class="form-control" id="item-sku" required value="<?=$edit?$item["item_sku"]:""?>">
      <label>SKU</label>
    </div>
    <span class="text-secondary" onclick="item.randomSKU()">[Random SKU]</span><br>

  <button type="button" class="my-1 btn btn-danger d-flex-inline" onclick="cb.page(1)">
        </div>
  </div>


    <i class="ico-sm icon-undo2"></i> Zurück
  </button>
  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-checkmark"></i> Speichern
  </button>
</form>
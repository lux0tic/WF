<?php
// (A) MONTH & YEAR
$months = [
  1 => "Januar", 2 => "Februar", 3 => "März", 4 => "April",
  5 => "Mai", 6 => "Juni", 7 => "Juli", 8 => "August",
  9 => "September", 10 => "Oktober", 11 => "November", 12 => "Dezember"
];
$monthNow = date("m");
$yearNow = date("Y");

// (B) HTML
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="mb-3">DOKUMENTE
</h3>
<div class="d-flex flex-wrap">
  <!-- (B1) MOVEMENT CSV -->
  <form class="m-1 p-4 bg-white border" method="post" target="_blank" action="<?=HOST_BASE?>report/movement">
    <div class="fw-bold text-danger mb-2">ARTIKELBEWEGUNG</div>
    <div class="form-floating mb-4">
      <select class="form-select" name="range">
        <option value="A">Alle Artikel</option>
        <option value="S">Zusammenfassung</option>
      </select>
      <label>Bereich</label>
    </div>
    <div class="form-floating mb-4">
      <select name="month" class="form-select"><?php foreach ($months as $m=>$mth) {
        printf("<option value='%u'%s>%s</option>",
          $m, $m==$monthNow?" selected":"", $mth
        );
      } ?></select>
      <label>Monat</label>
    </div>
    <div class="form-floating mb-4">
      <input type="number" name="year" max="<?=$yearNow?>" step="1" class="form-control" required value="<?=$yearNow?>">
      <label>Jahr</label>
    </div>
    <input type="submit" class="w-100 col btn btn-primary" value="CSV">
  </form>

  <!-- (B2) ITEMS LIST -->
  <form class="m-1 p-4 bg-white border" method="post" target="_blank" action="<?=HOST_BASE?>report/items">
    <div class="fw-bold text-danger mb-2">ARTIKELLISTE</div>
    <div class="form-floating mb-4">
      <select class="form-select" name="range">
        <option value="">Alle Artikel</option>
        <option value="M">Nur überwachte Artikel</option>
      </select>
      <label>Bereich</label>
    </div>
    <input type="submit" class="w-100 col btn btn-primary" value="CSV">
  </form>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
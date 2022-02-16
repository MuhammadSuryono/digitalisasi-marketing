<style type="text/css">
  /* CONFIGURED BY ADAM SANTOSO */
  .tbl-spec {
    table-layout: fixed !important; width: 100% !important; word-wrap: break-word !important;
  }
  .tbl-logo {
    text-align: center !important; vertical-align: middle !important;
  }
  .b-t {
    border-top: 1px solid #000 !important;
  }
  .b-b {
    border-bottom: 1px solid #000 !important;
  }
  .b-l {
    border-left: 1px solid #000 !important;
  }
  .b-r {
    border-right: 1px solid #000 !important;
  }
  .b-all {
    border: 1px solid #000 !important;
  }
  .bg-b {
    background: #000 !important; color: #FFF !important; font-weight: bold !important; text-align: center !important;
  }
  .bg-b td{ text-align:center!important }
</style>

<table cellspacing="0" class="tbl-spec">
  <tr>
    <td rowspan="8" class="tbl-logo" width="25%"><img src="<?= base_url('images/logo.png')?>" width="150px" height="150px" /></td>
    <td class="b-t b-l b-r" width="25%">Job Name</td>
    <td class="b-t b-r" width="25%">&nbsp;:&nbsp;</td>
    <td class="b-t b-r" width="10%">Distribusi</td>
    <td class="b-t b-r" width="15%"></td>
  </tr>
  <tr>
    <td class="b-t b-l b-r">Job No</td>
    <td class="b-t b-r">&nbsp;:&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
    <td class="b-t b-r">F. Director</td>
    <td class="b-t b-r">&nbsp;(1)</td>
  </tr>
  <tr>
    <td class="b-t b-l b-r">Date</td>
    <td class="b-t b-r">&nbsp;:&nbsp;</td>
    <td class="b-t b-r">F. Director</td>
    <td class="b-t b-r">&nbsp;(2)</td>
  </tr>
  <tr>
    <td class="b-t b-l b-r">Exec</td>
    <td class="b-t b-r">&nbsp;:&nbsp;</td>
    <td class="b-t b-r">SPV</td>
    <td class="b-t b-r">&nbsp;(3)</td>
  </tr>
  <tr>
    <td class="b-t b-l b-r">R. MGR</td>
    <td class="b-t b-r">&nbsp;:&nbsp;</td>
    <td class="b-t b-r">Fin</td>
    <td class="b-t b-r">&nbsp;(4)</td>
  </tr>
  <tr>
    <td class="b-t b-l b-r">SPV/AFM</td>
    <td class="b-t b-r">&nbsp;:&nbsp;</td>
    <td class="b-t b-r">Coding</td>
    <td class="b-t b-r">&nbsp;(5)</td>
  </tr>
  <tr>
    <td class="b-t b-l b-r">DP</td>
    <td class="b-t b-r">&nbsp;:&nbsp;</td>
    <td class="b-t b-r">DP</td>
    <td class="b-t b-r">&nbsp;(6)</td>
  </tr>
  <tr>
    <td class="b-t b-l b-r"></td>
    <td class="b-t b-r"></td>
    <td class="b-t b-r">Puncher</td>
    <td class="b-t b-r">&nbsp;(7)</td>
  </tr>
  <tr class="bg-b">
    <td class="b-t b-l" width="25%"><b>Schedule Details</b></td>
    <td class="b-t b-l b-r" width="25%"><b>Date</b></td>
    <td class="b-t b-r" width="25%"><b>Schedule Details</b></td>
    <td class="b-t b-r" colspan="2" width="25%"><b>Date</b></td>
  </tr>
  <?php
  error_reporting(0);
  for ($i=0; $i < $bagi ; $i++) {
    echo '<tr><td class="b-t b-l">'.$listPP[0][$i]['nk'].'</td><td class="b-t b-l b-r">'.$listPP[0][$i]['dt'].' - '.$listPP[0][$i]['ft'].'</td><td class="b-t b-r">'.$listPP[1][$i]['nk'].'</td><td class="b-t b-r" colspan="2">'.$listPP[1][$i]['dt'].' - '.$listPP[1][$i]['ft'].'</td></tr>';
  } ?>
  <tr>
    <td class="b-all" colspan="5">KET</td>
  </tr>
  <tr>
    <td class="b-b b-l b-r" colspan="5">
      <table width="100%">
        <tr>
          <td class="text-center" width="33.3%">Checked by:</td>
          <td class="b-l b-r text-center" width="33.3%">Checked by:</td>
          <td class="text-center" width="33.3%">Checked by:</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

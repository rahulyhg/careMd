<?php

error_reporting(E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR);
require('./roots.php');

require($root_path . 'include/inc_environment_global.php');
require($root_path . 'include/care_api_classes/class_tz_pharmacy.php');

define('NO_2LEVEL_CHK', 1);
require($root_path . 'include/inc_front_chain_lang.php');



$debug = FALSE;
// Endable db-debugging if variable debug is true
($debug) ? $db->debug = TRUE : $db->debug = FALSE;

$product_obj = new Product();
$product_obj->usePriceDescriptionTable();


require_once($root_path . 'main_theme/head.inc.php');
require_once($root_path . 'main_theme/header.inc.php');
require_once($root_path . 'main_theme/topHeader.inc.php');

?>

<html>
  <head>
    <title>-</title>
    <meta
      name="Description"
      content="Hospital and Healthcare Integrated Information System - CARE2x"
    />
    <meta name="Author" content="Robert Meggle" />
    <meta
      name="Generator"
      content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder"
    />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <script language="javascript">
      <!--
      function gethelp(x,s,x1,x2,x3,x4)
      {
          if (!x) x="";
          urlholder="../../main/help-router.php?sid=<?php echo $sid."&lang=".$lang;?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
          helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
          window.helpwin.moveTo(0,0);
      }
      // -->
    </script>
    <link
      rel="stylesheet"
      href="../../css/themes/default/default.css"
      type="text/css"
    />
    <script language="javascript" src="../../js/hilitebu.js"></script>

    <style type="text/css">
     .text-right {
        text-align: right;
     }
    </style>
    <script language="JavaScript">
      <!--
      function popPic(pid,nm){

       if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php $sid ?>&lang=<?php $lang ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

      }
      // -->
    </script>
  </head>
</html>


<body bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066">
  <table width="100%" border="0" cellspacing="0">
    <tbody class="main">
      <tr>
        <td valign="top" align="middle" height="35">
          <table cellspacing="0" class="titlebar" border="0">
            <tr valign="top" class="titlebar">
              <td bgcolor="#99ccff">
                &nbsp;&nbsp;<font color="#330066"
                  >NHIF Prices</font
                >
              </td>
              <td bgcolor="#99ccff" align="right">
                <a href="javascript:window.history.back()"
                  ><img
                    src="../../gui/img/control/default/en/en_back2.gif"
                    border="0"
                    width="110"
                    height="24"
                    alt=""
                    style="filter:alpha(opacity=70)"
                    onMouseover="hilite(this,1)"
                    onMouseOut="hilite(this,0)"/></a
                ><a
                  href="javascript:gethelp('pharmacy_product_menu.php','Pharmacy :: My Product Catalog')"
                  ><img
                    src="../../gui/img/control/default/en/en_hilfe-r.gif"
                    border="0"
                    width="75"
                    height="24"
                    alt=""
                    style="filter:alpha(opacity=70)"
                    onMouseover="hilite(this,1)"
                    onMouseOut="hilite(this,0)"/></a
                ><a href="pharmacy_tz.php"
                  ><img
                    src="../../gui/img/control/default/en/en_close2.gif"
                    border="0"
                    width="103"
                    height="24"
                    alt=""
                    style="filter:alpha(opacity=70)"
                    onMouseover="hilite(this,1)"
                    onMouseOut="hilite(this,0)"
                /></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>

    </tbody>

  </table>

<?php 

$hospitalCode = 0;
$sql="SELECT value FROM  care_config_global WHERE type = 'main_info_facility_code' ";
$hospQuery = $db->Execute($sql);

while ($hospital_datail=$hospQuery->FetchRow()) {
  $hospitalCode = $hospital_datail['value'];
}

$drugSQL = "SELECT item_id, item_number, item_description, unit_price_1, unit_price_2, nhif_item_code  FROM  care_tz_drugsandservices ";
$drugQuery = $db->Execute($drugSQL);


?>
  <div style="margin: 10px;">
      <button class="btn btn-success btn-md updateNHIFBtn" onclick="updateNHIFPrices();">Update Prices</button>
  </div>


  <div style="margin: 10px;">
      
    <table class="table datatable3 table-condensed table-striped table-bordered table-hover">
        <thead>
            <tr>
                <td>SN</td>
                <td>Item Number</td>
                <td>Item Description</td>
                <td>Standard NHIF Price</td>
                <td>Bunge NHIF Price</td>
                <td>Item Code</td>
            </tr>
        </thead>
        <tbody>
            <?php 

                while ($drug= $drugQuery->FetchRow()) {

                    echo "<tr>
                        <td>". $drug['item_id']."</td>
                        <td>". $drug['item_number']."</td>
                        <td>". $drug['item_description']."</td>
                        <td class='text-right'>". number_format($drug['unit_price_1'], 2)."</td>
                        <td class='text-right'>". number_format($drug['unit_price_2'], 2)."</td>
                        <td class='text-right'>". $drug['nhif_item_code']."</td>
                    </tr>";

                }
             ?>

        </tbody>
    </table>
  </div>
</body>

<?php

require_once($root_path . 'main_theme/footer.inc.php');


?>

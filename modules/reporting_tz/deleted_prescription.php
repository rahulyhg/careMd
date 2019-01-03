<?php


require('./roots.php');
require($root_path . 'include/inc_environment_global.php');

define('LANG_FILE', 'reporting.php');
require($root_path . 'include/inc_front_chain_lang.php');


require_once($root_path . 'main_theme/head.inc.php');
require_once($root_path . 'main_theme/header.inc.php');
require_once($root_path . 'main_theme/topHeader.inc.php');


require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

require_once($root_path . 'include/care_api_classes/class_tz_reporting.php');

require_once($root_path . 'include/care_api_classes/class_tz_insurance.php');
require_once($root_path . 'include/care_api_classes/class_ward.php');

$ward_obj = new Ward;
$rep_obj = new selianreport();
$insurance_obj = new Insurance_tz;

$items = 'nr,name';
$TP_SELECT_BLOCK_IN = '';
$ward_info = $ward_obj->getAllWardsItemsObject($items);

$TP_SELECT_BLOCK_IN.='<select name="current_ward_nr" size="1"><option value="all_ipd">all</option>';
if (!empty($ward_info) && $ward_info->RecordCount()) {
    while ($station = $ward_info->FetchRow()) {
        $TP_SELECT_BLOCK_IN.='
                                <option value="' . $station['nr'] . '" ';
        if (isset($current_ward_nr) && ($current_ward_nr == $station['nr']))
            $TP_SELECT_BLOCK.='selected';
        $TP_SELECT_BLOCK_IN.='>' . $station['name'] . '</option>';
    }
}
$TP_SELECT_BLOCK_IN .= '</select>';

require_once($root_path . 'include/care_api_classes/class_department.php');
$dept_obj = new Department;
$medical_depts = $dept_obj->getAllMedical();
$TP_SELECT_BLOCK = '<select name="dept_nr" size="1"><option value="all_opd">all</option>';
$later_depts = $medical_depts;

while (list($x, $v) = each($medical_depts)) {
    $TP_SELECT_BLOCK.='
    <option value="' . $v['nr'] . '">';
    $buffer = $v['LD_var'];
    if (isset($$buffer) && !empty($$buffer))
        $TP_SELECT_BLOCK.=$$buffer;
    else
        $TP_SELECT_BLOCK.=$v['name_formal'];
    $TP_SELECT_BLOCK.='</option>';
}
$TP_SELECT_BLOCK.='</select>';



use  CareMd\CareMd\CareUsersQuery;
use  CareMd\CareMd\CareUserRolesQuery;

$userId = $_SESSION['sess_login_userid'];

$user = CareUsersQuery::create()->filterByLoginId($userId)->findOne()->toArray();
$roleId = $user['RoleId'];
// $roleId = 13;

$userRole = CareUserRolesQuery::create()->filterByRoleId($roleId)->findOne()->toArray();
$themeName = $user['ThemeName'];

$userPermissions = explode(" ", $userRole['Permission']);


$userPermissions = str_replace('_a_1_', '', $userPermissions);
$userPermissions = str_replace('_a_2_', '', $userPermissions);
$userPermissions = str_replace('_a_3_', '', $userPermissions);
$userPermissions = str_replace('_a_4_', '', $userPermissions);

$showFinancialReport = false;

foreach ($userPermissions as $permission) {

    if ($permission == "financialreportingread" || $permission == "allreportingread" ) {
        $showFinancialReport = true;
    }
}


if ($userPermissions[0] == "System_Admin" || $userPermissions[0] == "_a_0_all " || $userPermissions[0] == "_a_0_all")  {
    $showFinancialReport = true;
}


$debug = FALSE;
$PRINTOUT = FALSE;
$EXPORT = FALSE;

if(isset($_POST['show'])){
    $msg="";
    $error=FALSE;
    if($_POST['date_from']=="" || $_POST['date_to']==""){

       $msg="PLEASE ENTER DATE";
       $error=TRUE;
       

    } else if($_POST['date_from']>$_POST['date_to']){
        $msg="DATE FROM MUST BE GREATER";
        $error=TRUE;

    }else{

       $MysqlDateFrom= @formatDate2STD($_POST['date_from'],$date_format);
       $MysqlDateTo=@formatDate2STD($_POST['date_to'],$date_format);
       

       switch ($_POST['insurance']) {
           case '-2':
               $insurance="";
               $ins_name='All Insurance Companies';
               break;
           case '-1':
               $insurance="AND insurance_id=".'0'; 
               $ins_name='CASH';   
                   break; 

           
           default:
               $insurance="AND insurance_id=".$_POST['insurance'];
               $sql_insurancename = "SELECT name FROM care_tz_company where id='".$_POST['insurance']."'";
                $insurance_name = $db->Execute($sql_insurancename);
                $sql_insurancename = $insurance_name->FetchRow();
                $ins_name = $sql_insurancename['name'];
               break;
       }

     switch ($_POST['admission_id']) {
         case 'all_opd_ipd':
             $admission="";
             $admissionname='All OPD and IPD';
             break;
         case '1':
         if($_POST['current_ward_nr']=='all_ipd'){
            $admission="AND encounter_class_nr=".'1';
            $admissionname='All IPD';
         }else{
            $admission="AND current_ward_nr =".$_POST['current_ward_nr']; 
            $sql_ward_name="SELECT name FROM care_ward WHERE nr=".$_POST['current_ward_nr'];
            $result=$db->Execute($sql_ward_name);
            if($wname=$result->FetchRow()){
                $admissionname=$wname['name'];
                
            }
            
         }  
         break;

         case '2':
            if ($_POST['dept_nr']=='all_opd') {
                $admission="AND encounter_class_nr=".'2';
                $admissionname='All OPD';
              }else{
                $admission="AND current_dept_nr=".$_POST['dept_nr'];
                $sql_dept_name="SELECT name_formal FROM care_department WHERE nr=".$_POST['dept_nr'];
                $result=$db->Execute($sql_dept_name);
                if($row_deptname=$result->FetchRow()){
                  $admissionname=$row_deptname['name_formal'];

                }

              }  
               break;  
         
         default:
             $admission="";
             break;
     }



    }

}


?>

 <table cellspacing="0"  class="titlebar" border=0>
    <tr valign=top  class="titlebar" >
        <td width="202" bgcolor="#99ccff" >
            &nbsp;&nbsp;<font color="#330066"><?php echo $LDConsumption; ?></font></td>
        <td width="408" align=right bgcolor="#99ccff">
            <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)" ></a>
            <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>
            <a href="<?php echo $root_path; ?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>  
        </td>
    </tr>
</table>
<?php  require_once($root_path . 'main_theme/reportingNav.inc.php'); ?>

<?php

require_once($root_path . 'main_theme/footer.inc.php');
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
    <HEAD>
        <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
        <meta name="Author" content="Robert Meggle">
        <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

        <script language="javascript" >
<!-- 
            function gethelp(x, s, x1, x2, x3, x4)
            {
                if (!x)
                    x = "";
                urlholder = "../../main/help-router.php?sid=<?php echo sid; ?>&lang=$lang&helpidx=" + x + "&src=" + s + "&x1=" + x1 + "&x2=" + x2 + "&x3=" + x3 + "&x4=" + x4;
                helpwin = window.open(urlholder, "helpwin", "width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
                window.helpwin.moveTo(0, 0);
            }
            function printOut(admission_id, dept, insurance)
            {
                urlholder = "./DetailedRevenue.php?printout=TRUE&start=<?php echo $selected_date_from; ?>&end=<?php echo $selected_date_to; ?>&company=<?php echo $company; ?>&in_out_patient=" + admission_id + "&dept_nr=" + dept + "&insurance=" + insurance;
                testprintout = window.open(urlholder, "printout", "width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                window.testprintout.moveTo(0, 0);
            }

        </script> 

        <script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
        <script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
        <script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
        <script src="<?php print $root_path; ?>/include/_jquery.js" language="javascript"></script> 

        <link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
        <script language="javascript" src="../../js/hilitebu.js"></script>

        <STYLE TYPE="text/css">
            A:link  {color: #000066;}
            A:hover {color: #cc0033;}
            A:active {color: #cc0000;}
            A:visited {color: #000066;}
            A:visited:active {color: #cc0000;}
            A:visited:hover {color: #cc0033;}

            .report{
                font-size: 10px;
                border-collapse:collapse;
            }


        </style>
        <script language="JavaScript">
            <!--
        function popPic(pid, nm) {

                if (pid != "")
                    regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid; ?>&lang=$lang&pid=" + pid + "&nm=" + nm, "regpicwin", "toolbar=no,scrollbars,width=180,height=250");

            }
            // -->
        </script>

        <script language="JavaScript">
            function popdepts() {
                var x = document.getElementById("admission_id").value;
                if (x == 1) {
                    document.getElementById("dept").innerHTML =<?php echo json_encode($TP_SELECT_BLOCK_IN); ?>

                } else if (x == 2) {
                    document.getElementById("dept").innerHTML =<?php echo json_encode($TP_SELECT_BLOCK); ?>
                } else if (x == "all_opd_ipd") {

                    document.getElementById("dept").innerHTML = "all_opd_ipd";
                }
            }
        </script>	
        <script type="text/javascript">
        function popcomp(){
            var compvalue=document.getElementById("comp").value;
            if(compvalue=="1"){
                document.getElementById("comp_show").innerHTML="";

            }else if(compvalue=="2"){
                document.getElementById("comp_show").innerHTML=<?php echo json_encode($insurance_obj->ShowAllInsurancesForQuotatuion()); ?>
            }
        }
            
        </script>	 
        <script language="JavaScript">
            
            function validate() {
                var datefrom=document.getElementById("date_from").value;
                var dateto=document.getElementById("date_to").value;
                var healthfund=document.getElementById("insurance").value;
                var comp=document.getElementById("comp").value;

                
                if(datefrom==""){
                    alert("INCORRECT DATE");
                    return false;
                }


            }

        </script>
    </HEAD>

    <BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

        <!-- START HEAD OF HTML CONTENT -->
        <table width=100% border=0 cellspacing=0>
            <tbody class="main">

                <tr>
                    <td  valign="top" align="middle" height="35">
                        <table cellspacing="0"  class="titlebar" border=0>
                            <tr valign=top  class="titlebar" >
                                <td width="202" bgcolor="#99ccff" >
                                    &nbsp;&nbsp;<font color="#330066"><?php echo $LDConsumption; ?></font></td>
                                <td width="408" align=right bgcolor="#99ccff">
                                    <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)" ></a>
                                    <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>
                                    <a href="<?php echo $root_path; ?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>  
                                </td>
                            </tr>
                        </table>

                          <form name="form1" method="post" action="" onSubmit="return validate();">


                            <?php require_once($root_path . $top_dir . 'include/inc_gui_timeframe_cash_credit.php'); ?>
                            <?php
                            if (isset($_POST['show'])) {           
                                if($error==FALSE){

                                   $rep_obj->drug_consumption($MysqlDateFrom,$MysqlDateTo,$insurance,$admission);

                                    
                                    

                                }


                                
                                                          
                                

                                //$rep_obj->drug_consumption($selected_date_from, $selected_date_to, $company, $_POST['admission_id']);
                            }
                            ?>
                            <!-- &nbsp;&nbsp;
                             <a href="./gui/downloads/detailed_revenue.csv"><img border=0 src=<?php //echo $root_path;                 ?>/gui/img/common/default/savedisk.gif></a>-->
                        </form>
                        
                        <?php  require_once($root_path . 'main_theme/reportingNav.inc.php'); ?>

                       

                </TR>
            </TBODY>
        </TABLE>
    </body>
</html>










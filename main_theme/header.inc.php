<?php

require('./roots.php');

require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

use  CareMd\CareMd\CareUsersQuery;
use  CareMd\CareMd\CareUserRolesQuery;

if (empty($_SESSION['sess_login_userid'])) {
  header("location: " . $root_path . "?is_logged_out=1");
  exit;
}


$sql="SELECT nr,sort_nr,name,LD_var AS \"LD_var\",url,is_visible FROM care_menu_main WHERE is_visible=1 OR LD_var='LDEDP' OR LD_var='LDLogin' ORDER by sort_nr";

$result=$db->Execute($sql);
$navigationMenus = [];
$userNavigationMenus = [];

if($result){

    include_once($root_path.'main/menu/big_icon/tags.php');

    while($menu=$result->FetchRow()){

        if (preg_match('/LDLogin/i',$menu['LD_var'])){
            if ($_COOKIE['ck_login_logged'.$sid]=='true'){
              $menu['url']='main/logout_confirm.php';
              $menu['LD_var']='LDLogout';
            }
        }

        if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])){
          $name = $$menu['LD_var'];
        }else{
          $name = $menu['name'];
        }

        $menu = array(
            'name' => $name,
            'url' => $root_path.$menu['url'].URL_APPEND,
        );

        if ($menu['name'] == "Appointments") {
          array_push($navigationMenus, array('name' => 'Discharge', 'url' =>$root_path. "modules/ambulatory/amb_clinic_patients_discharge.php" . URL_APPEND ));
        }


        array_push($navigationMenus, $menu);

    }
    
}

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

if ($userPermissions[0] == "System_Admin" || $userPermissions[0] == "_a_0_all " || $userPermissions[0] == "_a_0_all")  {
  $userNavigationMenus = $navigationMenus;

}else{

  foreach ($navigationMenus as $navigationMenu) {
    if($navigationMenu['name'] == "Home"){
      array_push($userNavigationMenus, $navigationMenu);
    }

    if ($navigationMenu['name'] == "Registration" || $navigationMenu['name'] == "Discharge") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "admissionwrite" || $userPermission == "admissionread" || $userPermission == "archiveread" || $userPermission == "aarreadwrite") {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Ambulatory") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "outpwrite" || $userPermission == "outpread") {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Nursing") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "nursingstationallwrite" || $userPermission == "nursingstationallread" || $userPermission == "nursingdutyplanwrite" || $userPermission == "nursingdutyplanread")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Inpatient") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "diagnosticsresultwrite" || $userPermission == "diagnosticsresultread" || $userPermission == "diagnosticsreceptionwrite" || $userPermission == "diagnosticsrequest")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Doctors") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "medocswrite" || $userPermission == "medocsread" || $userPermission == "meddepotdbadmin" || $userPermission == "meddepotreception"  || $userPermission == "meddepotorder"  || $userPermission == "meddepotread"  || $userPermission == "doctorsdutyplanwrite"  || $userPermission == "doctorsdutyplanread")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Radiology") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "photowrite" || $userPermission == "photoread")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Radiology") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "photowrite" || $userPermission == "photoread" || $userPermission == "diagnosticsreceptionwrite" || $userPermission == "diagnosticsrequest")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Billing") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "billallwrite" || $userPermission == "billallread" || $userPermission == "billquotations" || $userPermission == "billquotationsoutp" || $userPermission == "billquotationsinp" || $userPermission == "billquotationsden" || $userPermission == "billreports")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

     if ($navigationMenu['name'] == "Pharmacy") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "pharmadbadmin" || $userPermission == "pharmareception" || $userPermission == "pharmaorder" || $userPermission == "pharmaread")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Reporting") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "billreports" || $userPermission == "allreportingread" || $userPermission == "reportingread" || $userPermission == "clinicreportingread"  || $userPermission == "financialreportingread" || $userPermission == "systemreportingread" )  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Special Tools") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "newsallwrite" || $userPermission == "newscafewrite" || $userPermission == "newsallmoderatedwrite" || $userPermission == "clinicreportingread"  || $userPermission == "financialreportingread" || $userPermission == "systemreportingread" )  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Intranet Email") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "hxpserver")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Directory") {
      foreach ($userPermissions as $userPermission) { 
        if ($userPermission == "teldirwrite")  {
          array_push($userNavigationMenus, $navigationMenu);
        }
      }
    }

    if ($navigationMenu['name'] == "Logout") {
      array_push($userNavigationMenus, $navigationMenu);
    }

  }

}

    array_push($userNavigationMenus, array('name' => 'Accounting & Stock', 'url' => "http://localhost/weberp"));


 // echo "<pre>"; print_r($userPermissions);echo "</pre>";

// die();

$userNavigations = array_unique($userNavigationMenus, SORT_REGULAR);

?>


  
    <div class="sidebar" data-color="azure" data-background-color="white">

      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal" style="text-transform: none;">
          CareMd
        </a>
      </div>
      <div class="sidebar-wrapper nav-scroll backgroundOne " >
        <ul class="nav" >

          <?php foreach ($userNavigations as $menu): ?>
            <?php if ($menu['name'] == "Home"): ?>
            <li class="nav-item colorOne <?php if($pageName == "Home") echo 'active'; ?> " >
              <a class="nav-link " href="<?php echo $root_path ?>modules/dashboard/dashboard.php<?php echo URL_APPEND ?>">
               
                <p class="colorOne" > <i class="fa fa-home fa-fw"></i><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Registration"): ?>
            <li class="nav-item colorOne <?php if($pageName == "Registration") echo 'active'; ?> " >
              <a class="nav-link " href="<?php echo $menu['url'] ?>" >
                 <i class="fa fa-user fa-fw"></i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Discharge"): ?>
            <li class="nav-item  <?php if($pageName == "Discharge") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">check_circle_outline</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Patient" || $menu['name'] == "Patient/ID"): ?>
            <li class="nav-item <?php if($pageName == "Patient") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">perm_identity</i>
                <p class="colorOne">Registration</p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Appointments"): ?>
            <li class="nav-item <?php if($pageName == "Appointments") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">calendar_today</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>   

            <?php elseif ($menu['name'] == "Ambulatory"): ?>
            <li class="nav-item <?php if($pageName == "Ambulatory") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">departure_board</i>
                <p class="colorOne">Outpatient</p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Inpatient"): ?>
            <li class="nav-item <?php if($pageName == "Inpatient") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">airline_seat_flat</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>   

            <?php elseif ($menu['name'] == "Doctors"): ?>
            <li class="nav-item <?php if($pageName == "Doctors") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">streetview</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li> 

            <?php elseif ($menu['name'] == "Nursing"): ?>
            <li class="nav-item <?php if($pageName == "Nursing") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">exposure</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "OR"): ?>
            <li class="nav-item <?php if($pageName == "OR") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">account_balance</i>
                <p class="colorOne">OP Room</p>
              </a>
            </li>
            
            <?php elseif ($menu['name'] == "Laboratories"): ?>
            <li class="nav-item <?php if($pageName == "Laboratories") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">gavel</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Radiology"): ?>
            <li class="nav-item <?php if($pageName == "Radiology") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">picture_in_picture</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Pharmacy"): ?>
            <li class="nav-item <?php if($pageName == "Pharmacy") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">enhanced_encryption</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Billing"): ?>
            <li class="nav-item <?php if($pageName == "Billing") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">art_track</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Reporting"): ?>
            <li class="nav-item <?php if($pageName == "Reporting") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">file_copy</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Directory"): ?>
            <li class="nav-item <?php if($pageName == "Directory") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">list</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "System Admin"): ?>
            <li class="nav-item <?php if($pageName == "System Admin") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">settings</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Intranet Email"): ?>
            <li class="nav-item <?php if($pageName == "Intranet Email") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">email</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Special Tools"): ?>
            <li class="nav-item <?php if($pageName == "Special Tools") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">perm_data_setting</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>


            <?php elseif ($menu['name'] == "Referrer Notes"): ?>
            <li class="nav-item <?php if($pageName == "Referrer Notes") echo 'active'; ?> ">
              <a class="nav-link"  href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">perm_data_setting</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Login"): ?>
            <li class="nav-item <?php if($pageName == "Login") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">lock</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Accounting & Inventory"): ?>
            <li class="nav-item <?php if($pageName == "Accounting & Inventory") echo 'active'; ?> ">
              <a class="nav-link" target="_blank" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">shop_two</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Logout"): ?>
            <li class="nav-item <?php if($pageName == "Logout") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons colorOne">exit_to_app</i>
                <p class="colorOne"><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php else: ?>
            <li class="nav-item ">
            <a class="nav-link"  href="<?php echo $menu['url'] ?>">
              <i class="material-icons colorOne">dashboard</i>
              <p class="colorOne"><?php echo $menu['name'] ?></p>
            </a>
            </li>
          <?php endif ?>
          <?php endforeach ?>
        
        </ul>
      </div>
    </div>
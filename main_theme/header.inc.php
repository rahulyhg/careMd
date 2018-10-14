<?php

require('./roots.php');

$sql="SELECT nr,sort_nr,name,LD_var AS \"LD_var\",url,is_visible FROM care_menu_main WHERE is_visible=1 OR LD_var='LDEDP' OR LD_var='LDLogin' ORDER by sort_nr";

$result=$db->Execute($sql);
$navigationMenus = [];

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


?>

<body class="">
  <div class="wrapper ">



    <div class="sidebar sidebar-colored" data-color="azure" data-background-color="white">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal" style="text-transform: none;">
          CareMd
        </a>
      </div>
      <div class="sidebar-wrapper nav-scroll">
        <ul class="nav">

          <?php foreach ($navigationMenus as $menu): ?>
            <?php if ($menu['name'] == "Home"): ?>
            <li class="nav-item <?php if($pageName == "Home") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $root_path ?>modules/dashboard/dashboard.php<?php echo URL_APPEND ?>">
                <i class="material-icons">dashboard</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Registration"): ?>
            <li class="nav-item  <?php if($pageName == "Registration") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">perm_identity</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Discharge"): ?>
            <li class="nav-item  <?php if($pageName == "Discharge") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">check_circle_outline</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Patient" || $menu['name'] == "Patient/ID"): ?>
            <li class="nav-item <?php if($pageName == "Patient") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">perm_identity</i>
                <p>Registration</p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Appointments"): ?>
            <li class="nav-item <?php if($pageName == "Appointments") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">calendar_today</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>   

            <?php elseif ($menu['name'] == "Ambulatory"): ?>
            <li class="nav-item <?php if($pageName == "Ambulatory") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">departure_board</i>
                <p>Outpatient</p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Inpatient"): ?>
            <li class="nav-item <?php if($pageName == "Inpatient") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">airline_seat_flat</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>   

            <?php elseif ($menu['name'] == "Doctors"): ?>
            <li class="nav-item <?php if($pageName == "Doctors") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">streetview</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li> 

            <?php elseif ($menu['name'] == "Nursing"): ?>
            <li class="nav-item <?php if($pageName == "Nursing") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">exposure</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "OR"): ?>
            <li class="nav-item <?php if($pageName == "OR") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">account_balance</i>
                <p>OP Room</p>
              </a>
            </li>
            
            <?php elseif ($menu['name'] == "Laboratories"): ?>
            <li class="nav-item <?php if($pageName == "Laboratories") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">gavel</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Radiology"): ?>
            <li class="nav-item <?php if($pageName == "Radiology") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">picture_in_picture</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Pharmacy"): ?>
            <li class="nav-item <?php if($pageName == "Pharmacy") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">enhanced_encryption</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Billing"): ?>
            <li class="nav-item <?php if($pageName == "Billing") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">art_track</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Reporting"): ?>
            <li class="nav-item <?php if($pageName == "Reporting") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">file_copy</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Directory"): ?>
            <li class="nav-item <?php if($pageName == "Directory") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">list</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "System Admin"): ?>
            <li class="nav-item <?php if($pageName == "System Admin") echo 'active'; ?> ">
              <a class="nav-link" target="_blank" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">settings</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Intranet Email"): ?>
            <li class="nav-item <?php if($pageName == "Intranet Email") echo 'active'; ?> ">
              <a class="nav-link" target="_blank" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">email</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Special Tools"): ?>
            <li class="nav-item <?php if($pageName == "Special Tools") echo 'active'; ?> ">
              <a class="nav-link" target="_blank" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">perm_data_setting</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>


            <?php elseif ($menu['name'] == "Referrer Notes"): ?>
            <li class="nav-item <?php if($pageName == "Referrer Notes") echo 'active'; ?> ">
              <a class="nav-link"  href="<?php echo $menu['url'] ?>">
                <i class="material-icons">perm_data_setting</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Login"): ?>
            <li class="nav-item <?php if($pageName == "Login") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">lock</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php elseif ($menu['name'] == "Logout"): ?>
            <li class="nav-item <?php if($pageName == "Logout") echo 'active'; ?> ">
              <a class="nav-link" href="<?php echo $menu['url'] ?>">
                <i class="material-icons">exit_to_app</i>
                <p><?php echo $menu['name'] ?></p>
              </a>
            </li>

            <?php else: ?>
            <li class="nav-item ">
            <a class="nav-link"  href="<?php echo $menu['url'] ?>">
              <i class="material-icons">dashboard</i>
              <p><?php echo $menu['name'] ?></p>
            </a>
            </li>
          <?php endif ?>
          <?php endforeach ?>
        
        </ul>
      </div>
    </div>
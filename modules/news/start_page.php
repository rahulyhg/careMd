<?php

error_reporting(E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path . 'include/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org,
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define('LANG_FILE', 'startframe.php');
define('NO_CHAIN', 1);

require_once($root_path . 'include/inc_front_chain_lang.php');

$cksid = 'ck_sid' . $sid;
if (!$_COOKIE[$cksid] && !$cookie) {
    header("location:" . $root_path . "cookies.php?lang=$lang&startframe=1");
    exit;
}
$_SESSION['sess_news_nr'] = '';
if (!isset($_SESSION['sess_news_nr']))
    $_SESSION['sess_news_nr'];

$readerpath = 'headline-read.php?sid=' . $sid . '&lang=' . $lang;
# reset all 2nd level lock cookies
require($root_path . 'include/inc_2level_reset.php');

$dept_nr = 1; # 1 = press relations
# Get the maximum number of headlines to be displayed
$config_type = 'news_headline_max_display';
include($root_path . 'include/inc_get_global_config.php');

if (!isset($news_headline_max_display) || !$news_headline_max_display)
    $news_num_stop = 3;# default is 3
else
    $news_num_stop = $news_headline_max_display;# The maximum number of news article to be displayed
//include($root_path.'include/inc_news_get.php'); // now get the current news
$thisfile = basename($_SERVER['PHP_SELF']);
require_once($root_path . 'include/care_api_classes/class_news.php');
$newsobj = new News;
$news = $newsobj->getHeadlinesPreview($dept_nr, $news_num_stop);

# Set initial session environment for this module
$_SESSION['sess_file_editor'] = '';
$_SESSION['sess_file_reader'] = '';
if (!isset($_SESSION['sess_file_editor']))
    $_SESSION['sess_file_editor'];
if (!isset($_SESSION['sess_file_reader']))
    $_SESSION['sess_file_reader'];



$_SESSION['sess_file_break'] = $top_dir . $thisfile;
$_SESSION['sess_file_return'] = $top_dir . $thisfile;
$_SESSION['sess_file_editor'] = 'headline-edit-select-art.php';
$_SESSION['sess_file_reader'] = 'headline-read.php';
$_SESSION['sess_dept_nr'] = '1'; // 1= press relations dept
$_SESSION['sess_title'] = $LDEditTitle . '::' . $LDSubmitNews;
$_SESSION['sess_user_origin'] = 'main_start';
$_SESSION['sess_path_referer'] = $top_dir . $thisfile;

$readerpath = 'headline-read.php' . URL_APPEND;
# Load the news display configs
require_once($root_path . 'include/inc_news_display_config.php');

# Start Smarty templating here
/**
 * LOAD Smarty
 */
# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme

require_once($root_path . 'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('common');

# Hide the title bar
$smarty->assign('bHideTitleBar', TRUE);

# Window title
$smarty->assign('title', isset($LDPageTitle));

$smarty->assign('news_normal_display_width', $news_normal_display_width);

# Headline title
$smarty->assign('LDHeadline', $LDHeadline);

$smarty->assign('sOnLoadJs', 'onLoad="window.parent.STARTPAGE.location.href=\'' . $root_path . 'main/indexframe.php?sid=' . $sid . '&lang=' . $lang . '\';"');


#Collect html code

/**
 * Routine to display the headlines
 */





# Collect html for the submenu blocks

ob_start();

include($root_path . 'include/inc_rightcolumn_menu.php');

# Stop buffering, get contents

$sTemp = ob_get_contents();

ob_end_clean();

# assign contents to subframe

$smarty->assign('sSubMenuBlock', $sTemp);




# Assign the subframe template file name to mainframe

//$smarty->assign('sMainBlockIncludeFile', 'news/headline.tpl');
?>

<TABLE CELLSPACING=3 cellpadding=0 border="0" width="{{$news_normal_display_width}}">

    <tr>
        <td VALIGN="top" width="100%">

            <table width=100%>
    <tr>
        <td>
            <table border=0 bgcolor=#cfcfcf cellpadding=1 cellspacing=0 width="100%">
<tr>
<td>

<table border=0 bgcolor=#ffffff cellpadding=1 cellspacing=0 width="100%">
<tr>
<td>
<font size=6 color=#800000>
<b>DASH BOARD</b>
</font>
</td>
</tr>
</table>

</td>
</tr>
</table>
        </td>
    </tr>

    <tr valign=top>
        <td>


        
  
    <script type="text/javascript" src="../../js/graph_loader/line_graph.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Nhif', 'Cash','AAR','Jubilee'],
          ['Jan',  1000,      400, 300, 1000],
          ['Feb',  1170,      460, 400,500],
          ['mar',  660,       1120, 230,350],
          ['apr',  1030,      540,260,410],
          ['june',  1030,      540,260,410],
          ['july',  1030,      540,260,410],
          ['aug',  1030,      540,260,410],
          ['sept',  1030,      540,260,410],
          ['nov',  1030,      540,260,410],
          ['dec',  1030,      540,260,700],
        ]);

        var options = {
          title: 'Patient Trends',
          curveType: 'function',
          legend: {position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

     <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  
  <body>
    
    <div id="curve_chart" style="width: 500px; height: 150px"></div>  
    <hr>    
        
        
        

    <div id="piechart_3d" style="width: 550px; height: 150px;"></div>
    <hr>


            
     </td>   
    </tr>

    <tr valign=top>
        <td>
            
            <hr>
        </td>
    </tr>

    <tr valign=top>
        <td>
            
            <hr>
        </td>
    </tr>

</table>

        </td>
        <!--      Vertical spacer column      -->
        <TD   width=1  background="../../gui/img/common/biju/vert_reuna_20b.gif">&nbsp;</TD>

        <TD VALIGN="top">

            {{$sSubMenuBlock}}

        </TD>
    </tr>
</table>
</body>
<?php


/**
 * show Template
 */
$smarty->display('common/mainframe.tpl');
?>

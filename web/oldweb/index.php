<?php

dir(dirname(__FILE__));
set_include_path("./:../../:../");

// include configuration
require_once('../../etc/config.inc');
// include functions
require_once('webfuncs.inc');

function main_menu()
{
   $text=<<<EOF
         <hr />
         <h2>End-device administration:</h2>
         <ul>
            <li><a href="find.php">Finding PCs/ Devices</a></li>
         </ul>
         <h2>Reporting</h2>
	 <ul>
            <li><a href="hubs.php">Hub finder</a>: list ports with more than one end-device</li>
            <li><a href="stats.php">Statistics</a>: End_devices per class/OS/VLAN</li>
            <li>Cable + switch port usage: <a href="vmps.php">one switch</a>, <a href="allvmps.php">all switches</a></li>
         </ul>
	 <h2>Monitoring</h2>
	<ul>
		<li><a href="../phpsysinfo/">System information</a>
		<li><a href="logtail.php">Log file</a>
	</ul>
EOF;
   return $text;
}

if ($ad_auth===true)
{
   $rights=user_rights($_SERVER['PHP_AUTH_USER']);
   if ($rights>=1)
   {
      echo header_read();
      echo main_stuff();
      echo "<div align=\"right\">Rights: <strong>";
      if ($rights == 99)
         echo "Administrator";
      else if ($rights == 2)
         echo "Write";
      else 
         echo "Read";
      echo "</strong></div>\n";
      echo main_menu();
      echo read_footer();   
   }
   else {
      echo "<h1>ACCESS DENIED</h1>";
   }
}
else
{
   echo header_read();
   echo main_stuff();
   echo main_menu();
   echo read_footer();
}


?>

<?php

/**
 * exceptions.php
 * 
 * Definition of Exceptions and functions that throw those exceptions to be used by vmpsd_external and vmps_lastseen
 *
 * PHP version 5
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation.
 *
 * @package			FreeNAC
 * @author			Sean Boran (FreeNAC Core Team)
 * @author			Seiler Thomas (contributer)
 * @copyright			2007 FreeNAC
 * @license			http://www.gnu.org/copyleft/gpl.html   GNU Public License Version 2
 * @version			SVN: $Id$
 * @link			http://www.freenac.net
 */
 
/**
 * This Exception may be thrown at any point in the decision process to
 * indicate that the current request should be denied 
 * This class extends the {@link Exception} class.
 */
class DenyException extends Exception
{
   # constructor  	
   function __construct() {
      parent::__construct("DENY"); 
   }
}

/**
 * This function is some syntactic sugar to throw a DenyException from the 
 * policy class
 * @throws	DenyException 
 */
function DENY() {
   throw new DenyException;
}

/**
 * This Exception may be thrown at any point in the decision process to
 * indicate that the current request should be denied and furthermore, the
 * current system should be killed
 * This class extends the {@link Exception} class.
 */
class KillException extends Exception
{
   # constructor  	
   function __construct() {
      parent::__construct("KILL"); 
   }
}

/**
 * This function is some syntactic sugar to throw a KillException from the 
 * policy class 
 * @throws	KillException
 */
function KILL() {
   throw new KillException;
}


/**
 * This Exception may be thrown at any point in the decision process to
 * indicate that the current request should be allowed into a given VLAN
 * This class extends the {@link Exception} class.
 */
class AllowException extends Exception
{
   # The vlan that we communicate to VMPSD 
   protected $decidedVlan;

   # Constructor to set this VLAN  	
   function __construct($vlan) {
      $this->decidedVlan = $vlan;
      parent::__construct("ALLOW ".vlanId2Name($vlan)); 
   }

   public function getDecidedVlan() {
      return $this->decidedVlan;
   }	
}

/**
 * This function is some syntactic sugar to throw an AllowException 
 * from the policy class. It also handles default vlan
 * @param int $vlan	Vlan ID of the VLAN we want to assign
 * @throws	AllowException
 */
function ALLOW($vlan = -1) {
   if ($vlan == -1) {
   /**
   * @todo Get the default vlan logic straight
   */
   $vlan = $defaultvlan;
   }
   throw new AllowException($vlan);
}
?>

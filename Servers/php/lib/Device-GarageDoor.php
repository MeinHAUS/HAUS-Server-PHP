<?php
/*******************************************************************************
 * 
 * Copyright 2012 Mark Hensler
 * 
 * This file is part of HAUS.
 *
 * Haus is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Peneral Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * HAUS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with HAUS.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************/
 namespace HAUS;
 require_once('lib/Device.php');
$log->trace('Reading lib/'.basename(__FILE__));

 class GarageDoor extends Device {
 
 	protected $DeviceType = "";
 	protected $cfg;
 	private $log;
 
 	public function __construct($config) {
 		$this->log = \Logger::getLogger(__CLASS__);
 		$this->cfg = $config;
 		
 		
 		$this->log->debug('Device loaded: '.__CLASS__);
 		return true;
 	}
 	
 }
 
 ?>
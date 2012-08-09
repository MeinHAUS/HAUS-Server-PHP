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
require_once($cfg['BasePath'].'/lib/Device.php');
$log->trace('Reading lib/'.basename(__FILE__));

 class GarageDoor extends Device {
 
 	private $log;
 
 	protected function init() {
 		$this->log = \Logger::getLogger(__CLASS__);
 		
 		$this->log->debug('Device initialized: ['.__CLASS__.':'.$this->DeviceID.']');
 		return true;
 	}
 	
 	public function getControls() {
 		$controls = new \jqmPhp\jqmForm();
 		$position = new \jqmPhp\jqmRadiogroup('', 'door', 'Door Position', '', '', 'vertical', true);
 		foreach ($this->cfg["Positions"] as $value => $label) {
	 		$position->addRadio($label, $value, '', ($this->GetDoorPosition() == $value ? true : false));
 		}
 		$controls->add($position);

		// Add the light controls 		
 		$controls->add(new \jqmPhp\jqmSlider('', '', 'Garage Light', '', 'On', 'on', 'Off', 'off', '', true));
 		
 		return $controls;
 	}
 	
 	protected function GetDoorPosition() {
 		return 0;
 	}
 	
 	protected function SetDoorPosition() {
 	}
 	
 }
 
 ?>
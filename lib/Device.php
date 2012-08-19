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

/**
 * 
 * 
 * 
 * @property string $DeviceID unique DeviceID used for this device in config.json
 * @property string $DeviceIP IP to use for communication with this device's hardware
 * @property string $DeviceName A short, yet descriptive name for this device
 * @property integer $DevicePort TCP port to use for communication with this device's hardware
 * @property string $DeviceType The Device Type of this device
 * @property string $Password Password to use if the device hardware requires credentials
 * @property string $Username Username to use if the device hardware requires credentials
 * @property boolean $UseHTTPS Use HTTPS for all communication with this device's hardware?
 * 
 */
abstract class Device {
 
 	// properties for a base Device
 	protected $DeviceID;
 	protected $DeviceIP;
 	protected $DeviceName;
 	protected $DeviceType;
 	
 	// config for an instance of an extended Device
 	protected $cfg;
 	
 	// a log instance specific to this Device class
 	private $log;
 
 	// list of Device properties that we'll allow read access to
	protected $_getters = array('DeviceID', 'DeviceIP', 'DeviceName', 'DevicePort', 'DeviceType',
				'Password', 'Username', 'UseHTTPS');
	// list of Device properties that we'll allow write access to
	protected $_setters = array();
  
 	public function __construct($def) {
 		$this->log = \Logger::getLogger(__CLASS__);
 		
 		global $cfg;
 		$this->cfg = $def['Config'];
 		
 		// populate our properties
 		foreach (array(	'DeviceID', 'DeviceIP', 'DeviceName', 'DevicePort', 'DeviceType',
 				'Password', 'Username', 'UseHTTPS') as $var) {
 			$this->$var = $def[$var];
 		}
 		# run the init() specific to this DeviceType
 		$rtn = $this->init();
 		
 		$this->log->debug(print_r($this, true));
 		
 		if ($rtn) {
 			$this->log->debug('Device loaded: ['.__CLASS__.':'.$this->DeviceID.']');
 		}
 		else {
 			$this->log->debug('Error loading device: ['.__CLASS__.':'.$this->DeviceID.']');
 		}
 		
 		return $rtn;
 	}
  
	public function __get($property) {
		if (in_array($property, $this->_getters)) {
			return $this->$property;
		}
		else if (method_exists($this, '_get_' . $property))
			return call_user_func(array($this, '_get_' . $property));
		else if (in_array($property, $this->_setters) OR method_exists($this, '_set_' . $property))
			throw new \Exception('Property "' . $property . '" is write-only.');
		else
			throw new \Exception('Property "' . $property . '" is not accessible.');
	}
	
	public function __set($property, $value) {
		if (in_array($property, $this->_setters)) {
			$this->$property = $value;
		}
		else if (method_exists($this, '_set_' . $property))
			call_user_func(array($this, '_set_' . $property), $value);
		else if (in_array($property, $this->_getters) OR method_exists($this, '_get_' . $property))
			throw new \Exception('Property "' . $property . '" is read-only.');
		else
			throw new \Exception('Property "' . $property . '" is not accessible.');
	}

	public function _get_cfg() {
		return $this->cfg;
	}

 	abstract public function getControls();
 	abstract protected function init();
 	
}
 
?>
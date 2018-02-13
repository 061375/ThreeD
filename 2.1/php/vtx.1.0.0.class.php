<?php
/*****************************************************************
 * @class Vtx
 * @description 
 * @copyright Copyright (c) 2010-Present, 061375
 * @author Jeremy Heminger <contact@jeremyheminger.com>
 * @bindings
 * @deprecated = false
 *
 * */
class Vtx
{
    private $errors = array();
	
	
	/**
	 * allows a file to be uploaded
	 * @return array
	 * */
    public function uploadVtx()
    {
		$action_result = array();
		$files = isset($_FILES) ? $_FILES : false;
		if (false == $files) {
			$this->set_error_message('No File Uploaded IN Vtx :: uploadVtx ');
			return false;
		}
		if(strpos($files['file']['name'],'.vtx') === false) {
			$this->set_error_message('Unrecognized file extension IN Vtx :: uploadVtx ');
			return false;
		}
		if(substr($files['file']['name'],strlen($files['file']['name'])-4,4) != '.vtx') {
			$this->set_error_message('Unrecognized file extension IN Vtx :: uploadVtx ');
			return false;
		}
		if ($files['file']['size'] > MAX_BYTES) {
			// make sure the file isn't too big
			$this->set_error_message('File size is larger than '.MAXBYTES.' IN Vtx :: uploadVtx');
			return false;
		}
		$path = getcwd().'/temp/';
		if (false == is_dir($path)) {
			mkdir($path);	// mk
			chmod($path,777);
		}   
		if('application/octet-stream' !== $files['file']['type']) {
			// deal with the compression type
			$this->set_error_message('An unrecognized file type was selected IN Vtx :: uploadVtx ');
			return false;
		} 
		$file = $files['file']['tmp_name'];
		$newfile = $path.$files['file']['name'];
		if (!copy($file, $newfile)) {
			$this->set_error_message("failed to copy $file to $newfile  IN Vtx :: uploadVtx");
			return false;
		}
		$action_result['result'] = 1;
		$action_result['file'] = $newfile;
		$action_result['name'] = $files['file']['name'];
		return $action_result;
    }
	/**
	 * @param string
	 * @return array
	 * */
    public function openVtx($filename)
    {
		$result = array();
		if (filesize($filename) > MAX_BYTES) {
			// file too big
			$this->set_error_message('File too big');
			return false;
		}
		$handle = @fopen($filename, "r");
		if (false !== $handle) {
			while (($buffer = fgets($handle, 4096)) !== false) {
				if (true !== $this->fileIsClean($buffer)) {
					$this->set_error_message('File contains potentially dangerous code!');
					return false;
				} else {
					$result['data'][] = $buffer;
				}
			}
			if (!feof($handle)) {
				$this->set_error_message('Error: unexpected fgets() fail_');
				return false;
			}
			fclose($handle);
			unlink($filename);
		}
		if (false == isset($result['data'])) {
			$this->set_error_message('Error: unexpected fgets() fail_');
			return false;
		}
		return $result;
    }
	/**
	 * @param array
	 * @return array
	 * */
    public function prepareVtx($data)
    {
		$gathering = false;
		$points = array();
		$faces = array();
		if (false == isset($data['data'])) {
			$this->set_error_message('data has no value IN Vtx :: prepareVtx');
			return false;
		}
			foreach ($data['data'] as $row) {
			
				if (strpos($row,"// end") !== false) {
					$gathering = false;
					continue;
				}
				if(false !== $gathering) {
					switch($gathering) {
						case 'points':
							$points[] = $row;
							break;
						case 'faces':
							$faces[] = $row;
							break;
					}
				}
				if (strpos($row,".Vertex") !== false) {
					$gathering = 'points';
				}
				if (strpos($row,".Index") !== false) {
					$gathering = 'faces';
				}
				
			}
		$model = array(
				'result' => 1,
				'faces' => $faces,
				'points' => $points
				);
		return $model;
    }
	/**
	 * @param array
	 * @return array
	 * */
    public function get3Dpoints($data)
    {
		$result = array();;
		$newdata = array();
		if (false == isset($data['points']) OR count($data['points']) < 1) {
			$this->set_error_message('Error IN Vtx::get3Dpoints = points not set');
			return false;
		}
		foreach ($data['points'] as $key => $value) {
			$ps = explode(' ', $value);
			//$result[] = $ps[0].','.$ps[1].','.$ps[2];
			$result[$key] = [$ps[0],$ps[1],$ps[2]];
		}

		if (count($result) < 1) {
			$this->set_error_message('Error IN Vtx::get3Dpoints = No Results');
			return false;
		} 
		return $result;
    }
	/**
	 * @param array
	 * @return array
	 * */
    public function make3Dpoints($data,$objpath = 'this.')
    {
		/*
				pointsArray = [
				MakeA3DPoint(-26.955,-52.911,-26.955),
				MakeA3DPoint(-26.955,-52.911,26.955),
				MakeA3DPoint(-26.955,52.911,-26.955),
				MakeA3DPoint(-26.955,52.911,26.955),
				MakeA3DPoint(26.955,-52.911,-26.955),
				MakeA3DPoint(26.955,-52.911,26.955),
				MakeA3DPoint(26.955,52.911,-26.955),
				MakeA3DPoint(26.955,52.911,26.955)
			];
		*/
		$result = $objpath."pointsArray = [";
		$count_row = 0;
	
		foreach ($data as $value) {
				$points = $value;
		
				foreach ($points as $key => $point) {
					$point = (float)$points[$key];
					
					if ($point < 0) {
						$points[$key] = $point + ($point * -2);
					} else {
						$points[$key] = $point - ($point * 2);
					}
				}
			
				$result.=$objpath."makeA3DPoint(".implode(',',$points).")";
		
			if ($count_row < count($data)-1) {
				$result.=",";
			}
			$count_row++;
		}
		$result .="];";

		return $result;
    }
	/**
	 * @param array
	 * @return array
	 * */
    public function get3Dfaces($data)
    {
		$result = array();;
		$newdata = array();
		if (false == isset($data['faces']) OR count($data['faces']) < 1) {
			$this->set_error_message('Error IN Vtx::get3Dfaces = faces not set');
			return false;
		}
		foreach ($data['faces'] as $key => $value) {
			$ps = explode(' ', $value);
			$result[] = $ps[0].','.$ps[1].','.$ps[2];
		}
		if (count($result) < 1) {
			$this->set_error_message('Error IN Vtx::get3Dfaces = No Results');
			return false;
		} 
		return $result;
    }
	/**
	 * @param array
	 * @return array
	 * */
    public function make3Dfaces($data,$objpath = 'this.')
    {
		/*
		 facesArray = [
			  [0,4,6,2],
			  [1,3,7,5],
			  [0,2,3,1],
			  [4,5,7,6],
			  [2,6,7,3],
			  [0,1,5,4]		  
		];
		*/
		$result = $objpath."facesArray = [";
		$count_row = 0;
		foreach ($data as $row) {
			$result .= "[".$row."]";
			if ($count_row < count($data)-1 ) {
				$result.=",";
			}
			$count_row++;
		}
		$result .="];";
		return $result;
    }
	/**
	 * @param string
	 * @return boolean
	 * */
    private function fileIsClean($string)
    {
        if (strpos($string,'eval') !== false) {
            return false;
        }
        if (strpos($string,'base64decode') !== false) {
            return false;
        }
        if (strpos($string,'<?') !== false) {
            return false;
        }
        if (strpos($string,'<?php') !== false) {
            return false;
        }
        if (strpos($string,'?>') !== false) {
            return false;
        }
        return true;
    }
    // --------------------------------------------------------------------

    /**
     * Get Error messages
     *
     * @return array
     */
    public function get_error_message()
    {
        if (count($this->errors) > 0)
        {
            $tmp = $this->errors;
            $this->errors = array();
            return $tmp;
        }
        return true;
    }

    // --------------------------------------------------------------------

    /**
     * Set Error messages
     *
     * @return array
     */
    private function set_error_message($message)
    {
        if ($message != '')
        {
            $this->errors[] = $message;
        }
    }
	
    // --------------------------------------------------------------------
	
    /**
     * Has Error
     *
     * @return array
     */
    private function has_error()
    {
        if (count($this->errors) > 0)
        {
            return true;
        }
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Clear Error
     *
     * @return array
     */
    private function clear_error()
    {
        $this->errors = array();
    }
    /**
     * Gathers errors and converts them to XML to be returned to the user
     *
     * @return void
     */
    public function display_errors()
    {
        $errors = array();
        $errors = $this->get_error_message();
		echo '<script>';
			foreach ($errors as $row) {
				echo "alert('Error :: ".$row."');";
			}
		echo '</script>';
		die();
    }
}
?>
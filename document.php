<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.DocumentTable");
Kernel::Import("classes.data.DocumentCategoryTable");
Kernel::Import("classes.unit.createzip");


class IndexPage extends PublicPage {

	/**
	 * @var DocumentTable
	 */
	var $DocumentTable;
	/**
	 * @var DocumentCategoryTable
	 */
	var $DocumentCategoryTable;
	
	var $data = false;

	
	function index() {
		parent::index();

		$this->DocumentTable = new DocumentTable($this->connection);
		$this->DocumentCategoryTable = new DocumentCategoryTable($this->connection);
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'documents'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
	}
	
	function onZipDoc(){
		$intDocumentID = $this->request->getNumber('intDocumentID', 0);	
		
		$data = $this->DocumentTable->Get(array('intDocumentID' => $intDocumentID));
		
		$file_path=FILES_PATH.substr($data['varFileName'],0,3).'/'.$data['varFileName'];

		$file_name = explode('.',$data['varFileNameReal']);
		unset($file_name[count($file_name)-1]);
		$file_name = implode('.',$file_name);

		
		$createZip = new createZip;
		
		$fileNameDownload = $file_name.'.zip';
		
		$fileContents = file_get_contents($file_path);
        $createZip->addFile($fileContents, $file_name.'.'.$data['varFile']);

		//$content = $createZip->getZippedfile();
		
		$fileName = PROJECT_PATH.'tmp/'.$file_name.'.zip';
		$fd = fopen ($fileName, 'wb');
		$out = fwrite ($fd, $createZip->getZippedfile());
		fclose ($fd);
		
		$createZip->forceDownload($fileName);
		unlink($fileName);
		die;
		
	}
	
	function onDoc(){
		$intDocumentID = $this->request->getNumber('intDocumentID', 0);	
		$data = $this->DocumentTable->Get(array('intDocumentID' => $intDocumentID));
		$file_path=FILES_PATH.substr($data['varFileName'],0,3).'/'.$data['varFileName'];
		$file_name = $data['varFileNameReal'];
		$this->output_file($file_path, $file_name);
		die;
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

	
	
	

	function render() {
		parent::render();
		
	    $tmp = array();
		$document = $this->DocumentTable->GetList(array('isActive'=>1), array('intOrdering'=>'ASC'));
		foreach ($document as $key => $value) {
			$value['link'] = FILES_URL.substr($value['varFileName'],0,3).'/'.$value['varFileName'];
			$tmp[$value['intCategoryID']][] = $value;
			$category_ids[] = $value['intCategoryID'];
		}
		$document = $tmp;
		$category_ids[] = -1;
		$this->document->addValue('document', $document);
		$tmp = array();
		$category = $this->DocumentCategoryTable->GetList(array('INintCategoryID'=>implode(',',$category_ids)), array('intOrdering'=>'ASC'));
		foreach ($category  as $key => $value) {
			$tmp[$value['intCategoryID']] = $value;
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$category  = $tmp;	
		
		
		$this->document->addValue('category', $category );
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Документы',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("document.tpl"));
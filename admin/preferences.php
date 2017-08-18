<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PreferencesTable");
Kernel::Import("classes.data.SpoPreferencesTable");

class IndexPage extends AdminPage {

	/**
	 * @var SpoPreferencesTable
	 */
	var $spoPreferencesTable;
	/**
	 * @var PreferencesTable
	 */
	var $preferencesTable;

	var $data;
	
	function index() {
		parent::index();
		
		$this->setPageTitle('Настройки');
		$this->setBoldMenu('preferences');
		
		$this->preferencesTable = new PreferencesTable($this->connection);
		$this->spoPreferencesTable = new SpoPreferencesTable($this->connection);
	}
	
	function OnSave() {
		$varPrefValue = $this->request->getString('korregKoeff');	
		$intPrefID = $this->request->getNumber('intPrefID');
		
		$varColorBG = $this->request->getString('varColorBG');	
		$varColorRO = $this->request->getString('varColorRO');	
		$varLinkSPO = $this->request->getString('varLinkSPO');
        
        $varImgBGTop = $this->request->getFiles('varImgBGTop', 'NotEmpty');
        $varImgBGBody = $this->request->getFiles('varImgBGBody', 'NotEmpty');
        $varColorBGBody = $this->request->getString('varColorBGBody');
        
        $varImgBGTop_Clear = $this->request->getString('varImgBGTop_Clear');
        $varImgBGBody_Clear = $this->request->getString('varImgBGBody_Clear');
        
		
		if(!empty($intPrefID) && !empty($varPrefValue)) {
			$pref = $this->preferencesTable->Get(array('intPrefID' => $intPrefID));
			if($pref['varPrefValue'] != $varPrefValue) {
				$data = array();
				$data['varPrefValue'] = $varPrefValue;
				$data['varPrefName'] = 'korregKoeff';
				$data['varPrefDescr'] = 'Коррегирующий коэффициент';
				$data['varDate'] = time();
				$this->preferencesTable->Insert($data);
			}
		}
		
		$SPOpref = $this->spoPreferencesTable->Get(array('intSPOPrefID' => 1));
		$data = array();
		$data['intSPOPrefID'] = 1;
		if(!empty($varColorBG)) $data['varColorBG'] = $varColorBG;
		if(!empty($varColorRO)) $data['varColorRO'] = $varColorRO;
        
        if ($varImgBGTop['size']) {
            $file_path = FILES_BG;         
            if (!empty($SPOpref['varImgBGTop'])) unlink($file_path.$SPOpref['varImgBGTop']);       
            $file_pathinfo = pathinfo($varImgBGTop['name']);
            $file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
            move_uploaded_file($varImgBGTop['tmp_name'], $file_path.$file_name);
            chmod($file_path.$file_name, 0777);
            $data['varImgBGTop'] = $file_name;
        } else {
            if($varImgBGTop_Clear == 1){
                $data['varImgBGTop'] = '';
            }else{
                $data['varImgBGTop'] = $SPOpref['varImgBGTop'];
            }
        }
        if ($varImgBGBody['size']) {
            $file_path = FILES_BG;      
            if (!empty($SPOpref['varImgBGBody'])) unlink($file_path.$SPOpref['varImgBGBody']); 
            $file_pathinfo = pathinfo($varImgBGBody['name']);
            $file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
            move_uploaded_file($varImgBGBody['tmp_name'], $file_path.$file_name);
            chmod($file_path.$file_name, 0777);
            $data['varImgBGBody'] = $file_name;
        } else {
            if($varImgBGBody_Clear == 1){
                $data['varImgBGBody'] = '';
            }else{
                $data['varImgBGBody'] = $SPOpref['varImgBGBody'];
            }
        }
        $data['varColorBGBody']=$varColorBGBody;
		$this->spoPreferencesTable->Update($data);
		$this->addMessage('Данные успешно сохранены');
	}
	
	function render() {
		parent::render();
		
		$pref = $this->preferencesTable->GetList();
		$this->document->addValue('pref', $pref[count($pref) - 1]);	

		$SPOpref = $this->spoPreferencesTable->Get(array('intSPOPrefID' => 1));
		$this->document->addValue('spoPref', $SPOpref);	
        $this->document->addValue('path_file', FILES_BG_URL);    
         
	}	
	
}

Kernel::ProcessPage(new IndexPage("preferences.tpl"));
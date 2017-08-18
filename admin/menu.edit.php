<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.MenuTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.PromoTable");

class IndexPage extends AdminPage {

	/**
	 * @var MenuTable
	 */
	var $menuTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var modulesPageTable
	 */
	var $modulesPageTable;
	/**
	 * @var NewsTable
	 */
	var $newsTable;
	/**
	 * @var NewsTypeTable
	 */
	var $newsTypeTable;
	var $data = false;
	var $PromoTable;

	function index() {
		parent::index();
		$this->setPageTitle('Пункт меню');
		$this->setBoldMenu('menu');

		$this->menuTable 			= new MenuTable($this->connection);
		$this->pagesTable 			= new PagesTable($this->connection);
		$this->modulesPageTable 	= new ModulesPagesTable($this->connection);
		$this->newsTable 			= new NewsTable($this->connection);
		$this->newsTypeTable 		= new NewsTypeTable($this->connection);
		$this->PromoTable 			= new PromoTable($this->connection);

		$intMenuID = $this->request->getNumber('intMenuID', 0);
		if ($intMenuID) {
			$this->data = $this->menuTable->Get(array('intMenuID'=>$intMenuID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет пункта с заданным ID');
				$this->response->redirect('index.php');
			}
		}
	}

	function OnSave() {		
		$data['intMenuID'] = $this->request->getNumber('intMenuID');
		$data['intParentID'] = $this->request->getNumber('intParentID');
		$data['varTypeMenu'] = $this->request->getString('varTypeMenu', 'NotEmpty');
		$data['varTitle'] = $this->request->getString('varTitle', 'NotEmpty');
		$varIdentifier1 = $this->request->getNumber('varIdentifier1');
		$varIdentifier2 = $this->request->getNumber('varIdentifier2');
		$varIdentifier3 = $this->request->getNumber('varIdentifier3');
		$varIdentifier4 = $this->request->getNumber('varIdentifier4');
		$data['varModule'] = $this->request->getString('varModule');
		$data['isAuthorized'] = $this->request->getNumber('isAuthorized');
		$data['varUrl'] = $this->request->getString('varUrl');
		$data['isVisible'] = $this->request->getString('isVisible');
		$data['varImage'] = $this->request->getFiles('varImage');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if ($data['varModule'] == 'page') {
				$data['varIdentifier'] = $varIdentifier1;
			} elseif ($data['varModule'] == 'news') {
				$data['varIdentifier'] = $varIdentifier2;
			} elseif ($data['varModule'] == 'news_type') {
				$data['varIdentifier'] = $varIdentifier3;
			} elseif ($data['varModule'] == 'promoakcii') {
				$data['varIdentifier'] = $varIdentifier4;
			}
			switch ($data['varModule']) {
				case 'link'					: { unset($data['varIdentifier']); } break;
				case 'page'					: if (!empty($data['varIdentifier'])) { unset($data['varUrl']); } break;
				case 'news'					: if (!empty($data['varIdentifier'])) { unset($data['varUrl']); } break;
				case 'news_type'			: if (!empty($data['varIdentifier'])) { unset($data['varUrl']); } break;
				case 'index'				: { unset($data['varIdentifier']); $data['varUrl'] = 'index.php'; } break;
				case 'currency_courses'		: { unset($data['varIdentifier']); $data['varUrl'] = 'currency_courses.php'; } break;
				case 'news_archive'			: { unset($data['varIdentifier']); $data['varUrl'] = 'news_archive.php'; } break;
				case 'where_buy'			: { unset($data['varIdentifier']); $data['varUrl'] = 'where_buy.php'; } break;
				case 'private_room'			: { unset($data['varIdentifier']); $data['varUrl'] = 'private_room.php'; } break;
				case 'regions_and_hotels'	: { unset($data['varIdentifier']); $data['varUrl'] = 'regions_and_hotels.php'; } break;
				case 'so'					: { unset($data['varIdentifier']); $data['varUrl'] = 'so.php'; } break;
				case 'feedback'				: { unset($data['varIdentifier']); $data['varUrl'] = 'feedback.php'; } break;
				case 'documents'			: { unset($data['varIdentifier']); $data['varUrl'] = 'documents.php'; } break;
				case 'contact'				: { unset($data['varIdentifier']); $data['varUrl'] = 'contacts.php'; } break;
				case 'tourtypes'			: { unset($data['varIdentifier']); $data['varUrl'] = '/tours-country/'; } break;
				
				
			}

			if ($data['varImage']['size']) {
				$file_path = FILES_PATH;
				if (!empty($this->data['varImage'])) unlink($file_path.$this->data['varImage']);
				$file_pathinfo = pathinfo($data['varImage']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varImage']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varImage'] = $file_name;
			} else $data['varImage'] = $this->data['varImage'];
			
			if (isset($data['intMenuID']) && !empty($data['intMenuID'])) {
				$this->menuTable->Update($data);
			} else {
				$this->menuTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intMenuID']) && !empty($data['intMenuID'])) $this->response->redirect('menu.php');
		}
	}

	function OnDeleteImage() {
		$data['intMenuID'] = $this->request->getNumber('intMenuID', 'NotEmpty');
		$data['varImage'] =	$this->request->getString('varImage', 'NotEmpty');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varImage'])) {
				unlink(FILES_PATH.$this->data['varImage']);
				$this->data['varImage'] = '';
				$this->menuTable->Update($this->data);
			}
		}
	}

	function render() {
		parent::render();
		$modules_list = $this->modulesPageTable->GetList(array('onView'=>'yes'), array('varTitle'=>'ASC'));
		$this->document->addValue('modules_list', $modules_list);
		$this->document->addValue('pages_list', $this->pagesTable->GetList(array('intActive' => 1), array('varTitle'=>'ASC')));
		$this->document->addValue('news_list', $this->newsTable->GetList(array('intActive' => 1)));
		$this->document->addValue('news_type_list', $this->newsTypeTable->GetList(array('intActive' => 'Yes')));
		$this->document->addValue('promo', $this->PromoTable->GetList(array('intActive' => 'Yes')));
		
		$this->document->addValue('menu_list', $this->getMenuTree(0));
		$this->document->addValue('menu', $this->data);
		$this->document->addValue('FILES_URL', FILES_URL);
	}

	function getMenuTree($intMenuID = 0) {
		$sort = array('intSortOrder'=>'asc');
		$data = array('intParentID'=>$intMenuID);
		$menu_list = $this->menuTable->GetList($data, $sort);
		if (is_array($menu_list)) {
			foreach($menu_list as $k => $v) {
				if($v['intMenuID'] == $intMenuID) {
					unset($menu_list[$k]);
					continue;
				}else{
					$v['childs'] = $this->getMenuTree($v['intMenuID']);
					$tmp[] = $v;
				}
			}
		}
		$menu_list = $tmp;
		return $menu_list;
	}
}

Kernel::ProcessPage(new IndexPage("menu.edit.tpl"));
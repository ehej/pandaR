<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CatalogMenuTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.PromoTable");


class IndexPage extends AdminPage {

	/**
	 * @var CountriesTable
	 */
	var $AdvCountriesTable;
	
	/**
	 * @var CatalogMenuTable
	 */
	var $CatalogMenuTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var NewsTable
	 */
	var $newsTable;
		/**
	 * @var modulesPageTable
	 */
	var $modulesPageTable;
	var $PromoTable;
	var $data = false;
	var $parent;
	var $type;

	function index() {
		parent::index();
		$this->setPageTitle('Пункт меню стран');
		$this->setBoldMenu('menuCountries');

		$this->AdvCountriesTable		= new AdvCountriesTable($this->connection);
		$this->CatalogMenuTable 		= new CatalogMenuTable($this->connection);
		$this->pagesTable 				= new PagesTable($this->connection);
		$this->newsTable 				= new NewsTable($this->connection);
		$this->modulesPageTable 		= new ModulesPagesTable($this->connection);
		$this->PromoTable 				= new PromoTable($this->connection);
		$this->newsTypeTable 			= new NewsTypeTable($this->connection);
		$this->countriesTable 			= new CountriesTable($this->connection);
		$this->menuCountriesTable		= new MenuCountriesTable($this->connection);
		$this->resortsTable 			= new ResortsTable($this->connection);
		
		$intMenuID = $this->request->getNumber('intMenuID', 0);
		if ($intMenuID) {
			$this->data = $this->menuCountriesTable->Get(array('intMenuID'=>$intMenuID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет пункта с заданным ID');
				$this->response->redirect('index.php');
			}
		}
		
		$this->parent = $this->request->getNumber('intParentID', 'NotEmpty');
		$this->type = $this->request->getString('type', 'NotEmpty');
		
		if($this->type == 'country') {
			$this->country = $this->countriesTable->Get(array('intCountryID' => $this->parent));
			$this->setPageTitle(($intMenuID?'Редактирование':'Добавление').' меню страны '.$this->country['varName']);
			$this->setBoldMenu('countriesCatalog');
		} elseif($this->type=='resort') {
			$this->resort = $this->resortsTable->Get(array('intResortID' => $this->parent));
			$this->setPageTitle(($intMenuID?'Редактирование':'Добавление').' меню курота '.	$this->resort['varName']);
			$this->setBoldMenu('resortsCatalog');
		}
	}

	function OnSave() {		
		$data['intMenuID'] = $this->request->getNumber('intMenuID');
		$data['intMenuParentID'] = $this->request->getNumber('intMenuParentID');
		$data['varTitle'] = $this->request->getString('varTitle', 'NotEmpty');
		$data['intParentID'] = $this->request->getNumber('intParentID');
		$data['varParentType'] = $this->request->getString('type', 'NotEmpty');
		$data['varColor'] = $this->request->getString('varColor');
		$data['addToSO'] = $this->request->getNumber('addToSO');
		$data['isVisible'] = $this->request->getNumber('isVisible');
		$varIdentifier1 = $this->request->getNumber('varIdentifier1');
		$varIdentifier2 = $this->request->getNumber('varIdentifier2');
		$varIdentifier3 = $this->request->getNumber('varIdentifier3');
		$varIdentifier4 = $this->request->getNumber('varIdentifier4');
		$data['varModule'] = $this->request->getString('varModule');
		$data['varUrl'] = $this->request->getString('varUrl');
		$data['isAllwaysOpen'] = $this->request->getNumber('isAllwaysOpen');
		$parent = $this->menuCountriesTable->GetByFields(array(
                    'intCountryID' => $data['intParentID'],
                    'intParentID' => 0
                ));
		
		$data['intParentID'] =  $parent['intMenuID'];
		$data['intCountryID'] =  $parent['intCountryID'];
		
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
				case 'index'				: { unset($data['varIdentifier']); $data['varUrl'] = 'index.php'; } break;
				case 'currency_courses'		: { unset($data['varIdentifier']); $data['varUrl'] = 'currency_courses.php'; } break;
				case 'news_archive'			: { unset($data['varIdentifier']); $data['varUrl'] = 'news_archive.php'; } break;
				case 'where_buy'			: { unset($data['varIdentifier']); $data['varUrl'] = 'where_buy.php'; } break;
				case 'private_room'			: { unset($data['varIdentifier']); $data['varUrl'] = 'private_room.php'; } break;
				case 'regions_and_hotels'	: { unset($data['varIdentifier']); $data['varUrl'] = 'regions_and_hotels.php'; } break;
				case 'so'					: { unset($data['varIdentifier']); $data['varUrl'] = 'so.php'; } break;
				case 'feedback'				: { unset($data['varIdentifier']); $data['varUrl'] = 'feedback.php'; } break;
				case 'contact'				: { unset($data['varIdentifier']); $data['varUrl'] = 'contacts.php'; } break;
				case 'excursions'			: { unset($data['varIdentifier']); $data['varUrl'] = 'excursions.php'; } break;
				case 'tours'				: { unset($data['varIdentifier']); $data['varUrl'] = 'tours.php'; } break;
				case 'adv_country'			: {
					$all_adv_c = $this->AdvCountriesTable->GetList();
					foreach ($all_adv_c as $value) {
						if($value['intParentCountry'] == $data['intCountryID']){
							$data['varIdentifier'] = $value['intCountryID']	;	
						}
					}
				} break;
			}
			if (isset($data['intMenuID']) && !empty($data['intMenuID'])) {
				$this->menuCountriesTable->Update($data);
			} else {
				$this->menuCountriesTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			
			
			
			$this->response->redirect('catalog_menu.edit.php?intParentID='.$parent['intCountryID'].'&type=country&intMenuID='.$data['intMenuID']);
		}
	}

	function getMenuTree($intParentID) {
		$sort = array('intSortOrder' => 'asc');
		$data = array('intParentID' => $intParentID, 'intMenuParentID' => 0, 'varParentType'=>$this->type, 'NOTintMenuID' => $this->data['intMenuID']);
		$menu_list = $this->CatalogMenuTable->GetList($data, $sort);
		if (is_array($menu_list)) {
			foreach($menu_list as $k => $v) {
				$data = array('intMenuParentID' => $v['intMenuID'], 'NOTintMenuID' => $this->data['intMenuID']);
				$submenu_list = $this->CatalogMenuTable->GetList($data, $sort);
				if ( ! empty($submenu_list)) {
					//$menu_list[$k]['childs'] = $submenu_list;
				}		
			}
		}
		return $menu_list;	
	}
	
	function render() {
		parent::render();
		$modules_list = $this->modulesPageTable->GetList(array('onView'=>'yes'), array('varTitle'=>'ASC'));
		$this->document->addValue('modules_list', $modules_list);
		$this->document->addValue('pages_list', $this->pagesTable->GetList(array('intActive' => 1), array('varTitle'=>'ASC')));
		$this->document->addValue('news_list', $this->newsTable->GetList(array('intActive' => 1), array('varTitle'=>'ASC')));
		$this->document->addValue('parents_countries', $this->CatalogMenuTable->GetList(array('intParentID' => 0)));
		$this->document->addValue('news_type_list', $this->newsTypeTable->GetList(array('intActive' => 'Yes')));
		$this->document->addValue('promo', $this->PromoTable->GetList(array('intActive' => 'Yes')));
		
		if(!$this->data){
			$this->data['intParentID'] = $this->request->getNumber('intParentID');
		}
		
		$this->document->addValue('menu', $this->data);
		$this->document->addValue('QUERY_STRING', $_SERVER['QUERY_STRING']);
		$this->document->addValue('intParentID', $this->parent);
		$this->document->addValue('type', $this->type);
		$this->document->addValue('menu_list', $this->getMenuTree($this->parent));
	}
}

Kernel::ProcessPage(new IndexPage("catalog_menu.edit.tpl"));

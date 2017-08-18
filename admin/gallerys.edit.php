<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.ImagesTable");

Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.PagesToCountriesTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.HotelsTable");

Kernel::Import("classes.unit.Image");

class IndexPage extends AdminPage {

	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var ImagesTable
	 */
	var $imagesTable;
	/**
	 * @var unknown_type
	 */
	var $imageManipulate;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	/**
	 * @var MenuCountriesTable
	 */
	var $menuCountriesTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var MenuTable
	 */
	var $menuTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var PagesToCountriesTable
	 */
	var $pagesToCountriesTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных фотогалереи');
		$this->setBoldMenu('gallerys');		
		
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->imagesTable = new ImagesTable($this->connection);	
		
		$this->countriesTable = new CountriesTable($this->connection);

		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->menuCountriesTable = new MenuCountriesTable($this->connection);

		$this->pagesTable = new PagesTable($this->connection);
		$this->pagesToCountriesTable = new PagesToCountriesTable($this->connection);

		$this->regionsTable = new RegionsTable($this->connection);

		$this->hotelsTable = new HotelsTable($this->connection);

		
		$this->imageManipulate = new Image();
			
		$intGalleryID = $this->request->getNumber('intGalleryID', 0);
		if ($intGalleryID) {
			$this->data = $this->gallerysTable->Get(array('intGalleryID' => $intGalleryID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет фотогалереи с заданным ID');
				$this->response->redirect('gallerys.php');
			}
		}
	}

 	function OnSave() {
		$data['intGalleryID'] = $this->request->getNumber('intGalleryID');
		$data['varTitle'] =	$this->request->getString('varTitle', 'NotEmpty');
		$data['intPreviewWidth'] = $this->request->getNumber('intPreviewWidth');
		$data['intPreviewHeight'] = $this->request->getNumber('intPreviewHeight');
		$data['intCountImgInRow'] = $this->request->getNumber('intCountImgInRow');		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intGalleryID']) && !empty($data['intGalleryID'])) {
				$this->gallerysTable->Update($data);
			} else {
				$this->gallerysTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intGalleryID']) && !empty($data['intGalleryID']))
				$this->response->redirect('gallerys.edit.php?intGalleryID='.$data['intGalleryID']);
		}
	}

	/**
	 * Закачка файла (изображения или видео) на сервер
	 * @access ajax | post
	 */
	function OnUpload () {
		if ( ! is_numeric($this->data['intGalleryID'])) return;
		$content = null;
		$source = $this->request->getFiles('varFileName');
		$isAjax = empty($source) ? true : false;
		if ($isAjax) { // is Ajax
			$filename = $this->request->getString('filename');
			$content = $GLOBALS['HTTP_RAW_POST_DATA'];
		} else {
			$filename = $source['name'];
			$content = file_get_contents($source['tmp_name']);
		}
		$file = md5($source['tmp_name'].time().rand(1000, 9999));
		$dir = IMAGES_PATH.substr($file, 0, 3)."/";
		if ( ! empty($filename)) {
			if ( ! is_dir($dir)){
				if ( ! mkdir($dir, 0777)){
					$data['messages'][] = 'Не удалось создать директорию для загрузки файла';
				}
			}
			$filepath = $dir.$file;
			if ( ! isset($data['message']) && ! file_put_contents($filepath, $content)){
				$data['messages'][] = 'Ошибка загрузки файла';
			} else {
				$data['intGalleryID'] = $this->data['intGalleryID'];
				$data['varRealFileName'] = $filename;
				// $data['fileType'] = substr(mime_content_type($filepath), 0, 5);
				$data['varFileName'] = $file;
				//if ($data['fileType'] == 'image') {
					chmod($filepath, 0755);
					$data['intOrder'] = $this->imagesTable->getMaxOrder($this->data['intGalleryID']);
					$data['intImageID'] = $this->imagesTable->Insert($data);
					$data['messages'][] = 'Изображение успешно загружено';
					// resize image
					$data['imageUrl'] = $this->getImageUrl($file, $this->data['intPreviewWidth'].'x'. $this->data['intPreviewHeight']);
					$data['imageOrigUrl'] = $this->getImageUrl($file);
				// } else {
					// unlink ($filepath);
					// $data['messages'][] = 'Файл не является изображением или видео';
				// }
			}
		}
		if ($isAjax) {
			$data['width'] = $this->data['intPreviewWidth'];
			$data['height'] = $this->data['intPreviewHeight'];
			$data['imageUrl'] = $this->getImageUrl($data['varFileName'], $data['width'].'x'.$data['height']);
			$data['imageOrigUrl'] = $this->getImageUrl($data['varFileName']);
			echo json_encode($data);
			$this->terminatePage();
		} else {
			$this->response->redirect('gallerys.edit.php?intGalleryID='.$this->data['intGalleryID']);
		}
	}

	/**
	 * Сортировка изображений
	 * @access ajax
	 */
	function OnSort() {
		$c = 1;
		$ids = $this->request->getString('ids');
		$ids = explode(",", $ids);
		foreach ($ids as $k => $id) {
			$data = array('intImageID'=>$id);
			$image = $this->imagesTable->get($data);
			$image['intOrder'] = $c++;
			print_r($image);
			$this->imagesTable->update($image);
		}
		$this->terminatePage();
	}	

	/**
	 * Удаление файла изображения
	 * @access ajax
	 */
	function OnDeleteImage() {
		$data['intImageID'] = $this->request->getNumber('intImageID');
		$image = $this->imagesTable->get($data);
		if ( ! empty($image)) {
			//@unlink(IMAGES_PATH.substr($image['varFile'], 0, 3)."/100x70/".$image['varFile']); // small
			@unlink(IMAGES_PATH.substr($image['varFile'], 0, 3)."/".$image['varFile']); // original
			$this->imagesTable->delete($image);
		}
		$this->terminatePage();
	}
	
	/**
	 * Поддерживает ли брузер возможность drop-down файла
	 * @return boolean true если поддерживает, false не поддерживает
	 */
	private function isCompatibilityBrowser() {
		$browser = $this->browser_info($_SERVER['HTTP_USER_AGENT']);
		$browsers = array('firefox' => 3.6, 'safari' => 0);
		foreach($browsers as $n=>$v) {
			if (isset($browser[$n]) && $browser[$n] >= $v) {
				if($v == 'safari' && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === true) continue;
				return true;
			}
		}
		return false;
	}

	/**
	 * Получить информацию о пользовательском браузер
	 * @param Mixed  (Example return: array('firefox'=>3.6))
	 */
	private function browser_info($agent=null) {
		  // Declare known browsers to look for
		  $known = array('msie','firefox','safari','webkit','opera','netscape','konqueror','gecko','chrome');
		  // Clean up agent and build regex that matches phrases for known browsers
		  // (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
		  // version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
		  $agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
		  $pattern = '#(?<browser>'.join('|',$known).')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';
		  // Find all phrases (or return empty array if none found)
		  if (!preg_match_all($pattern, $agent, $matches)) return array();
		  // Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
		  // Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
		  // in the UA).  That's usually the most correct.
		  $i = count($matches['browser'])-1;
		  return array($matches['browser'][$i] => $matches['version'][$i]);
	}

	/**
	 * Изменить размер изображения
	 * @param String $image
	 * @param String $size (WIDTHxHEIGHT)
	 * @return URL
	 */
	private function getImageUrl($image, $size = null) {
		if ( ! empty($size)) {
			$path = IMAGES_PATH.substr($image,0,3)."/".$size."/".$image;
			if ( ! file_exists($path)) {
				$path = substr($image,0,3)."/".$image;
				// chmod($path, 0755);
				$this->imageManipulate->resize($path, $size);
			}
			$path = IMAGES_URL.substr($image,0,3)."/".$size."/".$image;
		} else {
			$path = IMAGES_URL.substr($image,0,3)."/".$image;
		}
		return $path;
	}
	
	/**
	 * Задать подпись к картинке
	 * @param Integer $intImageID
	 * @param String $varTitle
	 * @access ajax
	 */
	public function OnSetImageTitle() {
		$data['intImageID'] = $this->request->getNumber('intImageID');
		$data['varTitle'] = $this->request->getString('varTitle');
		
		if (!empty($data['intImageID'])) {
			$this->imagesTable->update($data);
			echo $data['varTitle'];
			$this->terminatePage();
		}
	}
    
	function render() {
		parent::render();	
		
		$this->document->addValue('data', $this->data);
		if (is_numeric($this->data['intGalleryID'])) {	
			$images = $this->imagesTable->GetList(array('intGalleryID' => $this->data['intGalleryID']), array('intOrder'=>'ASC'));
			foreach ($images as $k => $image) {
				$images[$k]['imageUrl'] = $this->getImageUrl($image['varFileName'], $this->data['intPreviewWidth'].'x'. $this->data['intPreviewHeight']);
				$images[$k]['imageOrigUrl'] = $this->getImageUrl($image['varFileName']);
				$images[$k]['varTitle'] = htmlentities($images[$k]['varTitle'], ENT_QUOTES, 'UTF-8');
			}
			//print_r($images);
			$this->document->addValue('images_list', $images);
			$this->document->addValue('compability', $this->isCompatibilityBrowser());
		}	
	}

}

Kernel::ProcessPage(new IndexPage("gallerys.edit.tpl"));
<?php

Kernel::Import("classes.web.module");
Kernel::Import("classes.unit.phpmailer.phpmailer");
Kernel::Import("classes.data.FormsTable");
Kernel::Import("classes.data.FormFieldsTable");

Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.DepartureCitiesTable");

class FormCreator extends Module {
	public static $FieldType = array(
		'text'				=>'Текстовое поле',
		'textarea'			=>'Многострочной текстовое поле',
		'select'			=>'Выпадающий список',
		'multi_select'		=>'Мульти селект',
		'chekbox'			=>'Чекбоксы',
		'radio'				=>'Радио баттоны',
		'calendar'			=>'Календарь',
		'password'			=>'Пароль',
		'kaptcha'			=>'Капча');
	
	public static $FieldCheck = array(
		''					=>'Нет',
		'email'				=>'E-mail',
		'digit'				=>'Цыфра',
		'date'				=>'Дата',
		'empty'				=>'Не пустое');
		
	public static $FieldTableSelect = array(
		''					=>'Нет',
		'countries'			=>'Страны',
		'departure_cities'	=>'Города',
		'hotels'			=>'Отели'
		);
	protected $connection;
	private $FormsTable;
	private $FormFieldsTable;
	public $mod_folder = 'forms';
	private $Response;
	private $mail;
	/**
	 * @private HotelsTable
	 */
	private $hotels;
	/**
	 * @private DepartureCitiesTable
	 */
	private $departure_cities;
	/**
	 * @private CountriesTable
	 */
	private $countries;
		
	public function __construct(&$connection){
		parent::__construct('');
		$this->connection = $connection;
		$this->FormsTable = new FormsTable($this->connection);
		$this->FormFieldsTable = new FormFieldsTable($this->connection);
		
		$this->hotels = new HotelsTable($this->connection);	
		$this->countries = new CountriesTable($this->connection);
		$this->departure_cities = new DepartureCitiesTable($this->connection);
		$this->mail = new PHPMailer();
	}
	
	function CreateForm($form_ident=false){
		if(!$form_ident) return;
		$data_form = $this->FormsTable->GetByFields(array('varIdentificator'=>$form_ident));
		
		if(!$data_form){ return;}
		$data_fields = $this->FormFieldsTable->GetList(array('intFormID'=>$data_form['intFormID']), array('intOrdering'=>'ASC'));
		if(!$data_fields){ return;}
		
		$array_fields = array();
		$scripts['validator'] = '<script>$(document).ready(function(){$("#auto_form_'.$data_form['intFormID'].'").validate();});</script>';
		$fields_active = $this->session->Get('form_'.$data_form['intFormID'], false);
		
		foreach ($data_fields as $key => $value) {
			$value['varValues'] = $this->values_to_array($value['varValues']);
			if($value['varTableSelect'] != ''){
				$value['varValues'] = $this->select_table($value['varTableSelect']);	
			}
			$this->document->addValue('data', $value);
			if($value['varType'] == 'calendar'){
				$fields_active['form_'.$data_form['intFormID'].'_field_'.$value['intFieldID']] = ($fields_active['form_'.$data_form['intFormID'].'_field_'.$value['intFieldID'].'Year'].'-'.$fields_active['form_'.$data_form['intFormID'].'_field_'.$value['intFieldID'].'Month'].'-'.$fields_active['form_'.$data_form['intFormID'].'_field_'.$value['intFieldID'].'Day']);
			}
			if (isset($fields_active['form_'.$data_form['intFormID'].'_field_'.$value['intFieldID']])){
				$this->document->addValue('data_active', $fields_active['form_'.$data_form['intFormID'].'_field_'.$value['intFieldID']]);
			}elseif($fields_active){
				$this->document->addValue('data_active', true);
			}else{
				$this->document->addValue('data_active', false);
			}
			switch ($value['varType']) {
			   case 'text':
			   		$this->Template = 'text.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'select':
			   		$this->Template = 'select.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			   		break;	
			   case 'multi_select':
			   		$this->Template = 'multi_select.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'textarea':
			   		$this->Template = 'textarea.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'chekbox':
			   		$this->Template = 'chekbox.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'radio':
			   		$this->Template = 'radio.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'password':
			   		$this->Template = 'password.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'kaptcha':
			   		$this->Template = 'kaptcha.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   case 'calendar':
			   		$scripts['calendar']= '<script type="text/javascript" src="/js/calendar.js"></script>';
			   		$this->Template = 'calendar.tpl';
					$data_fields[$key]['html'] = $this->response->display();
			     	break;
			   	break;
			}
		}
		$this->document->addValue('data_form', $data_form);
		$this->document->addValue('data', $data_fields);
		$this->Template = 'table_fields.tpl';
		$fields_html = $this->response->display();
		
		$button_submit = '<input type="submit" value="Отправить" class="auto_form_submit">';
		
		$template_html = str_replace('{name-form}',			$data_form['varName'],			$data_form['varTemplateForm']);
		$template_html = str_replace('{table-fields}',		$fields_html,					$template_html);
		$template_html = str_replace('{description-form}',	$data_form['varDescription'],	$template_html);
		$template_html = str_replace('{button-submit}',		$button_submit,					$template_html);
		$this->document->addValue('scripts', $scripts);
		$this->document->addValue('data_form', $data_form);
		$this->document->addValue('template_html', $template_html);
		$this->Template = 'main_form.tpl';
		$form['html'] = $this->response->display();
		return $form['html'];
	}
	
	function values_to_array($data){
		if(empty($data)) return;
		
		$tmp = explode(',',$data);
		foreach ($tmp as $value) {
			list($a, $b) = explode('=', $value);
			$t = array('key'=>trim($a),'value'=>trim($b));
			$ret[] = $t;
		}
		return $ret;
	}
	
	function select_table($data, $id=null){
		$key = $this->$data->getKeyColumn();
		if(!is_null($id)){
			if(is_array($id)){
				$where = array('IN'.$key['name']=>"'".implode("', '", $id)."'");
			}else{
				$where = array($key['name']=>$id);
			}
		}else{
			$where = null;
		}
		$data_select = $this->$data->GetList($where, array('varName'=>'ASC'));	
		foreach ($data_select as $value) {
			$arr[$value[$key['name']]]['key'] = $value[$key['name']];
			$arr[$value[$key['name']]]['value'] = $value['varName'];
		}
		return $arr;
	}
	
	function getValueField($value, $array){
		$arr = $this->values_to_array($array);	
		$ar = array();
		foreach ($arr as $val) {
			if($val['key'] == $value){
				$ar[] = $val['value'];
			}
		}
		if(empty($ar)){
			$ar[] = $value;
		}
		return implode(', ', $ar);
	}
	
	function SendFormData(){
		$intFormID = $this->request->getNumber('intFormID', 0);
		$data_form = $this->FormsTable->GetByFields(array('intFormID'=>$intFormID));
		if($intFormID != 0 && !empty($data_form)){
			$data_fields = $this->FormFieldsTable->GetList(array('intFormID'=>$data_form['intFormID']), array('intOrdering'=>'ASC'));
			$kaptcha_flag = true;
			$msend = false;
			foreach ($data_fields as $val) {
				$relative_fields[$val['intFieldID']] = $val;
				if($val['varType'] == 'kaptcha'){
					$intKaptchaID = $val['intFieldID'];
					$kaptchaTextFields = 'form_'.$data_form['intFormID'].'_field_'.$intKaptchaID;
					$varKaptcha = $this->request->getString($kaptchaTextFields);
					if(trim($varKaptcha) != $this->session->Get($kaptchaTextFields) || trim($varKaptcha)=='' || $this->session->Get($kaptchaTextFields) == ''){
						$kaptcha_flag = false; 
						$this->addErrorMessage($val['varErrorMessage']);
					}
				}
			}
			if($kaptcha_flag){
				$body = '<table>';
				$field_send = array();
				foreach($_POST as $key=>$value){
					if(isset($intKaptchaID) && $key == $kaptchaTextFields){ continue; }
					$reg = '/^form_(\d+)_field_(\d+)(.*)/i';
				    preg_match($reg, $key, $mathes);
				    $FFID = $mathes[1];
				    $intFieldID = $mathes[2];
				    $last_part = $mathes[3];
				    $arr = array();
				    if($FFID == $intFormID && array_key_exists($intFieldID, $relative_fields) && !in_array($intFieldID, $field_send) && !empty($value)){
			    		if($relative_fields[$intFieldID]['varTableSelect'] != ''){
			    			$table_select = $this->select_table($relative_fields[$intFieldID]['varTableSelect'], $value);
			    			foreach ($table_select as $val) {	$arr[] = $val['value']; } 
							$text = implode(', ',$arr);
			    		}else{
			    			if(is_array($value)){
			    				if(
			    					$relative_fields[$intFieldID]['varType'] == 'select' ||
			    					$relative_fields[$intFieldID]['varType'] == 'multi_select' ||
			    					$relative_fields[$intFieldID]['varType'] == 'chekbox' ||
			    					$relative_fields[$intFieldID]['varType'] == 'radio'
								){
									foreach ($value as $val) {
										$arr[] = $this->getValueField($val, $relative_fields[$intFieldID]['varValues']);	
									}
									$text = implode(', ',$arr);
								}else{
									$text = implode(', ',$value);
								}
			    			}else{
			    				if($relative_fields[$intFieldID]['varType'] == 'calendar' && ($last_part == 'Day' || $last_part == 'Month' || $last_part == 'Year')){
									$text = $_POST['form_'.$FFID.'_field_'.$intFieldID.'Year'].'-'.$_POST['form_'.$FFID.'_field_'.$intFieldID.'Month'].'-'.$_POST['form_'.$FFID.'_field_'.$intFieldID.'Day'];
									$text = date('Y-m-d', strtotime($text));
			    				}else{
			    					if(
			    						$relative_fields[$intFieldID]['varType'] == 'select' ||
			    						$relative_fields[$intFieldID]['varType'] == 'multi_select' ||
			    						$relative_fields[$intFieldID]['varType'] == 'chekbox' ||
			    						$relative_fields[$intFieldID]['varType'] == 'radio'
									){
										$text = $this->getValueField($value, $relative_fields[$intFieldID]['varValues']);	
									}else{
										$text = $value;
									}
			    				}
							}
						}
						$body .= '<tr><td>'.$relative_fields[$intFieldID]['varName'].':</td><td>'.$text.'</td></tr>';		
						$field_send[] = $intFieldID;
				    }
				}
				$body .= '</table>';
			
				foreach(explode(',', $data_form['varEmailTO']) as $to) {
					$this->mail = new PHPMailer();
					$template_html = str_replace('{name-form}',			$data_form['varName'],			$data_form['varTemplate']);
					$template_html = str_replace('{table-fields}',		$body,							$template_html);
					$template_html = str_replace('{description-form}',	$data_form['varDescription'],	$template_html);
					$this->mail->Subject = $data_form['varSubject'];
					$this->mail->Body = $template_html;
					$this->mail->From = $data_form['varEmailFrom'];
					$this->mail->FromName = $data_form['varFromName'];
					$this->mail->ContentType = 'text/html';
					$this->mail->AddCustomHeader('MIME-Version: 1.0' . "\n");
					$this->mail->CharSet = 'utf-8';
					$this->mail->AddAddress($to);
					if($this->mail->Send()) {
						$msend = true;
						$this->session->Remove('form_'.$intFormID);
					}
				}
				if($msend) $this->addMessage('Спасибо. Ваша форма отправлена'); else $this->addErrorMessage('Ошибка отправки, пожалуйста повторите попытку позже.');
			}else{
				$this->session->Set('form_'.$intFormID, $_POST);
			}
			$this->response->redirect(($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/'));
		}
	}
	
	static function GetFieldType(){
		return FormCreator::$FieldType;
	}

	static function GetFieldCheck(){
		return FormCreator::$FieldCheck;
	}

	static function GetFieldTableSelect(){
		return FormCreator::$FieldTableSelect;
	}
}
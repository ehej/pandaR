<?php
class LinkCreator {
	
	public function LinkCreator() {
	}
	
	static function create($data, $data_alias) {
//		print_r($data['varModule']);	
		switch ($data['varModule']) {
		    case "page":	
		        $link = '/'.$data_alias['pages'][$data['varIdentifier']]['varUrlAlias'];
		        break;
		        
		    case "news_archive":
		        $link = '/news';
		        break;
		    case "news":
		        $link = '/news/record'.$data['varIdentifier'];
		        break;
			case "tours":
			case "tours-country":
				$link = '/tours-country/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'];
				break;
			case "vizas":
				$link = '/vizas-country/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'];
				break;
		    case "news_type":
		        $link = '/news/cat/'.$data_alias['news_type'][$data['varIdentifier']]['varUrlAlias'];
		        break;   
		   	case "about_country":
		        $link = '/about-country/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'];
		        break;
		    case "so":
		        $link = '/spo'.($data['intCountryID']?'/'.$data['intCountryID']:'');
		        break;
		        
		    case "countries":
		        $link = '/countries/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'];
		        break;
		    case "resorts":
		        $link = '/cities-country/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'];
		        break;
		    case "resort_one":
		        $link = '/cities/'.$data_alias['resorts'][$data['intResortID']]['varUrlAlias'];
		        break;
		    case "regions":
		        $link = '/regions-country/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'];
		        break;
		    case "region_one":
		        $link = '/regions/'.$data_alias['regions'][$data['intRegionID']]['varUrlAlias'];
		        break;
		    case "hotels":
					$link = '/hotels-country/'.$data_alias['countries'][$data['intCountryID']]['varUrlAlias'].($data['varParentType']=='resort'?'?intResortID='.$data['intResortID']:'');	
		        break;
		    case "hotel_one":
		        $link = '/hotels/'.$data_alias['hotels'][$data['intHotelID']]['varUrlAlias'];
		        break;
	        
		    case "country":
		        $link = '/countries/'.$data_alias['countries'][$data['varIdentifier']]['varUrlAlias'];
		        break;
		    case "resort":
		        $link = '/cities/'.$data_alias['resorts'][$data['varIdentifier']]['varUrlAlias'];
		        break;
		    case "region":
		        $link = '/regions/'.$data_alias['regions'][$data['varIdentifier']]['varUrlAlias'];
		        break;
		    case "hotel":
		        $link = '/hotels/'.$data_alias['hotels'][$data['varIdentifier']]['varUrlAlias'];
		        break;
		    case "hotel_gallery":
		        $link = '/hotels/'.$data_alias['hotels'][$data['varIdentifier']]['varUrlAlias'].'/gallery';
		        break;
		        
		    case "attractions":
		        $link = '/attractions/'.($data['varParentType']=='resort'?'resort':'country').'/'.($data_alias[($data['varParentType']=='resort'?'resorts':'countries')][($data['varParentType']?$data['intParentID']:$data['intCountryID'])]['varUrlAlias']?$data_alias[($data['varParentType']=='resort'?'resorts':'countries')][($data['varParentType']?$data['intParentID']:$data['intCountryID'])]['varUrlAlias']:$data['varIdentifier2']);
		        break;
		    case "attraction":
		        $link = '/attraction/'.($data_alias['attractions'][$data['varIdentifier']]['varUrlAlias']?$data_alias['attractions'][$data['varIdentifier']]['varUrlAlias']:$data['varIdentifier']);
		        break;
		        
		    case "other_info":
		        $link = '/info/'.($data_alias['other_info'][$data['varIdentifier']]['varUrlAlias']?$data_alias['other_info'][$data['varIdentifier']]['varUrlAlias']:$data['varIdentifier']);
		        break;
		    
		    case "adv_country":
		        $link = '/guide/'.$data_alias['AdvCountries'][$data['varIdentifier']]['varUrlAlias'];
		        break;
		    case "adv_resort":
		        $link = '/guide/'.$data_alias['AdvCountries'][$data['varIdentifier']]['varUrlAlias'].'/'.$data['varUrlAlias'];
		        break;
		    case "adv_resort_content":
		        $link = '/guide/'.$data_alias['AdvCountries'][$data['varIdentifier']]['varUrlAlias'].'/'.$data_alias['AdvResorts'][$data['intResortID']]['varUrlAlias'].'/'.$data['varUrlAlias'];
		        break;
		    
		    case "promoakcii":
		        $link = '/promo-'.$data['varIdentifier'];
		        break;
		    
		    case "excursion":
		        $link = '/excursion-'.$data['varIdentifier'];
		        break;
		    case "excursions":
		        $link = '/excursions/'.($data['varParentType']=='resort'?'resorts':'country').'/'.($data_alias[($data['varParentType']=='resort'?'resorts':'countries')][($data['varParentType']?$data['intParentID']:$data['intCountryID'])]['varUrlAlias'] != ''?$data_alias[($data['varParentType']=='resort'?'resorts':'countries')][($data['varParentType']?$data['intParentID']:$data['intCountryID'])]['varUrlAlias']:$data['varIdentifier2']);
		        break;
		        
		    case "documents":
		        $link = '/documents';
		        break;
		            
		    case "subscribes":
		        $link = '/subscribes';
		        break;
		    case "unsubscribes":
		        $link = '/unsubscribes';
		        break;
		    case "link":
		        $link = $data['varUrl'];
		        break;
		    case "feedback":
		        $link = '/feedback';
		        break;
		    case "private_room":
		        $link = '/private-room';
		        break;
		    case "akcii":
		        $link = '/akcii';
		        break; 
		    case "akciya":
		        $link = '/akciya-'.$data['varIdentifier'];
		        break;
		    case "where_buy":
		        $link = '/gde-kupit-tour';
		        break;
		    case "contact":
		        $link = '/contact';
		        break;    
		    case "currency_courses":
		        $link = '/currency-courses';
		        break;
		    case "contacts_region":
		        $link = '/contacts-region';
		        break;
		    case "guest_book":
		        $link = '/guest-book';
		        break;
		    case "index":
		        $link = '/';
		        break;    
		        
		    default:	
		        $link = $data_alias['pages'][$data['varIdentifier']]['varUrlAlias'];
		        break;        
		}
		//echo(' '.$link.'<br>');
		return $link;

	}
	
	static function url_to_id($module,$url,$all_alias){
	   		/*$data['AdvCountries'] 		= $this->AdvCountriesTable->getListIDsUrl();
			$data['AdvResortsContent'] 	= $this->AdvResortsContentTable->getListIDsUrl();
			$data['AdvResorts'] 		= $this->AdvResortsTable->getListIDsUrl();
			$data['countries'] 			= $this->countriesTable->getListIDsUrl();
			$data['pages'] 				= $this->pagesTable->getListIDsUrl();
			$data['regions'] 			= $this->regionsTable->getListIDsUrl();
			$data['resorts'] 			= $this->ResortsTable->getListIDsUrl();
			$data['hotels']
*/
			$id = '';
			$clear_url = trim($url,' /');
		    foreach ($all_alias[$module] as $key => $value) {
		    	if($clear_url == $value['varUrlAlias']){
					$id = $key;
		    	}
		    }
		    return $id;
	}
}
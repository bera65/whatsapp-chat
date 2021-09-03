<?php
/**
F Yazılım 2009 - 2017
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class whatsapp extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'whatsapp';
        $this->tab = 'administration';
        $this->version = '3.0.0';
        $this->author = 'fyazilim.com';
        $this->module_key = 'b13e0ca14c55a0671b84c086f1010ac5';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Whatsapp Chat');
        $this->description = $this->l('Add your number to whatsapp');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        include(dirname(__FILE__).'/sql/install.php');
		return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayFooter') &&
            $this->registerHook('leftColumn') &&
            $this->registerHook('rightColumn');
    }

    public function uninstall()
    {
        include(dirname(__FILE__).'/sql/uninstall.php');
		return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
		$output = null;
		$languages = Language::getLanguages(false);
		
/*********** GENERAL INFORMATION ***********/
		if (((bool)Tools::isSubmit('telekle')) == true) {
			$telefon 		= Tools::getValue('telefon');
			$shook 			= Tools::getValue('shook');
			$shareThis 		= Tools::getValue('shareThis');
			$shareMessage 	= Tools::getValue('shareMessage');
			$userName 		= Tools::getValue('userName');
		
			if (Validate::isPhoneNumber($telefon) && Validate::isCountryName($shook) && Validate::isInt($shareThis) && Validate::isCleanHtml($shareMessage) && Validate::isName($userName))
			{
				Db::getInstance()->update('whatsapp', array(
					'telefon' 		=> pSQL($telefon),
					'shareThis' 	=> (int)$shareThis,
					'shareMessage' 	=> pSQL($shareMessage),
					'userName' 		=> pSQL($userName),
					'hook' 			=> pSQL($shook),
				), 'id_whatsapp = 1');
				$output .= $this->displayConfirmation($this->l('Settings updated'));
			}
			else
				$output .= $this->displayError($this->l('Invalid Configuration value'));
		}
/*********** STATUS ***********/		
		if (((bool)Tools::isSubmit('statusChange')) == true) {
			$statusch = Tools::getValue('statusch');
		
			if (Validate::isInt($statusch))
			{
				Db::getInstance()->update('whatsapp_settings', array(
					'status' => (int)$statusch,
				), 'id_settings = 1');
				$output .= $this->displayConfirmation($this->l('Settings updated'));
			}
			else
				$output .= $this->displayError($this->l('Invalid Configuration value'));
			
			if (isset($_FILES["avatar"]))
			{
				require_once(_PS_MODULE_DIR_.'whatsapp/include/class.upload.php');
				$rtipi = $_FILES["avatar"]["type"];
				if ((($rtipi=="image/jpeg") OR ($rtipi=="image/gif") OR ($rtipi=="image/png")))
				{
					$upload = new Upload($_FILES["avatar"]);
					if($upload->uploaded)
					{
						$isim = 'whatsapp';
						$upload->image_resize          = true;
						$upload->image_ratio_fill      = true;
						$upload->file_overwrite 	   = true;
						$upload->image_x               = 90;
						$upload->image_y               = 90;
						$upload->image_convert         = 'jpg';
						$output .= $this->displayConfirmation($this->l('Change Image'));
					}
					$upload->file_new_name_body = $isim;
					$upload->Process(_PS_MODULE_DIR_.'whatsapp/views/img/');
				}
			}
		}
		
/*********** STATUS NAME ***********/		
		if (((bool)Tools::isSubmit('statusEdit')) == true) {
			foreach ($languages as $l)
			{
				$idLang 	= $l['id_lang'];
				$online 	= Tools::getValue('online_'.$l['id_lang'].'');
				$offline 	= Tools::getValue('offline_'.$l['id_lang'].'');
				$busy 		= Tools::getValue('busy_'.$l['id_lang'].'');
				
				$statusTouchOne = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'whatsapp_status_lang` WHERE id_status = 1 AND id_lang ='.(int)$idLang.'');
				$statusTouchTwo = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'whatsapp_status_lang` WHERE id_status = 2 AND id_lang ='.(int)$idLang.'');
				$statusTouchThr = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'whatsapp_status_lang` WHERE id_status = 3 AND id_lang ='.(int)$idLang.'');
				
				if (!$statusTouchOne)
					Db::getInstance()->insert('whatsapp_status_lang', array('id_status' => 1, 'id_lang' => (int)$idLang));
				if (!$statusTouchTwo)
					Db::getInstance()->insert('whatsapp_status_lang', array('id_status' => 2, 'id_lang' => (int)$idLang));
				if (!$statusTouchThr)
					Db::getInstance()->insert('whatsapp_status_lang', array('id_status' => 3, 'id_lang' => (int)$idLang));
				
				if (Validate::isCarrierName($online) && Validate::isCarrierName($offline) && Validate::isCarrierName($busy))
				{
					Db::getInstance()->update('whatsapp_status_lang', array(
						'status_message' 	=> pSQL($online),
					), 'id_status = 1 AND id_lang ='.(int)$idLang);
					Db::getInstance()->update('whatsapp_status_lang', array(
						'status_message' 	=> pSQL($offline),
					), 'id_status = 2 AND id_lang ='.(int)$idLang);
					Db::getInstance()->update('whatsapp_status_lang', array(
						'status_message' 	=> pSQL($busy),
					), 'id_status = 3 AND id_lang ='.(int)$idLang);
					$output .= $this->displayConfirmation($this->l('Settings updated'));
				}
				else
					$output .= $this->displayError($this->l('Invalid Configuration value'));
			}
		}
/*********** GENERAL SETTINGS ***********/		
		if (((bool)Tools::isSubmit('globalSettings')) == true) {	
			$opn 		= Tools::getValue('opn');
			$clse 		= Tools::getValue('clse');
			$showefect 	= Tools::getValue('showefect');
			$showAfter 	= Tools::getValue('showAfter');
			$opn 		= str_replace(':','',$opn);
			$clse 		= str_replace(':','',$clse);
			
			$fristOpn 	= Tools::substr($opn, 0, 1);
			$fristClose	= Tools::substr($opn, 0, 1);
			
			if ($fristOpn == 0 OR $fristClose == 0)
				$output .= $this->displayError($this->l('Please not add 0 eg: 8:30'));
			
			if (Validate::isInt($opn) && Validate::isInt($clse) && Validate::isInt($showefect) && Validate::isInt($showAfter) && Tools::strlen($opn) < 5 && Tools::strlen($clse) < 5)
			{
				Db::getInstance()->update('whatsapp_settings', array(
					'open' 			=> (int)$opn,
					'close' 		=> (int)$clse,
					'show_efect' 	=> (int)$showefect,
					'show_offline' 	=> (int)$showAfter,
				), 'id_settings = 1');
				
				$output .= $this->displayConfirmation($this->l('Settings updated'));
			}
			else
				$output .= $this->displayError($this->l('Invalid Configuration value'));
		}
		
		
		$iso_code = $this->context->language->iso_code;
		$no 				= Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp WHERE id_whatsapp = 1');
		$generalSetting 	= Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp_settings WHERE id_settings = 1');
		
		$whatasppno 		= $no['telefon'];
		$hook 				= $no['hook'];
		$shareThis 			= $no['shareThis'];
		$userName 			= $no['userName'];
		$shareMessage  		= $no['shareMessage'];
		$opn  				= $generalSetting['open'];
		$clse  				= $generalSetting['close'];
		$showEfect 			= $generalSetting['show_efect'];
		$showOffline 		= $generalSetting['show_offline'];
		$status  			= $generalSetting['status'];
		
		$opn 				= substr_replace($opn, ':', -2).Tools::substr($opn , -2);
		$clse 				= substr_replace($clse, ':', -2).Tools::substr($clse , -2);
		
		$this->context->smarty->assign(array(
			'whatasppno' 	=> $whatasppno,
			'hook' 			=> $hook,
			'shareThis' 	=> $shareThis,
			'userName' 		=> $userName,
			'shareMessage' 	=> $shareMessage,
			'whp_mdir' 		=> $this->_path,
			'lang_iso' 		=> $iso_code,
			'pyazi' 		=> "{PRODUCT}",
			'languages' 	=> $languages,
			'opn' 			=> $opn,
			'clse' 			=> $clse,
			'showEfect' 	=> $showEfect,
			'showOffline' 	=> $showOffline,
			'status' 		=> $status,
			'timeST' 		=> strtotime("now"),
		));
        return $output.$this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
		if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/whatsapp.js');
        $this->context->controller->addCSS($this->_path.'/views/css/whatsapp.css');
    }

    public function whatsapp($params)
    {
		$detect 	= new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		$lang 		= $params['cookie']->id_lang;
		
		$st = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp_settings WHERE id_settings = 1');
		$openSt 		= $st['open'];
		$closeSt 		= $st['close'];
		$showEfect		= $st['show_efect'];
		$showOffline	= $st['show_offline'];
		$status			= $st['status'];
		
		$defaultTime = Configuration::get('PS_TIMEZONE');
		date_default_timezone_set(''.$defaultTime.'');
		$time = date('H:i');
		$time = str_replace(':','',$time);
		
		$no = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp WHERE id_whatsapp = 1');
		$whatasppno 		= $no['telefon'];
		$hook 				= $no['hook'];
		$shareThis 			= $no['shareThis'];
		$shareMessage  		= $no['shareMessage'];
		$userName	  		= $no['userName'];
		
		$page = Tools::getValue('controller');
		if (Validate::isCountryName($page) && $page == 'product')
		{
			$idPr = Tools::getValue('id_product');
			$pr   = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'product_lang` WHERE id_product = '.(int)$idPr.' AND id_lang = '.(int)$lang.'');
			$name = $pr['name'];
			
			$shareMessage = str_replace("{PRODUCT}","*".$name."*","{$shareMessage}");
		}
		
		$this->context->smarty->assign(array(
			'whatasppno' 	=> $whatasppno,
			'hook' 		 	=> $hook,
			'deviceType' 	=> $deviceType,
			'shareThis' 	=> $shareThis,
			'shareMessage' 	=> $shareMessage,
			'userName' 		=> $userName,
			'openSt' 		=> $openSt,
			'closeSt' 		=> $closeSt,
			'showEfect' 	=> $showEfect,
			'showOffline' 	=> $showOffline,
			'status' 		=> $status,
			'time' 			=> $time,
			'lang' 			=> $lang,
			'attac' 		=> 1,
			'whataspp_module_dir' => $this->_path,
		));

		if (_PS_VERSION_ > 1.6)
			return $this->context->smarty->fetch($this->local_path.'views/templates/front/footer_v2.tpl');
		else
			return $this->context->smarty->fetch($this->local_path.'views/templates/front/footer.tpl');
    }
	public function hookDisplayFooter($params)
    {
        $no = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp WHERE id_whatsapp = 1');
		$hook = $no['hook'];
		if ($hook == 'footer')
			return $this->whatsapp($params);
    }
	public function hookLeftColumn($params)
	{
		$no = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp WHERE id_whatsapp = 1');
		$hook = $no['hook'];
		if ($hook == 'leftColumn')
			return $this->whatsapp($params);
	}
	public function hookRightColumn($params)
	{
		$no = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp WHERE id_whatsapp = 1');
		$hook = $no['hook'];
		if ($hook == 'rightColumn')
			return $this->whatsapp($params);
	}
	public static function getValueLang($idValue, $lang)
	{
		$statusLang = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp_status_lang WHERE id_status = '.(int)$idValue.' AND id_lang = '.(int)$lang.'');
		$rtr 		= $statusLang['status_message'];
		return $rtr;
	}
	public static function getStatus($idST)
	{
		$status = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'whatsapp_status WHERE id_status = '.(int)$idST.'');
		$stName = $status['status_name'];
		return $stName;
	}
}

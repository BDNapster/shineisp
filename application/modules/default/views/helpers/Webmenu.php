<?php
/**
 * Webmenu helper
 */
class Zend_View_Helper_Webmenu extends Zend_View_Helper_Abstract {
	public $view;
	protected $translator;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
	
	/*
	 * menu
	 * Create the menu
	 */
	public function webmenu() {
		$this->translator = Shineisp_Registry::get ( 'Zend_Translate' );
		$NS = new Zend_Session_Namespace ( 'Default' );
		if (!empty($NS->customer)) {
			$this->view->user = $NS->customer;
		}
		
		$menu = array('items' => array(), 'parents' => array());

		// Get the store categories product
		$categories = ProductsCategories::getMenu ();
		foreach($categories as $menuItem)
		{
			$menu['items'][$menuItem['category_id']] = $menuItem;
			$menu['parents'][$menuItem['parent']][]  = $menuItem['category_id'];
		}
		
		// Create CMS pages menu
		$cmsmenu = '<li><a href="/">'.$this->translator->translate('Blog').'</a>' . $this->createMenu(0) . "<li>";
		
		// Create the tlds list menu
		$tldmenu = $this->createTldMenu();
		
		// Create the store categories menu
		$storecategories = $this->buildMenu(0, $menu);

		// Delete the last </ul> in the list
		$storecategories = substr_replace($storecategories ,"",-6);
		
		// Replace the header of the menu list
		$storecategories = substr_replace($storecategories, $tldmenu . $cmsmenu, 0, strlen("<ul class=''>\n"));
		
		// we will send the body of the bullet list to the partial template
		$this->view->menu = $storecategories;

		return $this->view->render ( 'partials/webmenu.phtml' );
	}
	
	/** 
	 * Create a CMS menu
	 * @param unknown_type $parent
	 * @param unknown_type $locale
	 * @return string
	 */
	private function createMenu($parent) {
		
		$locale = $this->translator->getAdapter ()->getLocale ();
		
		$children = CmsPages::getParent ( $parent, $locale );
		$items = array ();
		
		if (is_array ( $children )) {
			foreach ( $children as $row ) {
				$link = ! empty ( $row ['link'] ) ? $row ['link'] : "/cms/" . $row ['var'] . ".html";
				$items [] = "<li class=\"item\"><a href=\"" . $link . "\">" . $row ['title'] . "</a>" . $this->createMenu ( $row ['page_id'] ) . "</li>";
			}
		}
		if (count ( $items )) {
			return "<ul class=\"dropdown\">" . implode ( '', $items ) . "</ul>";
		} else {
			return '';
		}
	}
	

	private function buildMenu($parentId, $menuData, $deep=0)
	{
		$html = '';
	
		if (isset($menuData['parents'][$parentId]))
		{
			$class = ($deep) ? "dropdown" : "";
				
			$html = "<ul class='$class'>\n";
			foreach ($menuData['parents'][$parentId] as $itemId)
			{
				$html .= '<li><a class="'.$class.'" href="/categories/' . $menuData['items'][$itemId] ['uri'] . '.html">' . $menuData['items'][$itemId]['name'] . "</a>";
	
				$deep++;
	
				// find childitems recursively
				$html .= $this->buildMenu($itemId, $menuData, $deep);
	
				$deep--;
	
				$html .= "</li>\n";
			}
				
			$html .= "</ul>\n";
		}
	
		return $html;
	}
	
	
	/**
	 *
	 * Create the tld list
	 *
	 */
	private function createTldMenu() {
		$ns = new Zend_Session_Namespace ();
		$items = DomainsTlds::getHighlighted($ns->langid);
		$currency = Shineisp_Registry::get ( 'Zend_Currency' );
	
		$html = "<li>";
		$html .= '<a href="/domainschk/index/" class="dropdown">'.$this->translator->translate('Domains').'</a>';
		$html .= "<ul class=\"dropdown\">";
		foreach ( $items as $item ) {
			if(!empty($item ['DomainsTldsData'][0]['name'])){
				$item ['registration_price'] = $currency->toCurrency($item ['registration_price'], array('currency' => Settings::findbyParam('currency')));
				$html .= '<li><a title="' . Shineisp_Commons_Utilities::truncate(strip_tags($item ['DomainsTldsData'][0]['description']), 150, "...", false, true) . '" href="/tlds/' . $item ['DomainsTldsData'][0]['name'] . '.html">.<b>' . strtoupper($item ['DomainsTldsData'][0]['name']) . "</b> - " . $item ['registration_price'] . " (" . $this->translator->translate('VAT not included') . ")</a></li>";
			}
		}
		$html .= "</ul>";
		$html .= "</li>";
	
		return $html;
	}
}

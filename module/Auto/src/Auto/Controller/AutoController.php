<?php
/**
 * Created by JetBrains PhpStorm.
 * User: winder
 * Date: 10.02.13
 * Time: 10:40
 * To change this template use File | Settings | File Templates.
 */
namespace Auto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AutoController extends AbstractActionController
{
	protected $autoTable;

	public function indexAction()
	{
		$category_list = $this->getAutoTable()->getCategoryList();

		foreach($category_list as $key => $category) {
			$category_all[$key]['link'] = '/list/' . $category->id;
			$category_all[$key]['title'] = $category->title;
			$category_all[$key]['id'] = $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
			$category_all[$key]['ref_id'] = $category->ref_id;
		}

		$firms_list = $this->getAutoTable()->getFirmsAll();
		foreach($firms_list as $key => $firms) {
			$firms_all[$key]['title'] = $firms->title;
			$firms_all[$key]['id'] = $firms->id;
			$firms_all[$key]['desc'] = $firms->description;
			$firms_all[$key]['image'] = $firms->image;
			$firms_all[$key]['link'] = '/firmlist/' . $firms->id;
		}

		return new ViewModel(array(
			'hitauto' => $this->getAutoTable()->getHitAuto(),
			'cat_list' => $category_all,
			'firms_all' => $firms_all,
		));
	}

	public function onasAction()
	{
		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$category_all[$key]['link'] = '/list/' . $category->id;
			$category_all[$key]['title'] = $category->title;
			$category_all[$key]['id'] = $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
			$category_all[$key]['ref_id'] = $category->ref_id;
		}

		return new ViewModel(array(
			'hitauto' => $this->getAutoTable()->getHitAuto(),
			'cat_list' => $category_all,
		));
	}

	public function contactsAction()
	{
		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$cat_list[$key]['title'] = $category->title;
			$cat_list[$key]['link'] = '/list/' . $category->id;
		}
		return new ViewModel(array(
			'hitauto' => $this->getAutoTable()->getHitAuto(),
			'cat_list' => $cat_list,
		));
	}

	public function adminAction($id = null)
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		$category_list = $this->getAutoTable()->getCategoryAll();
		foreach($category_list as $key => $category) {
			$category_all[$key]['title'] = $category->title;
			$category_all[$key]['id'] = $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
			$category_all[$key]['ref_id'] = $category->ref_id;
		}

		$products_list = $this->getAutoTable()->getProductsAll();
		foreach($products_list as $key => $product) {
			$products_all[$key]['title'] = $product->title;
			$products_all[$key]['id'] = $product->id;
			$products_all[$key]['desc'] = $product->description;
			$products_all[$key]['firm_id'] = $product->firm_id;
			$products_all[$key]['ref_id'] = $product->ref_id;
			$products_all[$key]['image'] = $product->image;
			$products_all[$key]['is_on_main'] = $product->is_on_main;
		}

		$firms_list = $this->getAutoTable()->getFirmsAll();
		foreach($firms_list as $key => $firms) {
			$firms_all[$key]['title'] = $firms->title;
			$firms_all[$key]['id'] = $firms->id;
			$firms_all[$key]['desc'] = $firms->description;
			$firms_all[$key]['image'] = $firms->image;
		}

		return new ViewModel(array(
			'firms_all' => $firms_all,
			'products_all' => $products_all,
			'category_all' => $category_all,
		));
	}


	public function addcatAction()
	{

		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		if(isset($_POST['title'])) {
			$aCategoryAdd['title'] = $_POST['title'];
			$aCategoryAdd['description'] = $_POST['description'];
			$aCategoryAdd['ref_id'] = $_POST['ref_id'];
			$aCategoryAdd['image'] = $_POST['image'];
			if($this->getAutoTable()->addCategory($aCategoryAdd)) {
				return $this->redirect()->toUrl('/admin');
			}
		}

		$category_list = $this->getAutoTable()->getCategoryAll();
		foreach($category_list as $key => $category) {
			$category_all[$key]['title'] = $category->title;
			$category_all[$key]['id'] = $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
			$category_all[$key]['ref_id'] = $category->ref_id;
		}

		return new ViewModel(array(
			'category_all' => $category_all,
		));
	}

	public function addfirmAction()
	{

		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		if(isset($_POST['title'])) {
			$aFirmAdd['title'] = $_POST['title'];
			$aFirmAdd['description'] = $_POST['description'];
			$aFirmAdd['image'] = $_POST['image'];
			if($this->getAutoTable()->addFirm($aFirmAdd)) {
				return $this->redirect()->toUrl('/admin');
			}
		}
	}

	public function addproductAction()
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		if(isset($_POST['title'])) {
			$aProdAdd['title'] = $_POST['title'];
			$aProdAdd['description'] = $_POST['description'];
			$aProdAdd['ref_id'] = (int)$_POST['ref_id'];
			$aProdAdd['firm_id'] = (int)$_POST['firm_id'];
			if($_POST['is_on_main'] == 'on'){
				$aProdAdd['is_on_main'] = 1;
			} else {
				$aProdAdd['is_on_main'] = 0;
			}
			$aProdAdd['image'] = $_POST['image'];
			if($this->getAutoTable()->addProduct($aProdAdd)) {
				return $this->redirect()->toUrl('/admin');
			}
		}

		$category_list = $this->getAutoTable()->getCategoryAll();
		foreach($category_list as $key => $category) {
			$category_all[$key]['title'] = $category->title;
			$category_all[$key]['id'] = $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
			$category_all[$key]['ref_id'] = $category->ref_id;
		}

		$firms_list = $this->getAutoTable()->getFirmsAll();
		foreach($firms_list as $key => $firms) {
			$firms_all[$key]['title'] = $firms->title;
			$firms_all[$key]['id'] = $firms->id;
			$firms_all[$key]['desc'] = $firms->description;
			$firms_all[$key]['image'] = $firms->image;
		}

		return new ViewModel(array(
			'category_all' => $category_all,
			'firms_all' => $firms_all,
		));

	}

	public function editAction()
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}
		if(isset($_POST['sub_btn'])) {
			if($_POST['sub_btn'] == 'Закрыть') {
				return $this->redirect()->toUrl('/admin');
			} else {
				if(isset($_POST['cat_edit'])) {
					$id = $_POST['cat_edit'];
					$aCategoryUpd['title'] = $_POST['title'];
					$aCategoryUpd['description'] = $_POST['description'];
					$aCategoryUpd['ref_id'] = $_POST['ref_id'];
					$aCategoryUpd['image'] = $_POST['image'];
					$this->getAutoTable()->setCategory($id, $aCategoryUpd);
					$id = $_POST['cat_edit'];
					unset($_POST);
					$_POST['cat_id'] = $id;
				}

				if(isset($_POST['firm_edit'])) {
					$id = $_POST['firm_edit'];
					$aFirmUpd['title'] = $_POST['title'];
					$aFirmUpd['description'] = $_POST['description'];
					$aFirmUpd['image'] = $_POST['image'];
					$this->getAutoTable()->setFirm($id, $aFirmUpd);
					$id = $_POST['firm_edit'];
					unset($_POST);
					$_POST['firm_id'] = $id;
				}

				if(isset($_POST['prod_edit'])) {
					$id = $_POST['prod_edit'];
					$aProdUpd['title'] = $_POST['title'];
					$aProdUpd['description'] = $_POST['description'];
					$aProdUpd['image'] = $_POST['image'];
					$aProdUpd['ref_id'] = $_POST['ref_id'];
					$aProdUpd['firm_id'] = $_POST['firm_id'];
					if($_POST['is_on_main'] == 'on'){
						$aProdUpd['is_on_main'] = 1;
					} else {
						$aProdUpd['is_on_main'] = 0;
					}
					$this->getAutoTable()->setProduct($id, $aProdUpd);
					$id = $_POST['prod_edit'];
					unset($_POST);
					$_POST['prod_id'] = $id;
				}
			}
		}

		if(isset($_POST['cat_id'])) {
			$id = $_POST['cat_id'];
			$category = $this->getAutoTable()->getCategory($id);
			foreach($category as $cat){
			$aCategory['id'] = $cat->id;
			$aCategory['title'] = $cat->title;
			$aCategory['ref_id'] = $cat->ref_id;
			$aCategory['description'] = $cat->description;
			$aCategory['image'] = $cat->image;
			}

			$category_list = $this->getAutoTable()->getCategoryAll();
			foreach($category_list as $key => $category) {
				$category_all[$key]['title'] = $category->title;
				$category_all[$key]['id'] = $category->id;
				$category_all[$key]['desc'] = $category->description;
				$category_all[$key]['image'] = $category->image;
				$category_all[$key]['ref_id'] = $category->ref_id;
			}

			return new ViewModel(array(
				'category_all' => $category_all,
				'aCategory' => $aCategory,
			));
		}

		if(isset($_POST['firm_id'])) {
			$id = $_POST['firm_id'];
			$oFirm = $this->getAutoTable()->getFirm($id);
			foreach($oFirm as $firm){
				$aFirm['id'] = $firm->id;
				$aFirm['title'] = $firm->title;
				$aFirm['description'] = $firm->description;
				$aFirm['image'] = $firm->image;
			}

			return new ViewModel(array(
				'aFirm' => $aFirm,
			));
		}

		if(isset($_POST['prod_id'])) {
			$id = $_POST['prod_id'];
			$oProduct = $this->getAutoTable()->getProduct($id);
			foreach($oProduct as $product){
				$aProduct['id'] = $product->id;
				$aProduct['title'] = $product->title;
				$aProduct['description'] = $product->description;
				$aProduct['image'] = $product->image;
				$aProduct['ref_id'] = $product->ref_id;
				$aProduct['firm_id'] = $product->firm_id;
				$aProduct['is_on_main'] = $product->is_on_main;
			}
			$category_list = $this->getAutoTable()->getCategoryAll();
			foreach($category_list as $key => $category) {
				$category_all[$key]['title'] = $category->title;
				$category_all[$key]['id'] = $category->id;
				$category_all[$key]['desc'] = $category->description;
				$category_all[$key]['image'] = $category->image;
				$category_all[$key]['ref_id'] = $category->ref_id;
			}
			$firms_list = $this->getAutoTable()->getFirmsAll();
			foreach($firms_list as $key => $firms) {
				$firms_all[$key]['title'] = $firms->title;
				$firms_all[$key]['id'] = $firms->id;
				$firms_all[$key]['desc'] = $firms->description;
				$firms_all[$key]['image'] = $firms->image;
			}

			return new ViewModel(array(
				'aProduct' => $aProduct,
				'category_all' => $category_all,
				'firms_all' => $firms_all,
			));
		}

	}

	public function deleteAction()
	{
	}

	public function catalogAction()
	{
		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$category_all[$key]['title'] = $cat_list[$key]['title'] = $category->title;
			$category_all[$key]['link'] = $cat_list[$key]['link'] = '/list/' . $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
		}

		$firms_list = $this->getAutoTable()->getFirmsAll();
		foreach($firms_list as $key => $firms) {
			$firms_all[$key]['title'] = $firms->title;
			$firms_all[$key]['id'] = $firms->id;
			$firms_all[$key]['desc'] = $firms->description;
			$firms_all[$key]['image'] = $firms->image;
		}
		return new ViewModel(array(
			'firms_all' => $firms_all,
			'category_all' => $category_all,
			'cat_list' => $cat_list,
		));
	}

	public function listAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		$subcategory_list = $this->getAutoTable()->getCategoryList($id);

		foreach($subcategory_list as $subcategory) {
			if(isset($subcategory->title)) {
				$product_all[$subcategory->id]['title'] = $subcategory->title;
				$product_all[$subcategory->id]['link'] = '/list/' . $subcategory->id;
				$product_all[$subcategory->id]['desc'] = $this->crop_str($subcategory->description, 300);
				$product_all[$subcategory->id]['image'] = $subcategory->image;
			}
		}
		if(!isset($product_all)) {
			$product_list = $this->getAutoTable()->getProductList($id);
			foreach($product_list as $key => $product) {
				if(isset($product->title)) {
					$product_all[$key]['title'] = $product->title;
					$product_all[$key]['link'] = '/product/' . $product->id;
					$product_all[$key]['desc'] = $this->crop_str($product->description,300);
					$product_all[$key]['image'] = $product->image;
					$product_all[$key]['firm_id'] = $product->firm_id;
					$firm_arr[] = $product->firm_id;
				}
			}
		}

		if(isset($firm_arr)) {
			$firm = $this->getAutoTable()->getFirmsAll();
			foreach($firm as $key => $firms) {
				if (in_array($firms->id, $firm_arr)) {
					$firms_all[$key]['title'] = $firms->title;
					$firms_all[$key]['id'] = $firms->id;
					$firms_all[$key]['desc'] = $firms->description;
					$firms_all[$key]['image'] = $firms->image;
				}
			}
		} else {
			$firms_all = null;
		}

		$category_list = $this->getAutoTable()->getCategoryAll();
		foreach($category_list as $key => $category) {
			$category_all[$category->id]['title'] = $cat_list[$key]['title'] = $category->title;
			$category_all[$category->id]['link'] = $cat_list[$key]['link'] = '/list/' . $category->id;
			$category_all[$category->id]['desc'] = $this->crop_str($category->description, 300);
			$category_all[$category->id]['image'] = $category->image;
		}
		return new ViewModel(array(
			'category' => $category_all[$id],
			'product_all' => $product_all,
			'firm_res' => $firms_all,
			'cat_list' => $cat_list,
		));
	}

	public function firmlistAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		$product_list = $this->getAutoTable()->getProductsByFirmId($id);

		foreach($product_list as $key => $product) {
			if(isset($product->title)) {
				$product_all[$key]['title'] = $product->title;
				$product_all[$key]['link'] = '/product/' . $product->id;
				$product_all[$key]['desc'] = $this->crop_str($product->description,300);
				$product_all[$key]['image'] = $product->image;
				$product_all[$key]['firm_id'] = $product->firm_id;
			}
		}

		$firm = $this->getAutoTable()->getFirm($id);
		foreach($firm as $firm_value) {
			$firm_res[$firm_value->id]['title'] = $firm_value->title;
			$firm_res[$firm_value->id]['link'] = $firm_value->id;
			$firm_res[$firm_value->id]['desc'] = $firm_value->description;
			$firm_res[$firm_value->id]['image'] = $firm_value->image;
		}

		$category_list = $this->getAutoTable()->getCategoryAll();
		foreach($category_list as $key => $category) {
			$cat_list[$key]['title'] = $category->title;
			$cat_list[$key]['link'] = '/list/' . $category->id;
		}

		return new ViewModel(array(
			'firm_res' => $firm_res[$id],
			'product_all' => $product_all,
			'cat_list' => $cat_list,
		));
	}

	public function productAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		$product = $this->getAutoTable()->getProduct($id);
		foreach($product as $prod){
			$prod_itog = $prod;
		}
		$id = (int)$prod_itog->ref_id;

		$category_list = $this->getAutoTable()->getCategoryAll();
		foreach($category_list as $key => $category) {
			$category_all[$category->id]['title'] = $cat_list[$key]['title'] = $category->title;
			$category_all[$category->id]['link'] = $cat_list[$key]['link'] = '/list/' . $category->id;
			$category_all[$category->id]['desc'] = $this->crop_str($category->description, 800);
			$category_all[$category->id]['image'] = $category->image;
			$category_all[$category->id]['id'] = $category->id;
		}

		return new ViewModel(array(
			'category' => $category_all[$id],
			'product' => $prod_itog,
			'cat_list' => $cat_list,
		));
	}

	public function delAction()
	{

		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		if(isset($_POST['module'])) {
			if($_POST['del'] == 'Да'){
				$this->getAutoTable()->delItem($_POST['module'], $_POST['id']);
				return $this->redirect()->toUrl('/admin');
			} else {
				return $this->redirect()->toUrl('/admin');
			}
		}
		$id = (int) $this->params()->fromRoute('id', 0);
		$module = $this->params()->fromRoute('mod', '');
		$result = $this->getAutoTable()->fetchAll($module, $id);
		foreach($result as $res){
			$result_item['id'] = $res->id;
			$result_item['title'] = $res->title;
			$result_item['module'] = $module;
		}

		return new ViewModel(array(
			'result_item' => $result_item,
		));
	}

	public function getAutoTable()
	{
		if (!$this->autoTable) {
			$sm = $this->getServiceLocator();
			$this->autoTable = $sm->get('Auto\Model\AutoTable');
		}
		return $this->autoTable;
	}

	function crop_str($string, $limit)
	{

		$substring_limited = substr($string,0, $limit);

		return substr($substring_limited, 0, strrpos($substring_limited, ' ' )) . '...';

	}
}
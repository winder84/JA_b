<?php
/**
 * Created by JetBrains PhpStorm.
 * User: winder
 * Date: 10.02.13
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */
namespace Auto\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;

class AutoTable
{
	protected $tableGateway;
	protected $adapter;

	public function __construct($dbad)
	{
		$this->adapter = $dbad;
	}

	public function fetchAll($table, $id)
	{
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from($table);
		$select->where(array('id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function delItem($table, $id)
	{
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$delete = $sql->delete($table);
		$delete->where(array('id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($delete);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function saveAuto(Auto $auto)
	{
		$data = array(
			'artist' => $auto->artist,
			'title'  => $auto->title,
		);

		$id = (int)$auto->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getAuto($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}

	public function getHitAuto() {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');
		$select->where(array('is_on_main' => '1'));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getCategoryList($ref_id = 0) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('category');
		$select->where(array('ref_id' => $ref_id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getCategoryAll() {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('category');

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getCategory($id) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('category');
		$select->where(array('id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getProductList($id) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');
		$select->where(array('ref_id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getProduct($id) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');
		$select->where(array('id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getProductsAll() {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getFirmsAll() {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('firms');

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getFirm($id) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('firms');
		$select->where(array('id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function addCategory($aCategoryAdd) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$insert = $sql->insert('category');
		$insert->values($aCategoryAdd);

		$selectString = $sql->getSqlStringForSqlObject($insert);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function addFirm($aFirmAdd) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$insert = $sql->insert('firms');
		$insert->values($aFirmAdd);

		$selectString = $sql->getSqlStringForSqlObject($insert);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function addProduct($aProductAdd) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$insert = $sql->insert('product');
		$insert->values($aProductAdd);

		$selectString = $sql->getSqlStringForSqlObject($insert);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function setCategory($id, $aCategoryUpd) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$update = $sql->update('category');
		$update->where(array('id' => $id));
		$update->set($aCategoryUpd);

		$selectString = $sql->getSqlStringForSqlObject($update);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function setFirm($id, $aFirmUpd) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$update = $sql->update('firms');
		$update->where(array('id' => $id));
		$update->set($aFirmUpd);

		$selectString = $sql->getSqlStringForSqlObject($update);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function setProduct($id, $aProdUpd) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$update = $sql->update('product');
		$update->where(array('id' => $id));
		$update->set($aProdUpd);

		$selectString = $sql->getSqlStringForSqlObject($update);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

		public function deleteAuto($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}
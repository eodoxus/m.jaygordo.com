<?php

/**
 * Controller to support C.R.U.D (create, update and delete) on models
 */
abstract class Controller_Base_CRUD extends Controller_API {
	
	// The model which this controller will interact with.
	protected $_model;
	
	// The id field (not necessarily primary key) that this model will filter objects by.
	protected $_id_field = 'id';
	
	// How to order objects returned by this controller. Must be in the format <column>|<direction>, i.e. 'user_id|desc'.
	protected $_orderby = 'dateCreated|desc';
	
	/**
	 * Find 1 or more data objects
	 *
	 * @param int (optional) The id of the object to retrieve. If empty, get a list of all objects.
	 * @return mixed The object, or a list of the objects.
	 */
	public function action_index($id = null, $extra_id = null) {
			
		if ($id) {
			$object = $this->_get_object($id);
			if ( ! $object->loaded()) throw new Api_Exception_NotFound();
			$this->content = $object->as_response();
		} else {
			$this->content = array();
			$objects = $this->_get_objects();
			foreach ($objects as $object) {
				$this->content[] = $object->as_response();
			}
		}
	}
	
	/**
	 * Add a new object for a user.
	 * 
	 * @return object The object that was just created.
	 */
	public function action_create() {
		
		if ( ! $this->_has_access()) throw new Api_Exception_AccessDenied();

		// In case they're recreating the same object, we might end up doing an update...
		$object = ORM::factory($this->_model);
		$object->values((array)$this->post_data)->check();
		$object->save();
		
		$this->request->status = 201;
		$this->content = $object->as_response();
	}
	
	/**
	 * Update an object for a user.
	 *
	 * @return object The object that was just updated.
	 */
	public function action_update() {
		
		if ( ! $this->_has_access()) throw new Api_Exception_AccessDenied();
		
		$object = ORM::factory($this->_model, $this->post_data->id);
		if ( ! $object->loaded()) throw new Api_Exception_NotFound();
		
		$object->values((array)$this->post_data)->check();
		$object->save();

		$this->content = $object->as_response();
	}
	
	/**
	 * Delete a user's object.
	 *
	 * @param int The id of the object to delete.
	 */
	public function action_delete($id) {
		
		$object = ORM::factory($this->_model, $id);
		if ( ! $object->loaded()) throw new Api_Exception_NotFound();
		
		if ( ! $this->_has_access($object)) throw new Api_Exception_AccessDenied();
		
		$object->delete();
	}
	
	/**
	 * Creates a query which finds 1 and only 1 object, filtered by object id
	 */
	protected function _get_object($id, $extra_id = null) {
		$query = ORM::factory($this->_model)->where($this->_id_field, '=', $id);
		return $this->_apply_orderby($query)->find();
	}
	
	/**
	 * Creates a query which finds all objects in the class's model.
	 */
	protected function _get_objects($extra_id = null) {
		$query = ORM::factory($this->_model);
		return $this->_apply_orderby($query)->find_all();
	}
	
	/**
	 * Apply the orderby setting to the query.
	 */
	protected function _apply_orderby($query) {
		
		if ($orderby = Input::get('orderby')) {
			$this->_orderby = $orderby;
		}
		
		if (isset($this->_orderby)) {
			
			if (strpos($this->_orderby, '|') === false) throw new API_Exception('error.invalid_orderby');
			
			list($column, $direction) = explode('|', $this->_orderby);
			$query->order_by($column, $direction);
		}
		
		return $query;
	}
	
	protected function _has_access($object=null) {
		return true;
	}
}
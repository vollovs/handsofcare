<?php
/**
 * Call PDO In this class
 */
class SQLQuery {
	protected $_dbHandle;
	protected $_result;

	/** Connects to database **/
	function connect($host, $account, $pwd, $db_name) {
		try {
			$this->_dbHandle = new PDO("mysql:host=$host;dbname=$db_name", $account, $pwd, array (
				PDO :: ATTR_PERSISTENT => true
			));
			$this->_dbHandle->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			error_log($e->getMessage(), 0);
		}
	}

	/** Disconnects from database **/
	function disconnect() {
		$this->_dbHandle = NULL;
	}

	/**
	 * Returns TRUE on success or FALSE on failure
	 */
	function execute($query, $parameters = array ()) {
		$stmt = $this->_dbHandle->prepare($query);
		if (!empty ($parameters)) {
			return $stmt->execute($parameters);
		} else {
			return $stmt->execute();
		}
	}

	/**
	 * SQL SELECT query and return an array with array[i]['$field_name']
	 */
	function query($query, $parameters = array (), $fetch_style=PDO::FETCH_BOTH ) {
		$stmt = $this->_dbHandle->prepare($query);

		if (!empty ($parameters)) {
			$stmt->execute($parameters);			
		} else {
			$stmt->execute();
		}
		$result = $stmt->fetchAll();
		return $result;
	}
	
	/** Get an array of error information  **/
	function getError() {
		return $this->_dbHandle->errorInfo();
	}
}
<?php
/**
 * Handles the database queries
 */
class Database extends PDO
{
	/**
	 * Creates a new Database instance.
	 *
	 * @param string $driver
	 * @param string $host
	 * @param string $name
	 * @param string $user
	 * @param string $pass
	 */
	public function __construct($driver, $host, $name, $user, $pass) {
		parent::__construct($driver.':dbname='.$name.';host='.$host, $user, $pass);
	}

	/**
	 * Executes a SELECT SQL query and returns the result as array of associative arrays.
	 * Returns FALSE if error occured while executing the given query.
	 *
	 * @param  string $selectQuery the SELECT query with arguments placeholders
	 * @param  string $args        the arguments to fill the prepared statement with
	 * @return array|false
	 */
	public function fetch($selectQuery, $args) {
		$stmnt = $this->executeQuery($selectQuery, $args);
		if (false === $stmnt) {
			return false;
		}

		$rows = [];
		$row = $stmnt->fetch(PDO::FETCH_ASSOC);
		while (false !== $row) {
			$rows[] = $row;
			$row = $stmnt->fetch(PDO::FETCH_ASSOC);
		}
		return $rows;
	}

	/**
	 * Executes a query using prepared statement.
	 * Returns FALSE if error occured while executing the given query.
	 *
	 * @param  string $query the SQL query with arguments placeholders
	 * @param  string $args  the arguments to fill the statement with
	 * @return PDOStatement|null
	 */
	public function executeQuery($query, $args = null) {
		$stmnt = $this->prepare($query);
		if($stmnt->execute($args))
			return $stmnt;
		return false;
	}

	/**
	 * Gets information about the last occuring error.
	 *
	 * @return string
	 */
	public function getErrors() {
		$errs = $this->errorInfo();
		return  '[SQL Code: ' . $errs[0] .
				', Driver Code: ' . $errs[1] .
				', message: "' . $errs[2] . '" ]';
	}
}
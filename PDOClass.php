<?php
class PDOClass{
	
	private $result    = array();
	private $conn      = false;
	public $PDO        = "";
	private $sql       = "";
	private $row_count = "";
	
	public function __construct(){					
		try {
			global $DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME,$DB_TYPE;
			$DB_STR = $DB_TYPE.":host=".$DB_HOST.";dbname=".$DB_NAME;
			$this->PDO = new PDO($DB_STR, $DB_USERNAME, $DB_PASSWORD);
			$this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);		
		} catch (PDOException $e) {
			print "<br>Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}	
	public function selectNoWhere($sql){ 
		$stmt = $this->PDO->query($sql);
		$row  = $stmt->fetchAll();
		return $row;
	}		
	
	public function insertPrepare($sql, $array, $return=NULL){
		try {
			$stmt = $this->PDO->prepare($sql);
			$stmt->execute($array);
			if($return == 'yes'){
				return $this->PDO->lastInsertId();
			}
		} 
		catch (PDOException $e) {
			print "<br>Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	
	public function deletePrepare($sql, $array){
		try {
			$stmt = $this->PDO->prepare($sql);
			$stmt->execute($array);
		} catch (Exception $e) {
			echo "<br>Error!: " . $e->getMessage() . "<br/>";
		}
	}	
	
	public function updatePrepare($sql, $array){
		$stmt = $this->PDO->prepare($sql);
		$stmt->execute($array);
	}
	
	public function updatePrepareNoWhereNoData($sql){
		$stmt = $this->PDO->prepare($sql);
		$stmt->execute();
	}
	
	public function rowCount(){
	}	
	
	public function selectWhereClause($sql,$array){
		$stmt = $this->PDO->prepare($sql);
		$stmt->execute($array);
		$row  = $stmt->fetchAll();
		return $row;
	}
	
	public function selectWhereClauseLimit($sql,$array){
		$stmt = $this->PDO->prepare($sql);
		$stmt->bindValue(1, 39, PDO::PARAM_INT);
		$stmt->bindValue(2, 23, PDO::PARAM_INT);
		$stmt->execute($array);
		$row  = $stmt->fetchAll();
		return $row;
	}
	
	public function trxn(){
		try{
			$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->PDO->beginTransaction();
			
			$sql1 = $this->PDO->prepare("SELECT * FROM students");
			$sql2 = $this->PDO->prepare("UPDATE city SET cstudents = cstudents + 1 WHERE cname = ?");
			
			$sql1->execute();
			$sql2->execute(["Goa"]);
			
			$this->PDO->commit();
			echo "All Data saved";
		}catch(Exception $e){
			$this->PDO->rollback();
			echo $e->getMessage();
		}
	}	
	
	
	public function testException($sql){
		try {
			$this->sql = $this->PDO->prepare($sql); 
			$this->sql->execute();
			$error = $this->sql->errorInfo();
		}catch(PDOException $e){
			print "<br>Error!: " . $e->getMessage() . "<br/>";
		}
			
		$result = $this->sql->fetchAll();
	}
	
	public function __destruct(){
		$this->PDO  = NULL;		
	}
	
}
?>
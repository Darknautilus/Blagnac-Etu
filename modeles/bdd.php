<?

class BDD
{
	private $err;
	private $stream;
	private $result;
	private $query;
	
	public function __construct()
	{
		$this->stream = null;
		$this->result = null;
		$this->err = null;
	}
	
	public function query($query)
	{	
		$this->query = $query;
		
		/*
			Ouverture connexion
		*/
		try
		{
			$this->stream = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME,DBUSER, DBPASSWD);
			$this->stream->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$this->result = $this->stream->query($query);
		}
		catch(PDOException $e)
		{
		}
		
		$errorInfo = $this->stream->errorInfo();
		$errorCode = $this->stream->errorCode();
		
		$this->stream = null;
		$this->err = "Erreur SQL : ".$errorInfo[2];
		
		if($this->err == "Erreur SQL : ")
			return true;
		else
			return false;
	}
	
	public function error()
	{
		return $this->err;
	}
	
	public function result()
	{
		return $this->result;
	}
}

function nbElemTable($table)
{
	$streamNbElem = new BDD;
	$streamNbElem->query("SELECT COUNT(*) FROM ".$table);
	
	$nbElem = $streamNbElem->result()->fetchAll();
	
	return $nbElem[0]["COUNT(*)"];
}
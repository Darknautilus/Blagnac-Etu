<?

class BDD
{
	private $dbserver;
	private $dbname;
	private $dbuser;
	private $dbpasswd;
	private $err;
	private $stream;
	private $result;
	private $query;
	
	public function __construct()
	{
		$this->dbserver = DBSERVER;
		$this->dbname = DBNAME;
		$this->dbuser = DBUSER;
		$this->dbpasswd = DBPASSWD;
		$this->stream = null;
		$this->result = null;
		$this->err = "";
	}
	
	public function query($query)
	{	
		$this->query = $query;
		
		/*
			Ouverture connexion
		*/
		try
		{
			$this->stream = new PDO("mysql:host=".$this->dbserver.";dbname=".$this->dbname,$this->dbuser, $this->dbpasswd);
			$this->stream->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$this->result = $this->stream->query($query);
		}
		catch(PDOException $e)
		{
		}
		
		$errorInfo = $this->stream->errorInfo();
		$errorCode = $this->stream->errorCode();
		
		$this->stream = null;
		$this->err .= "Erreur SQL : ".$errorInfo[2];
		
		return $this->err;
	}
	
	public function result()
	{
		return $this->result;
	}
}
<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

class BD
{
	private $Server;
	private $User;
	private $Password;
	private $DataBase;
	private $connect;
	private $ResultQuery;

	public function __construct()
	{
		$this->server = $_ENV['SERVER'];
		$this->User = $_ENV['USER'];
		$this->Password = $_ENV['PASSWORD'];
		$this->DataBase = $_ENV['DATABASE'];
	}
	protected function Connect()
	{
		@$this->Connect = mysqli_connect( $this->Server, $this->User, $this->Password, $this->DataBase ) or die("<br><br>No se pudo realizar la conexión a la base de datos");
		return $this->Connect;
	}

	protected function CloseConnect()
	{
		return mysqli_close( $this->Connect );
	}

	public function EjectQuery( $query )
	{
		$this->ResultQuery = mysqli_query( $this->Connect() , $query ) or die ("Error en consulta: <br> " . mysqli_error( $this->Connect ));
		$this->CloseConnect();
		return $this->ResultQuery;
	}
	
}


<?php
class BancodeDados {
    // Nas linhas abaixo voc� poder� colocar as informa��es do Banco de Dados.
    private $host = "localhost";
   // private $host = "localhost"; 	// Nome ou IP do Servidor
    private $user = "root"; 		// Usu�rio do Servidor MySQL
    private $senha = ""; 		// Senha do Usu�rio MySQL
    private $banco = "testeaula"; 		// Nome do seu Banco de Dados
    public $con;

	// m�todo respons�vel para conex�o a base de dados
	function conecta(){
        $this->con = mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
       //   $this->con = @mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
        // Conecta ao Banco de Dados
        if(!$this->con){
      		// Caso ocorra um erro, exibe uma mensagem com o erro
			die ("Problemas com a conex&atildeo");
        }
    }

	// m�todo respons�vel para fechar a conex�o
	function fechar(){
		mysqli_close($this->con);
		return;
	}


}


?>

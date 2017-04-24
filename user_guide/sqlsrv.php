<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta charset="UTF-8">
</head>

<?php
header('Content-Type: text/html; charset=UTF-8');
// Dados do banco
$dbhost   = "200.98.66.44";   #Nome do host
$db       = "maximacarga2";   #Nome do banco de dados
$user     = "senior"; #Nome do usuário
$password = "senior";   #Senha do usuário

// Dados da tabela
$tabela = "empresa";    #Nome da tabela
$campo1 = "em_nome";  #Nome do campo da tabela
$campo2 = "em_nomefantasia";  #Nome de outro campo da tabela

ini_set('mssql.charset', 'UTF-8');

mssql_connect($dbhost,$user,$password) or die("Não foi possível a conexão com o servidor!");
mssql_select_db("$db") or die("Não foi possível selecionar o banco de dados!");
 
$instrucaoSQL = "SELECT $campo1, $campo2 FROM $tabela ORDER BY $campo1";
$consulta = mssql_query($instrucaoSQL);
$numRegistros = mssql_num_rows($consulta);
 
echo "Esta tabela contém $numRegistros registros!\n<hr>\n";
 
if ($numRegistros!=0) {
	while ($cadaLinha = mssql_fetch_array($consulta)) {
		echo "$cadaLinha[$campo1] - $cadaLinha[$campo2]\n<br>\n";
	}
}
?>
</html>
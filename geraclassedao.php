<?php

require_once './DAOmkr/geracod.php';

$host = $_POST['host'];
$user = $_POST['usrname'];
$pass = $_POST['pass'];
$banco = $_POST['banco'];
$output = 'output/' . $banco;

geracod::setConfig($host, $banco, $user, $pass);
mkdir($output, 0777, true);

//gerando o arquivo de conexão que os demais arquivos importam
$stconexao = file_get_contents('resources/stConexao.php');

$dir = $output . '/stConexao.php';
$fp = fopen($dir, "w");
$escreve = fwrite($fp, $stconexao);
fclose($fp);




foreach ($_POST['tab'] as $tabela) {
    $dir = $output . '/' . $tabela . '.php';
    $dao = geracod::getCodigo($tabela);
    $fp = fopen($dir, "w");
    $escreve = fwrite($fp, $dao);
    fclose($fp);
}

// diretório que será compactado
$diretorio = $output;
echo 'ok';


// Caso o usuário queira gerar um arquivo zip contendo as classes DAO

// inicializa a classe ZipArchive
//$zip = new ZipArchive();
//// abre o arquivo .zip
//if ($zip->open("output/$banco.zip", ZIPARCHIVE::CREATE) !== TRUE) {
//    die("Erro!");
//}
//
//$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($diretorio));
//
//// itera cada pasta/arquivo contido no diretório especificado
//foreach ($iterator as $key => $value) {
//// adiciona o arquivo ao .zip
//    $zip->addFile(realpath($key), iconv('ISO-8859-1', 'IBM850', $key)) or die("ERRO: Não é possível adicionar o arquivo: $key");
//}
//// fecha e salva o arquivo .zip gerado
//$zip->close();
//
//header('location: output/'.$banco.'.zip');

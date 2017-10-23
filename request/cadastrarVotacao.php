<?php
    require_once __DIR__."/../session.php";
    require_once __DIR__."/../tools.php";

    $iniciocandidatura     = DateTime::createFromFormat('d/m/Y', @$_POST["iniciocandidatura"]);
    $terminocandidatura    = DateTime::createFromFormat('d/m/Y', @$_POST["terminocandidatura"]);

    $iniciovotacao     = DateTime::createFromFormat('d/m/Y', @$_POST["iniciovotacao"]);
    $terminovotacao    = DateTime::createFromFormat('d/m/Y', @$_POST["terminovotacao"]);
    $arquivos   = @multiple($_FILES);

    $response = [];

    if (@$arquivos["edital"][0]['type'] != "application/pdf"){
        $response["tipo"] = "erro";
        $response["mensagem"] = "São aceitos apenas arquivos do tipo PDF";
    }
    if (empty($_FILES)){
        $response["tipo"] = "erro";
        $response["mensagem"] = "Informe o arquivo";
    }

    if (empty($_POST["terminovotacao"]) || empty($_POST["terminocandidatura"])){
        $response["tipo"] = "erro";
        $response["mensagem"] = "Preencha a data final";
    }

    if ($iniciocandidatura > $terminocandidatura || $iniciovotacao > $terminovotacao){
        $response["tipo"] = "erro";
        $response["mensagem"] = "Data final é maior que data inicial";
    }

    if (empty($_POST["iniciocandidatura"]) || empty($_POST["iniciovotacao"])){
        $response["tipo"] = "erro";
        $response["mensagem"] = "Preencha a data incial";
    }

    if (!$usuario instanceof \Administrador){
        $response["tipo"] = "erro";
        $response["mensagem"] = "Você não possui privilégios para cadastrar uma votação.";
    }

    if (!empty($response)){
        echo json_encode($response);
        return;
    }

    $nomeArquivo = md5(microtime().@$arquivos["edital"][0]['tmp_name']);
    if (!move_uploaded_file($arquivos["edital"][0]['tmp_name'], __DIR__."/../editais/".$nomeArquivo)){
        $response["tipo"] = "erro";
        $response["mensagem"] = "Ocorreu um erro ao copiar o arquivo.";
        echo json_encode($response);
        return;
    }

    $cipa = new \Cipa;
    $cipa->setEdital($nomeArquivo)
        ->setInicioCandidatura($iniciocandidatura)
        ->setFimCandidatura($terminocandidatura)
        ->setInicioVotacao($iniciovotacao)
        ->setFimVotacao($terminovotacao);
    try{
        $usuario->cadastrarVotacao($cipa);
        $response["tipo"] = "sucesso";
        $response["mensagem"] = "Cipa cadastrada com sucesso!";
    } catch(\Exception $e){
        $response["tipo"] = "erro";
        $response["mensagem"] = $e->getMessage();
    } finally{
        echo json_encode($response);
        return;
    }

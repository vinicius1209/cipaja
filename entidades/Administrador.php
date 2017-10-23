<?php
require_once "Usuario.php";
require_once "Cipa.php";
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22/10/2017
 * Time: 22:22
 */
class Administrador extends Usuario
{
    public function cadastrarVotacao(\Cipa $cipa){
        require_once __DIR__."/../config.php";
        //verifica se existe votação no período
        $stmt = $db->query("select count(id) qtd from cipa where inicio_votacao between {$cipa->getInicioVotacao()} and {$cipa->getFimVotacao()} or fim_votacao between '{$cipa->getInicioVotacao()}' and '{$cipa->getFimVotacao()}'", PDO::FETCH_OBJ);

        if ($stmt->fetch()->qtd > 0){
            throw new \Exception("Há outra votação ocorrendo no período");
        }
        $stmt = $db->prepare('INSERT INTO cipa(inicio_candidatura, fim_candidatura, inicio_votacao, fim_votacao, edital) VALUES (:inicio_candidatura, :fim_candidatura, :inicio_votacao, :fim_votacao, :edital)');
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt->bindParam(":inicio_candidatura", $cipa->getInicioCandidatura());
        $stmt->bindParam(":fim_candidatura", $cipa->getFimCandidatura());
        $stmt->bindParam(":inicio_votacao", $cipa->getInicioVotacao());
        $stmt->bindParam(":fim_votacao", $cipa->getFimVotacao());
        $stmt->bindParam(":edital", $cipa->getEdital());
        $id = $db->lastInsertId("cipa_id_seq");
        $stmt->execute();
    }
}
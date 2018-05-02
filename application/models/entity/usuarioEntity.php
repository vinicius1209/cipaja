<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17/04/2018
 * Time: 22:10
 */

class UsuarioEntity implements JsonSerializable
{
    protected $id;
    protected $nome;
    protected $matricula;
    protected $senha;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UsuarioEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return UsuarioEntity
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     * @return UsuarioEntity
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     * @return UsuarioEntity
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function jsonSerialize()
    {
        $cipa = ($this->cipa) ? $this->cipa->getId() : "";
        return [
            "id" => $this->getId(),
            "nome" => $this->getNome(),
            "matricula" => $this->getMatricula()
        ];
    }
}
<?php
require_once("application/models/entity/usuarioEntity.php");
class AdministradorEntity extends UsuarioEntity
{
    protected $id;
    protected $usuario;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return administradorEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     * @return administradorEntity
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }
}
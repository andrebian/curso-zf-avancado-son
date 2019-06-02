<?php
/**
 * Created by PhpStorm.
 * User: andrebian - Andre Cardoso https://github.com/andrebian
 * Date: 05/08/18
 * Time: 15:06
 */

namespace Blog\Model;

class Post
{
    private $id;
    private $titulo;
    private $conteudo;
    private $dataCriacao;
    private $dataAtualizacao;

    public function exchangeArray(array $data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->titulo = isset($data['titulo']) ? $data['titulo'] : null;
        $this->conteudo = isset($data['conteudo']) ? $data['conteudo'] : null;
        $this->dataCriacao = isset($data['dataCriacao']) ? new \DateTime($data['dataCriacao']) : null;
        $this->dataAtualizacao = isset($data['dataAtualizacao']) ? new \DateTime($data['dataAtualizacao']) : null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return mixed
     */
    public function getConteudo()
    {
        return $this->conteudo;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @return mixed
     */
    public function getDataAtualizacao()
    {
        return $this->dataAtualizacao;
    }
}

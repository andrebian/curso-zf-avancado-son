<?php
/**
 * Created by PhpStorm.
 * User: andrebian - Andre Cardoso https://github.com/andrebian
 * Date: 05/08/18
 * Time: 15:10
 */

namespace Blog\Model;


use DateTime;
use Exception;
use Zend\Db\TableGateway\TableGatewayInterface;

class PostTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getPost($id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        return $rowset->current();
    }

    public function savePost(Post $post)
    {
        $data = [
            'titulo' => $post->getTitulo(),
            'conteudo' => $post->getConteudo(),
            'dataCriacao' => date('Y-m-d H:i:s')
        ];

        $id = (int)$post->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return true;
        }

        if (! $this->getPost($id)) {
            throw new Exception('Post não existe');
        }

        $data['dataAtualizacao'] = date('Y-m-d H:i:s');

        $this->tableGateway->update($data, ['id' => $id]);
        return true;
    }
}

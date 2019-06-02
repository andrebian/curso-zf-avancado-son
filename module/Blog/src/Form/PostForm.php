<?php
/**
 * Created by PhpStorm.
 * User: andrebian - Andre Cardoso https://github.com/andrebian
 * Date: 05/08/18
 * Time: 16:19
 */

namespace Blog\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class PostForm extends Form
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $postFormFilter = new PostFormFilter();
        $this->setInputFilter($postFormFilter->getInputFilter());

        $this->add([
            'name' => 'titulo',
            'type' => Text::class,
            'options' => [
                'label' => 'Titulo'
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'titulo',
                'autocomplete' => 'Off'
            ]
        ]);

        $this->add([
            'name' => 'conteudo',
            'type' => Textarea::class,
            'options' => [
                'label' => 'Conteudo'
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'conteudo',
                'autocomplete' => 'Off'
            ]
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => Csrf::class
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'class' => 'btn btn-default',
                'value' => 'Gravar'
            ]
        ]);
    }
}

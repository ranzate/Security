<?php
namespace Security\Model\Entity;

use Cake\ORM\Entity;

/**
 * Grupo Entity.
 */
class Grupo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'acoes' => true,
        'id_empresa' => true,
    ];
}

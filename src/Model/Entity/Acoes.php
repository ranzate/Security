<?php
namespace Security\Model\Entity;

use Cake\ORM\Entity;

/**
 * Acoes Entity.
 */
class Acoes extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id_modulo' => true,
        'nome' => true,
        'tag' => true,
        'controller' => true,
        'action' => true,
        'grupos' => true,
    ];
}

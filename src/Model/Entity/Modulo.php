<?php
namespace Security\Model\Entity;

use Cake\ORM\Entity;

/**
 * Modulo Entity.
 */
class Modulo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
    ];
}

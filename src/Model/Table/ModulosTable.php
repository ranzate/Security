<?php
namespace Security\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;
use Security\Model\Entity\Modulo;

/**
 * Modulos Model
 *
 */
class ModulosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('modulos');
        $this->displayField('nome');
        $this->primaryKey('id_modulo');
        $this->hasMany('Acoes', [
            'foreignKey' => 'id_modulo',
            'className' => 'Security.Acoes'
        ]);
        $this->addBehavior('Search.Search');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id_modulo', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id_modulo', 'create');
            
        $validator
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        return $validator;
    }

    public function getAcoesModulo(){
        return $this->find('all', [
            'contain' => 'Acoes'
            ]
            )->toArray();
    }

    public function searchConfiguration()
    {
        $search = new Manager($this);
        $search
        ->like('nome', [
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('nome')],
            'filterEmpty' => true
            ]);
        return $search;
    }
}

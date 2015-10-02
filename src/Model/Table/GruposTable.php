<?php
namespace Security\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;
use Security\Model\Entity\Grupo;

/**
 * Grupos Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Acoes
 */
class GruposTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('grupos');
        $this->displayField('nome');
        $this->primaryKey('id_grupo');
        $this->belongsToMany('Acoes', [
            'foreignKey' => 'id_grupo',
            'targetForeignKey' => 'id_acao',
            'joinTable' => 'grupos_acoes',
            'className' => 'Security.Acoes'
            ]);


        $this->belongsTo('Empresas', [
            'foreignKey' => 'id_empresa'            
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
        ->add('id_grupo', 'valid', ['rule' => 'numeric'])
        ->allowEmpty('id_grupo', 'create');

        $validator
        ->requirePresence('nome', 'create')
        ->notEmpty('nome');

        return $validator;
    }

    public function searchConfiguration()
    {
        $search = new Manager($this);
        $search
        ->value('id_empresa', [
            'field' => $this->aliasField('id_empresa'),
            'filterEmpty' => true
            ])
        ->like('nome', [
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('nome')],
            'filterEmpty' => true
            ]);
        return $search;
    }
}

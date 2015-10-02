<?php
namespace Security\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;
use Security\Model\Entity\Acoes;

/**
 * Acoes Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Grupos
 */
class AcoesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('acoes');
        $this->displayField('nome');
        $this->primaryKey('id_acao');
        $this->belongsToMany('Grupos', [
            'foreignKey' => 'id_acao',
            'targetForeignKey' => 'id_grupo',
            'joinTable' => 'grupos_acoes',
            'className' => 'Security.Grupos'
            ]);
        $this->belongsTo('Modulos', [
            'foreignKey' => 'id_modulo',
            'className' => 'Security.Modulos'
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
        ->add('id_acao', 'valid', ['rule' => 'numeric'])
        ->allowEmpty('id_acao', 'create');

        $validator
        ->add('id_modulo', 'valid', ['rule' => 'numeric'])
        ->requirePresence('id_modulo', 'create')
        ->notEmpty('id_modulo');

        $validator
        ->requirePresence('nome', 'create')
        ->notEmpty('nome');

        $validator
        ->allowEmpty('tag');

        $validator
        ->allowEmpty('controller');

        $validator
        ->allowEmpty('action');

        return $validator;
    }

    public function getAcoesByGrupo($grupoId){
        $acoes = $this->find('all');
        $acoes->matching('Grupos', function ($q) use($grupoId){
            return $q->where(['Grupos.id_grupo' => $grupoId]);
        });
        return $acoes->toArray();
    }

    public function searchConfiguration()
    {
        $search = new Manager($this);
        $search
        ->value('id_modulo', [
            'field' => $this->aliasField('id_modulo'),
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
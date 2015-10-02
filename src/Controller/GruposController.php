<?php
namespace Security\Controller;

use Cake\ORM\TableRegistry;
use Security\Controller\AppController;

/**
 * Grupos Controller
 *
 * @property \Security\Model\Table\GruposTable $Grupos
 */
class GruposController extends AppController
{

    /**
     * Index method
     *
     * @return void
     * @RequiresPermissions(permissions=["gestaousuario:grupo:visualizar","gestaousuario:grupo:incluir","gestaousuario:grupo:alterar","gestaousuario:grupo:excluir"], logical="OR")
     */
    public function index()
    {
        if(!empty($this->userSession['id_empresa'])){
            $this->request->query['id_empresa'] = $this->userSession['id_empresa'];
        }

        $grupos = $this->Grupos->find('search', $this->Grupos->filterParams($this->request->query))
        ->contain(['Empresas']);
        $grupos = $this->paginate($grupos);
        $empresas = $this->Grupos->Empresas->find('list');
        $this->set(compact('grupos','empresas'));
        $this->set('_serialize', ['grupos']);
    }

    /**
     * View method
     *
     * @param string|null $id Grupo id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @RequiresPermissions(permissions=["gestaousuario:grupo:visualizar"])
     */
    public function view($id = null)
    {
        $title = "Visualizar Grupo";
        $modulos = TableRegistry::get('Security.Modulos');
        $modulos = $modulos->getAcoesModulo();
        $grupo = $this->Grupos->get($id, [
            'contain' => ['Acoes']
            ]);
        $acoes = $this->Grupos->Acoes->find('list', ['limit' => 200]);
        $this->set(compact('title', 'grupo', 'acoes', 'modulos'));
        $this->set('_serialize', ['grupo']);
        $this->render('form');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     * @RequiresPermissions(permissions=["gestaousuario:grupo:incluir"])
     */
    public function add()
    {
        $title = "Incluir Grupo";
        $grupo = $this->Grupos->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->data);
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('Grupo inclído com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Não foi possível incluir o grupo.'));
            }
        }
        $acoes = $this->Grupos->Acoes->find('list', ['limit' => 200]);
        $modulos = TableRegistry::get('Security.Modulos');
        $modulos = $modulos->getAcoesModulo();
        $this->set(compact('title', 'grupo', 'acoes', 'modulos'));
        $this->set('_serialize', ['grupo']);
        $this->render('form');
    }

    /**
     * Edit method
     *
     * @param string|null $id Grupo id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @RequiresPermissions(permissions=["gestaousuario:grupo:alterar"])
     */
    public function edit($id = null)
    {
        $title = "Alterar Grupo";
        $grupo = $this->Grupos->get($id, [
            'contain' => ['Acoes']
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->data);
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('Grupo alterado com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Não foi possível alterar o grupo.'));
            }
        }
        $acoes = $this->Grupos->Acoes->find('list', ['limit' => 200]);
        $modulos = TableRegistry::get('Security.Modulos');
        $modulos = $modulos->getAcoesModulo();
        $this->set(compact('title', 'grupo', 'acoes', 'modulos'));
        $this->set('_serialize', ['grupo']);
        $this->render('form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Grupo id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     * @RequiresPermissions(permissions=["gestaousuario:grupo:excluir"])
     */
    public function delete($id = null)
    {
        $grupo = $this->Grupos->get($id);
        if ($this->Grupos->delete($grupo)) {
            $this->Flash->success(__('Grupo excluído com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir o grupo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

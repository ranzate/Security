<?php
namespace Security\Controller;

use Security\Controller\AppController;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;

/**
 * Modulos Controller
 *
 * @property \Security\Model\Table\ModulosTable $Modulos
 */
class ModulosController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    
        if(!$this->userSession['idr_admin'] && !empty($this->userSession['id_empresa']) && !empty($this->userSession['id_grupo'])){
            throw new UnauthorizedException("Usuário da sessão não possui permissão para acessar a ação escolhida");
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $modulos = $this->Modulos->find('search', $this->Modulos->filterParams($this->request->query));
        $this->set('modulos', $this->paginate($modulos));
        $this->set('_serialize', ['modulos']);
    }

    /**
     * View method
     *
     * @param string|null $id Modulo id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $title = "Visualizar Módulo";
        $modulo = $this->Modulos->get($id, [
            'contain' => []
        ]);
        $this->set(compact('title', 'modulo'));
        $this->set('_serialize', ['modulo']);
        $this->render('form');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $title = "Incluir Módulo";
        $modulo = $this->Modulos->newEntity();
        if ($this->request->is('post')) {
            $modulo = $this->Modulos->patchEntity($modulo, $this->request->data);
            if ($this->Modulos->save($modulo)) {
                $this->Flash->success(__('Módulo incluído com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Não foi possível incluir o módulo.'));
            }
        }
        $this->set(compact('title', 'modulo'));
        $this->set('_serialize', ['modulo']);
        $this->render('form');
    }

    /**
     * Edit method
     *
     * @param string|null $id Modulo id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $title = "Alterar Módulo";
        $modulo = $this->Modulos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modulo = $this->Modulos->patchEntity($modulo, $this->request->data);
            if ($this->Modulos->save($modulo)) {
                $this->Flash->success(__('Módulo alterado com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Não foi possível alterar o módulo.'));
            }
        }
        $this->set(compact('title', 'modulo'));
        $this->set('_serialize', ['modulo']);
        $this->render('form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Modulo id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $modulo = $this->Modulos->get($id);
        if ($this->Modulos->delete($modulo)) {
            $this->Flash->success(__('Módulo excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir o módulo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace Security\Controller;

use Security\Controller\AppController;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;

/**
 * Acoes Controller
 *
 * @property \Security\Model\Table\AcoesTable $Acoes
 */
class AcoesController extends AppController
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
        $acoes = $this->Acoes->find('search', $this->Acoes->filterParams($this->request->query))
        ->contain(['Modulos']);
        $acoes = $this->paginate($acoes);
        $modulos = $this->Acoes->Modulos->find('list');
        $this->set(compact('acoes', 'modulos'));
        $this->set('_serialize', ['acoes']);
    }

    /**
     * View method
     *
     * @param string|null $id Aco id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $title = "Visualizar Ação";
        $acao = $this->Acoes->get($id, [
            'contain' => ['Grupos']
            ]);
        $modulos = $this->Acoes->Modulos->find('list', ['limit' => 200]);
        $this->set(compact('title', 'acao', 'modulos'));
        $this->set('_serialize', ['acao']);
        $this->render('form');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $title = "Incluir Ação";
        $acao = $this->Acoes->newEntity();
        if ($this->request->is('post')) {
            $acao = $this->Acoes->patchEntity($acao, $this->request->data);
            if ($this->Acoes->save($acao)) {
                $this->Flash->success(__('Ação incluída com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Não foi possível incluir a ação.'));
            }
        }
        $modulos = $this->Acoes->Modulos->find('list', ['limit' => 200]);
        $this->set(compact('title', 'acao', 'modulos'));
        $this->set('_serialize', ['acao']);
        $this->render('form');
    }

    /**
     * Edit method
     *
     * @param string|null $id Aco id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $title = "Alterar Ação";
        $acao = $this->Acoes->get($id, [
            'contain' => ['Grupos']
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acao = $this->Acoes->patchEntity($acao, $this->request->data);
            if ($this->Acoes->save($acao)) {
                $this->Flash->success(__('Ação alterada com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Não foi possível alterar a ação.'));
            }
        }
        $modulos = $this->Acoes->Modulos->find('list', ['limit' => 200]);
        $this->set(compact('title', 'acao', 'modulos'));
        $this->set('_serialize', ['acao']);
        $this->render('form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Aco id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $acao = $this->Acoes->get($id);
        if ($this->Acoes->delete($acao)) {
            $this->Flash->success(__('Ação excluida com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir a ação.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

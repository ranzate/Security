<?php
namespace Security\Controller\Component;

use Cake\Collection\Collection;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;
use \zpt\anno\AnnotationFactory;

/**
 * Security component
 */
class SecurityComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';

    /**
     * Callback for Controller.startup event.
     *
     * @param \Cake\Event\Event $event Event instance.
     * @return void|\Cake\Network\Response
     */
    public function startup(Event $event)
    {

        $controller = $event->subject();
        $method = $controller->request->params['action'];
        $reflectionMethod = new \ReflectionMethod(get_class($controller), $method);
        $values = $this->getAnnotationValues($reflectionMethod);
        if(!empty($values)){
            $this->anyPermitted($values['permissions'], $values['logical']);
        }
    }

    public function isPermitted()
    {
    	$session = $this->request->session()->read('Auth.User');
    	$parametros = $this->request->params;
    	$acoes = TableRegistry::get('Security.Acoes');

    	$existeAcao = $acoes->find()
    	->where([
    		'controller' => $parametros['controller'],
    		'action' => $parametros['action']
    		])
    	->count() == 0;

    	if($session['idr_admin'] || $existeAcao){	
    		return true;
    	}

    	$acoes = new Collection($session['acoes']);

    	$permitido = $acoes->filter(function ($acao, $key) use($parametros) {
    		return (mb_strtoupper($acao['controller']) == mb_strtoupper($parametros['controller']) && 
    			mb_strtoupper($acao['action']) == mb_strtoupper($parametros['action']));
    	});

    	if(count($permitido->toArray()) > 0){
            return true;
        } else {
            throw new UnauthorizedException("Usuário da sessão não possui permissão para acessar a ação escolhida");
        }
    }

    private function anyPermitted($permissions, $operator = self::OPERATOR_AND)
    {
        $session = $this->request->session()->read('Auth.User');

        if($session['idr_admin']){  
            return true;
        }

        $acoes = new Collection($session['acoes']);

        if(is_array($permissions)){
            if($operator == self::OPERATOR_AND){
                foreach ($permissions as $k => $p) {
                    $permitido = $acoes->filter(function ($acao, $key) use($p) {
                        return (mb_strtoupper($acao['tag']) == mb_strtoupper($p));
                    });
                    if(count($permitido->toArray()) == 0){
                        break;
                    }           
                }
            }else{
                foreach ($permissions as $k => $p) {
                    $permitido = $acoes->filter(function ($acao, $key) use($p) {
                        return (mb_strtoupper($acao['tag']) == mb_strtoupper($p));
                    });
                    if(count($permitido->toArray()) > 0){
                        break;
                    }           
                }
            }
        }else{
            $permitido = $acoes->filter(function ($acao, $key) use($permissions) {
                return (mb_strtoupper($acao['tag']) == mb_strtoupper($permissions));
            });
        }

        if(count($permitido->toArray()) == 0){
            throw new UnauthorizedException("Usuário da sessão não possui permissão para acessar a ação escolhida");
        }
    }

    private function getAnnotationValues(\Reflector $reflection){
        $values = null;
        
        $factory = new AnnotationFactory;
        $annotations = $factory->get($reflection);
        $annotations = $annotations->asArray();

        if(array_key_exists('requirespermissions', $annotations)){
            $values = $annotations['requirespermissions'];
            if(array_key_exists('logical', $values)){
                if(!in_array($values['logical'], [self::OPERATOR_AND, self::OPERATOR_OR])){
                    $values['logical'] = self::OPERATOR_AND;
                }
            }else{
                $values['logical'] = self::OPERATOR_AND;
            }
        }
        return $values;
    }
}

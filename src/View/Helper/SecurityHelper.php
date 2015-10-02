<?php

namespace Security\View\Helper;

use Cake\Collection\Collection;
use Cake\View\Helper;

class SecurityHelper extends Helper
{

	public function isPermitted($permissions, $operator = OPERATOR_AND)
	{
		$session = $this->request->session()->read('Auth.User');

		if($session['idr_admin']){	
			return true;
		}

		$acoes = new Collection($session['acoes']);

		if(is_array($permissions)){
			if($operator == OPERATOR_AND){
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
		if(count($permitido->toArray()) > 0){
			return true;
		}else{
			return false;	
		}
	}
}
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="#">Segurança</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Pesquisar Grupos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#"><?= $title ?></a>
    </li>    
</ul>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <?= $title ?>
        </div>
    </div>
    <div class="portlet-body">
       <?= $this->Form->create($grupo, ['class' => 'horizontal-form', 'data-parsley-validate']) ?>
       <?= $this->Form->hidden('id_empresa', ['label' => false, 'div' => false, 'value' => $this->request->session()->read('Auth.User.id_empresa')]) ?>
       <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Nome</label>
                    <?= $this->Form->input('nome', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'required']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Ações</label>
                    <?= $this->Form->input('acoes._ids', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'options' => $acoes, 'style' => 'display: none;']) ?>
                
                    <div class="panel-group accordion" id="listgrupo">
                        <?php foreach ($modulos as $k => $m) :?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#listgrupo" href="#collapse_<?= $m->id_modulo?>"><?= $m->nome?></a>
                                    </h4>
                                </div>
                                <div id="collapse_<?= $m->id_modulo?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php foreach ($m->acoes as $i => $a) :?>
                                            <input type="checkbox" value="<?= $a->id_acao ?>" /><?= $a->nome ?><br/>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions right">
        <button type="submit" class="btn blue">Salvar</button>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn default btn-voltar">Voltar</a>
    </div>
    <?= $this->Form->end() ?>
</div>
</div>

 <?= $this->Html->script('Security.grupos.js') ?> 
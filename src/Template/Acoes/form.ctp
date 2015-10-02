<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="#">Segurança</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Pesquisar Ações</a>
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
     <?= $this->Form->create($acao, ['class' => 'horizontal-form', 'data-parsley-validate']) ?>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Modulo</label>
                    <?= $this->Form->input('id_modulo', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'options' => $modulos , 'empty' => 'Selecione', 'required']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Tag</label>
                    <?= $this->Form->input('tag', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'required']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Controller</label>
                    <?= $this->Form->input('controller', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'required']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Action</label>
                    <?= $this->Form->input('action', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'required']) ?>
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


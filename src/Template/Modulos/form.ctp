<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="#">Segurança</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Pesquisar Módulos</a>
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
     <?= $this->Form->create($modulo, ['class' => 'horizontal-form', 'data-parsley-validate']) ?>
     <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Nome</label>
                    <?= $this->Form->input('nome', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'required']) ?>
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


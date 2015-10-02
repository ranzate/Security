<?= $this->Form->create(null, ['type' => 'get', 'class' => 'horizontal-form form-search', 'novalidate']) ?>
<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Nome</label>
                <?= $this->Form->input('nome', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'required']) ?>
            </div>
        </div>
    </div>
    <?php if(!$this->Sisrural->existEmpresa()): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Empresas</label>
                <?= $this->Form->input('id_empresa', ['label' => false, 'div' => false, 'class' => 'form-control input-sm', 'options' => $empresas , 'empty' => 'Selecione']) ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="form-actions right">
    <button type="submit" class="btn blue">Pesquisar</button><br />
</div>
<?= $this->Form->end() ?>
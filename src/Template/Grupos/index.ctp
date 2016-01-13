<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="#">Segurança</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">Pesquisar Grupos</a>
    </li>    
</ul>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            Pesquisar Grupos
        </div>
        <div class="actions">
            <?php if($this->Security->isPermitted("gestaousuario:grupo:incluir")) : ?>
            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn default btn-sm btn-incluir">Incluir</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="portlet-body">
    <?= $this->element('Search' . DS . 'searchGrupos') ?>
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <?php if(!$this->Sisrural->existEmpresa()): ?>
                        <th>Empresa</th>
                    <?php endif; ?>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grupos as $grupo): ?>
                    <tr>
                        <td><?= h($grupo->nome) ?></td>
                        <?php if(!$this->Sisrural->existEmpresa()): ?>
                            <td><?= $grupo->has('empresa') ? h($grupo->empresa->razao_social) : 'Sem empresa' ?></td>
                        <?php endif; ?>
                        <td class="actions">
                            <?php if($this->Security->isPermitted("gestaousuario:grupo:visualizar")) : ?>
                            <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $grupo->id_grupo], ['class' => 'btn default btn-xs green-stripe']) ?>
                            <?php endif; ?>

                            <?php if($this->Security->isPermitted("gestaousuario:grupo:alterar")) : ?>
                            <?= $this->Html->link(__('Alterar'), ['action' => 'edit', $grupo->id_grupo], ['class' => 'btn default btn-xs blue-stripe']) ?>
                            <?php endif; ?>

                            <?php if($this->Security->isPermitted("gestaousuario:grupo:excluir")) : ?>
                            <?= $this->Html->link(__('Excluir'), ['action' => 'delete', $grupo->id_grupo], ['class' => 'btn default btn-xs red-stripe btn-excluir']) ?>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('Anterior') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('Próximo') ?>
            </ul>
        </div>
    </div>
</div>
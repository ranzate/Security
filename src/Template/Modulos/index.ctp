<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="#">Segurança</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">Pesquisar Módulos</a>
    </li>    
</ul>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            Pesquisar Módulos
        </div>
        <div class="actions">
            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn default btn-sm btn-incluir">Incluir</a>
        </div>
    </div>
    <div class="portlet-body">
    <?= $this->element('Search\searchModulos') ?>
       <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modulos as $modulo): ?>
                <tr>
                    <td><?= h($modulo->nome) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $modulo->id_modulo], ['class' => 'btn default btn-xs green-stripe']) ?>
                        <?= $this->Html->link(__('Alterar'), ['action' => 'edit', $modulo->id_modulo], ['class' => 'btn default btn-xs blue-stripe']) ?>
                        <?= $this->Html->link(__('Excluir'), ['action' => 'delete', $modulo->id_modulo], ['class' => 'btn default btn-xs red-stripe btn-excluir']) ?>
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
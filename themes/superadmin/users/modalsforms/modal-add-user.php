<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="modal_add_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= url("{$user->url}/atualizar-usuario") ?>" method="post" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?= $value->id ?>" required />
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus"></i> Add Novo Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <?php
                    unset($value);
                    include __DIR__.'/form-user.php';
                    ?>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Cadastrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

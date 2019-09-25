<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="custom-modal" aria-hidden="true" id="modal_user_update_<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= url("{$user->url}/atualizar-usuario") ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user"></i> Atualizar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <input name="id" type="hidden" value="<?= $value->id ?>" required />
                <?php include __DIR__.'/form-user.php' ?>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Confirmar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

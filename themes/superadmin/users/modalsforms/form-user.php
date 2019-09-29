<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Nome *</label>
                <input class="form-control" name="name" type="text" value="<?= $value->name??"" ?>" readonly />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Email *</label>
                <input class="form-control" name="email" type="email" value="<?= $value->email??"" ?>" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nível</label>
                <select name="level" class="form-control" required>
                   <?php foreach (level() as $key => $val):
                            $selected = ($val == $value->level) ? 'selected=""' : '';
                        ?>
                        <option value="<?= $val; ?>" <?= $selected ?>><?= $val; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Data de Nascimento *</label>
                <input class="form-control" name="date_birth" type="date_birth" value="<?= $value->date_birth??"" ?>" readonly />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Telefone</label>
                <input class="form-control" name="phone_number" value="<?= $value->phone_number??"" ?>" type="text" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="rg">RG</label>
                <input class="form-control" name="rg" id="rg" type="text" value="<?= $value->rg??"" ?>" readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input class="form-control" name="cpf" id="cpf" type="text" value="<?= $value->cpf??"" ?>" readonly>
            </div>
        </div>
    </div>
</div>

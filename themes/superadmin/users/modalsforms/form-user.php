<div class="modal-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Primeiro Nome *</label>
                <input class="form-control" name="first_name" type="text" value="<?= $value->first_name??"" ?>" required />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Sobrenome *</label>
                <input class="form-control" name="last_name" type="text" value="<?= $value->last_name??"" ?>" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Email *</label>
                <input class="form-control" name="email" type="email" value="<?= $value->email??"" ?>" required />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Matrícula</label>
                <input class="form-control" name="office_registry" type="text" value="<?= $value->office_registry??"" ?>" />
            </div>
        </div>
    </div>
    <div class="row">
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
        <div class="col-lg-6">
            <div class="form-group">
                <label>Telefone</label>
                <input class="form-control" name="phone_number" value="<?= $value->phone_number??"" ?>" type="text">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Unidade</label>
                <select name="office_unity_id" class="form-control">
                    <?php foreach ($units as $key => $val):
                            $selected = ($val->id == $value->office_unity_id) ? 'selected=""' : '';
                        ?>
                        <option value="<?= $val->id ?>" <?= $selected ?>><?= $val->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Cargo/Função</label>
                <input class="form-control" name="office" type="text" value="<?= $value->office??"" ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Active</label>
                <select name="status" class="form-control">
                    <?php
                        $array = ['ON', 'OFF', 'BLOCK'];
                        foreach ($array as $key => $val):
                            $selected = ($val == $value->status) ? 'selected=""' : '';
                        ?>
                        <option value="<?= $val ?>" <?= $selected ?>><?= $val ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Inteligência</label>
                <select name="reserved" class="form-control">
                    <?php
                        $array = ['YES', 'NO'];
                        foreach ($array as $key => $val):
                            $selected = ($val == $value->reserved) ? 'selected=""' : '';
                        ?>
                        <option value="<?= $val ?>" <?= $selected ?>><?= $val ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <!-- <div class="form-group">
        <label>Avatar image (optional):</label>
        <br />
        <input type="file" name="image">
    </div> -->
</div>


<?php 
if($groupid=="baru"){
    ?>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Range:</label>
        <div class="col-sm-5">
            <?php $bm=$this->Jadwal_model->getBatchMaster() ?>
            <select name="group_mulai" id="group_mulai" class="form-control" onchange="getJamSampai()">
            <option value="">Pilih Jam Mulai</option>
                <?php 
                foreach ($bm as $b ) {
                    ?>
                    <option value="<?= $b->id ?>"><?= $b->jam?></option>
                    <?php
                }
                ?>
            </select>
            <div class="text-error" id="err_group_mulai"></div>
        </div>
        <div class="col-sm-5">
            <select name="group_selesai" id="group_selesai" class="form-control" onchange="priviewGroup()">
                <option value="">Pilih Jam Selesai</option>
            </select>
            <div class="text-error" id="err_group_selesai"></div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Quota:</label>
        <div class="col-sm-10">
            <input type="text" name="group_quotaperjam" id="group_quotaperjam" class="form-control" value="10" onkeyup="priviewGroup()">
            <div class="text-error" id="err_group_quotaperjam"></div>
        </div>
    </div>
    <div id="priview_group"></div>
    <?php
}else{
    ?>
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Range</th>
                        <th>Label</th>
                        <th>Quota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=0;
                    foreach ($batch as $b) {
                        $no++;
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $b->name ?></td>
                            <td><?= $b->label ?></td>
                            <td><?= $b->tersedia ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php
}
?>

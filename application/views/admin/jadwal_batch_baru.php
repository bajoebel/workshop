<div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="checkall" id="checkall" onclick="pilihSemua()"></th>
                        <th>Range</th>
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
                            <td>
                                <input type="hidden" name="bid[]" id="bid<?= $b->id?>" value="<?= $b->id?>">
                                <input type="hidden" name="name<?= $b->id?>" id="name<?= $b->id?>" value="<?= $b->name?>">
                                <input type="hidden" name="jam<?= $b->id?>" id="jam<?= $b->id?>" value="<?= $b->jam?>">
                                <input type="checkbox" class='pilih' name="pilih<?= $b->id?>" id="pilih<?= $b->id?>" value="1">
                            </td>
                            <td><?= $b->name ?></td>
                            <td><?= $quota ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Data Pemeliharaan</h4>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-table" for="id_alat">Nama Alat</label>
                                                <select name="id_al" id="alat" class="form-control" required>
                                                <option value="<?= $row['id_al']; ?>">--<?= $row['nama_alat']; ?> --</option>
                                                <?php
                                                $sql_alat = mysqli_query($conn, "SELECT * FROM alat") or die
                                                    (mysqli_error($conn));
                                                while($alat = mysqli_fetch_array($sql_alat)) {
                                                    echo '<option value="'.$alat['id_al'].'">' 
                                                    .$alat['nama_alat'].'</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="kegiatan">Nama Kegiatan</label>
                                                <select name="id_k" id="kegiatan" class="form-control" required>
                                                <option value="<?= $row['id_k']; ?>">--<?= $row['nama_keg']; ?> --</option>
                                                <?php
                                                $sql_keg = mysqli_query($conn, "SELECT * FROM kegiatan") or die
                                                    (mysqli_error($conn));
                                                while($kegiatan = mysqli_fetch_array($sql_keg)) {
                                                    echo '<option value="'.$kegiatan['id_k'].'">' 
                                                    .$kegiatan['nama_keg'].'</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                            <input type="hidden" name="id_p" value="<?php echo $row['id_p']?>" class="form-control" id="id_k">
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
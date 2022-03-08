<?= $this->extend('layouts/admin')?>
<?= $this->section('content')?>
<?php
    if (session()->getFlashdata('success')){
       ?>
       <div class= "alert alert-success  alert-dismissible fade show" role= "alert">
        <?= session()->getFlashdata('success')?>
        <button type ="button" class= "close" data-dissmiss= "alert" arial-label="close">x</button>
    </div>
    <?php
    }
    ?>
<div class="container">
    <h3>Data Menu</h3>
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addDetail">Tambah Data</button>
   
    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jenis</th>
            <th>Stok</th>
            <!--<th>Gambar</th> -->
            <th>Option</th>
        </thead>
        <tbody>
            <?php
            $no=1;
            foreach ($data as $row):
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$row['nama']?></td>
                <td><?=$row['harga']?></td>
                <td><?=$row['jenis']?></td>
                <td><?=$row['stok']?></td>
               <!--  <td><?=$row['gambar']?></td> -->
                <td>
                <a href="" class="btn btn-primary btn-sm btn-edit" data-toggle="modal" data-target="#editMenu-<?=$row['id']?>" btn-sm btn-edit>Edit</a>
                    <a href="<?= base_url ('MenuController/delete/'.$row['id'])?> "onclick="return confirm ('yakin mau dihapus?')" class= "btn btn-danger btn btn-Hapus">Hapus</a>
                </td>
            </tr>
            <form action="<?= base_url ('menu/edit/'.$row['id'])?>" method="post">
    <div class="modal fade" id="editMenu-<?= $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-gruop">
                        <label> Nama Menu</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Menu" value="<?=$row['nama']?>">
                    </div>
                    <div class="form-gruop">
                        <label> Harga Menu</label>
                        <input type="text" class="form-control" name="harga" placeholder="Harga Menu" value="<?=$row['harga']?>">
                    </div>
                    <div class="form-gruop">
                        <label>Jenis Menu</label>
                        <div class ="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="flexRadioDefault1" value="makanan" <?=$row['jenis']=="makanan"? "checked":""?> >
                                <label class="form-check-label" for="flexRadioDefault1">Makanan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="flexRadioDefault2" value="minuman" <?=$row['jenis']=="minuman"? "checked":""?> >
                                <label class="form-check-label" for="flexRadioDefault2">Minuman</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="flexRadioDefault3" value="camilan"  <?=$row['jenis']=="camilan"? "checked":""?> >
                                <label class="form-check-label" for="flexRadioDefault3">Camilan</label>
                            </div>
                    </div>
                    <div class="form-gruop">
                        <label> Stok</label>
                        <input type="text" class="form-control" name="harga" placeholder="stok" value="<?=$row['stok']?>">
                    </div>
                    <!--- <div class="form-gruop">
                        <label> Harga Menu</label>
                        <input type="text" class="form-control" name="harga" placeholder="Harga Menu" value="<?=$row['harga']?>">
                    </div> -->
                </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
            <?php
            $no++;
            endforeach?>
        </tbody>
    </table>
</div>

<!-- Add product -->
<!-- <form action="/UserController/save" method="post"> -->
    <div class="modal fade" id="addDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu')?>" method ="post">
                <div class="modal-body">

                    <div class="form-gruop">
                        <label> Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Menu">
                    </div>
                    <div class="form-gruop">
                        <label> Harga</label>
                        <input type="text" class="form-control" name="harga" placeholder="Harga">
                    </div>
                    <div class="form-gruop">
                        <label>Jenis</label>
                        <div class ="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="flexRadioDefault1" value="makanan" >
                                <label class="form-check-label" for="flexRadioDefault1">Makanan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="flexRadioDefault2" value="minuman" >
                                <label class="form-check-label" for="flexRadioDefault2">Minuman</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="flexRadioDefault3" value="camilan" >
                                <label class="form-check-label" for="flexRadioDefault3">Camilan</label>
                            </div>
                    </div>
                    <div class="form-gruop">
                        <label> Stok</label>
                        <input type="text" class="form-control" name="stok" placeholder="Stok">
                    </div>
                </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- </form> -->

<?= $this->endSection()?>

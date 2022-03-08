<?= $this->extend('layouts/admin')?>
<?= $this->section('content')?>
<div class="container">
    <h3>Laporan</h3>
   
    <table class="table table-bordered">
        <thead>
            <th>id</th>
            <th>tanggal</th>
            <th>no meja</th>
            <th>nama pemesan</th>
            <th>total harga</th>
            <th>option</th>
        </thead>
        <tbody>
            <?php
            $no=0;
            foreach ($data as $row):
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$row['tanggal']?></td>
                <td><?=$row['no_meja']?></td>
                <td><?=$row['nama_pemesan']?></td>
                <td><?=$row['total_harga']?></td>
                <td>
                <a href="<?= base_url ('LaporanController/delete/'.$row['id'])?> "onclick="return confirm ('yakin mau dihapus')" class= "btn btn-danger btn-sm btn-delete">Hapus</a>
                </td>
            </tr>
            <?php
            $no++;
            endforeach?>
        </tbody>
    </table>
</div>
<?= $this->endSection()?>

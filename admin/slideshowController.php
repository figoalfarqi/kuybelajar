
<?php
include_once("../config.php");
if(isset($_GET['id_slideshow'])){
  $id_slideshow=$_GET['id_slideshow'];
  $result = mysqli_query($mysqli, "SELECT * FROM slideshows where id_slideshow='$id_slideshow'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
    $gambar="";
    if(is_uploaded_file($_FILES['gambar']['tmp_name'])) {
        $rand = rand();
        $sourcePath = $_FILES['gambar']['tmp_name'];
        $targetPath = "images/gambar_slideshow/".$rand.$_FILES['gambar']['name'];
        move_uploaded_file($sourcePath,$targetPath);
        $gambar=$rand.$_FILES['gambar']['name'];
    }
        $judul=$_POST['judul'];
        $subjudul=$_POST['subjudul'];
        $isi=$_POST['isi'];
        $tombol_teks=$_POST['tombol_teks'];
        $tombol_url=$_POST['tombol_url'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_slideshow']==""){

      $id_slideshow=$_POST['id_slideshow'];
      if($gambar==""){
        $result = mysqli_query($mysqli, "UPDATE slideshows set judul='$judul', subjudul='$subjudul',isi='$isi', tombol_teks='$tombol_teks', tombol_url='$tombol_url',updated_at='$tanggal' where id_slideshow='$id_slideshow'");
      }
      else{
        $result = mysqli_query($mysqli, "UPDATE slideshows set gambar='$gambar', judul='$judul', subjudul='$subjudul',isi='$isi', tombol_teks='$tombol_teks', tombol_url='$tombol_url',updated_at='$tanggal' where id_slideshow='$id_slideshow'");
      }
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO slideshows(gambar, judul, subjudul,isi, tombol_teks, tombol_url, created_at, updated_at) 
        values('$gambar',
        '$judul',
        '$subjudul',
        '$isi',
        '$tombol_teks',
        '$tombol_url',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_slideshow=$_POST['id_slideshow'];
    $result = mysqli_query($mysqli, "DELETE FROM slideshows where id_slideshow='$id_slideshow'");
  }
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM slideshows ORDER BY id_slideshow DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['judul'] ?></td>
                    <td><?php echo $data_table['subjudul'] ?></td>
                    <td><?php echo $data_table['isi'] ?></td>
                    <td><?php echo $data_table['tombol_teks'] ?></td>
                    <td><?php echo $data_table['tombol_url'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_slideshow"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_slideshow"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}
?>

<?php
include_once("../config.php");
if(isset($_GET['id_menonton'])){
  $id_menonton=$_GET['id_menonton'];
  $result = mysqli_query($mysqli, "SELECT * FROM menontons where id_menonton='$id_menonton'");
  while($data_table = mysqli_fetch_array($result)) { 
    $haha=$data_table;
  }
  echo json_encode($haha);
}

else if(isset($_POST['aksi'])){
  
  if($_POST['aksi']=="simpan"){
        $id_pengguna=$_POST['id_pengguna'];
        $id_postingan=$_POST['id_postingan'];
        $jumlah_menonton=$_POST['jumlah_menonton'];
        $tanggal=date('Y-m-d H:i:s');
    if(!$_POST['id_menonton']==""){

      $id_menonton=$_POST['id_menonton'];
        $result = mysqli_query($mysqli, "UPDATE menontons set id_pengguna='$id_pengguna',id_postingan='$id_postingan',jumlah_menonton='$jumlah_menonton', updated_at='$tanggal' where id_menonton='$id_menonton'");
      
    }
    else{
      $result = mysqli_query($mysqli, "INSERT INTO menontons(id_pengguna,id_postingan,jumlah_menonton, created_at, updated_at) 
        values(
        '$id_pengguna',
        '$id_postingan',
        '$jumlah_menonton',
        '$tanggal',
        '$tanggal'
      )");
    }
  }
  else if($_POST['aksi']=="hapus"){
    $id_menonton=$_POST['id_menonton'];
    $result = mysqli_query($mysqli, "DELETE FROM menontons where id_menonton='$id_menonton'");
  }
}
else if(isset($_GET['aksi'])){
  $haha="";
  if(isset($_GET['id_postingan'])){
    $id_postingan=$_GET['id_postingan'];
    $result = mysqli_query($mysqli, "SELECT * FROM postingans ORDER BY id_postingan DESC");
    while($data_table = mysqli_fetch_array($result)) {
      if($data_table['id_postingan']==$id_postingan){
        $haha.= "<option value=".$data_table['id_postingan']." selected>".$data_table['judul']."</option>";
      }
      else{
        $haha.= "<option value=".$data_table['id_postingan'].">".$data_table['judul']."</option>";
      }                
    }
  }
  else if(isset($_GET['id_pengguna'])){
    $id_pengguna=$_GET['id_pengguna'];
    $result = mysqli_query($mysqli, "SELECT * FROM penggunas ORDER BY id_pengguna DESC");
    while($data_table = mysqli_fetch_array($result)) {
      if($data_table['id_pengguna']==$id_pengguna){
        $haha.= "<option value=".$data_table['id_pengguna']." selected>".$data_table['nama_depan']." ".$data_table['nama_belakang']."</option>";
      }
      else{
        $haha.= "<option value=".$data_table['id_pengguna'].">".$data_table['nama_depan']." ".$data_table['nama_belakang']."</option>";
      }                
    }
  }
  echo $haha;
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM menontons left join penggunas on menontons.id_pengguna=penggunas.id_pengguna left join postingans on menontons.id_postingan=postingans.id_postingan ORDER BY id_menonton DESC");
                    $no=0;
                    while($data_table = mysqli_fetch_array($result)) { 
                    $no++; 
                      ?>
                      <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_table['nama_depan']." ".$data_table['nama_belakang'] ?></td>
                    <td><?php echo $data_table['judul'] ?></td>
                    <td><?php echo $data_table['jumlah_menonton'] ?></td>
                    <td><button type='button' class='btn btn-block btn-primary btnEdit' data-id='<?php echo $data_table["id_menonton"] ?>'>Edit</button></td>
                    <td><button type='button' class='btn btn-block btn-danger btnHapus' data-id='<?php echo $data_table["id_menonton"] ?>'>Hapus</button></td>
                  </tr>
                <?php } 
}


?>
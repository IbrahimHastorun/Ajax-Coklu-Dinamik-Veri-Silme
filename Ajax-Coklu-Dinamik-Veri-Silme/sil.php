<?php
require_once('../database.php');

$id = $_POST['id'];

$sil = $database->prepare("DELETE FROM bilgiler WHERE id = ?");
$sil->bindParam(1,$id,PDO::PARAM_INT);
$sonuc = $sil->execute();

if ($sonuc) {
    echo "Silme başarılı";
}

  
?>



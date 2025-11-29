<?php
    require("function.php");

    $id_kategori = $_GET['id_kategori'];


    if(hapus_data_kategori($id_kategori) > 0){
        echo "
            <script>
                
                alert('Kategori berhasil dihapus dari database!');
                document.location.href = 'index2.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Kategpri gagal dihapus dari database!');
                document.location.href = 'index2.php';
            </script>
        ";
    }
   
?>

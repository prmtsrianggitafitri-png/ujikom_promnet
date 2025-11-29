<?php
    require("function.php");

    $id_buku = $_GET['id_buku'];


    if(hapus_data_buku($id_buku) > 0){
        echo "
            <script>
                
                alert('Data berhasil dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data gagal dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }
   
?>

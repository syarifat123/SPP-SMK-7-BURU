
   
   <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script type="text/javascript">
      $("#id_kelas").change(function(){
         var id_kelas = $("#id_kelas").val();
         var value = {
            id_kelas: id_kelas
         }
         $.ajax({
            url : "<?= base_url() ?>siswa/getsiswa/"+id_kelas,
            type: "GET",
            dataType : "html",
            success: function(data)
            {
               $("#id_siswa").html(data);
            }
         });
      });

      $("#id_siswa").change(function(){
         var id_siswa = $("#id_siswa").val();
         var value = {
            id_siswa: id_siswa
         }
         $.ajax({
            url : "<?= base_url() ?>tagihan/gettagihan/"+id_siswa,
            type: "GET",
            dataType : "html",
            success: function(data)
            {
               $("#data_tagihan").html(data);
            }
         });
      });

      $(document).on("click",".btnhapus",function(){
         var id =$(this).attr("data-id");
         swal({
            title: "Peringatan!",
            text: "Apakah anda ingin menghapus data pembayaran "+id+"?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
            .then((willDelete) => {
            if (willDelete) {
               window.location = "<?= base_url() ?>bayar/delete/"+id;
            } else {
               swal("Cancelled", "Batal :)", "error");
            }
         });
      });

      $(document).on("click",".btnupload",function(){
         var no_bayar =$(this).attr("data-id");
         var value = {
            no_bayar: no_bayar
         }
         $.ajax({
            url : "<?= base_url() ?>bayar/getmodal/"+no_bayar,
            type: "GET",
            dataType : "html",
            success: function(data)
            {
               $("#modalupload").modal("show");
               $("#data_tagihan").html(data);
            }
         });
      });

      $(document).on("click",".btnkonfirmasi",function(){
         var no_bayar =$(this).attr("data-id");
         var value = {
            no_bayar: no_bayar
         }
         $.ajax({
            url : "<?= base_url() ?>bayar/getkonfirmasi/"+no_bayar,
            type: "GET",
            dataType : "html",
            success: function(data)
            {
               $("#modalkonfirmasi").modal("show");
               $("#data_konfirmasi").html(data);
            }
         });
      });
   </script>
<script>
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
</script>
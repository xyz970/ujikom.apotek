@if (Session::has('insertSuccess'))
<script>
    swal("Success", "Data berhasil dimasukkan", "success");
</script>
@endif
@if (Session::has('deleteSuccess'))
<script>
    swal("Success", "Data berhasil dihapus", "success");
</script>
@endif
@if (Session::has('updateSuccess'))
<script>
    swal("Success", "Data berhasil diubah", "success");
</script>
@endif
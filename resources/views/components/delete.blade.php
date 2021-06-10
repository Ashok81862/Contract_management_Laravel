@section('plugins.Sweetalert2', true)

@push('js')
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.dismiss != "cancel" && result.value == true) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush

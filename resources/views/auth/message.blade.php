<!-- message.blade.php -->

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    // JavaScript untuk menghilangkan pesan setelah beberapa detik
    document.addEventListener('DOMContentLoaded', function() {
        var alertElements = document.querySelectorAll('.alert');
        alertElements.forEach(function(alert) {
            setTimeout(function() {
                alert.remove();
            }, 5000); // Menghilangkan pesan setelah 5 detik
        });
    });
</script>

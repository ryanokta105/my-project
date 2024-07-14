<!doctype html>
<html lang="ar">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>Iventori</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-4 text-light" href="#">Edit Kategori</a>
        </div>
    </nav>

    <form action="{{ route('update', $edit_kategori->kode_kategori) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container mt-3 w-50">
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Kode Kategori</label>
                <input type="text" id="disabledTextInput" name="kode_kategori" class="form-control"
                    value="{{ $edit_kategori->kode_kategori }}" required>
            </div>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Kategori</label>
                <input type="text" id="disabledTextInput" name="jenis" class="form-control"
                    value="{{ $edit_kategori->jenis }}" required>
            </div>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Gambar</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="gambar" id="inputGroupFile02"
                        value="{{ $edit_kategori->gambar }}">
                </div>
                <div class="gambar mt-3">
                    <img src="{{ asset('storage/' . $edit_kategori->gambar) }}" alt="" style="width: 30%;">
                </div>
            </div>
            <div class="modal-footer mb-5">
                <a href="/kategori">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Batal</button>
                </a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </form>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const confirmed = confirm('Apakah Anda yakin ingin menghapus?');
                    if (confirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    -->
</body>

</html>

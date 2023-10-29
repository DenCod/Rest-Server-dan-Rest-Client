<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container mt-5">
      <a class="btn btn-primary mb-2" href="/" role="button">Kembali</a>
      <form action="/store" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="name" name="name" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="division" class="form-label">Division</label>
                    <select class="form-select division" aria-label="Default select example" name="division" id="division">
                        <option value="">Pilih</option>
                        @foreach ($division as $divisi)
                        <option value="{{ $divisi['id'] }}">{{ $divisi['division_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <select class="form-select position" aria-label="Default select example" name="position_id" id="position_id">
                        <option value="">Pilih</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="birth_date" class="form-label">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" placeholder="dd/mm/yyyy" name="birth_date" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone_number" placeholder="08xxxxxxxxxx" name="phone_number" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" aria-label="Default select example" name="gender">
                        <option value="">Pilih</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="join_date" class="form-label">Join Date</label>
                    <input type="date" class="form-control" id="join_date" placeholder="dd/mm/yyyy" name="join_date" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="is_active" class="form-label">Is Active</label>
                    <select class="form-select" aria-label="Default select example" name="is_active">
                        <option value="">Pilih</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>    

    <script>
        document.getElementById('division').addEventListener('change', function () {
        var divisionID = this.value;
        var positionSelect = document.getElementById('position_id');

        // Hapus semua opsi subkategori sebelum mengisi ulang
        positionSelect.innerHTML = '<option value="">Pilih</option>';

        // Isi ulang opsi subkategori berdasarkan kategori yang dipilih
        <?php foreach($position as $posisi): ?>
            if (<?php echo $posisi['division_id']; ?> == divisionID) {
                var option = document.createElement('option');
                option.value = <?php echo $posisi['id']; ?>;
                option.textContent = '<?php echo $posisi['position_name']; ?>';
                positionSelect.appendChild(option);
            }
        <?php endforeach; ?>
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
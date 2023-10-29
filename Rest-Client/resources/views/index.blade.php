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
      <a class="btn btn-primary mb-2" href="/tambah" role="button">Tambah Data</a>
        <div class="row">
            <div class="col">
              @if (session()->has('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif
                <table class="table table-bordered border-dark">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Division</th>
                        <th scope="col">Position</th>
                        <th scope="col">Age</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Working Periode</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($employees as $employee)
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{ $employee['name'] }}</td>
                                <td>{{ $employee['position_name'] }}</td>
                                <td>{{ $employee['division_name'] }}</td>
                                <td>{{ $employee['birth_date'] }}</td>
                                <td>{{ $employee['phone_number'] }}</td>
                                <td>{{ $employee['join_date'] }}</td>
                                <td>
                                  <a class="btn btn-success" href="/edit/{{ $employee['id'] }}" role="button">Edit</a>
                                  <a class="btn btn-danger" onclick="return confirm('Are you sure ?')" href="/destroy/{{ $employee['id'] }}" role="button">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Department List</title>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <br>
            <h1 style="text-align: center;">Departments</h1>
        <br>
        <div style="text-align: right;">
            <a href="/department/form" class="btn btn-success">Add</a>
        </div>
        <h1>{{ $title }}</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Active</th>
                {{-- <th scope="col"></th> --}}
              </tr>
            </thead>
            <tbody>
                @foreach ($departments as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->active ? 'เปิดใช้งาน' : 'ปิดใช้งาน' }}</td>
                    {{-- <td width="180">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('department.form', $item->id) }}" class="btn btn-primary">View</a>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('department.delete', $item->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this department?')">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</body>
</html>

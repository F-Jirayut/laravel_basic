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
    <div class="container">
        <br>
        <h1 style="text-align: center;">Department Form</h1>
        <br>

    <!-- resources/views/departments/create.blade.php -->
    <form method="POST" action="{{ route('department.form.submit' , $id) }}">
        @csrf

        @php
            $value_name = "";
            $value_descr = "";
            $value_active = true;
            if ($department) {
                $value_name =  $department->name;
            }
            if (old('name')) {
                $value_name =  old('name');
            }

            if ($department) {
                $value_descr =  $department->description;
            }
            if (old('description')) {
                $value_descr =  old('description');
            }

            if ($department) {
                $value_active =  $department->active;
            }
            if (old('active')) {
                $value_active =  old('active');
            }
        @endphp

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" value="{{ $value_name }}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control">{{ $value_descr }}</textarea>
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Active</label>
            <select id="active" name="active" class="form-select">
                <option value="1" @if ($value_active == 1) selected @endif>True</option>
                <option value="0" @if ($value_active == 0) selected @endif>False</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



    </div>
</body>
</html>

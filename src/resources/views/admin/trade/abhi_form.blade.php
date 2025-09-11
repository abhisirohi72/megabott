<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        @if (session('notify'))
            <div class="alert alert-success">
                {{ session('notify') }}
            </div>
        @endif

        <form action="{{ route('admin.trade.addTradeLogs') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="text" class="form-label">Min Balance</label>
                <input type="text" class="form-control" name="min_balance" placeholder="Enter your Min Balance">
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Max Balance</label>
                <input type="text" class="form-control" name="max_balance" placeholder="Enter your MAx Balance">
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Income Limit</label>
                <input type="text" class="form-control" name="inc_limit" placeholder="Enter your income limit">
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Minimum Return</label>
                <input type="text" class="form-control" name="min_return" placeholder="Enter your Minimum Return">
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Maximum Return</label>
                <input type="text" class="form-control" name="max_return" placeholder="Enter your Maximum Return">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="table-responsive mt-2" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Min Balance</th>
                        <th>Max Balance</th>
                        <th>Income Limit</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($details as $key=>$item)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item->min_balance }}</td>
                      <td>{{ $item->max_balance }}</td>
                      <td>{{ $item->inc_limit }}</td>
                    </tr>
                  @endforeach  
                    <!-- Add more rows here -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

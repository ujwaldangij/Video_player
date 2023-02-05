<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $data[0]->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</head>

<body class="bg-warning text-white">
    <div id="head">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 mt-5">
                    <h1 class="text-uppercase">{{ $data[0]->title }}</h1>
                    <div class="text text-capitalize">
                        <p>{{ $data[0]->description }}</p>
                    </div>
                    <button class="btn btn-danger d" href="{{ asset('uploads/'.$data[0]->file) }}">Click Here To download</button>
                </div>
                <div class="col-md-6 ">
                    <video class="w-100" controls controlsList="nodownload">
                        <source src="{{ asset('uploads/'.$data[0]->file) }}" type="video/mp4" />
                    </video>
                    <h1 id="u">Download-> {{ $count }}</h1>
                    <h1 id="u">View-> {{ $view }}</h1>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="{{ asset('asset/admin/js/jquery-3.5.1.min.js') }}"></script>
    <script>
        $(document).on('click', '.d', function (e) {
            e.preventDefault();
            var data = '{{ $data[0]->file  }}';
            window.open("/download?key="+data, "_blank");
            location.reload();
          });
    </script>
</body>

</html>

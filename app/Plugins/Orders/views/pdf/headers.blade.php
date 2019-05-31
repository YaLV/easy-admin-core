<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Farmers</title>
    <style type="text/css">
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            page-break-after: always;
            border-collapse: collapse;
        }

        table tr th, table tr td {
            border: 1px solid black;
            border-collapse: collapse;
            margin: 0px;
        }

    </style>
</head>
<body>
@if($master??false)
    @yield('content')
@else
    @include("Orders::pdf.farmer")
@endif
</body>
</html>

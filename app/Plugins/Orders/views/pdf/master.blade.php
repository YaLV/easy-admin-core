@extends("Orders::pdf.headers")

@section('content')
    @foreach($master as $farmerPDF)
        @include("Orders::pdf.farmer", $farmerPDF)
    @endforeach
@endsection
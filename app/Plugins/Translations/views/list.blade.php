@extends('admin.elements.table')

@include("Translations::modal")

@push('scripts')
    <script>
        var editUrl = "{{ route('translations.edit', ['ID']) }}";
        var modalID = "{{ $modalId['Translations'] }}";
        var storeUrl = "{{ route('translations.store', ['ID']) }}";
    </script>
@endpush
@extends('layouts.admin')

@php
    $orderable = Route::has($currentRoute.".sort")?:false;
@endphp

@section('content')

    @if($filters??false)
        @include('admin.partials.filters')

        @push('css')
            <link rel="stylesheet" href="{{ asset('css/daterangepicker.min.css') }}">
        @endpush

        @push('scripts')
            <script src="{{ asset('js/moment.js')}}"></script>
            <script src="{{ asset('js/jquery.daterangepicker.min.js')}}"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.daterangepicker').dateRangePicker({
                        startOfWeek: 'monday',
                        separator: ' ~ ',
                        format: 'DD.MM.YYYY HH:mm',
                        autoClose: false,
                        time: {
                            enabled: true
                        }
                    })
                })
            </script>
        @endpush
    @endif

    <div class="row tableContent">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">{{ $header??"" }}</div>
                        <div class="col-md-6 text-right">
                            @if(Route::has($currentRoute.".add"))
                                <a href="{{ route($currentRoute.".add", request()->route()->parameters) }}"
                                   class="btn btn-primary btn-xs"><i
                                            class="fas fa-plus"></i></a>
                            @endif
                            @if($massActions??false)
                                <div class="btn-group massActionGroup">
                                    @foreach($massActions as $action)
                                        <a href="{{ $action->url }}" data-params="getCheckedRows"
                                           class="btn btn-xs massAction {{ $action->class??"" }} isAjax post"
                                           data-callback="{{ $action->callback??"" }}" title="{{ $action->label??"" }}"
                                        ><i class="{{ $action->icon }}"></i></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            @if($orderable)
                                <td style="width:20px;">
                                </td>
                            @endif
                            @foreach($tableHeaders as $headerItem)
                                @if($headerItem['label']=='checkall')
                                    <th class="checkall">
                                        Select:<br />
                                        <a href="javascript:void(0)">All</a>
                                    </th>
                                @else
                                    <th style="vertical-align:top;">{{ $headerItem['label'] }}</th>
                                @endif
                            @endforeach
                        </tr>
                        </thead>
                        <tbody {{ $orderable?"data-sortable":"" }}>
                        @foreach($list as $listItem)
                            @php
                                $hasSoftDeletes = method_exists($listItem, "trashed");
                            @endphp
                            <tr class="{{ ($hasSoftDeletes && $listItem->trashed())??false?"text-muted":"text-dark" }} {{$listItem->rowClass??false}}"
                                data-id="{{ $listItem->id??"" }}">
                                @if($orderable)
                                    <td>
                                        <i class="fas fa-arrows-alt handle" style="cursor:grab;"></i>
                                    </td>
                                @endif
                                @foreach($tableHeaders as $headerItem)
                                    @if(($headerItem->field??$headerItem['field']??"")=='buttons')
                                        <td style="width:200px;" class="text-right {{ $headerItem['class']??false }}">
                                            <div class="btn-group">
                                                @foreach($headerItem['buttons'] as $button)
                                                    @includeIf('admin.buttons.'.$button)
                                                @endforeach
                                            </div>
                                        </td>
                                    @elseif(($headerItem->field??$headerItem['type']??"")=='yesno')
                                        <td {{ ($headerItem['class']??false)?"class=".$headerItem['class']:"" }}>
                                            @if($listItem->{$headerItem['field']})
                                                <i class="fas fa-check-circle" style="color:green;"></i>
                                            @else
                                                <i class="fas fa-window-close" style="color:darkred;"></i>
                                            @endif
                                        </td>
                                    @elseif($headerItem['translate']??false)
                                        @if($headerItem['translate']=='array')
                                            <td {{ ($headerItem['class']??false)?"class=".$headerItem['class']:"" }}>{{ $listItem->{$headerItem['field']}[language()]??$listItem[[$headerItem]['field']][language()]??"" }}</td>
                                        @else
                                            @if(!($listItem->{$headerItem['key']}??$listItem[$headerItem['key']]??""))
                                                <td {{ ($headerItem['class']??false)?"class=".$headerItem['class']:"" }}></td>
                                            @else
                                                <td {{ ($headerItem['class']??false)?"class=".$headerItem['class']:"" }}>{{ __(implode(".",[$headerItem['translate'], $listItem->{$headerItem['key']}??$listItem[$headerItem['key']]??""])) }}</td>
                                            @endif
                                        @endif
                                    @elseif($headerItem['fn']??false)
                                        <td {{ ($headerItem['class']??false)?"class=".$headerItem['class']:"" }}>{!! $headerItem['fn']($listItem->{$headerItem['field']}??$listItem[$headerItem['field']]??null, $headerItem['results'])??""  !!}</td>
                                    @else
                                        <td class="{{ ($headerItem['class']??false)?$headerItem['class']:"" }} {{ ($headerItem['classbyfield']??false)?($listItem->{$headerItem['classbyfield']}??$listItem[$headerItem['classbyfield']]??""):"" }}">{!! $listItem->{$headerItem['field']}??$listItem[$headerItem['field']]??""  !!}</td>
                                    @endif

                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                        @if($list instanceof Illuminate\Pagination\LengthAwarePaginator)
                            <tfoot>
                            <tr>
                                <td colspan="{{ count($tableHeaders) }}">{{ $list->render() }}</td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if($orderable)
        <script src="{{asset('js/Sortable.min.js')}}"></script>
        <script>
            jQuery(document).ready(function () {
                new Sortable($('[data-sortable]')[0], {
                    handle: "td:first-child",
                    ghostClass: 'blue-background-class',
                    onEnd: function (evt) {
                        let sequence = [];
                        rows = $('[data-sortable]').find('tr').each(function (index, el, list) {
                            sequence.push($(el).data('id'));
                        });
                        console.log(sequence);
                        $.post("{{ route("$currentRoute.sort", request()->route()->parameters) }}", "sequence=" + sequence.join(","), function (response) {
                            if (response.status) {
                                for (x in response.sequence) {
                                    $('[data-id=' + x + '] .seqTarget').text(response.sequence[x]);
                                }
                            }
                        });
                    }

                });
            });
        </script>
    @endif
    @foreach(($js??[]) as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach
@endpush
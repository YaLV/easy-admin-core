@extends('layouts.admin')

@section('content')
    <div class="ro">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">{{ $header??"" }}</div>
                        <div class="col-md-6 text-right">
                            @if(Route::has($currentRoute.".add"))
                                <a href="{{ route($currentRoute.".add") }}" class="btn btn-primary btn-xs"><i
                                            class="fas fa-plus"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>

                            @foreach($tableHeaders as $headerItem)
                                <th>{{ $headerItem['label'] }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $listItem)
                            @php
                                $hasSoftDeletes = method_exists($listItem, "trashed");
                            @endphp
                            <tr {{ ($hasSoftDeletes && $listItem->trashed())??false?"class=text-muted":"class=text-dark" }}>
                                @foreach($tableHeaders as $headerItem)
                                    @if(($headerItem->type??$headerItem['type']??"")=='translate')
                                        <td {{ ($headerItem['sortGrab']??false)?"class=dragdrop":"" }}>{{ __(($headerItem['use']??"").($listItem->{$headerItem['field']}??$listItem[[$headerItem]['field']]??"")) }}</td>
                                    @elseif(($headerItem->field??$headerItem['field']??"")=='buttons')
                                        <td style="width:200px;" class="text-right">
                                            <div class="btn-group">
                                                @foreach($headerItem['buttons'] as $button)
                                                    @includeIf('admin.buttons.'.$button)
                                                @endforeach
                                            </div>
                                        </td>
                                    @elseif(($headerItem->field??$headerItem['type']??"")=='yesno')
                                        <td>
                                            @if($listItem->{$headerItem['field']})
                                                <i class="fas fa-check-circle" style="color:green;"></i>
                                            @else
                                                <i class="fas fa-window-close" style="color:darkred;"></i>
                                            @endif
                                        </td>
                                    @elseif($headerItem['translate']??false)
                                        @if($headerItem['translate']=='array')
                                            <td {{ ($headerItem['sortGrab']??false)?"class=dragdrop":"" }}>{{ $listItem->{$headerItem['field']}[session()->get('language')??config('app.locale')]??$listItem[[$headerItem]['field']][session()->get('language')??config('app.locale')]??"" }}</td>
                                        @else
                                            <td {{ ($headerItem['sortGrab']??false)?"class=dragdrop":"" }}>{{ __(implode(".",[$headerItem['translate'], $listItem->{$headerItem['key']}??$listItem[$headerItem[$key]]??""])) }}</td>
                                        @endif
                                    @else
                                        <td {{ ($headerItem['sortGrab']??false)?"class=dragdrop":"" }}>{{ $listItem->{$headerItem['field']}??$listItem[[$headerItem]['field']]??"" }}</td>
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
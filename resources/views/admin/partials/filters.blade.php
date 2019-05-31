<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">Filters</div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('orders.setfilters') }}" class="btn btn-xs btn-success isAjax post"
                           data-callback="reloadPage" data-params="getForm" data-form="#filterform">Filter</a>
                        <a href="{{ route('orders.clearfilters') }}" class="btn btn-xs btn-warning isAjax post"
                           data-callback="reloadPage">Clear Filters</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="filterform">
                    @foreach($filters as $filter)
                        <div style="float:left;margin-left: 10px;">
                            @php
                                $id = str_random(7);
                            @endphp
                            @switch($filter['type'])
                                @case('text')
                                <label for="{{$id}}">{{$filter['label']}}</label>
                                <input type="text" name="filter[{{$filter['name']}}]" class="form-control" id="{{$id}}"
                                       value="{{($currentFilters[$filter['name']]??"")}}" />
                                @break

                                @case('select')
                                <label for="{{$id}}">{{$filter['label']}}</label><br />
                                <select name="filter[{{$filter['name']}}]" class="selectpicker" id="{{$id}}">
                                    <option></option>
                                    @foreach($filter['options'] as $optionId => $optionName)
                                        <option value="{{$optionId}}" {{($currentFilters[$filter['name']]??false)==$optionId?"selected":""}}>{{$optionName}}</option>
                                    @endforeach
                                </select>
                                @break
                            @endswitch
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
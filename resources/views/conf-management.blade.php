@extends('layouts.app')

@section('content')
<div class="container-fluid mt-1 h-100">
<div class="row h-100">
    @isset($ConfList)
    <div class="{{ isset($ConfList->first()::$html_casts['list']) ? $ConfList->first()::$html_casts['list']:'col-md-4' }} p-md-0">
        <div class="card h-100 flex-column">
        @if( (isset($ConfList->first()::$html_casts['search']) && $ConfList->first()::$html_casts['search'] ) || ( isset($ConfList->first()::$html_casts['create']) && $ConfList->first()::$html_casts['create']))
            <div class="flex container d-flex" >
                <div class="mt-auto pb-2 pt-1 w-100 d-flex justify-content-start">
                    @if(isset($ConfList->first()::$html_casts['search']) && $ConfList->first()::$html_casts['search'])
                    <form class="d-none d-md-inline-block form-inline mr-0 mr-md-5 my-2 my-md-0" method="GET" action="{{ route($ConfList->first()->getTable().'.index') }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                <div class="mt-auto pb-2 pt-1 w-100 d-flex justify-content-end">
                @if(isset($ConfList->first()::$html_casts['create']) && $ConfList->first()::$html_casts['create'])
                <form method="GET" action="{{ route($ConfList->first()->getTable().'.create') }}">
                <input type="hidden" id="page" name="page" value="{{ request()->get('page')?request()->get('page'):1 }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary" formaction="{{ route($ConfList->first()->getTable().'.create') }}">
                                    {{ __('Create '.ucfirst(Str::singular($ConfList->first()->getTable()))) }}
                    </button>
                </form>
                @endif
                </div>
            </div>
            @endif
            <table class="table table-responsive w-auto h-85" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 6%" scope="col">No</th>
                        @foreach ($ConfList->first()::$table_list as $key)
                        <th style="width: 92%" scope="col">{{ucfirst($key)}}</th>
                        @endforeach
                        <!-- <th style="width: 6%" scope="col">Status</th> -->
                        @if( (isset($ConfList->first()::$html_casts['action_edit']) && $ConfList->first()::$html_casts['action_edit'] ) || ( isset($ConfList->first()::$html_casts['action_delete']) && $ConfList->first()::$html_casts['action_delete']))
                        <th style="width: 6%" scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($ConfList as $key => $confarry)
                <tr>
                <td>{{ ++$i }}</td>
                @foreach ($ConfList->first()::$table_list as $key)
                <td>
                @if($loop->iteration == 1)
                <a href="{{ route($confarry->getTable().'.show',$confarry->id) }}?@if( request()->get('page') )page={{ request()->get('page') }}@endif">
                @endif
                {{ $confarry[$key] }}
                @if($loop->iteration == 1)</a> @endif
                </td>
                @endforeach
                <!-- <td><i class="fas fa fa-check-circle text-success" aria-hidden="true"></i></td> -->
                @if( (isset($ConfList->first()::$html_casts['action_edit']) && $ConfList->first()::$html_casts['action_edit'] ) || ( isset($ConfList->first()::$html_casts['action_delete']) && $ConfList->first()::$html_casts['action_delete']))
                <td>
                @endif
                    @if(isset($ConfList->first()::$html_casts['action_edit']) && $ConfList->first()::$html_casts['action_edit'])
                    <a href="{{ route($confarry->getTable().'.edit',$confarry->id) }}?@if( request()->get('page') )page={{ request()->get('page') }}@endif">
                    <i class="fas fa fa-edit" aria-hidden="true"></i>
                    </a>
                    &nbsp;&nbsp;
                    @endif
                    @if(isset($ConfList->first()::$html_casts['action_delete']) && $ConfList->first()::$html_casts['action_delete'])
                    <a data-toggle="modal" href="#" id="confirmationLink" data-target="#confirmation-modal" data-attr="{{ route($confarry->getTable().'.destroy', $confarry->id) }}"  data- id="{{ $confarry->id}}" data-name="{{$confarry[$confarry::$table_list[0]]}}" title="Delete {{ ucfirst(Str::singular($confarry->getTable())) }}">
                    <i class="fas fa-times-circle text-danger" aria-hidden="true"></i>
                    </a>
                    @endif
                @if( (isset($ConfList->first()::$html_casts['action_edit']) && $ConfList->first()::$html_casts['action_edit'] ) || ( isset($ConfList->first()::$html_casts['action_delete']) && $ConfList->first()::$html_casts['action_delete']))
                </td>
                @endif
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-auto d-flex justify-content-center w-100">
                {{ $ConfList->links() }}
            </div>
        </div>
    </div>
    @endisset
    <div class="{{ isset($ConfList->first()::$html_casts['view']) ? $ConfList->first()::$html_casts['view']:'col-md-8' }} p-md-0">
        <div class="card h-100 flex-column">
            @php if(Str::endsWith(Request::url(),'create')) $conf= app(get_class($ConfList->first())) @endphp
            @if(isset($conf))            
            <form method="POST" action="{{ Str::endsWith(Request::url(),'create')?route($conf->getTable().'.store'):route($conf->getTable().'.update',$conf->id) }}" class="form-signin h-85">
                <input type="hidden" id="page" name="page" value="{{ request()->get('page')?request()->get('page'):1 }}">
                @csrf
                @if(Str::endsWith(Request::url(),'create')) 
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="flex container h-100" >
                    <ul class="nav nav-tabs" role="tablist" id="ConfTab">
                        @foreach ($conf::$html_casts as $key => $value)
                        @if(is_array($value))
                        <li class="nav-item"><a  id="{{$key}}-tab" class="nav-link @if($loop->iteration == 1) active @endif" data-toggle="tab" href="#{{$key}}">{{ ucfirst($key) }}</a></li>
                        @endif
                        @endforeach
                    </ul>    
                    <div class="card-body tab-content">
                    @foreach ($conf::$html_casts as $key => $value)
                        @if(is_array($value))
                        <div id="{{$key}}" class="tab-pane fade h-100 @if($loop->iteration == 1) show active @endif" role="tabpanel" aria-labelledby="{{$key}}-tab">
                            <h3>{{ ucfirst($key) }} Configuration</h3><hr>
                            <div class="container">
                            <div class="row">                                  
                            @foreach ($value as $fields => $val)
                                <div class="@if(isset($conf::$html_casts['layout'])) @if($conf::$html_casts['layout'] == 1) col-md-12 @elseif($conf::$html_casts['layout'] == 2) col-md-6 @elseif($conf::$html_casts['layout'] == 3) col-md-4 @else col-md-12 @endif @else col-md-12 @endif"><!-- md-6 = 2 column layout md-4 = 3 column layout  -->
                                <div class="form-group row">
                                    <label for="{{$fields}}" class="col-md-5 col-form-label">{{ __(ucfirst($fields)) }}</label>
                                    <div class="col-md-7">
                                        <input id="{{$fields}}" type="{{$val}}" class="form-control @error($fields) is-invalid @enderror" name="{{$fields}}" value="{{ !in_array($fields, $conf->getHidden())?$conf[$fields]:'' }}" placeholder="Enter {{ __(ucfirst($fields)) }}" @if(!Str::endsWith(Request::url(),'create')) @if(!Str::endsWith(Request::url(),'edit') || in_array($fields,$conf::$html_disabled) ) disabled @endif @endif autocomplete="{{$fields}}">

                                        @error($fields)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                </div>                                    
                            @endforeach
                            {{-- @foreach ($value as $fields => $val)
                                @if($loop->iteration % 2 == 0) --}}
                            </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    {{-- {{ dd($conf->getKeyName()) }} --}}
                    </div>
                </div>
                @if(Str::endsWith(Request::url(),'edit') || Str::endsWith(Request::url(),'create')) 
                    <div class="mt-auto p-3 w-100 d-flex justify-content-end">
                        <button type="submit" class="btn btn-secondary" formaction="{{ url()->previous() }}" formmethod="GET">
                                        {{ __('Cancel') }}
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                        </button>
                    </div>
                @endif
            </form>
            @endisset
        </div>
    </div>
    @include('includes.confirmation-modal')
</div>
</div>
@endsection

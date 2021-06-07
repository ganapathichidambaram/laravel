@extends('layouts.app')

@section('content')
<div class="container-fluid mt-1 h-100">
<div class="row h-100">
    @isset($ConfList)
    <div class="{{ isset($view['casts']['list']) ? $view['casts']['list']:'col-md-4' }} p-md-0">
        <div class="card h-100 flex-column">
        @if( (isset($view['casts']['search']) && $view['casts']['search'] ) || ( isset($view['casts']['create']) && $view['casts']['create']))
            <div class="flex container d-flex" >
                <div class="mt-auto pb-2 pt-1 w-100 d-flex justify-content-start">
                    @if(isset($view['casts']['search']) && $view['casts']['search'])
                    <form class="d-none d-md-inline-block form-inline mr-0 mr-md-5 my-2 my-md-0" method="GET" action="{{ route($view['table'].'.index') }}">
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
                @if(isset($view['casts']['create']) && $view['casts']['create'])
                <form method="GET" action="{{ route($view['table'].'.create') }}">
                <input type="hidden" id="page" name="page" value="{{ request()->get('page')?request()->get('page'):1 }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary" formaction="{{ route($view['table'].'.create') }}">
                                    {{ __('Create '.ucfirst(Str::singular($view['table']))) }}
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
                        @foreach ($view['list'] as $key)
                        <th style="width: 92%" scope="col">{{ucfirst($key)}}</th>
                        @endforeach
                        <!-- <th style="width: 6%" scope="col">Status</th> -->
                        @if( (isset($view['casts']['action_edit']) && $view['casts']['action_edit'] ) || ( isset($view['casts']['action_delete']) && $view['casts']['action_delete']))
                        <th style="width: 6%" scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($ConfList as $key => $confarry)
                <tr>
                <td>{{ ++$i }}</td>
                @foreach ($view['list'] as $key)
                <td>
                @if($loop->iteration == 1)
                <a href="{{ route($view['table'].'.show',$confarry->id) }}?@if( request()->get('page') )page={{ request()->get('page') }}@endif">
                @endif
                {{ $confarry[$key] }}
                @if($loop->iteration == 1)</a> @endif
                </td>
                @endforeach
                <!-- <td><i class="fas fa fa-check-circle text-success" aria-hidden="true"></i></td> -->
                @if( (isset($view['casts']['action_edit']) && $view['casts']['action_edit'] ) || ( isset($view['casts']['action_delete']) && $view['casts']['action_delete']))
                <td>
                @endif
                    @if(isset($view['casts']['action_edit']) && $view['casts']['action_edit'])
                    <a href="{{ route($view['table'].'.edit',$confarry->id) }}?@if( request()->get('page') )page={{ request()->get('page') }}@endif">
                    <i class="fas fa fa-edit" aria-hidden="true"></i>
                    </a>
                    &nbsp;&nbsp;
                    @endif
                    @if(isset($view['casts']['action_delete']) && $view['casts']['action_delete'])
                    <a data-toggle="modal" href="#" id="confirmationLink" data-target="#confirmation-modal" data-attr="{{ route($view['table'].'.destroy', $confarry->id) }}"  data- id="{{ $confarry->id}}" data-name="{{$confarry[$view['list'][0]]}}" title="Delete {{ ucfirst(Str::singular($view['table'])) }}">
                    <i class="fas fa-times-circle text-danger" aria-hidden="true"></i>
                    </a>
                    @endif
                @if( (isset($view['casts']['action_edit']) && $view['casts']['action_edit'] ) || ( isset($view['casts']['action_delete']) && $view['casts']['action_delete']))
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
    <div class="{{ isset($view['casts']['view']) ? $view['casts']['view']:'col-md-8' }} p-md-0">
        <div class="card h-100 flex-column">
        @if(isset($conf) || Str::endsWith(Request::url(),'create'))
            <form method="POST" action="{{ Str::endsWith(Request::url(),'create')?route($view['table'].'.store'):route($view['table'].'.update',$conf->id) }}" class="form-signin h-85">
                <input type="hidden" id="page" name="page" value="{{ request()->get('page')?request()->get('page'):1 }}">
                @csrf
                @if(Str::endsWith(Request::url(),'create')) 
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="flex container h-100" >
                    <ul class="nav nav-tabs" role="tablist" id="ConfTab">
                        @foreach ($view['casts'] as $key => $value)
                        @if(is_array($value))
                        <li class="nav-item"><a  id="{{$key}}-tab" class="nav-link @if($loop->iteration == 1) active @endif" data-toggle="tab" href="#{{$key}}">{{ ucfirst($key) }}</a></li>
                        @endif
                        @endforeach
                    </ul>    
                    <div class="card-body tab-content">
                    @foreach ($view['casts'] as $key => $value)
                        @if(is_array($value))
                        <div id="{{$key}}" class="tab-pane fade h-100 @if($loop->iteration == 1) show active @endif" role="tabpanel" aria-labelledby="{{$key}}-tab">
                            <h4>{{ ucfirst($key) }} Configuration</h4><hr>
                            <div class="container">
                            <div class="row">                                  
                            @foreach ($value as $fields => $val)
                                @if( $val == 'break') 
                                    @if(Str::startsWith($fields,'__break')) </div><hr><div class="row">
                                    @else </div><h5>{{ ucfirst($fields) }} </h5> <hr><div class="row">
                                    @endif
                                    @continue
                                @endif                                
                                <div class="@if(isset($view['casts']['layout'])) @if($view['casts']['layout'] == 1) col-md-12 @elseif($view['casts']['layout'] == 2) col-md-6 @elseif($view['casts']['layout'] == 3) col-md-4 @else col-md-12 @endif @else col-md-12 @endif"><!-- md-6 = 2 column layout md-4 = 3 column layout  -->
                                    <div class="form-group row">
                                    @if( $val == 'text' || $val =='email' || $val =='password' )
                                        <label for="{{$fields}}" class="col-md-5 col-form-label">{{ __(ucfirst($fields)) }}</label>
                                        <div class="col-md-7">
                                            <input id="{{$fields}}" type="{{$val}}" class="form-control @error($fields) is-invalid @enderror" name="{{$fields}}" value="@isset($conf){{ !in_array($fields, $view['hidden'])?$conf[$fields]:'' }}@endisset" placeholder="Enter {{ __(ucfirst($fields)) }}" @if(!Str::endsWith(Request::url(),'create')) @if(!Str::endsWith(Request::url(),'edit') || in_array($fields,$view['disabled']) ) disabled @endif @endif autocomplete="{{$fields}}">

                                            @error($fields)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @elseif( $val == 'multi' || $val == 'select')
                                    <label for="{{$fields}}" class="col-md-5 col-form-label">{{ __(ucfirst($fields)) }}</label>
                                    <div class="col-md-7">
                                    <select name="{{$fields}}@if($val == 'multi')[]@endif" id="{{$fields}}" class="selectpicker form-control" data-live-search="true" @if($val == 'multi') multiple @endif data-actions-box="true" data-selected-text-format="count" data-size="5" >
                                    @isset($_fData[$fields])
                                        @foreach( $_fData[$fields] as $_fkey => $_fval)
                                        <option value="{{$_fkey}}" @if(isset($_cData[$fields]) && in_array($_fkey,$_cData[$fields])) selected @endif>{{$_fval}}</option>
                                        @endforeach                                        
                                    @endisset
                                    </select>
                                        @error($fields)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @endif
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
            @endif
        </div>
    </div>
    @include('includes.confirmation-modal')
</div>
</div>
@endsection

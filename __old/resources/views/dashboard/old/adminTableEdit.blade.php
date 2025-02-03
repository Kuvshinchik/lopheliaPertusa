@extends('layouts.admin')

@section('body')
    {{--dd($zagolovkiAndTovars)--}}
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{$breadcrumb[0]}}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$breadcrumb[1]}}</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$breadcrumb[1]}}</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{route('adminTableUpdate', ['alias' => $alias])}}">
                                    @csrf
                                <table id="example3" class="table">
                                    <thead class="table-light">
                                    <tr>
                                        @for ($i = 0; $i < count(array_keys($zagolovkiAndTovars)); $i++)
                                            <th>{{array_keys($zagolovkiAndTovars)[$i]}}</th>
                                        @endfor
                                        <th>ДЕЙСТВИЕ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $massivException = ['id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];
                                    @endphp
                                        <tr>
                                            @foreach ($zagolovkiAndTovars as $key=>$value)
                                                <td>
                                                @if(in_array($key, $massivException))
                                                    {{--$value--}}
												<div class="form-group">
                                                        <input name="{{$key}}" type="text" class="form-control input-default " value="{{$value}}" readonly>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <input name="{{$key}}" type="text" class="form-control input-default " value="{{$value}}">
                                                    </div>
                                                @endif
                                                </td>




                                            @endforeach
                                            <td>
                                {{--                <div class="d-flex">
                                                    <a href="{{route('adminTableEdit', ['alias'=>$alias, 'id'=>$zagolovkiAndTovars['id']])}}"
                                                       class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a href="{{route('adminTableDelete', ['alias'=>$alias, 'id'=>$zagolovkiAndTovars['id']])}}"
                                                       class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                    --}}
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto" style="margin-left: 0px !important">
                                                        <button type="submit" class="btn btn-primary">СОХРАНИТЬ</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--**********************************
                Content body end
            ***********************************-->

@endsection

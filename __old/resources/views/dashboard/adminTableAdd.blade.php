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
                    <li class="breadcrumb-item active"><a href="{{route('adminTable', ['alias' => $alias])}}">{{$breadcrumb[1]}}</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
							@if($alias == 'tovars')
					Добавить товар
				@else
					Добавить пост
				@endif
							{{--$breadcrumb[1]--}}
							
							
							</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
							
                                <form method="POST" action="{{route('adminTableSave', ['alias' => $alias])}}" enctype="multipart/form-data">
                                    @csrf
                            
							<table id="example3" class="table">
                                    <thead class="table-light">
                                    <tr>
                                        @for ($i = 0; $i < count(array_keys($zagolovkiAndTovars)); $i++)
                                            <th>{{array_keys($zagolovkiAndTovars)[$i]}}</th>
                                        @endfor										
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
												<div class="form-group">
                                                    <input name="{{$key}}" type="text" class="form-control input-default " readonly>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <input name="{{$key}}" type="text" class="form-control input-default">
                                                </div>
                                                @endif
                                                </td>
                                            @endforeach								
						
											
                                </tr>
                                </tbody>
                                </table>
								
@if (in_array($alias, ['tovars', 'blogs']))
				<div class="input-group">
                    <label for="file">

                    </label>
                   <input type="file" name="file_1" id="file_1"  multiple class="form-control"/>
                   <br>
                    <input type="file" name="file_2" id="file_2"  multiple class="form-control"/>
                </div>
                <br>
                <div>
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
				<br>
@endif								
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

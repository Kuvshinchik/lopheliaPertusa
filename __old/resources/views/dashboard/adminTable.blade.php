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

                                <table id="example3" class="table">
                                    <thead class="table-light">
                                    <tr>
                                        @for ($i = 0; $i < count(array_keys($zagolovkiAndTovars[0])); $i++)
                                            <th>{{array_keys($zagolovkiAndTovars[0])[$i]}}</th>
                                        @endfor
                                        <th>ДЕЙСТВИЕ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for ($i = 0; $i < count($zagolovkiAndTovars); $i++)
                                        <tr>
                                            @foreach ($zagolovkiAndTovars[$i] as $key=>$value)
                                                <td>{{$value}}</td>
                                            @endforeach
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('adminTableEdit', ['alias'=>$alias, 'id'=>$zagolovkiAndTovars[$i]['id']])}}"
                                                       class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a href="{{route('adminTableDelete', ['alias'=>$alias, 'id'=>$zagolovkiAndTovars[$i]['id']])}}"
                                                       class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--**********************************
	Content body end
***********************************-->
	@if (in_array($alias, ['tovars', 'blogs']))
		<br>
			<div>
				<a href="{{route('adminTableAdd', ['alias'=>$alias])}}">
				<button class="btn btn-primary" type="button">
				@if($alias == 'tovars')
					Добавить товар
				@else
					Добавить пост
				@endif
				</button>
				</a>
			</div>
		<br>
	@endif

@endsection

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
                            <h4 class="card-title">{{$zagolovkiAndTovars[array_keys($zagolovkiAndTovars)[1]]}}
                        </div>

	
@if($massivLoadPicture)
	<div class="card-header">
	<h4 class="card-title">Загруженные картинки</h4>
	</div>
	
	<table class="table">
		<thead class="table-light">
		<tr>
		<th>Фото</th>
		<th>ДЕЙСТВИЕ</th>
		</tr>
		</thead>
		
@foreach ($massivLoadPicture as $key=>$value)
<tr>
<td>
	<br>
	<div>
		<img src="{{asset('assets/images/single-product/' . '/' . $zagolovkiAndTovars['id'] . '/' . $value)}}" alt="featured-img" />
    </div>
	<br>
</td>
<td>
<div class="d-flex">
	<a href="#"
	   class="btn btn-danger shadow btn-xs sharp"><i
			class="fa fa-trash"></i></a>
</div>
</td>
</tr>
@endforeach	

<tbody>
@endif




                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{route('adminTableUpdate', ['alias' => $alias])}}" enctype="multipart/form-data">
                                    @csrf
									
                                <table id="example3" class="table">
                                    <thead class="table-light">
                                    <tr>
                                        @for ($i = 0; $i < count(array_keys($zagolovkiAndTovars)); $i++)
                                            <th>{{array_keys($zagolovkiAndTovars)[$i]}}</th>
                                        @endfor
										@if (!in_array($alias, ['tovars', 'blogs']))
										<th>ДЕЙСТВИЕ</th>
										@endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $massivException = ['id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at', 'massivLoadPicture'];
                                    @endphp
                                        <tr>
                                            @foreach ($zagolovkiAndTovars as $key=>$value)
                                                <td>
                                                @if(in_array($key, $massivException))
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
								
@if (!in_array($alias, ['tovars', 'blogs']))
									<td>
										<div class="form-group row">
											<div class="col-lg-8 ml-auto" style="margin-left: 0px !important">
												<button type="submit" class="btn btn-primary">СОХРАНИТЬ</button>
											</div>
										</div>
									</td>
@endif								
											
                                </tr>
                                </tbody>
                                </table>
								
@if (in_array($alias, ['tovars', 'blogs']))
				<div class="input-group">
                    <label for="file">

                    </label>
                    <input type="file" id="file" name="file" multiple class="form-control"/>
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

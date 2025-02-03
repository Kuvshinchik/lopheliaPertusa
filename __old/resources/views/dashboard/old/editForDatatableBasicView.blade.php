{{dd(77777);}}

<div class="card-body">
    <div class="table-responsive">

        <table id="example3" class="table">
            <thead class="table-light">
                <tr>
                    @for ($i = 0; $i < count($zagolovkiAndTovars[1]); $i++)
                        <th>{{$zagolovkiAndTovars[1][$i]}}</th>
                    @endfor
                        <th>ДЕЙСТВИЕ</th>
                </tr>
            </thead>
            <tbody>


                @for ($i = 0; $i < count($zagolovkiAndTovars[0]); $i++)
                    <tr>

                @php
                $massivException = ['id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];
                @endphp

{{--

$zagolovkiAndTovars - массив из двух массивов, первый массив всех строк запрашиваемой таблицы
и БД, второй массив ключей (названия столбцов в БД и формируемой таблице) первого массива, нужен формирования заголовков <th>{{$zagolovkiAndTovars[1][$i]}}</th>
второй массив непосредственно содержит данные длч заполнения таблицы <td>{{$zagolovkiAndTovars[0][$i][$zagolovkiAndTovars[1][$k]]}}</td>
Массив $zagolovkiAndTovars передается контроллером AdminTableController.php в составе главного массива $this->viewBDtable(), в котором содержатся и другие данные

--}}
                    @for ($k = 0; $k < count($zagolovkiAndTovars[1]); $k++)

{{--
Формируем строки таблицы с данными из БД, которую запросил администратор
Выше создали массив($massivException )полей
--}}
if(str_contains($alias, 'Edit'){
	<td>{{$zagolovkiAndTovars[0][$zagolovkiAndTovars[1][$k]]}}</td>
}else{

<td>{{$zagolovkiAndTovars[0][$i][$zagolovkiAndTovars[1][$k]]}}</td>
}

                    @endfor
                        <td>
                            <div class="d-flex">
{{--
                                <a href="{{route('viewBDtable', ['alias'=>'editStroke', 'zagolovk'=>$breadcrumb[1], 'id'=>$zagolovkiAndTovars[0][$i]['id']])}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
--}}
								<a href="{{route('viewBDtableEdit', ['alias'=>$alias . 'Edit', 'id'=>$zagolovkiAndTovars[0][$i]['id']])}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('viewBDtable', ['alias'=>'deleteStroke', 'zagolovk'=>$breadcrumb[1], 'id'=>$zagolovkiAndTovars[0][$i]['id']])}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
               @endfor
            </tbody>
        </table>
    </div>
</div>

<div class="card-body">
    <div class="table-responsive">
        <form method="POST" action="{{route('viewBDtable', ['alias' => 'saveEditTableForDatatableBasic'])}}">
            @csrf
            <table id="example3" class="table">
                <thead class="table-light">
                <tr>

{{--

$zagolovkiAndTovars - массив из двух массивов, первый массив всех строк запрашиваемой таблицы
и БД, второй массив ключей (названия столбцов в БД и формируемой таблице) первого массива, нужен формирования заголовков <th>{{$zagolovkiAndTovars[1][$i]}}</th>
второй массив непосредственно содержит данные длч заполнения таблицы <td>{{$zagolovkiAndTovars[0][$i][$zagolovkiAndTovars[1][$k]]}}</td>
Массив $zagolovkiAndTovars передается контроллером AdminTableController.php в составе главного массива $this->viewBDtable(), в котором содержатся и другие данные

--}}
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
//dd($zagolovkiAndTovars);
$massivException = ['id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];
@endphp

           @for ($k = 0; $k < count($zagolovkiAndTovars[1]); $k++)
               <td>
{{--
Формируем строку для редактирования, которую запросил администратор
Выше создали массив($massivException )полей, которые не подлежат редактированию
Проверяем если название поля входит массив, то не делаем его input
@else формируем input
--}}
                   @if(in_array($zagolovkiAndTovars[1][$k], $massivException))
                   {{$zagolovkiAndTovars[0][$i][$zagolovkiAndTovars[1][$k]]}}
                    @else
                   <div class="form-group">
                       <input name="{{$zagolovkiAndTovars[1][$k]}}" type="text" class="form-control input-default " value="{{$zagolovkiAndTovars[0][$i][$zagolovkiAndTovars[1][$k]]}}">
                   </div>
                   @endif
               </td>
           @endfor
{{--
В странице редактирования символы редактирования и удаления заменяем кнопкой SUBMIT
--}}
                                                   <td>
                                                       <div class="form-group row">
                                                           <div class="col-lg-8 ml-auto" style="margin-left: 0px !important">
                                                               <button type="submit" class="btn btn-primary">СОХРАНИТЬ</button>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </tr>
                                               @endfor

                </tbody>
            </table>
        </form>
    </div>
</div>

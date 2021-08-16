@extends('layouts.app', ['activePage' => 'decision', 'titlePage' => ('القرارات')])

@section('content')
<div style="margin-top:70px; ">
      <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">{{ ('القرارات') }}</h4>
                            <p class="card-category"> {{ ('هنا يمكن إدارة القرارات') }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('decision.index') }}" class="btn btn-sm btn-info">
                                        <i class="material-icons">navigate_next</i>
                                        {{ ('الرجوع إلى القائمة') }}</a>
                                </div>
                            </div>
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->is_department_secretary())
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{ route('decision.create') }}" class="btn btn-sm btn-info">{{ ('إضافة قرار جديد') }}</a>
                                    </div>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-info">
                                    <th>
                                        {{ (' الموضوع') }}
                                    </th>

                                    <th>
                                        {{ ('تاريخ القرار') }}
                                    </th>
                                    <th>
                                        {{('الكلية')}}
                                    </th>



                                    <th>
                                        {{ __(' الأفعال') }}
                                    </th>
</thead>
                                    <tbody>
                                        
                                    @foreach($decisions as $decision)
                                    @if(auth()->user()->userable_type == "App\Models\CouncilSecretary" || auth()->user()->userable_type == "App\Models\CouncilPresedent" || $decision->department_id == $x  )
                                        <tr>
                                            <td>
                                                {{ $decision->subject }}
                                            </td>

                                            <td>
                                                {{ $decision->date }}
                                            </td>
                                            <td>
                                                {{ $decision->department->faculty->name}}
                                            </td>



                                            <td>


                                                @if(Auth::user()->is_council_member() ||Auth::user()->is_council_presedent() ||Auth::user()->is_secretary_council() ||Auth::user()->is_union_represintive() ||Auth::user()->is_scientific_council_member() || Auth::user()->userable_type == "App\Models\DepartmentSecretary" )
                                                    <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="التفاصيل" class="btn btn-info btn-link" href="{{ route('decision.show', $decision) }}" data-original-title="" title="">
                                                    <i class="material-icons">remove_red_eye</i>
                                                    <div class="ripple-container"></div>
                                                    </a>
                                                @endif

                                             @if(Auth::user()->is_department_secretary())



                                                    <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="تعديل" class="btn btn-success btn-link" href="{{ route('decision.edit', $decision) }}" data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                        <a
                                                                rel="tooltip"  data-placement="top" title="حذف"
                                                                class="btn btn-danger btn-link" data-original-title="" title=""
                                                                data-toggle="modal"  onclick="deleteData({{$decision->id}})" data-target="#deleteModal">
                                                            <i class="material-icons">delete</i>
                                                            <div class="ripple-container"></div>
                                                        </a>

                                                @endif
                                                @if(Auth::user()->is_secretary_council())
                                                 <a class="btn btn-success btn-link"
                                                   rel="tooltip" data-toggle="modal" data-placement="top" title="إضافة هذا القرار إلى الجلسة القادمة "
                                                          onclick="addDecision({{$decision->id}})" data-target="#addModal" >
                                                        <i class="material-icons">add</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endif
                                            </td>

                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" id="addForm" method="post">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        هل تريد إضافة هذا القرار إلى الجلسة القادمة؟
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i> إلغاء</button>
                        <button type="button"  onclick="addFormSubmit()" class="btn btn-info"><i class="material-icons">done_outline</i> تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" id="deleteForm" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        هل أنت متأكد من انك تريد حذف هذا القرار ؟
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i> إغلاق</button>
                        <button type="button"  onclick="formSubmit()" class="btn btn-danger"><i class="material-icons">delete</i> حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("decision.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
<script type="text/javascript">
        function addDecision(id)
        {
            var id = id;
            var url = '{{ route("decision.add", ":id") }}';
            url = url.replace(':id', id);
            $("#addForm").attr('action', url);
        }

        function addFormSubmit()
        {
            $("#addForm").submit();
        }
    </script>
@endsection

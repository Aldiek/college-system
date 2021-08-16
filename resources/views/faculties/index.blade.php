@extends('layouts.app', ['activePage' => 'faculties', 'titlePage' => __('الكليات')])

@section('content')
<div style="margin-top:70px; ">
    <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">{{ __('الكليات') }}</h4>
                            <p class="card-category"> {{ __('هنا يمكنك إدارة الكليات ') }}</p>
                        </div>
                        <div class="card-body">
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
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{ route('faculties.create') }}" class="btn btn-sm btn-info">{{ __('إضافة كلية جديدة') }}</a>
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <table class="table">
                                  <th>
                                      {{ __('اسم الكلية') }}
                                  </th>


                                  <th>
                                        {{ __('') }}
                                  </th>
                                    <tbody>
                                    @foreach($faculties as $faculty)
                                        <tr>
                                            <td>
                                                {{ $faculty->name }}
                                            </td>

                                            <td>

                                                <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="استعراض الأقسام" class="btn btn-info btn-link" href="{{ route('departments.index2',$faculty ) }}" data-original-title="" title="">
                                                    <i class="material-icons">remove_red_eye</i>
                                                    <div class="ripple-container"></div>
                                                </a>


                                                        <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="تعديل" class="btn btn-success btn-link" href="{{ route('faculties.edit', $faculty) }}" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>

                                                <a
                                                        rel="tooltip"  data-placement="top" title="حذف"
                                                        class="btn btn-danger btn-link" data-original-title="" title=""
                                                        data-toggle="modal"  onclick="deleteData({{$faculty->id}})" data-target="#deleteModal">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                            </td>

                                        </tr>
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
                        هل أنت متأكد من انك تريد حذف هذه الكلية ؟
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
            var url = '{{ route("faculties.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>

@endsection

@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('إدارة المستخدمين ')])

@section('content')
<div style="margin-top:70px; ">
      <div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">{{ __('المستخدمون') }}</h4>
              <p class="card-category"> {{ __(' هنا يمكنك إدارة المستخدمين' ) }}</p>
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
                  <a href="{{ route('user.create') }}" class="btn btn-sm btn-info">
                    <i class="material-icons">person_add</i>
                    {{ __(' إضافة مستخدم جديد') }}</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-info">
                  <th>
                    {{ __('الإسم') }}
                  </th>
                  <th>
                    {{ __('البريد الإلكتروني') }}
                  </th>
                  <th>
                    {{__('نوع المستخدم')}}
                  </th>
                  <th>
                    {{ __('تاريخ الإنشاء ') }}
                  </th>
                  <th class="text-right">
                    {{ __('حذف') }}
                  </th>
                  </thead>
                  <tbody>

                  @foreach($users as $user)
                    <tr>
                      <td>
                        {{ $user->first_name }}-  {{ $user->last_name }}
                      </td>
                      <td>
                        {{ $user->email }}
                      </td>
                      <td>
                        @switch($user->userable_type)
                          @case('App\Models\CouncilPresedent')
                          رئيس مجلس   {{ $user->faculty }}
                          @break
                          @case('App\Models\CouncilMember')
                          عضو مجلس {{ $user->faculty }}
                          @break
                          @case('App\Models\CouncilSecretary')
                          أمين سر مجلس {{ $user->faculty }}
                          @break
                          @case('App\Models\DepartmentSecretary')
                           رئيس قسم  {{ $user->faculty }} {{ $user->department }}
                          @break

                        @endswitch
                      </td>
                      <td>
                        {{ $user->created_at->format('Y-m-d') }}
                      </td>
                      <td class="td-actions text-right">
                        @if ($user->id != auth()->id())



                          <a
                                  rel="tooltip"  data-placement="top" title="حذف"
                                  class="btn btn-danger btn-link" data-original-title="" title=""
                                  data-toggle="modal"  onclick="deleteData({{$user->id}})" data-target="#deleteModal">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                          </a>


                        @endif
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  {{ $users->links() }}  {{--تتكفّل الدالة links بإنشاء الصفحات عبر تقسيم المستخدمين على مجموعة--}}
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
          {{ csrf_field() }}   {{--يُولّد Laravel تلقائيًّا "رمز" CSRF لكل جلسة مستخدم نشطة يديرها التطبيق. يُستخدم هذا الرمز (token) للتحقّق من كون المستخدم المصادق عليه نفس الشخص الذي يقدّم الطلبات للتطبيق.--}}
          {{ method_field('DELETE') }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            هل أنت متأكد من انك تريد حذف هذا المستخدم ؟
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
          var url = '{{ route("user.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function formSubmit()
      {
          $("#deleteForm").submit();
      }
  </script>
@endsection

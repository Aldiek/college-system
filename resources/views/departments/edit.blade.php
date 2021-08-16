@extends('layouts.app', ['activePage' => 'faculties', 'titlePage' => __('الكليات')])

@section('content')
<div style="margin-top:70px; ">
        <div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('departments.update', $department) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('تعديل الكلية') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>
                  </div>
                </div>



                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __(' اسم القسم ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __(' اسم القسم') }}" value="{{$department->name}}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <input type="text" name="faculty_id" hidden value="{{$department->faculty_id}}">


              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-info">{{ __('حفظ التعديل') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app', ['activePage' => 'advertisement', 'titlePage' => __('الإعلانات')])

@section('content')
<div style="margin-top:70px; ">
      <div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('advertisement.update', $advertisement) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('تعديل الإعلان') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>
                  </div>
                </div>



                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __(' نص الإعلان ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" id="input-content" type="text" placeholder="{{ __(' نص الإعلان') }}" value="{{$advertisement->content}}" required="true" aria-required="true"/>
                      @if ($errors->has('summary'))
                        <span id="content-error" class="error text-danger" for="input-content">{{ $errors->first('content') }}</span>
                      @endif
                    </div>
                  </div>
                </div>


                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-expiration_date">{{ __(' تاريخ نهاية عرضه ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('expiration_date') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('expiration_date') ? ' is-invalid' : '' }}" input type="date" name="expiration_date" id="input-expiration_date" value="{{$advertisement->expiration_date}}" required />
                      @if ($errors->has('date'))
                        <span id="expiration_date-error" class="error text-danger" for="expiration_date">{{ $errors->first('expiration_date') }}</span>
                      @endif
                    </div>
                  </div>
                </div>


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

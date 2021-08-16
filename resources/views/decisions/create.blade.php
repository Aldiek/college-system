@extends('layouts.app', ['activePage' => 'decision', 'titlePage' => __(' القرارات')])

@section('content')
  <style>
    input[type="file"] {
      display: block;
    }
    .imageThumb {
      max-height: 75px;
      border-radius: 10px;
      padding: 1px;
      cursor: pointer;
    }
    .pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }
    .remove {
      margin-top: 10px;
      display: block;
      background: white;
      border-radius: 30px;
      border: 1px solid #ff5e52;
      color: #ff1a17;
      text-align: center;
      cursor: pointer;
    }
    .remove:hover {
      background: #ff1a17;
      color: white;
    }

    .imgPreview img {
      padding: 8px;
      max-width: 100px;
    }
  </style>

  <div style="margin-top:70px; ">
        <div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('decision.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('إضافة قرار جديد') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">

                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('الرجوع إلى القائمة') }}</a>

                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('الموضوع') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('summary') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" name="subject" id="input-summary" type="text" placeholder="{{ __('الموضوع') }}" value="{{ old('summary') }}" required="true" aria-required="true"/>
                      @if ($errors->has('summary'))
                        <span id="summary-error" class="error text-danger" for="input-summary">{{ $errors->first('subject') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('المستندات') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                      <textarea class="form-control  {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" id="input-content"  placeholder="{{ __(' المستندات') }}"  >{{old('content') }}</textarea>
                      @if ($errors->has('content'))
                        <span id="content-error" class="error text-danger" for="input-content">{{ $errors->first('content') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('وبعد الاطلاع على') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                      <textarea class="form-control  {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content1" id="input-content"  placeholder="{{ __('وبعد الاطلاع على') }}"  >{{old('content') }}</textarea>
                      @if ($errors->has('content'))
                        <span id="content-error" class="error text-danger" for="input-content">{{ $errors->first('content1') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('قرر المجلس مايلي') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                      <textarea class="form-control  {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content2" id="input-content"  placeholder="{{ __('قرر المجلس مايلي') }}"  >{{old('content') }}</textarea>
                      @if ($errors->has('content'))
                        <span id="content-error" class="error text-danger" for="input-content">{{ $errors->first('content2') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-date">{{ __(' تاريخ القرار ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" input type="date" name="date" id="input-date" placeholder="{{ __(' تاريخ القرار') }}" value="" required />
                      @if ($errors->has('date'))
                        <span id="date-error" class="error text-danger" for="date-name">{{ $errors->first('date') }}</span>
                      @endif
                    </div>
                  </div>
                </div>


               
                </div>
                  </div>


                </div>
              </div>



              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-info">{{ __('حفظ') }}</button>
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script type="text/javascript">
      tinymce.init({
          selector: 'textarea.tinymce-editor',
          height: 500,
          menubar: false,
          plugins: [
              'advlist autolink lists link image charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table paste code help wordcount'
          ],
          toolbar: 'undo redo | formatselect | ' +
              'bold italic backcolor | alignleft aligncenter ' +
              'alignright alignjustify | bullist numlist outdent indent | ' +
              'removeformat | help',
          content_css: '//www.tiny.cloud/css/codepen.min.css'
      });
  </script>
@endsection

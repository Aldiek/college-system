@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('الرئيسية')])

@section('content')
<div style="margin-top:70px; ">
      <div style="margin: 20px" >
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">{{ __('الإعلانات') }}</h4>
              <p class="card-category"> {{ __('آحدث الإعلانات   ') }}</p>
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

              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-info">
                  <th>

                  </thead>
                  <tbody>
                  @foreach($advertisements as $advertisement)
                    <tr>
                      <td>
                        {{ $advertisement->content }}
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
@endsection

@push('js')
  <script>
      $(document).ready(function() {
          // Javascript method's body can be found in assets/js/demos.js
          md.initDashboardPageCharts();
      });
  </script>
@endpush

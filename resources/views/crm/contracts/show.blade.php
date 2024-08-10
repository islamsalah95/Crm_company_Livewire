@extends('layouts.crm')
@section('title')
Show Contracts Employ
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Users/Employ')}}/</span>{{ translate('Show Contracts Employ')}}</h4>
<x-alert />
@foreach($userContracts as $userContract)
    
    <div class="card" style="margin-bottom: 30px;">
        <div class="card-body">
            <div class="row">
               
                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label for="start_date" class="col-form-label">Start Date</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" id="start_date" placeholder="YYYY-MM-DD" value="{{$userContract->start_date}}" disabled>
                    </div>
                </div>
    
                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label for="end_date" class="col-form-label">End Date</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" id="end_date" placeholder="YYYY-MM-DD" value="{{$userContract->end_date}}" disabled>
                    </div>
                </div>


                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="EstLaborOfficeId"> رقم التعريف الخاص بوزارة العمل</label>
                    <div class="col-md-10">
                      <input class="form-control" type="number" form="EstLaborOfficeId"  id="EstLaborOfficeId" value="{{$userContract->EstLaborOfficeId}}" disabled>
                    </div>
                  </div>



                  <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="EstSequenceNumber"> الرقم التلسلي في وزارة العمل</label>
                    <div class="col-md-10">
                      <input class="form-control" type="number" form="EstSequenceNumber"  id="EstSequenceNumber" value="{{$userContract->EstSequenceNumber}}" disabled>
                    </div>
                  </div>



                  <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="hourly_rate">  السعر بالساعة : (على الأقل 25 ساعة) </label>
                    <div class="col-md-10">
                      <input class="form-control" type="number" form="hourly_rate"  id="hourly_rate" value="{{$userContract->hourly_rate}}" disabled>
                    </div>
                  </div>


                  <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="working_hours_per_day">  ساعات العمل في اليوم: (لا تتجاوز 12 ساعة في اليوم) </label>
                    <div class="col-md-10">
                      <input class="form-control" type="number" form="working_hours_per_day"  id="working_hours_per_day" value="{{$userContract->working_hours_per_day}}" disabled>
                    </div>
                  </div>


                  <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="working_hours_per_week">  ساعات العمل في الأسبوع: (لا تتجاوز 24 ساعة أسبوعًا) </label>
                    <div class="col-md-10">
                      <input class="form-control" type="number" form="working_hours_per_week"  id="working_hours_per_week" value="{{$userContract->working_hours_per_week}}" disabled>
                    </div>
                  </div>


                  <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="working_hours">  إجمالي ساعات العمل: (لا تتجاوز 95 ساعة شهريا) </label>
                    <div class="col-md-10">
                      <input class="form-control" type="number" form="working_hours"  id="working_hours" value="{{$userContract->working_hours}}" disabled>
                    </div>
                  </div>




                  <div class="mb-3 col-md-6 fv-plugins-icon-container">
                    <label class="form-label" for="is_molTWC">  هل يتبع لخدمة العمل عن بعد</label>
                    <div class="position-relative" data-select2-id="49">
                    <select id="is_molTWC" value="{{$userContract->is_molTWC}}" class="select2 form-select select2-hidden-accessible" data-select2-id="is_molTWC" tabindex="-1" aria-hidden="true" disabled>
                        <option value="{{$userContract->0">no</option>
                        <option value="{{$userContract->1">yes</option>
                    </select>
                   </div>

                  </div>
    
            </div>
        </div>
    </div>
    
@endforeach

    @endsection




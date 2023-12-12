<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' :'ltr' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

<h1 style="text-transform: uppercase;text-align: center;background: #c9cbce;font-size: 16px">@lang('audit.Building or Business Name') {{$application->building_or_business_name}}</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">@lang('audit.Street Address'): </span>{{$application->street_address}}
</h1>

<hr>
<p style="text-align: center;font-size: 14px">@lang('audit.after_complete'):</p>
<h1 style="text-align: center;font-size: 18px">{{$compliance_score > 50 ? __('audit.PASSED') : __('audit.NEED AUDIT')}}</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">@lang('audit.AUDIT SCORE') </span>  <span style="font-weight: normal">@lang('audit.out of 100'): {{number_format($compliance_score,2)}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">@lang('audit.DATE OF AWARD'): </span><span style="font-weight: normal">{{$application->created_at}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">@lang('audit.BUILDING TYPE'): </span><span style="font-weight: normal">{{$application->buildingType->name_en}}</span>
</h1>

<hr>

<h1 style="text-align: center;font-size: 14px">
    <span>@lang('audit.Full Name'): </span><span style="font-weight: normal">{{$application->full_name}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span>@lang('audit.Email'): </span><span style="font-weight: normal">{{$application->email}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span>@lang('audit.Deed Number'): </span><span style="font-weight: normal">{{$application->deed_number}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span>@lang('audit.Plot Number'): </span><span style="font-weight: normal">{{$application->plot_number}}</span>
</h1>
<hr>
<p style="text-align: center;font-size: 12px;position: absolute;bottom: 5px">@lang('audit.quote')</p>
<div class="page-break"></div>


<h1 style="font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
    <span style="margin-left: 5px">@lang('audit.Building Type Selection') </span>
</h1>
<h1 style="font-size: 13px;background: #c2d6b6;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px">@lang('audit.Compliance Score') </span>
    <span>{{number_format($compliance_score,2)}}</span>
</h1>
<h1 style="font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">@lang('audit.Selected building type') </span><br>
    <span style="display: block;font-weight: normal">{{$application->buildingType->name_en}}</span>
</h1>


<h1 style="font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
    <span style="margin-left: 5px">@lang('audit.Applicant Information') </span>
</h1>
<h1 style="font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">@lang('audit.Full Name') </span><br>
    <span style="display: block;font-weight: normal">{{$application->full_name}}</span>
</h1>
<h1 style="font-size: 13px;background: #c2d6b6;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px">@lang('audit.Email') </span><br>
    <span style=" font-weight: normal">{{$application->email}}</span>
</h1>

<h1 style="font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
    <span style="margin-left: 5px">@lang('audit.Enter Building Information') </span>
</h1>
<h1 style="font-size: 13px;background: #c2d6b6;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px">@lang('audit.Address') </span><br>
    <span style="font-weight: normal">{{$application->city}}</span><br>
    <span style="font-weight: normal">{{$application->building_or_business_name}}</span><br>
    <span style="font-weight: normal">{{$application->street_address}}</span><br>
    <span style="font-weight: normal">{{$application->country->name_en}}</span><br>
</h1>
<h1 style="font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">@lang('audit.Deed Number') </span><br>
    <span style="display: block;font-weight: normal">{{$application->deed_number}}</span>
</h1>
<h1 style="font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">@lang('audit.Plot Number') </span><br>
    <span style="display: block;font-weight: normal">{{$application->plot_number}}</span>
</h1>

@foreach($application->buildingType->questions as $question)
    @if($question->question && $question->question->type == 'title')
        <h1 style="font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
            @if(app()->getLocale() == 'ar')
                <span style="margin-left: 5px">{{$question->question->question_name_ar}} </span>
            @else
                <span style="margin-left: 5px">{{$question->question->question_name_en}} </span>
            @endif
        </h1>
    @endif
    @if($question->question && $question->question->type == 'question' && in_array($question->question->id,$application->answers->pluck('question_id')->toArray()))
        <h1 style="font-size: 12px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
            @if(app()->getLocale() == 'ar')
                <span style="margin-left: 5px;">{{$question->question->question_name_ar}} </span><br>
                <span style="display: block;font-weight: normal">{{$application->answers->where('question_id',$question->question->id)->first()->answer_ar}}</span>
            @else
                <span style="margin-left: 5px;">{{$question->question->question_name_en}} </span><br>
                <span style="display: block;font-weight: normal">{{$application->answers->where('question_id',$question->question->id)->first()->answer}}</span>
            @endif
        </h1>
    @endif

@endforeach
</body>
{{--@dd(1)--}}
</html>

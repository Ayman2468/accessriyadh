<!DOCTYPE html>
<html lang="en">
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

<h1 style="text-transform: uppercase;text-align: center;background: #c9cbce;font-size: 16px">Business name {{$application->building_or_business_name}}</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">STREET ADDRESS: </span>{{$application->street_address}}
</h1>

<hr>

<p style="text-align: center;font-size: 14px">After Successful completion of a building audit, the above building has:</p>
<h1 style="text-align: center;font-size: 18px">{{$application->compliance_score > 50 ? 'PASSED' : 'NEED AUDIT'}}</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">AUDIT SCORE </span>  <span style="font-weight: normal">(out of 100): {{number_format($application->compliance_score,2)}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">DATE OF AWARD: </span><span style="font-weight: normal">{{$application->created_at}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span style="text-transform: uppercase;">BUILDING TYPE: </span><span style="font-weight: normal">{{$application->buildingType->name_en}}</span>
</h1>

<hr>

<h1 style="text-align: center;font-size: 14px">
    <span>Applicant Name: </span><span style="font-weight: normal">{{$application->full_name}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span>Applicant Email: </span><span style="font-weight: normal">{{$application->email}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span>Deed Number: </span><span style="font-weight: normal">{{$application->deed_number}}</span>
</h1>
<h1 style="text-align: center;font-size: 14px">
    <span>Plot Number: </span><span style="font-weight: normal">{{$application->plot_number}}</span>
</h1>
<hr>
<p style="text-align: center;font-size: 12px;position: absolute;bottom: 5px">
    The award has been granted based on the completion of an audit by the applicant. All information provided has been accurate to the knowledge of the applicant. The Royal
    Commission for Riyadh City reserves the right to make routine inspections of the premises to inspect the results of the survey and enforce any changes that were required
    as part of the audit.

</p>
<div class="page-break"></div>


<h1 style="text-align: left;font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
    <span style="margin-left: 5px">Building Type Selection </span>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #c2d6b6;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px">Compliance Score </span>
    <span>{{number_format($application->compliance_score,2)}}</span>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">Selected building type </span><br>
    <span style="display: block;font-weight: normal">{{$application->buildingType->name_en}}</span>
</h1>


<h1 style="text-align: left;font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
    <span style="margin-left: 5px">Applicant Information </span>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">Name </span><br>
    <span style="display: block;font-weight: normal">{{$application->full_name}}</span>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #c2d6b6;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px">Email </span><br>
    <span style=" font-weight: normal">{{$application->email}}</span>
</h1>

<h1 style="text-align: left;font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
    <span style="margin-left: 5px">Enter Building Information </span>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #c2d6b6;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px">Address </span><br>
    <span style="font-weight: normal">{{$application->city}}</span><br>
    <span style="font-weight: normal">{{$application->building_or_business_name}}</span><br>
    <span style="font-weight: normal">{{$application->street_address}}</span><br>
    <span style="font-weight: normal">{{$application->country->name_en}}</span><br>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">Deed Number </span><br>
    <span style="display: block;font-weight: normal">{{$application->deed_number}}</span>
</h1>
<h1 style="text-align: left;font-size: 13px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-top: 0">
    <span style="margin-left: 5px;display: block;width: 100%">Plot Number </span><br>
    <span style="display: block;font-weight: normal">{{$application->plot_number}}</span>
</h1>

@foreach($application->buildingType->questions as $question)
    @if($question->question && $question->question->type == 'title')
        <h1 style="text-align: left;font-size: 14px;background: #c9cbce;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
            <span style="margin-left: 5px">{{$question->question->question_name_en}} </span>
        </h1>
    @endif
    @if($question->question && $question->question->type == 'question' && in_array($question->question->id,$application->answers->pluck('question_id')->toArray()))
        <h1 style="text-align: left;font-size: 12px;background: #ffffff;margin-left: 5px;padding-left: 10px;margin-bottom: 0">
            <span style="margin-left: 5px;">{{$question->question->question_name_en}} </span><br>
            <span style="display: block;font-weight: normal">{{$application->answers->where('question_id',$question->question->id)->first()->answer}}</span>
        </h1>
    @endif

@endforeach
</body>
{{--@dd(1)--}}
</html>

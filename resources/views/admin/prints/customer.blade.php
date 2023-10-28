<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>
        {{env('APP_NAME',"Anti-smoking")}}
        -
        طباعة
    </title>
</head>
<style>
    @media print {
        @page {
            size: A4;
            /* You can also specify orientation if needed */
            /* orientation: landscape; */
        }

        /* Additional styles for the printed page */
        body {
            margin: 20mm; /* Add margins to the content to ensure it fits within the printable area */
        }
    }
</style>
<style>
    table {
        border-collapse: collapse;
    }

    table tr td {
        border-collapse: collapse;
        border: 1px solid black;
    }
</style>
<body
    style="margin: auto; font-family: 'Cairo', Georgia, 'Times New Roman', Times, serif !important;font-weight: 400;color: #1D2939;padding: 20px;    text-align: right;direction: rtl;;font-size: 14px">
<div>
    <table style="width: 100%">
        <tbody>
        <tr>
            <td style="width: 30%;border: none">
                <div>هوية المستفيد</div>
                <div>{{ $customer->identity }}</div>
            </td>
            <td style="width: 40%;text-align: center;font-weight: bold;font-size: 18px;border: none">تقرير زيارات
                المستفيد
            </td>
            <td style="width: 30%;text-align: left;border: none">
                <div>تاريخ التقرير</div>
                <div>{{\Carbon\Carbon::now()}}</div>
            </td>
        </tr>
        </tbody>
    </table>
    <hr style="width: 100%">
    <table class="" style="width: 100%;margin-top: 50px">
        <tbody>
        <tr>
            <td colspan="6" style="font-weight: bold;font-size: 18px;background: #e3dfdf">البيانات الاولية</td>
        </tr>
        <tr>
            <td style="font-weight: bold">الاسم بالكامل</td>
            <td>{{ $customer->full_name }}</td>
            <td style="font-weight: bold">رقم الهوية</td>
            <td>{{ $customer->identity }}</td>
            <td style="font-weight: bold">العمر</td>
            <td>{{ $customer->age }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">الحالة الاجتماعية</td>
            <td>{{ $customer->maritalState ? $customer->maritalState->item_name : '--' }}</td>
            <td style="font-weight: bold">فترة التدخين</td>
            <td>{{ $customer->smokingDuration ? $customer->smokingDuration->item_name : '--' }}</td>
            <td style="font-weight: bold">اسباب التدخين</td>
            <td>{{ $customer->smokingReason ? $customer->smokingReason->item_name : $customer->smoking_reason_text }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold">المؤهل العلمي</td>
            <td>{{ $customer->qualification ? $customer->qualification->item_name : '--' }}</td>
            <td style="font-weight: bold">الحالة الوظيفية</td>
            <td>{{ $customer->employmentStatus ? $customer->employmentStatus->item_name : '--' }}</td>
            <td style="font-weight: bold">عدد الزيارات</td>
            <td>{{ $customer->visits_count }}</td>
        </tr>
        </tbody>
    </table>
    @if(count($customer->visits) > 0)
        <table class="" style="width: 100%;margin-top: 30px">
            <tbody>
            <tr>
                <td colspan="4" style="font-weight: bold;font-size: 18px;background: #e3dfdf">الزيارات</td>
            </tr>

            @foreach($customer->visits ?? [] as $visit)
                <tr>
                    <td colspan="4" style="font-weight: bold;font-size: 18px;background: #ece9e9">
                        الزيارة رقم:
                        {{$visit->visit_number}}
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold">تاريخ الزيارة</td>
                    <td>{{$visit->created_at}}</td>
                    <td style="font-weight: bold">الاستقبال</td>
                    <td>{{ $visit->reception ? $visit->reception_measure_text : '--' }}</td>
                </tr>
                @if($visit->doctor)
                    <tr style="background: #eeeeee">
                        <td colspan="4" style="text-align: center">الطبيب
                            العام: {{ $visit->doctor ? $visit->doctor->name : '--' }} </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">مقياس التعافي</td>
                        <td>{{ $visit->doctor ? $visit->doctor_measure_text : '--' }}</td>
                        <td style="font-weight: bold">التشخيص</td>
                        <td>{{$visit->doctor_diagnosis}}</td>
                    </tr>
                    @php $hasPrescriptions = false; @endphp
                    @foreach($visit->prescriptions as $prescription)
                        @if($prescription['doctor_prescription'])
                            @php $hasPrescriptions = true; @endphp
                            <tr>
                                <td style="font-weight: bold">الوصفة</td>
                                <td>{{ $prescription['doctor_prescription'] }}</td>
                                <td style="font-weight: bold">حالة التسليم</td>
                                <td>
                                    {{$prescription->status_text}}
                                    @if($prescription->status == 2)
                                        <br>
                                        <b>سبب الرفض:</b>
                                        @if($prescription->rejectReason)
                                            {{ $prescription->rejectReason->item_name }}
                                        @else
                                            {{$prescription->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$hasPrescriptions)
                        <tr>
                            <td style="font-weight: bold">الوصفة</td>
                            <td>--</td>
                            <td style="font-weight: bold">حالة التسليم</td>
                            <td>--</td>
                        </tr>
                    @endif
                    @foreach($visit->transfers as $transfer)
                        @if($transfer->fromUser->user_type == 'doctor' && $transfer->from_user_id == $visit['doctor_id'])
                            <tr>
                                <td style="font-weight: bold">محول الى</td>
                                <td>{{ $transfer->toUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @if($transfer->toUser->user_type == 'doctor' && $transfer->to_user_id == $visit['doctor_id'])
                            <tr>
                                <td style="font-weight: bold">محول من</td>
                                <td>{{ $transfer->fromUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                @if($visit->psychologist)
                    <tr style="background: #eeeeee">
                        <td colspan="4" style="text-align: center">الطبيب
                            النفسي: {{ $visit->psychologist ? $visit->psychologist->name : '--' }} </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">مقياس التعافي</td>
                        <td>{{ $visit->psychologist ? $visit->psychologist_measure_text : '--' }}</td>
                        <td style="font-weight: bold">التشخيص</td>
                        <td>{{$visit->psychologist_diagnosis}}</td>
                    </tr>
                    @php $hasPrescriptions = false; @endphp
                    @foreach($visit->prescriptions as $prescription)
                        @if($prescription['psychologist_prescription'])
                            @php $hasPrescriptions = true; @endphp
                            <tr>
                                <td style="font-weight: bold">الوصفة</td>
                                <td>{{ $prescription['psychologist_prescription'] }}</td>
                                <td style="font-weight: bold">حالة التسليم</td>
                                <td>
                                    {{$prescription->status_text}}
                                    @if($prescription->status == 2)
                                        <br>
                                        <b>سبب الرفض:</b>
                                        @if($prescription->rejectReason)
                                            {{ $prescription->rejectReason->item_name }}
                                        @else
                                            {{$prescription->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$hasPrescriptions)
                        <tr>
                            <td style="font-weight: bold">الوصفة</td>
                            <td>--</td>
                            <td style="font-weight: bold">حالة التسليم</td>
                            <td>--</td>
                        </tr>
                    @endif
                    @foreach($visit->transfers as $transfer)
                        @if($transfer->fromUser->user_type == 'psychologist' && $transfer->from_user_id == $visit['psychologist_id'])
                            <tr>
                                <td style="font-weight: bold">محول الى</td>
                                <td>{{ $transfer->toUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @if($transfer->toUser->user_type == 'psychologist' && $transfer->to_user_id == $visit['psychologist_id'])
                            <tr>
                                <td style="font-weight: bold">محول من</td>
                                <td>{{ $transfer->fromUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach

                @endif
                @if($visit->family)
                    <tr style="background: #eeeeee">
                        <td colspan="4" style="text-align: center">الارشاد الاسري :
                            {{ $visit->family ? $visit->family->name : '--' }} </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">مقياس التعافي</td>
                        <td>{{ $visit->family ? $visit->family_measure_text : '--' }}</td>
                        <td style="font-weight: bold">التشخيص</td>
                        <td>{{$visit->family_diagnosis}}</td>
                    </tr>
                    @php $hasPrescriptions = false; @endphp
                    @foreach($visit->prescriptions as $prescription)
                        @if($prescription['family_prescription'])
                            @php $hasPrescriptions = true; @endphp
                            <tr>
                                <td style="font-weight: bold">الوصفة</td>
                                <td>{{ $prescription['family_prescription'] }}</td>
                                <td style="font-weight: bold">حالة التسليم</td>
                                <td>
                                    {{$prescription->status_text}}
                                    @if($prescription->status == 2)
                                        <br>
                                        <b>سبب الرفض:</b>
                                        @if($prescription->rejectReason)
                                            {{ $prescription->rejectReason->item_name }}
                                        @else
                                            {{$prescription->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$hasPrescriptions)
                        <tr>
                            <td style="font-weight: bold">الوصفة</td>
                            <td>--</td>
                            <td style="font-weight: bold">حالة التسليم</td>
                            <td>--</td>
                        </tr>
                    @endif
                    @foreach($visit->transfers as $transfer)
                        @if($transfer->fromUser->user_type == 'family' && $transfer->from_user_id == $visit['family_id'])
                            <tr>
                                <td style="font-weight: bold">محول الى</td>
                                <td>{{ $transfer->toUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @if($transfer->toUser->user_type == 'family' && $transfer->to_user_id == $visit['family_id'])
                            <tr>
                                <td style="font-weight: bold">محول من</td>
                                <td>{{ $transfer->fromUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach

                @endif
                @if($visit->religious)
                    <tr style="background: #eeeeee">
                        <td colspan="4" style="text-align: center">الارشاد الديني :
                            {{ $visit->religious ? $visit->religious->name : '--' }} </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">مقياس التعافي</td>
                        <td>{{ $visit->religious ? $visit->religious_measure_text : '--' }}</td>
                        <td style="font-weight: bold">التشخيص</td>
                        <td>{{$visit->religious_diagnosis}}</td>
                    </tr>
                    @php $hasPrescriptions = false; @endphp
                    @foreach($visit->prescriptions as $prescription)
                        @if($prescription['religious_prescription'])
                            @php $hasPrescriptions = true; @endphp
                            <tr>
                                <td style="font-weight: bold">الوصفة</td>
                                <td>{{ $prescription['religious_prescription'] }}</td>
                                <td style="font-weight: bold">حالة التسليم</td>
                                <td>
                                    {{$prescription->status_text}}
                                    @if($prescription->status == 2)
                                        <br>
                                        <b>سبب الرفض:</b>
                                        @if($prescription->rejectReason)
                                            {{ $prescription->rejectReason->item_name }}
                                        @else
                                            {{$prescription->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$hasPrescriptions)
                        <tr>
                            <td style="font-weight: bold">الوصفة</td>
                            <td>--</td>
                            <td style="font-weight: bold">حالة التسليم</td>
                            <td>--</td>
                        </tr>
                    @endif
                    @foreach($visit->transfers as $transfer)
                        @if($transfer->fromUser->user_type == 'religious' && $transfer->from_user_id == $visit['religious_id'])
                            <tr>
                                <td style="font-weight: bold">محول الى</td>
                                <td>{{ $transfer->toUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @if($transfer->toUser->user_type == 'religious' && $transfer->to_user_id == $visit['religious_id'])
                            <tr>
                                <td style="font-weight: bold">محول من</td>
                                <td>{{ $transfer->fromUser->name ?? '' }}</td>
                                <td style="font-weight: bold">حالة التحويل</td>
                                <td>
                                    {{$transfer->status_text}}
                                    @if($transfer->status == 2)
                                        <br>
                                        <b>سبب رفض التحويل:</b>
                                        @if($transfer->rejectReason)
                                            {{ $transfer->rejectReason->item_name }}
                                        @else
                                            {{$transfer->reject_reason_text}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach

                @endif

                @if($visit->visit_number == 10)
                    <tr>
                        <td colspan="4" style="border: 0">
                            <table class="" style="width: 100%;margin-top: 20px;margin-bottom: 20px">
                                <tbody>
                                <tr>
                                    <td style="background: #dadada" colspan="2">المرحلة الاولى</td>
                                </tr>
                                <tr style="background: #eae8e8">
                                    <td>1-1</td>
                                    <td>2-1</td>

                                </tr>
                                <tr>
                                    <td style="width: 16.5%">
                                        @if($customer->first_phase_result['first'])
                                            {{$customer->first_phase_result['first']}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td style="width: 16.5%">
                                        @if($customer->first_phase_result['second'])
                                            {{$customer->first_phase_result['second']}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
                @if($visit->visit_number == 20)
                    <tr>
                        <td colspan="4" style="border: 0">
                            <table class="" style="width: 100%;margin-top: 20px;margin-bottom: 20px">
                                <tbody>
                                <tr>
                                    <td style="background: #dadada" colspan="2">المرحلة الثانية</td>
                                </tr>
                                <tr style="background: #eae8e8">
                                    <td>1-2</td>
                                    <td>2-2</td>
                                </tr>
                                <tr>

                                    <td style="width: 16.5%">
                                        @if($customer->second_phase_result['first'])
                                            {{$customer->second_phase_result['first']}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td style="width: 16.5%">
                                        @if($customer->second_phase_result['second'])
                                            {{$customer->second_phase_result['second']}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif

                @if($visit->visit_number == 30)
                    <tr>
                        <td colspan="4" style="border: 0">
                            <table class="" style="width: 100%;margin-top: 20px;margin-bottom: 20px">
                                <tbody>
                                <tr>
                                    <td style="background: #dadada" colspan="2">المرحلة الثالثة</td>
                                </tr>
                                <tr style="background: #eae8e8">
                                    <td>1-3</td>
                                    <td>2-3</td>
                                </tr>
                                <tr>
                                    <td style="width: 16.5%">
                                        @if($customer->third_phase_result['first'])
                                            {{$customer->third_phase_result['first']}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td style="width: 16.5%">
                                        @if($customer->third_phase_result['second'])
                                            {{$customer->third_phase_result['second']}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif

</div>
</body>
<script>
    window.print();
</script>
</html>

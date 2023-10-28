<html>
<head>
    <title></title>
</head>
<body>
<object data="/storage/{{$saveFileName}}" type="application/pdf" width="100%" height="678px">
    <p>Unable to display PDF file. <a href="{{\Illuminate\Support\Facades\Storage::url($saveFileName)}}">Download</a> instead.</p>
</object>
{{--<div class='embed-responsive' style='padding-bottom:90%'>--}}

{{--<embed src="{{\Illuminate\Support\Facades\Storage::url($saveFileName)}}" type="application/pdf" width="800px" height="2100px" />--}}
{{--</div>--}}
{{--<iframe src="https://docs.google.com/gview?url={{\Illuminate\Support\Facades\Storage::url($saveFileName)}}&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>--}}

</body>
<script>

</script>
</html>

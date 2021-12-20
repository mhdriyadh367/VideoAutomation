<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ShaynaAdmin - HTML5 Admin Template</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('includes.style')
    
</head>

<body>
    
        <div class="container mt-4">            
            <form action="{{ route('video.store') }}" id="slide-progress" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="slide-x">
                    <div class="form-group">
                        <label for="photo">Input Photo</label><a onclick="delete_slide(this)" id="delete-slide" class="delete-slide ml-2 btn btn-danger btn-sm">delete this slide</a>
                        <input required type="file" class="form-control" id="photo" name="photo[]" accept="image/*" multiple>
                    </div>
                    <div class="form-group">
                        <label for="text">Description</label>
                        <textarea required class="form-control" id="text" name="text[]" rows="3"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn-submit btn btn-primary">Submit</button>
            </form>

            <button class="btn btn-success mt-2" id="add-slide">Tambah Slide</button>

        </div>
        <div class="clearfix"></div>
    

    {{-- Script --}}
    
    <!-- Scripts -->
    @include('includes.script')

<script>

    $( "#add-slide" ).click(function () {
        $('.btn-submit').before('<div class="slide-x"><div class="form-group"><label for="photo">Input Photo</label><a onclick="delete_slide(this)" id="delete-slide" class="delete-slide ml-2 btn btn-danger btn-sm">delete this slide</a><input required type="file" class="form-control" id="photo" name="photo[]" accept="image/*" multiple></div><div class="form-group"><label for="text">Description</label><textarea required class="form-control" id="text" name="text[]" rows="3"></textarea></div></div>');
    });

    function delete_slide(el){
        $(el).parent().parent().remove()
    }

    $('#slide-progress').submit(function(event) {
        window.onbeforeunload = function () {
            return "Are you sure that you want to leave this page?";
        }
        $('.btn-submit,.btn').prop('disabled', true);
        event.preventDefault();
        $('.btn-submit').after('<i class="fa fa-spinner fa-spin loading"></i>');
        var fd = new FormData(this);
        $.ajax({
            url: "{{ route('video.store.video') }}",
            type:"POST",
            cache: false,
            contentType: false,
            processData: false,
            data: fd,
            error: function(xhr, status, error) {
                $("#alert-error").remove();
                var err = eval("(" + xhr.responseText + ")");
                //alert(err.message);
                window.onbeforeunload = null;
                $('.loading').remove();
                $('.btn').prop('disabled', false);
                toast('error','Something Wrong, please try again');
            },
            success:function(response){
                $("#alert-error").remove();
                if (response.success) 
                {
                    process_video(response.id)
                } else {
                    toast('error','Something Wrong, please try again');
                    window.onbeforeunload = null;
                    $('.btn').prop('disabled', false);
                    $('.loading').remove();

                    if( response.message !== ''  )
                    {
                        $("<div class='alert alert-danger py-1' id='alert-error'></div>").insertBefore("#slide-progress");
                        $.each( response.message, function( key, value ) {
                            $("#alert-error").append("<li>"+key+": "+value+"</li>");
                        });
                    }
                }
            }
        })
    });

    function process_video(id) {
        var numItems = $('input#photo').length;
        var count = 0;
        $('input#photo').each(function(obj, v){

            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}'); 
            formData.append('video_id', id); 
            formData.append('photo', v.files[0]); 
            formData.append('text', $(this).parent().parent().find("#text").val());

            $.ajax({
                url: "{{ route('video.coba') }}",
                type:"POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,  
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.message);
                    toast('error','Something Wrong, please try again');
                    window.onbeforeunload = null;
                    $('.loading').remove();
                    $('.btn').prop('disabled', false);
                    return;
                },
                success:function(response){
                    count = count + 1;
                    if (response.success == true) 
                    {
                        if(count == numItems)
                        {
                            toast('success','Success Convert All Slide, wait a minute!');
                            merge_video(id)
                        } 
                    } 
                    else {
                        toast('error','Something Wrong, please try again');
                        window.onbeforeunload = null;
                        $('.loading').remove();
                        $('.btn').prop('disabled', false);
                        return;
                    }
                },
                async: false

            })

        })

    }

    function merge_video(id) {
        var form = {
            id: id,
            _token: '{{ csrf_token() }}'
        };
        $.ajax({
            url: "{{ route('video.gabung') }}",
            type:"POST",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            data: form,  
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                //alert(err.message);
                window.onbeforeunload = null;
                $('.loading').remove();
                $('.btn').prop('disabled', false);
                toast('error','Something Wrong, please try again');
            },
            success:function(response){
                window.onbeforeunload = null;
                $('.loading').remove();
                $('.btn').prop('disabled', false);
                    if (response.success) 
                    {
                        url = "{{ url('video') }}/"+response.message
                        window.open(url, "_blank");
                    } else {
                        toast('error','Something Error!');
                    }
            }
        })
    }

    {{--  $('#slide-progress').submit(function(event) {
        window.onbeforeunload = function () {
          return "Are you sure that you want to leave this page?";
        }
        $('.btn-submit,.btn').prop('disabled', true);
        event.preventDefault();
        var fd = new FormData(this);
        //$('#for-table-uncfg').empty();
        $('.btn-submit').after('<i class="fa fa-spinner fa-spin loading"></i>');
        startTime = new Date().getTime()
        $.ajax({
            url: "{{ route('video.store') }}",
            type:"POST",
            cache: false,
            contentType: false,
            processData: false,
            data: fd,
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.message);
                window.onbeforeunload = null;
                $('.loading').remove();
                $('.btn-submit').prop('disabled', false);
            },
            success:function(response){
                    $("#alert-error").remove();
                    window.onbeforeunload = null;
                    var time = new Date().getTime() - startTime;
                    var seconds = time / 1000;
                    seconds = seconds.toFixed(3);
                    var result = 'AJAX request took ' + seconds + ' seconds to complete.';
                    alert(result)
                if (response.success) {
                        url = "{{ url('video') }}/"+response.id
                        window.location.href = url;
                } else {
                    $("<div class='alert alert-danger py-1' id='alert-error'></div>").insertBefore("#slide-progress");
                    $.each( response.message, function( key, value ) {
                        $("#alert-error").append("<li>"+key+": "+value+"</li>");
                    });
                }
                $('.loading').remove();
                $('.btn-submit').prop('disabled', false);
                response.message = [];
              },
        });
    })  --}}

</script>

</body>
</html>

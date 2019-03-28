@foreach($files as $file)

        @if($file->category == 'photo')
            <div class="row">
            <div class="col-lg-4 ">

                    <img src="/storage/BrightDrive/user_{{auth()->user()->id}}/{{$file->filename}}" alt="{{$file->filename}}">


            </div>
            </div>
        @endif


@endforeach
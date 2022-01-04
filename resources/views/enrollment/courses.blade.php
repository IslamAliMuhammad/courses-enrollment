@extends('layouts.main')

@section('content')
<section class="special_cource padding_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="text-center section_tittle">
                    <h2>My Course Enrollment Applications</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($userEnrollments as $enrollment)
                <div class="col-sm-6 col-lg-4">
                    <div class="single_special_cource">
                        <img src="{{ optional($enrollment->course->photo)->getUrl() ?? asset('img/no_image.png') }}" class="special_img" alt="">
                        <div class="special_cource_text">
                            <a href="{{ route('courses.index') }}?discipline={{ $enrollment->course->discipline->id }}" class="mb-1 mr-1 btn_4">{{ $enrollment->course->discipline->name }}</a>
                            <h4>{{ $enrollment->course->getPrice() }}</h4>
                            <a href="{{ route('courses.show', $enrollment->course->id) }}"><h3>{{ $enrollment->course->name }}</h3></a>
                            <p>{{ Str::limit($enrollment->course->description, 100) }}</p>
                            @if($enrollment->course->institution)
                                <div class="author_info">
                                    <div class="author_img">
                                        <div class="author_info_text">
                                            <p>Institution</p>
                                            <h5><a href="{{ route('courses.index') }}?institution={{ $enrollment->course->institution->id }}">{{ $enrollment->course->institution->name }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="author_info">
                                <p>Status:</p>
                                <h5>{{ $enrollment->enrollmentStatus->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="mb-4 col-12">
                <div class="float-right">
                    {{ $userEnrollments->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

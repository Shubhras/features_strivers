
@extends('layouts.master')
@section('content')
<style>
.alert{
    display:none!important;
}
#wrapper{
    padding-top : 57px !important;
}
    </style>
<div class="container1-xl">
    <div class="backimage">
        <div class="backfirst container" >
           <h2>Online Course</h2>
           <h1>From 160 Top Instutions.</h1>
           <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non officia iure, unde iusto ex nostrum repellat saepe laboriosam dolorum placeat?</p>
           <button class="startcourse btn">Start Course</button>
        </div>
        <div class="secondimage">
            <iframe class = "aboutusvideo"
            src="https://www.youtube.com/embed/tgbNymZ7vqY?mute=1">
            </iframe>
        </div>
    </div>
    
    
</div>

<div class="ourglobalcommunity">
        <h1>Our Global Community</h1>
        <p>Join thousands of instructor and earn money hassel free!</p>
        <div class="a">
            <div class="b"><i class="fa fa-graduation-cap" aria-hidden="true"></i>27 Million Learners</div>
            <div class="b"><i class="fa fa-graduation-cap" aria-hidden="true"></i>27 Million Learners</div>
            <div class="b"><i class="fa fa-graduation-cap" aria-hidden="true"></i>27 Million Learners</div>
            <div class="b"><i class="fa fa-graduation-cap" aria-hidden="true"></i>27 Million Learners</div>
        </div>
</div>

<div class="container striverisgreat">
    <h2>
“Strivre is great for teams because it’s easy to get set up and the offerings touch on a vast array of soft skill focus areas, which not only build role-related talents but also enable team members to grow their whole selves beyond work.”</h2>
</div>
@endsection

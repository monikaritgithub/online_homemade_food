@extends('layouts.customerDashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card neumorphic">
                <div class="card-header bg-success text-white">Personal Details</div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="{{ $user->name }}" class="rounded-circle img-fluid" style="width: 200px;">


                        </div>
                        <div class="col-md-8">
                            <p class="mb-4"><strong class="text-success">Full Name:</strong> {{ $user->name }}</p>
                            <p class="mb-4"><strong class="text-success">Email:</strong> {{ $user->email }}</p>
                            <p class="mb-4"><strong class="text-success">Mobile:</strong> {{ $user->contactno }}</p>
                            <p class="mb-4"><strong class="text-success">Address:</strong> {{ $user->location }}</p>
                        </div>
                    </div>
                    <hr class="my-4"> <!-- Horizontal line -->
                    <div class="row justify-content-around">
                    <div class="col-md-4 mb-3">
    <a  onclick="goBack()" class="neumorphic-frame text-center bg-danger d-block py-3">
        <i class="fas fa-arrow-left text-white fa-2x mb-2"></i>
        
    </a>
</div>

                        <div class="col-md-4 mb-3">
                            <div class="neumorphic-frame text-center bg-info">
                                <a href="{{ url('/chatify/' . $user->id) }}"><i class="fas fa-comment fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .neumorphic {
        background: #f0f0f0;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 8px 8px 15px #cbced1, -8px -8px 15px #ffffff;
    }

    .neumorphic-frame {
        background: #f0f0f0;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 8px 8px 15px #cbced1, -8px -8px 15px #ffffff;
        transition: all 0.3s ease;
    }

    .neumorphic-frame:hover {
        box-shadow: 12px 12px 20px #cbced1, -12px -12px 20px #ffffff;
    }
</style>
<script>
        function goBack() {
            window.history.back();
        }
    </script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


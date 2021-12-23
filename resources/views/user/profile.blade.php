@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile Kamu</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Profile</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
					<div class="col-md-6 col-lg-5 mx-auto">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-auto mx-auto text-center">
										<div class="mb-3">
											<img src="{{ $user->pathImg() }}" class="user-image-lg img-fluid" alt="User Image">
										</div>
										<div class="mb-3">
											<h4 class="font-weight-bold">{{ $user->first_name }} {{ $user->last_name }}</h4>
										</div>
										<div class="mb-3 font-weight-bold">
											<i class="fas fa-phone-alt"></i> &nbsp; {{ $user->phone }}
										</div>
										<div class="mb-3 font-weight-bold">
											<i class="fas fa-envelope"></i> &nbsp; {{ $user->email }}
										</div>
										<div class="mb-3 font-weight-bold">
											Role: &nbsp;{{ $user->role->name }}
										</div>
										<div class="mb-3 font-weight-bold">
											Status Membership: &nbsp;{{ $user->is_membership ? 'Aktif' : 'Nonaktif' }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
			</div>
        </section>
    </div>
@endsection

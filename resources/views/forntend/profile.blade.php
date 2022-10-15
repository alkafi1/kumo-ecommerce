@extends('forntend.profile_master')

@section('account')
    <div class="col-12 col-md-12 col-lg-8 col-xl-8">
							<!-- row -->
							<div class="row align-items-center">
								<form class="row m-0">
									
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">First Name *</label>
											<input type="text" class="form-control" placeholder="Dhananjay" />
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">Email ID *</label>
											<input type="text" class="form-control" placeholder="dhananjay7@gmail.com" />
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">Current Password *</label>
											<input type="text" class="form-control" placeholder="Current Password" />
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">New Password *</label>
											<input type="text" class="form-control" placeholder="New Password" />
										</div>
									</div>
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">Country</label>
											<input type="text" class="form-control" placeholder="Country" />
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">Address</label>
											<input type="text" class="form-control" placeholder="Address" />
										</div>
									</div>

									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group">
											<label class="small text-dark ft-medium">Profile Image</label>
											<input type="file" class="form-control" />
										</div>
									</div>
									
									
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group">
											<button type="button" class="btn btn-dark">Save Changes</button>
										</div>
									</div>
									
								</form>
							</div>
							<!-- row -->
						</div>
@endsection
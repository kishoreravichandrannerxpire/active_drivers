<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Driver Profile</title>
        
        @include('partials.links')
<style>
body {
    background: #eef2f7;
    padding-top: 80px;
    font-family: 'Segoe UI', sans-serif;
}

/* Layout */
.profile-wrapper {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 25px;
    align-items: start;
}

/* Sidebar */
.profile-sidebar {
    background: #1e293b;
    color: #fff;
    border-radius: 16px;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* Avatar */
.profile-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #334155;
    overflow: hidden;
    margin: 0 auto 15px;
    border: 3px solid #475569;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Name & Status */
.profile-name {
    font-weight: 600;
    font-size: 18px;
}

.profile-status {
    font-size: 13px;
    padding: 5px 12px;
    border-radius: 20px;
    display: inline-block;
    margin-top: 8px;
}

.status-active { background: #22c55e; }
.status-inactive { background: #64748b; }

/* Right Panel */
.profile-content {
    background: #fff;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* Title */
.section-title {
    font-weight: 600;
    margin-bottom: 20px;
}

/* Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px 25px;
}

/* Info box */
.info-box {
    background: #f8fafc;
    padding: 12px 15px;
    border-radius: 10px;
    transition: 0.3s ease;
}

.info-box:hover {
    background: #f1f5f9;
}

/* Labels */
.info-label {
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 5px;
}

/* Values */
.info-value {
    font-weight: 500;
}

/* Inputs */
.info-box input,
.info-box select {
    border: none;
    background: transparent;
    width: 100%;
    outline: none;
    font-weight: 500;
}

/* Modal */
.modal-content {
    border-radius: 16px;
}

/* Image preview */
.preview-img {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    object-fit: cover;
    margin-top: 8px;
    border: 1px solid #ddd;
}

/* Button */
.btn {
    border-radius: 8px;
}

/* ================= MOBILE ================= */
@media (max-width: 768px) {

    .profile-wrapper {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .profile-sidebar {
        padding: 20px 15px;
    }

    .profile-avatar {
        width: 70px;
        height: 70px;
    }

    .profile-content {
        padding: 18px 15px;
    }

    .info-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .info-box {
        padding: 10px 12px;
    }

    .profile-name {
        font-size: 16px;
    }

    .profile-status {
        font-size: 12px;
        padding: 4px 10px;
    }

    .info-value {
        font-size: 14px;
    }

    .preview-img {
        width: 60px;
        height: 60px;
    }

    .modal-dialog {
        margin: 10px;
    }
}

</style>
    </head>
<body>
    @include('partials.navbar') 
    <div class="container mt-5">
         @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
        <div class="profile-wrapper">
            <!-- LEFT -->
             <div class="profile-sidebar">
                <div class="profile-avatar">
                    @if($driver?->driver_image)
                    <img src="{{ asset('storage/drivers/'.$driver->driver_image) }}">
                    @else
                    <div style="line-height:90px; font-size:30px;">
                        {{ strtoupper(substr($driver?->first_name,0,1)) }}
                    </div>
                    @endif
                </div>
                
                <div class="profile-name">
                    {{ $driver?->first_name }} {{ $driver?->last_name }}
                </div>
                
                <div class="profile-status {{ $driver?->status ? 'status-active' : 'status-inactive' }}">
                    {{ $driver?->status ? 'Active' : 'Inactive' }}
                </div>
                
                <hr class="my-4" style="border-color:#334155">
                <div class="text-start small">
                    <p><strong>Email:</strong><br>{{ $driver?->email }}</p>
                    <p><strong>Mobile:</strong><br>{{ $driver?->mobile_number }}</p>
                </div>
                
                <button class="btn btn-light mt-3 w-100" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    Edit Profile
                </button>
            </div>
            
            <!-- RIGHT -->
             
            <div class="profile-content">
                <h5 class="section-title">Driver Details</h5>
                <div class="info-grid">
                    <div class="info-box">
                        <div class="info-label">Age</div>
                        <div class="info-value">{{ $driver?->age }}</div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">License</div>
                        <div class="info-value">{{ $driver?->driver_license_number }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Experience</div>
                        <div class="info-value">{{ $driver?->total_experience_years }} Years</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Hill Experience</div>
                        <div class="info-value">{{ $driver?->hill_experience ? 'Yes' : 'No' }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Accident History</div>
                        <div class="info-value">{{ $driver?->accident_history ? 'Yes' : 'No' }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Luxury Car</div>
                        <div class="info-value">{{ $driver?->luxury_car_experience ? 'Yes' : 'No' }}</div>
                    </div>
                    
                    
                    <div class="info-box">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $driver?->address }}</div>
                    </div>
                    
                    <div class="info-box">
                        <div class="info-label">Pincode</div>
                        <div class="info-value">{{ $driver?->pincode }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MODAL (MATCHING UI) -->
     <div class="modal fade" id="editProfileModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
                <h5>Edit Profile</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="{{ route('driver.profile.update') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-label">First Name</div>
                            <input type="text" name="first_name" value="{{ old('first_name',$driver?->first_name) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Last Name</div>
                            <input type="text" name="last_name" value="{{ old('last_name',$driver?->last_name) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Mobile</div>
                            <input type="text" name="mobile_number" value="{{ old('mobile_number',auth()->user()->mobile_number) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Email</div>
                            <input type="email" name="email" value="{{ old('email',auth()->user()->email) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Age</div>
                            <input type="number" name="age" value="{{ old('age',$driver?->age) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Status</div>
                            <select name="status">
                                <option value="1" {{ old('status',$driver?->status)==1?'selected':'' }}>Active</option>
                                <option value="0" {{ old('status',$driver?->status)==0?'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">License</div>
                            <input type="text" name="driver_license_number" value="{{ old('driver_license_number',$driver?->driver_license_number) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Image</div>
                            <input type="file" name="driver_image">
                            @if($driver?->driver_image)
                            <img src="{{ asset('storage/drivers/'.$driver->driver_image) }}" class="preview-img">
                            @endif
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Experience</div>
                            <input type="number" name="total_experience_years" value="{{ old('total_experience_years',$driver?->total_experience_years) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Hill</div>
                            <select name="hill_experience">
                                <option value="1" {{ old('hill_experience',$driver?->hill_experience)=='1'?'selected':'' }}>Yes</option>
                                <option value="0" {{ old('hill_experience',$driver?->hill_experience)=='0'?'selected':'' }}>No</option>
                            </select>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Accident</div>
                            <select name="accident_history">
                                <option value="1" {{ old('accident_history',$driver?->accident_history)=='1'?'selected':'' }}>Yes</option>
                                <option value="0" {{ old('accident_history',$driver?->accident_history)=='0'?'selected':'' }}>No</option>
                            </select>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Luxury</div>
                            <select name="luxury_car_experience">
                                <option value="1" {{ old('luxury_car_experience',$driver?->luxury_car_experience)=='1'?'selected':'' }}>Yes</option>
                                <option value="0" {{ old('luxury_car_experience',$driver?->luxury_car_experience)=='0'?'selected':'' }}>No</option>
                            </select>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Address</div>
                            <input type="text" name="address" value="{{ old('address',$driver?->address) }}">
                        </div>
                        
                        <div class="info-box">
                            <div class="info-label">Pincode</div>
                            <input type="text" name="pincode" value="{{ old('pincode',$driver?->pincode) }}">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
@extends('backend.superadmin.layouts.app')
@section('title','Create Role')
@section('secton')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Role Form </h3>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('superadmin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Role Form </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Role Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('update',$rolePermissionsUser->role_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->has('role_name'))
                                    <span class="text-danger">{{ $errors->first('role_name') }}</span>
                                @endif
                                <div class="row">
                                    <div class="col-md-12 mb-4 col-12">
                                        <h6>Select User</h6>

                                        <fieldset class="form-group">
                                            <select class="form-select" name="role_name" id="basicSelect">
                                                <option value="" disabled="">Select Role</option>
                                                <option value="admin" <?php echo ($rolePermissionsUser->role_name == 'admin') ? 'selected' : ''; ?> >Admin</option>
                                                <option value="user" <?php echo ($rolePermissionsUser->role_name == 'user') ? 'selected' : ''; ?>>User</option>

                                            </select>
                                        </fieldset>
                                    </div>

                                    @if ($errors->has('role_permission'))
                                    <span class="text-danger">{{ $errors->first('role_permission') }}</span>
                                    @endif

                                        <section id="basic-checkbox">
                                            {{-- Culture start --}}
                                            <h4 class="card-title">Culture Check</h4>
                                            <div class="card-content">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-inline-block me-2 mb-1">
                                                        <div class="form-check">
                                                            <div class="checkbox">
                                                                <?php
                                                                if(array_key_exists("brandCultureStrategySurveys", $rolePermissionsArray)){
                                                                    ?>
                                                                     <input type="checkbox" id="checkbox1" name="role_permission[]" value="brandCultureStrategySurveys"  checked class="form-check-input"
                                                                     >
                                                                    <?php
                                                                }else {
                                                                    ?>
                                                                    <input type="checkbox" id="checkbox1" name="role_permission[]" value="brandCultureStrategySurveys"   class="form-check-input"
                                                                     >
                                                                     <?php
                                                                }

                                                                   ?>



                                                                <label for="checkbox1">Brand Culture Strategy Surveys</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <br>
                                            {{-- Culture  end --}}

                                             {{-- Learning  start --}}
                                            <h4 class="card-title">Learning</h4>
                                            <div class="card-content">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                    if(array_key_exists("courses", $rolePermissionsArray)){
                                                                        ?>
                                                                        <input type="checkbox" id="checkbox1" name="role_permission[]" value="courses" checked  class="form-check-input"
                                                                        >
                                                                        <?php
                                                                    }else {
                                                                        ?>
                                                                        <input type="checkbox" id="checkbox1" name="role_permission[]" value="courses"   class="form-check-input"
                                                                        >
                                                                        <?php
                                                                    }

                                                                   ?>

                                                                    <label for="checkbox1">Courses</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                    if(array_key_exists("videos", $rolePermissionsArray)){
                                                                        ?>
                                                                        <input type="checkbox" id="checkbox1" name="role_permission[]" value="videos" checked class="form-check-input"
                                                                        >
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <input type="checkbox" id="checkbox1" name="role_permission[]" value="videos"  class="form-check-input"
                                                                        >
                                                                        <?php
                                                                    }

                                                                   ?>

                                                                    <label for="checkbox1">Videos</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                    if(array_key_exists("archieved", $rolePermissionsArray)){
                                                                        ?>
                                                                         <input type="checkbox" id="checkbox1" name="role_permission[]" value="archieved" checked class="form-check-input"
                                                                         >
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                         <input type="checkbox" id="checkbox1" name="role_permission[]" value="archieved" class="form-check-input"
                                                                         >
                                                                        <?php
                                                                    }

                                                                   ?>

                                                                    <label for="checkbox1">Archieved</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("certifications", $rolePermissionsArray)){
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="certifications" checked class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="certifications" class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Certifications</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                            </div>
                                            <br>
                                             {{-- Learning  end --}}

                                             {{-- Rewards  start --}}
                                            <h4 class="card-title">Rewards</h4>
                                            <div class="card-content">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("redeem", $rolePermissionsArray)){
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="redeem" checked class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="redeem" class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Redeem</label>
                                                                </div>
                                                            </div>
                                                        </li>

                                                    </ul>
                                            </div>
                                            <br>
                                             {{-- Rewards  end --}}

                                             {{-- Community  start --}}
                                            <h4 class="card-title">Community</h4>
                                            <div class="card-content">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("resourceGroups", $rolePermissionsArray)){
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="resourceGroups" checked class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="resourceGroups" class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Resource Groups</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("events", $rolePermissionsArray)){
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="events" checked class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="events" class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Events</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("mentorship", $rolePermissionsArray)){
                                                                            ?>
                                                                             <input type="checkbox" id="checkbox1" name="role_permission[]" value="mentorship" checked class="form-check-input"
                                                                             >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                             <input type="checkbox" id="checkbox1" name="role_permission[]" value="mentorship" class="form-check-input"
                                                                             >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Mentorship</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("socialFeed", $rolePermissionsArray)){
                                                                            ?>
                                                                            <input type="checkbox" id="checkbox1" name="role_permission[]" value="socialFeed" checked class="form-check-input"
                                                                            >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                             <input type="checkbox" id="checkbox1" name="role_permission[]" value="socialFeed" class="form-check-input"
                                                                             >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Social Feed</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                            </div>
                                            <br>
                                             {{-- Community  end --}}

                                              {{-- Compaigns  start --}}
                                            <h4 class="card-title">Compaigns</h4>
                                            <div class="card-content">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("workspaces", $rolePermissionsArray)){
                                                                            ?>
                                                                           <input type="checkbox" id="checkbox1" name="role_permission[]" value="workspaces" checked class="form-check-input"
                                                                           >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                             <input type="checkbox" id="checkbox1" name="role_permission[]" value="workspaces" class="form-check-input"
                                                                             >
                                                                            <?php
                                                                        }

                                                                    ?>

                                                                    <label for="checkbox1">Workspaces</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-inline-block me-2 mb-1">
                                                            <div class="form-check">
                                                                <div class="checkbox">
                                                                    <?php
                                                                        if(array_key_exists("tasks", $rolePermissionsArray)){
                                                                            ?>
                                                                          <input type="checkbox" id="checkbox1" name="role_permission[]" value="tasks" checked class="form-check-input"
                                                                          >
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                             <input type="checkbox" id="checkbox1" name="role_permission[]" value="tasks" class="form-check-input"
                                                                             >
                                                                            <?php
                                                                        }

                                                                    ?>


                                                                    <label for="checkbox1">Tasks</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                            </div>
                                            <br>
                                             {{-- Compaigns  end --}}
                                        </section>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>
@endsection

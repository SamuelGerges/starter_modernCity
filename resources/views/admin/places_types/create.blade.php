@extends('admin/layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header justify-content-center">
            <div class="container-fluid">
                <div class="row mb-3">

                    <div class="col-sm-7">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.place_type.index') }}">User Group / </a> {{  !isset($users_groups->user_group_id)  ? 'Add / ' : "Edit / ". $users_groups->user_group_name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

    @include('admin/components/errors')

    <!-- Main content -->
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-6 ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{  !isset($place_type->place_type_id)  ? 'Add ' : "Edit "}} Info</h3>
                        </div>
                        <div class="card-body">
                            <?php !isset($place_type->place_type_id)  ? $id = '' : $id = $place_type->place_type_id ?>
                            <form class="form-group" method="post" action="{{ route('admin.place_type.edit', $id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12 pr-md-1 ">
                                        <label>Place Type Name</label>
                                        <input type="text" name="data[place_type_name]" class="form-control" placeholder="Enter Place Type Name" value="{{ !isset($place_type->place_type_name) ? '' : $place_type->place_type_name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-6 pr-md-1">
                                        <label>Upload Photo <span style="color: red;">@To do img</span></label>
                                        <div class="custom-file">
                                            <input type="file"  name="data[place_type_img][url]" class="custom-file-input" id="place_type_img">
                                            <label class="custom-file-label" for="exampleInputFile">Choose photo</label>
                                        </div>
                                    </div>
                                </div>




                                <button type="submit" class="btn btn-success float-right">{{  !isset($place_type->place_type_id)  ? 'Create' : 'Edit'}}</button>
                            </form>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


                <div class="col-md-4">
                    <div class="card" style="height: 400px; width: 400px; align-items: center">
                        <div id="img_holder" style="">
                            <?php
                            if(isset($place_type->place_type_id)){
                                //edit

                                if(isset($place_type->place_type_img)){
                                    $img_obj = json_decode($place_type->place_type_img, true);

                                    $img_url = asset('uploads/places_types/'.$img_obj['url']);
                                    $img_alt = $img_obj['alt'];

                                }
                                else{
                                    $img_url = asset('admin/site_imgs/place_type.png');
                                    $img_alt = 'place_type_avatar_img';
                                }

                            }
                            else{
                                // create view
                                $img_url = asset('admin/site_imgs/place_type.png');
                                $img_alt = 'place_type_avatar_img';
                            }


                            ?>
                            <img class="card-img-top"  id="avatar_img" src="{{$img_url}}" alt="{{$img_alt}}"  style="height: 200px; width:200px">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        avatar_img_preview($('#place_type_img'), $('#img_holder'), 'card-img-top', 'avatar_img')
    </script>


@endsection
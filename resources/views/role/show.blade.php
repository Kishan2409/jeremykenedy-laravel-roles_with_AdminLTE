@extends('layouts.app')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> {{ __('Role') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"> {{ __('Show Role') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Show Role</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Role Name" value="{{ $data->name }}" disabled>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="slug">Slug<span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    placeholder="Enter Slug Name" value="{{ $data->slug }}" disabled>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter role description " disabled>{{ $data->description }}</textarea>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="lavel">Lavel</label>
                                <input type="text" maxlength="1" name="lavel" id="lavel" class="form-control"
                                    placeholder="Enter role lavel" value="{{ $data->level }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Permission</label>
                                <div class="row">
                                    @foreach ($permissions as $model => $modelPermissions)
                                        <div class="card w-25 m-1">
                                            <div class="card-header">
                                                <div class="icheck-primary d-inline ms-1">
                                                    @php
                                                        $allPermissionsChecked = true;
                                                    @endphp
                                                    @foreach ($modelPermissions as $permission)
                                                        @unless (in_array($permission->id, $approved))
                                                            @php
                                                                $allPermissionsChecked = false;
                                                            @endphp
                                                        @break
                                                    @endunless
                                                @endforeach
                                                <input type="checkbox" class="checkModel"
                                                    id="content{{ $model }}" data-model="{{ $model }}"
                                                    {{ $allPermissionsChecked ? 'checked' : '' }} disabled>
                                                <label for="content{{ $model }}"
                                                    class="text-dark">{{ $model }}</label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($modelPermissions as $permission)
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" class="chk"
                                                        id="content{{ $permission->id }}" name="permission[]"
                                                        data-model="{{ $model }}" value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $approved) ? 'checked' : '' }}
                                                        disabled>
                                                    <label
                                                        for="content{{ $permission->id }}">{{ $permission->description }}</label><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $(".checkModel").change(function() {
            const model = $(this).data('model');
            $(`.chk[data-model="${model}"]`).prop('checked', $(this).prop("checked"));
        });

        // Check/uncheck the model checkbox when all related checkboxes are checked/unchecked
        $(".chk").change(function() {
            const model = $(this).data('model');
            const allChecked = $(`.chk[data-model="${model}"]:checked`).length === $(
                `.chk[data-model="${model}"]`).length;
            $(`.checkModel[data-model="${model}"]`).prop('checked', allChecked);
        });

    });
</script>
@endsection
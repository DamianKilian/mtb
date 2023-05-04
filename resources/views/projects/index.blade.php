@extends('layouts.mbt')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard333</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                {{-- <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="dataTable_length"><label>Show <select
                                                    name="dataTable_length" aria-controls="dataTable"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input
                                                    type="search" class="form-control form-control-sm" placeholder=""
                                                    aria-controls="dataTable"></label></div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <form id="filter">
                                            @csrf
                                            <!-- Name Input -->
                                            <input type="hidden" name="productFilter" value="1" />
                                            <div class="form-floating mb-3">
                                                <input value="{{ Request::get('name') }}" class="form-control"
                                                    id="name" name="name" type="text" placeholder="Name" />
                                            </div>
                                            <hr />
                                            <!-- Start date Input -->
                                            Start date<br>
                                            from
                                            <div class="form-floating mb-3">
                                                <input value="{{ Request::get('startDateFrom') }}" class="form-control"
                                                    id="start-date" name="startDateFrom" type="date"
                                                    placeholder="Start date" />
                                            </div>
                                            to
                                            <div class="form-floating mb-3">
                                                <input value="{{ Request::get('startDateTo') }}" class="form-control"
                                                    id="start-date" name="startDateTo" type="date"
                                                    placeholder="Start date" />
                                            </div>
                                            <hr />
                                            <!-- Stop date Input -->
                                            Stop date<br>
                                            from
                                            <div class="form-floating mb-3">
                                                <input value="{{ Request::get('stopDateFrom') }}" class="form-control"
                                                    id="stop-date" name="stopDateFrom" type="date"
                                                    placeholder="Stop date" />
                                            </div>
                                            to
                                            <div class="form-floating mb-3">
                                                <input value="{{ Request::get('stopDateTo') }}" class="form-control"
                                                    id="stop-date" name="stopDateTo" type="date"
                                                    placeholder="Stop date" />
                                            </div>

                                            <!-- Submit button -->
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-lg" type="submit">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered dataTable" id="dataTable" role="grid"
                                            aria-describedby="dataTable_info" style="width: 100%;" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" style="width: 78px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" style="width: 104px;"
                                                        aria-label="Position: activate to sort column ascending">Start date
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" style="width: 60px;"
                                                        aria-label="Office: activate to sort column ascending">Stop date
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" style="width: 31px;"
                                                        aria-label="Age: activate to sort column ascending">Image</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" style="width: 71px;"
                                                        aria-label="Start date: activate to sort column ascending">actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Start date</th>
                                                    <th rowspan="1" colspan="1">Stop date</th>
                                                    <th rowspan="1" colspan="1">Image</th>
                                                    <th rowspan="1" colspan="1">actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @php
                                                    $projectsData = [];
                                                @endphp
                                                @foreach ($projects as $project)
                                                    <tr>
                                                        <td>{{ $project->name }}</td>
                                                        <td>{{ $project->start_date }}</td>
                                                        <td>{{ $project->stop_date }}</td>
                                                        <td><img src="{{ url('storage/' . $project->image) }}"></td>
                                                        <td class="has-text-right">
                                                            <a class="btn"
                                                                href="{{ route('projects.edit', $project->id) }}">{{ __('Edit project') }}</a><br>
                                                            @php
                                                                $projectsData[$project->id] = [
                                                                    'routes' => [
                                                                        'destroy' => route('projects.destroy', ['project' => $project->id]),
                                                                        'email' => route('projects.email', ['project' => $project->id]),
                                                                    ],
                                                                ];
                                                            @endphp

                                                            <span class="react-actions"
                                                                data-id="{{ $project->id }}"></span>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="dataTable_info" role="status"
                                            aria-live="polite">
                                            Showing 1 to 10 of 57 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                            {{-- <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="dataTable_previous"><a href="#" aria-controls="dataTable"
                                                        data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="dataTable" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="dataTable" data-dt-idx="2" tabindex="0"
                                                        class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="dataTable" data-dt-idx="3" tabindex="0"
                                                        class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="dataTable" data-dt-idx="4" tabindex="0"
                                                        class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="dataTable" data-dt-idx="5" tabindex="0"
                                                        class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="dataTable" data-dt-idx="6" tabindex="0"
                                                        class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="dataTable_next"><a
                                                        href="#" aria-controls="dataTable" data-dt-idx="7"
                                                        tabindex="0" class="page-link">Next</a></li>
                                            </ul> --}}
                                            {{ $projects->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsUp')
    <script>
        window.projectsData = @json($projectsData);
        window.csrf = "{{ csrf_token() }}";
    </script>
@endsection

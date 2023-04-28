@extends('layouts.mbt')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection()

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                </div>
                <div class="card-body">
                    <!-- Bootstrap 5 Contact Form Snippet -->

                    <div class="container px-5 my-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card border-0 rounded-3 shadow-lg">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <div class="h1 fw-light">Nowy projekt</div>
                                        </div>
                                        <form id="projectForm" action="{{ route('projects.store') }}" method="POST">
                                            @csrf
                                            <!-- Name Input -->
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Name" />
                                                <label for="name">Name</label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Start date Input -->
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="start-date" name="startDate" type="date"
                                                    placeholder="Start date" />
                                                <label for="start-date">Start date</label>
                                                @error('startDate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Stop date Input -->
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="stop-date" name="stopDate" type="date"
                                                    placeholder="Stop date" />
                                                <label for="stop-date">Stop date</label>
                                                @error('stopDate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Message Input -->
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="message" name="message" type="text" placeholder="Message"
                                                    style="height: 10rem;"></textarea>
                                                <label for="message">Message</label>
                                                @error('stopDate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Img Input -->
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="image" name="image" type="file"
                                                    placeholder="Stop date" />
                                                <label for="image">Image</label>
                                            </div>

                                            <!-- Submit success message -->
                                            <div class="d-none" id="submitSuccessMessage">
                                                <div class="text-center mb-3">
                                                    <div class="fw-bolder">Form submission successful!</div>
                                                    <p>To activate this form, sign up at</p>
                                                    <a
                                                        href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                                </div>
                                            </div>

                                            <!-- Submit error message -->
                                            <div class="d-none" id="submitErrorMessage">
                                                <div class="text-center text-danger mb-3">Error sending message!</div>
                                            </div>

                                            <!-- Submit button -->
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                                            </div>
                                        </form>
                                        <!-- End of contact form -->

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

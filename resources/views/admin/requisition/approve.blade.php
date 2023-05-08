@extends('layouts.admin')

@section('page')
    <style>
        .jay-signature-pad {
            position: relative;
            display: -ms-flexbox;
            -ms-flex-direction: column;
            width: 100%;
            height: 100%;
            max-width: 500px;
            max-height: 315px;
            border: 1px solid #e8e8e8;
            background-color: #fff;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
            border-radius: 15px;
            padding: 20px;
        }

        .txt-center {
            text-align: -webkit-center;
        }
    </style>
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $data->name }} {{ $type }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        <!-- Content Wrapper. Contains page content -->
        <div class="">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data->name }} {{ $type }} Detail</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-2">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Budget</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $budget }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-2">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Payments</span>
                                                <span class="info-box-number text-center text-muted mb-0">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Start Time</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $data->start_date }}<span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">End Time</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $data->end_date }}<span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Requisitions</h4>
                                        @if (count($requisition) > 0)
                                            @foreach ($requisition as $request)
                                                <div class="post">
                                                    <div class="user-block">
                                                        <span class="username">
                                                            @if ($request->is_approved == '0')
                                                                <a
                                                                    href="{{ route('approve_request', [$type, $request->id]) }}">
                                                                    <button class="btn sm-btn btn-success">
                                                                        <small>Approve</small>
                                                                    </button>
                                                                </a>
                                                                <button class="btn sm-btn btn-secondary text-white"
                                                                    type="button" data-toggle="modal" data-target="#amend">
                                                                    <span>
                                                                        Amend
                                                                    </span>
                                                                </button>
                                                                {{-- include modal --}}
                                                                <div class="modal fade" id="amend">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content bg-primary">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title text-dark">
                                                                                    <h3 class="card-title">Amend</h3>
                                                                                </h4>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span></button>
                                                                            </div>
                                                                            {{-- amend form --}}
                                                                            <form
                                                                                action="{{ route('amend_request', [$request->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                {{-- all requisitions --}}
                                                                                <div class="card bg-yellow p-3">
                                                                                    {{-- name --}}
                                                                                    <div class="text-dark-bg-light p-2">
                                                                                        <div>
                                                                                            <label for="">Name</label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ $request->name }}"
                                                                                                placeholder="{{ $request->name  }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- details --}}
                                                                                    <div class="text-dark-bg-light p-2">
                                                                                        <div>
                                                                                            <label for="">Details</label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ $request->details }}"
                                                                                                placeholder="{{ $request->details  }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- amount --}}
                                                                                    <div class="text-dark-bg-light p-2">
                                                                                        <div>
                                                                                            <label for="">Amount</label>
                                                                                        </div>
                                                                                        <div>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ $request->amount }}"
                                                                                                placeholder="{{ $request->amount  }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- btn --}}
                                                                                    <button class="btn btn-success m-3">
                                                                                        Amend
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        </form>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                @include('admin.queries.inc.requisition')
                                                                <a
                                                                    href="{{ route('reject_request', [$type, $request->id]) }}">
                                                                    <button class="btn sm-btn btn-danger">
                                                                        <small>Reject</small>
                                                                    </button>
                                                                </a>
                                                            @else
                                                                <a
                                                                    href="{{ route('reject_request', [$type, $request->id]) }}">
                                                                    <button class="btn sm-btn btn-danger">
                                                                        <small>Reject</small>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </span>
                                                        <span class="description mt-3">
                                                            {{ $request->created_at }}</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                    <div>
                                                        <span>Requisition Amount:</span>
                                                        <span>{{ $request->amount }}</span>
                                                    </div>
                                                    <div>
                                                        <span>Requested By:</span>
                                                        <span>{{ $request->createdBy->first_name }}
                                                            {{ $request->createdBy->last_name }}</span>
                                                    </div>
                                                    <div>
                                                        <span>Requested For:</span>
                                                        <span>{{ $request->requsition_note }}</span>
                                                    </div>
                                                    <div>
                                                        <span>Estimated Budget:</span>
                                                        <span>{{ $request->estimated_budget }}</span>
                                                    </div>
                                                    <div>
                                                        <span>Status:</span>
                                                        @if ($request->is_approved == true)
                                                            <span>Approved</span>
                                                        @else
                                                            <span>Pending Approval</span>
                                                        @endif
                                                    </div>
                                                    </p>
                                                    <p>

                                                    </p>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>
                                                No requisitions made for this {{ $type }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- sifnature --}}
                                    <div class="col-12">
                                        <h4>Digital Signature</h4>
                                        <div class="post">
                                            <form method="POST" action="#">
                                                @csrf
                                                <div id="signature-pad" class="jay-signature-pad">
                                                    <div class="jay-signature-pad--body">
                                                        <canvas id="jay-signature-pad" width=300 height=250></canvas>
                                                    </div>
                                                    <div class="signature-pad--footer txt-center">
                                                        <div class="description"><strong> SIGN ABOVE </strong></div>
                                                        <div class="signature-pad--actions txt-center">
                                                            <div>
                                                                <button type="button" class="button clear"
                                                                    data-action="clear">Clear</button>
                                                                <button type="button" class="button"
                                                                    data-action="change-color">Change color</button>
                                                            </div><br />
                                                            <div>
                                                                <button type="button" class="button btn btn-success save"
                                                                    data-action="save-png">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>

    {{-- modals --}}
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    {{-- include datatable scripts --}}
    @include('admin.queries.inc.datatables_script')

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script>
        var wrapper = document.getElementById("signature-pad");
        var clearButton = wrapper.querySelector("[data-action=clear]");
        var changeColorButton = wrapper.querySelector("[data-action=change-color]");
        var savePNGButton = wrapper.querySelector("[data-action=save-png]");
        var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
        var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
        var canvas = wrapper.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });
        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            // This part causes the canvas to be cleared
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            // This library does not listen for canvas changes, so after the canvas is automatically
            // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
            // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
            // that the state of this library is consistent with visual state of the canvas, you
            // have to clear it manually.
            signaturePad.clear();
        }
        // On mobile devices it might make more sense to listen to orientation change,
        // rather than window resize events.
        window.onresize = resizeCanvas;
        resizeCanvas();

        function download(dataURL, filename) {
            var blob = dataURLToBlob(dataURL);
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement("a");
            a.style = "display: none";
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        }
        // One could simply use Canvas#toBlob method instead, but it's just to show
        // that it can be done using result of SignaturePad#toDataURL.
        function dataURLToBlob(dataURL) {
            var parts = dataURL.split(';base64,');
            var contentType = parts[0].split(":")[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;
            var uInt8Array = new Uint8Array(rawLength);
            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }
            return new Blob([uInt8Array], {
                type: contentType
            });
        }
        clearButton.addEventListener("click", function(event) {
            signaturePad.clear();
        });
        changeColorButton.addEventListener("click", function(event) {
            var r = Math.round(Math.random() * 255);
            var g = Math.round(Math.random() * 255);
            var b = Math.round(Math.random() * 255);
            var color = "rgb(" + r + "," + g + "," + b + ")";
            signaturePad.penColor = color;
        });
        savePNGButton.addEventListener("click", function(event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataURL = signaturePad.toDataURL();
                download(dataURL, "signature.png");
            }
        });
        saveJPGButton.addEventListener("click", function(event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataURL = signaturePad.toDataURL("image/jpeg");
                download(dataURL, "signature.jpg");
            }
        });
        saveSVGButton.addEventListener("click", function(event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataURL = signaturePad.toDataURL('image/svg+xml');
                download(dataURL, "signature.svg");
            }
        });
    </script>
@endsection

@if (session('status'))
    <div  class="card">
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div  class="card">
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div  class="card">
        <div class="card-body">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif

@if (session('info'))
    <div  class="card">
        <div class="card-body">
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        </div>
    </div>
@endif

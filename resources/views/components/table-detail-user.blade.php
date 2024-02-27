<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ $nameModule }}</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ $routeIndex }}" class="btn btn-sm btn btn-default">{{ $btnBack }}</a>
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    {{ $table }}
                </table>
            </div>
        </div>
    </div>
</div>
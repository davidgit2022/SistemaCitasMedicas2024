<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ $nameModule }}</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ $routeCreate }}" class="btn btn-sm btn btn-default">{{ $nameBtnNew }}</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i
                                class="fas fa-upload"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ $routeExportExcel }}">EXCEL</a>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3 row">
                    <div class="col-md-6 ml-auto">
                        <form action="{{ $routeIndex }}" method="get">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="{{ $placeholder }}"
                                    name="filterValue">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    {{ $table }}
                </table>
            </div>
            <div class="card-footer py-4">
                {{ $pagination }}
            </div>
        </div>
    </div>
</div>

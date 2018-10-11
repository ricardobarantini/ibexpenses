@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Create Account</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ url('/accounts') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-alternative" id="title" name="title" placeholder="Account Title" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control form-control-alternative" id="type" name="type">
                                    <option></option>
                                    @foreach ($accountTypes as $type)
                                        <option value="{{ $type }}" {{ (old('type') == $type) ? 'selected' : '' }}>{{ title_case($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control form-control-alternative" id="currency" name="currency">
                                    <option></option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency }}" {{ (old('currency') == $currency) ? 'selected' : '' }}>{{ strtoupper($currency) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <span class="p-4"><a class="mr-15" href="{{ route('accounts.index') }}">Go Back</a></span>
                                <span class="p-4"><button type="submit" class="btn btn-primary btn-lg active">Add Account</button></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

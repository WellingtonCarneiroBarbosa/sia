<div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="espacol"></div>
            <div class="text-center">
                <h3>{{ __("Check Customers") }}</h3>
            </div>
            <div class="modal-body">
                {{-- End Find By Corporation --}}

                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <h3>{{ __("Check by corporation") }}</h3>
                            <form action="{{route('customers.deleted.find.corporation')}}" class="form-loader" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label for="findPerName">{{ __("Enterprise") }}:</label>
                                        <x-input id="findPerName" icon="ni ni-building" name="corporation" :placeholder="__('Type customer corporation name')" :value="old('corporation')" :required="true" />
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button title="{{ __("Click to Search") }}" @if (!$hasCustomers) disabled @endif class="btn btn-primary" type="submit">
                                        {{ __("Consult") }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
               {{-- End Find By Corporation --}}


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>
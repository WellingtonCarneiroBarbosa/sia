<div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="espacol"></div>
            <div class="text-center">
                <h3>{{ __("Filter Statistics") }}</h3>
            </div>
            <div class="modal-body">
                <!--options-->

                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <form class="form-loader" action="{{ route('statistics.specificDate') }}" method="POST">
                                @csrf
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <label for="start">{{ __("Start Date") }}</label>
                                        <x-input icon="date" class="date" id="start" name="start" :value="old('start')" :required="true" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end">{{ __("End Date") }}</label>
                                        <x-input icon="date" class="date" id="end" name="end" :value="old('end')" :required="true" />
                                    </div>
                                </div>
                                
                                <div class="float-right">
                                    <button title="{{ __("Click to Filter") }}" class="btn btn-primary" type="submit">
                                        {{ __("Filter") }}
                                    </button>
                                </div>
                            </form>          
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>
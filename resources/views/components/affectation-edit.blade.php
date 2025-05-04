<div class="modal fade" id="affectation{{ $affectation->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white"><i class="bx bx-user-plus"></i> @lang('lang.affectation')</h5>
                <a class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <form method="POST" action="{{ route('affectations.update', $affectation->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">                        
                        <div class="col-12">     
                            <label for="">@lang('lang.begin') <span class="text-danger">*</span></label>
                            <div class="position-relative input-icon mb-3">
                                <input type="date" class="form-control" name="begin" value="{{ $affectation->begin }}" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-calendar-edit'></i></span>
                            </div>
                            <label for="">@lang('lang.end') <span class="text-danger">*</span></label>
                            <div class="position-relative input-icon mb-3">
                                <input type="date" class="form-control" name="end" value="{{ $affectation->end }}" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-calendar-edit'></i></span>
                            </div>                                 
                            <select class="form-select mb-3" name="employee_id" required>
                                <option value="">@lang('lang.employee', ['param'=>'']) *</option>
                                @foreach ($employees as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $affectation->employee_id ? 'selected' : '' }}>{{ $item->firstname." ".$item->name." | ".$item->position }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mb-3" name="customer_id" required>
                                <option value="" selected>@lang('lang.customer', ['param'=>'']) *</option>
                                @foreach ($customers as $item)
                                    <option value="{{ $item->id }}"{{ $affectation->customer_id == $item->id ? 'selected' : '' }}>{{ $item->name." | ".$item->responsible." | ".$item->phone }}</option>
                                @endforeach
                            </select>
                            <div class="position-relative input-icon mb-3">
                                <input type="text" class="form-control" name="location" placeholder="@lang('lang.location')" value="{{ $affectation->location }}" required />
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-current-location'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <input type="number" class="form-control" name="price" placeholder="@lang('lang.price')" value="{{ $affectation->price }}" required />
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-money'></i></span>
                            </div> 
                            <div class="position-relative input-icon mb-3">
                                <input type="text" class="form-control" name="tva" placeholder="@lang('lang.tva')" value="{{ $affectation->tva }}" required />
                                <span class="position-absolute top-50 translate-middle-y">%</span>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success"><i class="bx bx-user-check"></i> @lang('lang.submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
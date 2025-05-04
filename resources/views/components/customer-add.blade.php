<div class="modal fade" id="customer-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white"><i class="bx bx-buildings"></i> @lang('lang.new_customer')</h5>
                <a class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">                        
                        <div class="col-12">   
                            <div class="position-relative input-icon mb-3">
                                <input type="text" class="form-control" name="name" placeholder="@lang('lang.name')" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-buildings'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <input type="tel" class="form-control" name="phone" placeholder="@lang('lang.phone_id') *" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-phone'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <input type="email" class="form-control" name="email" placeholder="@lang('lang.email')">
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <input type="text" class="form-control" name="address" placeholder="@lang('lang.address') *" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-map'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <input type="text" class="form-control" name="responsible" placeholder="@lang('lang.responsible') *" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <input type="number" class="form-control" name="amount" placeholder="@lang('lang.amount') *" required>
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-money'></i></span>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <label>@lang('lang.begin') <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="position-relative input-icon mb-3">
                                <label>@lang('lang.end') <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">@lang('lang.logo')</label>
                                <input class="uploadify" type="file" name="logo" accept=".png, .jpg" multiple>
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
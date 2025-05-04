<div class="modal" id="SearchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
      <div class="modal-content">
        <div class="modal-header gap-2">
            <div class="position-relative popup-search w-100">
                <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="@lang('lang.search')...">
                <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i class='bx bx-search'></i></span>
            </div>
            <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="search-list">
                   <p class="mb-1">@lang('lang.employee_management')</p>
                   <div class="list-group">
                      <a href="{{ route('employees.index', app()->getLocale()) }}" class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-group fs-4'></i>@lang('lang.employee', ['param'=>'s'])</a>
                      <a href="{{ route('leaves.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-minus'></i>@lang('lang.leaf', ['param'=>'s'])</a>
                      <a href="{{ route('suspensions.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-minus'></i>@lang('lang.suspension', ['param'=>'s'])</a>
                      <a href="{{ route('dotations.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-plus'></i>@lang('lang.dotation', ['param'=>'s'])</a>
                      <a href="{{ route('applicants.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-group'></i>@lang('lang.applicant', ['param'=>'s'])</a>
                      <a href="ecommerce-add-new-products.html" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-x'></i>@lang('lang.licenciement', ['param'=>'s'])</a>
                      <a href="{{ route('affectations.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-check'></i>@lang('lang.affectation', ['param'=>'s'])</a>
                   </div>
                   
                <p class="mb-1 mt-3">@lang('lang.accountable')</p>
                   <div class="list-group">
                    <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-buildings'></i>@lang('lang.customer', ['param'=>'s'])</a>
                    <a href="{{ route('bills.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-blanket'></i>@lang('lang.bill', ['param'=>'s'])</a>
               </div>

                   <p class="mb-1 mt-3">@lang('lang.logistic', ['param'=>''])</p>
                   <div class="list-group">
                    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-x'></i>@lang('lang.category', ['param'=>'s'])</a>
                    <a href="{{ route('equipments.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-user-x'></i>@lang('lang.equipment', ['param'=>'s'])</a>
                   </div>

                   <p class="mb-1 mt-3">@lang('lang.secretary')</p>
                   <div class="list-group">
                    <a href="{{ route('mails.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-envelope'></i>@lang('lang.mail', ['param'=>'s'])</a>
                    <a href="{{ route('meets.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-calendar-week'></i>@lang('lang.meet', ['param'=>'s'])</a>
                    <a href="{{ route('groups', app()->getLocale()) }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-group'></i>@lang('lang.group', ['param'=>'s'])</a>
                    <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i class='bx bx-sm bx-group'></i>@lang('lang.user', ['param'=>'s'])</a>
                   </div>
            </div>
        </div>
      </div>
    </div>
</div>
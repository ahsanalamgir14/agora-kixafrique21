<div class="modal fade" id="formGenerateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Options de formulaire')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form class="{{ $formClassName ?? 'generate-form' }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="update_id" value="">
                    <div class="form-group">
                        <label>@lang('Type de formulaire')</label>
                        <select name="form_type" class="form-control" required>
                            <option value="">@lang('Sélectionnez-en un')</option>
                            <option value="text">@lang('Text')</option>
                            <option value="textarea">@lang('Textarea')</option>
                            <option value="select">@lang('Select')</option>
                            <option value="checkbox">@lang('Checkbox')</option>
                            <option value="radio">@lang('Radio')</option>
                            <option value="file">@lang('File')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('Is Required')</label>
                        <select name="is_required" class="form-control" required>
                            <option value="">@lang('Sélectionnez-en un')</option>
                            <option value="required">@lang('Requis')</option>
                            <option value="optional">@lang('Optional')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('Étiquette du formulaire')</label>
                        <input type="text" name="form_label" class="form-control" required>
                    </div>
                    <div class="form-group extra_area">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary btn-global generatorSubmit">@lang('Add')</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('script-lib')
<script src="{{ asset('assets/common/js/form_generator.js') }}"></script>
@endpush

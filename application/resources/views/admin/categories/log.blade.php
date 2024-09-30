@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('SI')</th>
                                    <th>@lang('Nom')</th>
                                    <th>@lang('Icon')</th>
                                    <th>@lang('Statut')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ __($category->name) }}</strong></td>
                                        <td><strong>@php echo  @$category->icon ; @endphp</strong></td>
                                        <td>
                                            @if ($category->status == 1)
                                                <span
                                                    class="text--small badge font-weight-normal badge--success">@lang('Activé')</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger">@lang('En attente')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a title="@lang('Edit')" href="javascript:void(0)"
                                                    class="btn btn-sm btn--primary ms-1 editBtn"
                                                    data-url="{{ route('admin.category.update', $category->id) }}"
                                                    data-category="{{ json_encode($category->only('name', 'icon', 'status')) }}">
                                                    <i class="la la-pen"></i>
                                                </a>


                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>



    {{-- NEW MODAL --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="createModalLabel"> @lang('Ajouter une nouvelle catégorie')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="las la-times"></i></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('admin.category.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <label>@lang('Nom de catégorie')</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label>@lang('Icône de catégorie')</label>
                            <div class="col-sm-12">

                                <div class="input-group">
                                    <input type="text" class="form-control iconPicker icon" autocomplete="on"
                                        name="icon" required>
                                    <span class="input-group-text  input-group-addon" data-icon="las la-home"
                                        role="iconpicker"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Statut de la catégorie')</label>
                            <div class="col-sm-12">
                                <select name="status" id="setDefault" class="form-control">
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('Désactiver')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-global" id="btn-save"
                            value="add">@lang('Sauvegarder')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">@lang('Modifier la catégorie')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="las la-times"></i></button>
                </div>
                <form method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>@lang('Nom de catégorie')</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Icône de catégorie')</label>
                            <div class="col-sm-12">

                                <div class="input-group">
                                    <input type="text" class="form-control iconPicker icon" autocomplete="on"
                                        name="icon" value="{{ old('icon') }}" required>
                                    <span class="input-group-text  input-group-addon" data-icon="las la-home"
                                        role="iconpicker"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Category Statut')</label>
                            <div class="col-sm-12">
                                <select name="status" id="setDefault" class="form-control">
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('En attente')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-global" id="btn-save"
                            value="add">@lang('Sauvegarder')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal></x-confirmation-modal>
@endsection


@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary addBtn" data-bs-toggle="modal" data-bs-target="#createModal"><i
            class="las la-plus"></i>@lang('Ajouter un nouveau')</a>
@endpush


@push('script-lib')
<link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.addBtn').on('click', function() {
                var modal = $('#createModal');
                modal.modal('show');
                $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                    $(this).closest('.form-group').find('.iconpicker-input').val(
                        `<i class="${e.iconpickerValue}"></i>`);
                });
            });
            $('.editBtn').on('click', function() {
                var modal = $('#editModal');
                var url = $(this).data('url');
                var category = $(this).data('category');

                modal.find('form').attr('action', url);
                modal.find('input[name=name]').val(category.name);
                modal.find('input[name=icon]').val(category.icon);
                if (category.status == 1) {
                    modal.find('.modal-body #setDefault').val(1);
                } else {
                    modal.find('.modal-body #setDefault').val(0);
                }
                modal.modal('show');
                $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                    $(this).closest('.form-group').find('.iconpicker-input').val(
                        `<i class="${e.iconpickerValue}"></i>`);
                });
            });
        })(jQuery);
    </script>
@endpush

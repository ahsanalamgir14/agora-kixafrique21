@extends('admin.layouts.app')
@section('panel')
<div class="row mb-none-30">
    <div class="col-md-12 mb-30">
        <div class="card bl--5-primary">
            <div class="card-body">
                <p class="text--primary">@lang('À partir de cette page, vous pouvez ajouter/mettre à jour du CSS pour l\'interface utilisateur. Changer le contenu de cette page nécessitait des connaissances en programmation.')</p>
                <p class="text--warning">@lang('Veuillez ne rien changer/éditer/ajouter sans en avoir une bonne connaissance. Le site Web peut mal se comporter en raison d\’une erreur que vous avez commise.')</p>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6>@lang('Write Custom CSS')</h6>
            </div>
            <form action="" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group custom-css">
                        <textarea class="form-control customCss" rows="10" name="css">{{ $file_content }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn--primary btn-global">@lang('Sauvegarder')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('style')
<style>
    .CodeMirror {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        line-height: 1.3;
        height: 500px;
    }

    .CodeMirror-linenumbers {
        padding: 0 8px;
    }

    ​ .custom-css p,
    .custom-css li,
    .custom-css span {
        color: white;
    }

    ​ .cm-s-monokai span.cm-tag {
        margin-left: 15px;
    }
</style>
@endpush
@push('style-lib')
<link rel="stylesheet" href="{{asset('assets/admin/css/codemirror.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/css/monokai.min.css')}}">
@endpush
@push('script-lib')
<script src="{{asset('assets/admin/js/codemirror.min.js')}}"></script>
<script src="{{asset('assets/admin/js/css.min.js')}}"></script>
<script src="{{asset('assets/admin/js/sublime.min.js')}}"></script>
@endpush
@push('script')
<script>
    "use strict";
    var editor = CodeMirror.fromTextArea(document.getElementsByClassName("customCss")[0], {
        lineNumbers: true,
        mode: "text/css",
        theme: "monokai",
        keyMap: "sublime",
        autoCloseBrackets: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        matchBrackets: true
    });
</script>
@endpush

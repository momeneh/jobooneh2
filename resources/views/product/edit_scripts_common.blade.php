@section('scripts')
    <script>
        var url = "{{ route('upload_file_'.$r)}}";
        var url_remove = "{{ route('remove_file_'.$r)}}";
    </script>
    <script src="{{ asset('green/js/SimpleAjaxUploader.js')}}"></script>
    <script src="{{ asset('green/js/uploader.js') }}"></script>
    <script src="{{asset('pub')}}/jquery-ui.js"></script>
    <script>
        $('#frm_product_edit').submit(function (event) {
            $('#fake_table0').html('');
            return true;
        });
        let row_number = {{ count(old('image',$saved)) }};
        {{--        var a = "{{json_encode(session()->getOldInput())}}";--}}
        //         console.log( a );
    </script>
    <script src="{{ asset('green/js/admin_product_form_needed.js') }}"></script>
@endsection

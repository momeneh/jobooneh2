@if( Session::has('message'))

    <script>
        demo.showNotification('bottom','center',"{{Session::get('message')}}",0,'tim-icons icon-satisfied');
    </script>
@endif


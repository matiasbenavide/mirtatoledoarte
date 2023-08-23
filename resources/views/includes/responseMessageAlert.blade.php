<div>
    @if(Session::has("success"))
        <script type="module">
            let message = {!! json_encode(Session::get("success")) !!};
            showSuccess([message]);
        </script>
    @elseif(Session::has("error"))
        <script type="module">
            let message = {!! json_encode(Session::get("error")) !!};
            console.error(message);
            showErrors([message]);
        </script>
    @endif
</div>

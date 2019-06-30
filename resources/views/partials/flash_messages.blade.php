@push('js')
<script>
    @foreach (session('flash_notification', collect())-> toArray() as $message)
            console.log("{{ $message['level'] }}");
    $.notify("{!! $message['message'] !!}", "{{ ($message['level']!='danger')?$message['level']:'error' }}");
    @endforeach
</script>
@endpush
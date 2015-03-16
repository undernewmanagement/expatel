<?php echo '<?xml version="1.0" encoding="UTF-8"?> '?>
<!-- page located at http://example.com/complex_gather.xml -->
<Response>
    <Gather action="http://{{Request::server('HTTP_HOST')}}/call?caller_id={{$caller_id}}" method="POST">
        <Say>Yo. Wait here</Say>
    </Gather>
    <Say>We didn't receive any input. Goodbye!</Say>
</Response>

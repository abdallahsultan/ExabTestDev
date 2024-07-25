@component('mail::message')
# Repositories Export

Your export is ready. The file is attached to this email. Click the button below to download the file from the attachments section (mime).

 <img src="{{ asset('export/info.png') }}">

<p>If the button doesn't work, please check the attachments section (mime) to download the file.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
# Introduction

# Thank You for Your message
<strong>Name: </strong> {{ $data['name'] }}
<strong>Email: </strong> {{ $data['email'] }}

<strong>Message</strong>

{{$data['message']}}
@endcomponent

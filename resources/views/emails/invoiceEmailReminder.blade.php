@component('mail::message')
# Invoice Information

Hello {{ $customer->name }},

<p>
	This is a reminder letting you know your invoice is still unpaid. If you have a check in the mail, please disregard this email. Please let me know if you have any questions.
</p>

Thank you,<br>
Devyn Earls
@endcomponent

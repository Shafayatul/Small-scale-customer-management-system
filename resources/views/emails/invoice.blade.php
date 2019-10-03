@component('mail::message')
# Invoice Information

Hello {{ $customer->name }},

<p>
	Attached is your invoice. Please let me know if you have any questions.
</p>

Thank you,<br>
Devyn Earls
@endcomponent
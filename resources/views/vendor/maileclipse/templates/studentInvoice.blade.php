@component('mail::message')

**Hey {{explode(' ', $payment->user->name)[0]}},**

Thank you for using Veedros! This is an invoice for your recent purchase.


@component('mail::table')
| | {{$payment->created_at->format('d/M/Y')}} |
| ------------- |:-------------:|
| Payment method: | {{$payment->method}} |
| Subtotal: | {{number_format($payment->amount, 2, '.', '')}} EGP |
@endcomponent

@component('mail::table')
| Course | Amount |
| ------------- |:-------------:|
@if($payment->promo_code)
@foreach($payment->courses as $course)
| {{$course->name}} | {!! ($payment->promo_code->hasCourse($course) || $payment->promo_code->global ? "<s>" . $course->price . "</s> " . number_format(($course->price * (1 - $payment->promo_code->discount_percentage/100)), 2, '.', '') : $course->price) !!} EGP |
@endforeach
@else
@foreach($payment->courses as $course)
| {{$course->name}} | {{$course->price}} EGP |
@endforeach
@endif
| |
| **Total** | {{number_format($payment->amount, 2, '.', '')}} EGP |
@endcomponent

Stay Safe,

The Veedros Team

-----

<small>If you have any questions about this receipt, you can email us at support@veedros.com.</small>


@endcomponent

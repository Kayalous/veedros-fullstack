@component('mail::message')
# <b style="color: #313c8b">Your courses are one step away!</b>

To finish enrolling in
<b>{{$enrollment->courses[0]->name .
                    ($enrollment->courses()->count() > 1 ? ', and ' .
                    ($enrollment->courses()->count() - 1) . ' other' .
                    ($enrollment->courses()->count() > 2 ? 's' : ''): '')}}
(Subtotal: <span style="color: #65D3BF">{{$enrollment->subtotal}} EGP</span>).</b>
<br>
You need to go to your nearest Aman/Masari <span class="ar">(أمان\مصاري)</span> outlet,
and ask for <span class="ar">"مدفوعات متنوعة آكسيبت"</span> and provide the code below:

## <b style="color: #313c8b">{{$amanCode}}</b>
<br>
<br>
Stay safe,
<br>
Veedros
@endcomponent

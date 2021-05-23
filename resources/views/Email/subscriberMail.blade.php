
@component('mail::message')
<center><img src="{{Storage::disk('uploads')->url($mailData['setting']->siteLogo)}}" alt="{{$mailData['setting']->sitename}}" style="max-width: 200px; margin-bottom: 2rem;"></center>

<center style="font-size: 2rem; font-weight:bold; margin-bottom: 1.5rem;">{{$mailData['news']->title}}</center>

<img src="{{Storage::disk('uploads')->url($mailData['news']->image)}}" alt="{{$mailData['news']->title}}" style="max-width: 100%;">

@component('mail::button', ['url' => $mailData['url'], 'color' => 'green'])
    Read The Article..
@endcomponent
@endcomponent




@component('mail::message')
    # Good Job!

    Well done, you have stopped smoking for: {{ $content['daysStopped'] }} days!

    Here's a snapshot of the significant benefits you've achieved so far:

    - You have avoided smoking a total of {{ $content['smokingData']['cigarettesNotSmokedSince'] }} cigarettes.
    - You've not inhaled {{ $content['smokingData']['nicotineNotInhaledSince'] }} mg of nicotine.
    - You've also prevented {{ $content['smokingData']['tarNotInhaledSince'] }} mg of tar from entering your lungs.
    - You have refrained from buying {{ $content['smokingData']['packetsNotBoughtSince'] }} packets of cigarettes.

    Each day you spend without smoking is a testament to your strength and determination. Keep up the excellent work!

    Keep it up!,

    Dear regards,

    {{ config('app.name') }}
@endcomponent

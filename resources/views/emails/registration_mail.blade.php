@component('mail::message')
    # CONGRATULATIONS!!!

    We officially welcome you to our family, so on behalf of AIESEC Cairo University, we want to tell you "YOU’RE ACCEPTED!!!"

    After hectic phases and interviews, now must come the CELEBRATION TIME!

    We are now inviting you to attend your first AIESEC experience "ASPIRE’20" as your first step  in order to activate your membership.

    . ASPIRE is our 3 days winter fiesta full of warm and cosy surroundings where we will introduce you to our culture, our dances and you'll learn AIESEC's structure and what we exactly do.
    . We will definitely have lots of fun and bond with each other and it will be your first step to be at your second home.
    . There will be very important informative sessions, but that doesn't mean that we will not be having fun at the same time with all our surprises.

    Can you make a wish?
    Pack your bags and get ready to meet your second family next weekend from the 24th til the 26nd of December.
    Winter is absolutely magical... and we're ready to create more life-changing stories all year long!
@component('mail::button', ['url' => route('book-id',['ASPIRE\'20',$mail_data['delegate']->id]), 'color' => 'success'])
        Register Now!
@endcomponent
@component('mail::button', ['url' => 'https://www.aspire20-cu.aieseccu.com'])
        Check Our Website
@endcomponent
@component('mail::button', ['url' => 'https://www.facebook.com/groups/838546556910789'])
        Join Our Facebook Group
@endcomponent


    Thanks,
    {{ config('app.name') }} Team.
@endcomponent

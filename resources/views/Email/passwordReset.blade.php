@component('mail::message')
# Hallo!

Iemand heeft een verzoek ingediend om je Boer naar Burger wachtwoord te resetten. Klik op onderstaande knop om het wachtwoord te wijzigen.

@component('mail::button', ['url' => env('APP_URL') . '/change-password?token=' . $token])
Reset Wachtwoord
@endcomponent

Heb je deze e-mail niet aangevraagd? Negeer dit bericht, je wachtwoord blijft veilig en zal niet worden gewijzigd!

Met vriendelijke groeten,<br>
<strong>Boer naar Burger</strong>
@endcomponent

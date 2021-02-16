@component('mail::message')
# Hallo!

Iemand heeft een verzoek ingediend om je Boer naar Burger wachtwoord te resetten. Klik op onderstaande knop om het wachtwoord te wijzigen.

@component('mail::button', ['url' => 'http://localhost:4200/change-password'])
Reset Wachtwoord
@endcomponent

Heb je deze e-mail niet aangevraagd? Negeer dit bericht, je wachtwoord blijf veilig en zal niet worden gewijzigd!

Met vriendelijke groeten,<br>
<strong>Boer naar Burger</strong>
@endcomponent

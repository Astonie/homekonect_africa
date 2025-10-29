# Email Notification System

## Overview
HomeKonnect now has a comprehensive email notification system integrated with Gmail SMTP.

## Configuration

### Environment Variables
The following variables are configured in your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail_address@gmail.com
MAIL_PASSWORD=your_app_password   # Use a Google App Password (see below)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@yourdomain.com"  # or your Gmail
MAIL_FROM_NAME="${APP_NAME}"
```

## Implemented Notifications

### 1. Welcome Notification
**File:** `app/Notifications/WelcomeNotification.php`  
**Trigger:** When a user registers  
**Sent To:** New user  
**Controller:** `RegisteredUserController@store`

Welcomes new users and provides them with a link to explore properties.

### 2. Property Approved Notification
**File:** `app/Notifications/PropertyApprovedNotification.php`  
**Trigger:** When admin approves a property listing  
**Sent To:** Property owner (landlord/agent)  
**Controller:** `PropertyAdminController@verify`

Notifies the property owner that their listing has been approved and is now live.

### 3. Property Rejected Notification
**File:** `app/Notifications/PropertyRejectedNotification.php`  
**Trigger:** When admin rejects a property listing  
**Sent To:** Property owner (landlord/agent)  
**Controller:** `PropertyAdminController@reject`

Informs the property owner about rejection with a reason and provides a link to edit the property.

### 4. KYC Verified Notification
**File:** `app/Notifications/KYCVerifiedNotification.php`  
**Trigger:** When admin approves or rejects KYC verification  
**Sent To:** User who submitted KYC  
**Controller:** `KycVerificationAdminController@approve` & `@reject`

Notifies users about their KYC verification status (approved or rejected).

### 5. New Inquiry Notification
**File:** `app/Notifications/NewInquiryNotification.php`  
**Trigger:** When someone submits an inquiry on a property  
**Sent To:** Property owner  
**Controller:** `ContactController@sendInquiry`

Alerts property owners about new inquiries with the inquirer's contact details and message.

## Testing Email Configuration

### Test Command
Use the following Artisan command to test email configuration:

```bash
php artisan email:test [email]
```

**Examples:**
```bash
# Test with first user in database
php artisan email:test

# Test with specific email
php artisan email:test admin@homekonnect.com
```

## Contact System

### Property Inquiry Form
Users can send inquiries about specific properties through the property details page.

**Route:** `POST /properties/{property}/inquiry`  
**Controller:** `ContactController@sendInquiry`

**Fields:**
- Name (required)
- Email (required)
- Phone (optional)
- Message (required, max 1000 chars)

### General Contact Form
Users can send general inquiries through the contact page.

**Routes:**
- `GET /contact` - Show contact form
- `POST /contact` - Send contact message

**Controller:** `ContactController@show` & `@send`

**Fields:**
- Name (required)
- Email (required)
- Subject (required)
- Message (required, max 2000 chars)

## Email Queue (Optional)

All notifications implement `ShouldQueue` interface, which means they will be queued if you configure a queue driver.

### To Enable Queue Processing:

1. Set queue driver in `.env`:
```env
QUEUE_CONNECTION=database
```

2. Create jobs table:
```bash
php artisan queue:table
php artisan migrate
```

3. Run queue worker:
```bash
php artisan queue:work
```

**Benefits:**
- Faster response times
- Better user experience
- Email failures won't affect app functionality

## Email Templates

All emails use Laravel's MailMessage class with a clean, professional design:
- Blue gradient header
- Clear sections for content
- Action buttons with hover effects
- Responsive design
- Professional footer

## Customization

### Changing Email Appearance
Laravel notifications use the default mail template. To customize:

```bash
php artisan vendor:publish --tag=laravel-mail
```

This publishes the email templates to `resources/views/vendor/mail`.

### Adding New Notifications

1. Create notification class:
```bash
php artisan make:notification YourNotification
```

2. Implement the notification:
```php
public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Your Subject')
        ->greeting('Hello!')
        ->line('Your message here')
        ->action('Action Button', url('/'))
        ->salutation('Best regards, Team');
}
```

3. Send the notification:
```php
$user->notify(new YourNotification($data));
```

## Troubleshooting

### Email Not Sending

1. Check `.env` configuration
2. Verify Gmail credentials
3. Ensure "Less secure app access" is enabled or use App Password
4. Check Laravel logs: `storage/logs/laravel.log`
5. Test with: `php artisan email:test`

### Gmail App Password

If you're using 2-factor authentication:
1. Go to Google Account settings
2. Security → 2-Step Verification
3. App passwords → Generate new password
4. Use this password in `MAIL_PASSWORD`

Security note: Don’t commit real credentials or secrets to your repository. The examples above use placeholders.

### Testing in Development

To log emails instead of sending:
```env
MAIL_MAILER=log
```

Emails will be logged to `storage/logs/laravel.log`.

## Future Enhancements

Consider implementing:
- Email preferences in user settings
- Notification history/inbox
- Push notifications
- SMS notifications for critical events
- Weekly digest emails
- Property price change alerts
- New properties matching user preferences

## Support

For issues or questions:
- Check Laravel documentation: https://laravel.com/docs/notifications
- Review logs: `storage/logs/laravel.log`
- Test configuration: `php artisan email:test`

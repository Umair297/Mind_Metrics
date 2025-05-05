<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Service Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px; margin: 0;">
    <table cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color: #EE2D7B; padding: 20px 30px; color: #ffffff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2 style="margin: 0; font-size: 24px;">📋 New Service Submitted</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p><strong>👤 Student Name:</strong> {{ $service->student_first_name }} {{ $service->student_last_name }}</p>
                <p><strong>📱 Phone:</strong> {{ $service->phone_primary }}</p>
                
            
                <p>Your service has been successfully submitted. Click the button below to view all details and access related documents easily.</p>
                
                <!-- Link -->
                <p><a href="http://localhost/cms/services/44/show" style="color: #EE2D7B; text-decoration: none;">Click here to Show a document</a></p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f9f9f9; padding: 20px 30px; text-align: center; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; font-size: 14px; color: #777;">
                <p style="margin: 0;">This is an automated email from {{ config('app.name') }}.</p>
            </td>
        </tr>
    </table>
</body>
</html>

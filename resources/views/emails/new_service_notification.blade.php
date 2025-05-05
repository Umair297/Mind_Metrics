<!-- resources/views/emails/new_service_notification.blade.php -->
<h1>New Service Added</h1>
<p>Student: {{ $service->student_first_name }} {{ $service->student_last_name }}</p>
<p>Phone: {{ $service->phone_primary }}</p>
<p>Service Type: {{ $service->services_type }}</p>

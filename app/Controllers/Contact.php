<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class Contact extends Controller
{
    public function send_email()
    {
        // Validation rules
        $validation = \Config\Services::validation();
        
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]',
            'phone' => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get form data
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'ip_address' => $this->request->getIPAddress(),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        try {
            $email = \Config\Services::email();

            // Email configuration (prefer a domain you control for From)
            $email->setFrom('no-reply@yourdomain.com', 'Portfolio Website');
            $email->setReplyTo($data['email'], $data['name']);
            $email->setTo('mejaghani@gmail.com'); // Replace with your email
            $email->setSubject('Contact Form: ' . $data['subject']);

            // Use HTML mail type for better formatting
            $email->setMailType('html');

            // Create HTML email message
            $emailMessage = $this->buildEmailMessage($data);
            $email->setMessage($emailMessage);

            if ($email->send()) {
                return redirect()->back()->with('success', 'Your message has been sent successfully!');
            } else {
                log_message('error', 'Email sending failed: ' . $email->printDebugger(['headers']));
                return redirect()->back()->withInput()->with('error', 'Failed to send email. Please try again.');
            }

        } catch (\Exception $e) {
            log_message('error', 'Email exception: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while sending your message.');
        }
    }

    /**
     * Build HTML formatted email message
     */
    private function buildEmailMessage(array $data): string
    {
        // Basic escaping for safety
        $name = htmlspecialchars($data['name'] ?? '', ENT_QUOTES, 'UTF-8');
        $emailFrom = htmlspecialchars($data['email'] ?? '', ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($data['phone'] ?: 'Not provided', ENT_QUOTES, 'UTF-8');
        $subject = htmlspecialchars($data['subject'] ?? '', ENT_QUOTES, 'UTF-8');
        $messageText = htmlspecialchars($data['message'] ?? '', ENT_QUOTES, 'UTF-8');
        $ipAddress = htmlspecialchars($data['ip_address'] ?? '', ENT_QUOTES, 'UTF-8');
        $timestamp = htmlspecialchars($data['timestamp'] ?? '', ENT_QUOTES, 'UTF-8');

        return "
<!doctype html>
<html>
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Contact Form</title>
    <style>
      body{font-family:Arial,Helvetica,sans-serif;line-height:1.6;color:#111;margin:0;padding:24px;background:#f7f7f8}
      .card{max-width:680px;margin:auto;background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden}
      .header{background:#111827;color:#fff;padding:16px 20px}
      .content{padding:20px}
      .row{margin:0 0 10px}
      .label{display:block;font-size:12px;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px}
      .value{font-size:15px;color:#111}
      .divider{border-top:1px solid #e5e7eb;margin:16px 0}
      .muted{color:#6b7280;font-size:12px}
    </style>
  </head>
  <body>
    <div class=\"card\">
      <div class=\"header\"><h2 style=\"margin:0;font-size:18px\">New Contact Form Submission</h2></div>
      <div class=\"content\">
        <div class=\"row\"><span class=\"label\">Name</span><div class=\"value\">{$name}</div></div>
        <div class=\"row\"><span class=\"label\">Email</span><div class=\"value\"><a href=\"mailto:{$emailFrom}\">{$emailFrom}\n</a></div></div>
        <div class=\"row\"><span class=\"label\">Phone</span><div class=\"value\">{$phone}</div></div>
        <div class=\"row\"><span class=\"label\">Subject</span><div class=\"value\">{$subject}</div></div>
        <div class=\"divider\"></div>
        <div class=\"row\"><span class=\"label\">Message</span><div class=\"value\">" . nl2br($messageText) . "</div></div>
        <div class=\"divider\"></div>
        <p class=\"muted\"><em>Sent from:</em> {$ipAddress}<br><em>Time:</em> {$timestamp}</p>
      </div>
    </div>
  </body>
</html>";
    }

    /**
     * Alternative method using HTML email
     */
    private function buildHtmlEmailMessage(array $data): string
    {
        return view('emails/contact_template', $data);
    }
}
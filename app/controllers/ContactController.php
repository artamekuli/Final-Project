<?php

namespace app\controllers;

use app\models\Message;

class ContactController extends Controller
{
    public function contactpage()
    {
        $this->returnView('../public/views/contact.html');
    }

    public function validateContact($inputData)
    {
        $errors = [];

        $name = $inputData['name'];
        $email = $inputData['email'];
        $message = $inputData['message'];

        if ($name) {
            $name = htmlspecialchars($name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (strlen($name) < 1) {
                $errors['nameShort'] = 'Name is too short';
            }
        } else {
            $errors['requiredName'] = 'Name is required';
        }

        if ($email) {
            $email = htmlspecialchars($email, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['invalidEmail'] = 'Please enter a valid email address';
            }
        } else {
            $errors['requiredEmail'] = 'Email is required';
        }

        if ($message) {
            $message = htmlspecialchars($message, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (strlen($message) < 10) {
                $errors['messageShort'] = 'Message should be at least 10 characters';
            }
        } else {
            $errors['requiredMessage'] = 'Message is required';
        }

        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }

        return [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];
    }

    public function submit(): void
    {
        $inputData = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'message' => $_POST['message'] ?? null,
        ];

        error_log('Form Data: ' . print_r($inputData, true));

        $validated = $this->validateContact($inputData);

        $msgModel = new Message();

        error_log('Validated Data: ' . print_r($validated, true));

        $result = $msgModel->saveMessage([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Message received and saved!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save message.']);
        }

        http_response_code(200);
        exit();
    }

    public function getMessageCount()
    {
        header('Content-Type: application/json');
        $model = new Message();
        $count = $model->getMessageCount();
        echo json_encode(['count' => $count]);
    }

    public function contactView(): void
    {
        include '../../public/views/contact.html';
        exit();
    }
}

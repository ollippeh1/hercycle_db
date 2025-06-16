<?php

namespace App\Controllers;

class Chatbot extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Chat AI Dashboard',
            'menu_items' => [
                ['name' => 'Kalender', 'completed' => false],
                ['name' => 'Note', 'completed' => false],
                ['name' => 'Chat AI', 'completed' => true],
                ['name' => 'EduKasi', 'completed' => false],
            ],
            'content' => [
                'date' => date('F j, Y'), // Current date
                'category' => 'AI Assistant',
                'title' => 'Welcome to Chat AI',
                'buttons' => [
                    ['text' => 'Start Chatting >', 'url' => 'https://hercycle-drab.vercel.app/'],
                ],
            ]
        ];

        return view('user/chatbot/index', $data);
    }
}

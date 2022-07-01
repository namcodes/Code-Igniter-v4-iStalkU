<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use Config\Validation;
use PHPUnit\Util\Xml\Validator;
use Config\Database;

class Routes extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $user_token = session()->get('user_token');
        if (!$user_token) {
            return view('index');
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function auth_user()
    {

        $validation = $this->validate([
            "name" => [
                'rules' => 'required|regex_match[/^([a-zA-Z ])+$/i]',
                'errors' => [
                    'required' => "Your name is required",
                    'regex_match' => "Invalid character input, Only letters is available.",
                ]
            ],
        ]);

        if (!$validation) {
            return view('index', ['validation' => $this->validator]);
        } else {
            function token(int $length, string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
            {
                if ($length < 1) {
                    throw new \RangeException("Length must be a positive integer");
                }
                $pieces = [];
                $max = mb_strlen($keyspace, '8bit') - 1;
                for ($i = 0; $i < $length; ++$i) {
                    $pieces[] = $keyspace[random_int(0, $max)];
                }
                return implode('', $pieces);
            }

            $token = token(15);
            $name = $this->request->getPost('name');
            $date = date('Y - m - d');

            $values = [
                'token' => $token,
                'name' => htmlspecialchars($name),
                'date' => $date
            ];

            $userModel = new \App\Models\userModel();
            $query = $userModel->insert($values);

            if (!$query) {
                return redirect()->back()->with('error', "Something went wrong");
            } else {
                session()->set('user_token', $token);
                return redirect()->to('dashboard')->with('success', "Successfully Created");
            }
        }
    }

    public function dashboard()
    {
        $user_token = session()->get('user_token');
        if (!$user_token) {
            return redirect()->to('/');
        } else {
            $user_Data = new \App\Models\userToken();
            $user_data = $user_Data->find($user_token);
            $messageData = new \App\Models\userMessage();
            $message_record = $messageData->where('token', $user_token);
            $query = $message_record->get();
            $record = $query->getResult();

            $data = [
                'title' => 'dashboard',
                'user_data' => $user_data,
                'record' => $record
            ];
            return view('dashboard', $data);
        }
    }

    public function message($param)
    {
        $user_Token = new \App\Models\userToken();
        $user_record = $user_Token->find($param);

        $user_token = session()->get('user_token');


        $token = [
            'title' => 'message',
            'user_token' => $param
        ];

        if (!$user_token) {
            if (!$user_record) {
                return redirect()->to('/');
            } else {
                return view('message', $token);
            }
        } else {
            return redirect()->to('dashboard');
        }
    }

    public function auth_message()
    {
        $token = $this->request->getPost('user_token');
        $message = $this->request->getPost('message');
        date_default_timezone_set('Asia/Taipei');
        $date = date('Y - m - d | h:i A', time());
        $values = [
            'token' => $token,
            'message' => htmlspecialchars($message),
            'created' => $date
        ];

        $userMessage = new \App\Models\userMessage();

        $query = $userMessage->insert($values);
        if (!$query) {
            return redirect()->to('/')->with('error', "Failed to Sent");
        } else {
            return redirect()->to('/')->with('success', "Successfully Sent");
        }
    }

    public function logout()
    {
        if (session()->has('user_token')) {
            session()->remove('user_token');
            return redirect()->to('?access=out')->with('success', "Successfully Logout");
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($message_id)
    {
        $userMessage = new \App\Models\userMessage();
        $query = $userMessage->delete($message_id);

        if ($query) {
            return redirect()->to('dashboard');
        }
    }
}

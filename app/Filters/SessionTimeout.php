<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionTimeout implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('id_user')) {

            $timeout = 300; // 5 menit
            $lastActivity = session()->get('last_activity');

            if ($lastActivity && (time() - $lastActivity) > $timeout) {
                session()->destroy();
                return redirect()->to(site_url('login'))
                    ->with('error', 'Session habis karena tidak ada aktivitas');
            }

            // update aktivitas
            session()->set('last_activity', time());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}

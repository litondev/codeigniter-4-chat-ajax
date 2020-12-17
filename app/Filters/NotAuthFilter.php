<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NotAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    	if(session('user')){    	
    		return redirect()->to('/user');
    	} 
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
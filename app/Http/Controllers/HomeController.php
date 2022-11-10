<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;

class HomeController extends Controller
{

    private  string $file  ;
    private  int $limit  ;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->file = Storage::path('public/error.log') ;
        $this->limit = 10 ;
    }

    public function setFile(Request $request)
    {
        $this->file = $request->input('fileName') ;
        return "success" ;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $path =  Storage::path('public/*.log');
        $filenames = glob($path);



        $file = $this->file ; // Let's take the current file just as an example.
        $lines_to_display = $this->limit ;
        $lines = count(file($file)) ;
        $limit =  $this->limit  ;

       $result =   $this->log_viewer() ;

        return view('home',compact('lines','limit','filenames'));
    }

    public function log_viewer($start = 0)
    {
    $file =  $this->file ;
    $lines_to_display = $this->limit   ;
    $lines = count(file($file)) ;

    $output = "" ;
    $i = 0 ;
    if($start >= $lines ) {
        return $output  = "end of file" ;
    }
    $lines =   array_slice(file($file), $start, $lines_to_display);
    foreach(  $lines as $line) {
        $i++ ;
        $output .="Line ".$i."-".$line. "<br>";
    }

     return $output ;



    }
}

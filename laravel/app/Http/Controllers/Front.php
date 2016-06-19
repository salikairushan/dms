<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\Http\Requests;

class Front extends Controller
{

    //Load default home page
    public function index(){

                return redirect('/details');

     }



    //Load details home Page
    public function detailsLoad(Request $request){
                $array = array();
               if ($request->text== "no"){

                   if (isset($request->page)) {
                       $page = $request->page;
                   } else {

                       $page = 1;

                   }
                   $data = glob('./sathkara piyasa/*.*');
                   $text ="no";

               }
                else {



                    $text = $request->text;

                    if (isset($request->page)) {
                        $page = $request->page;
                    } else {

                        $page = 1;

                    }

                    $data = glob('./sathkara piyasa/*' . $request->text . '*.*');




                }


                foreach($data as $file){

                    $varId= substr($file,18,strpos(substr($file,18),'.'));

                    $idNo=substr($varId,strpos($varId,")")+1);

                    $word =substr($file,strpos($file,'('));

                    $end = strpos($word,')')-1;

                    $copyNo = substr($word,1,$end);


                    //get the position of "_" +1
                    $start =strpos($file,'_')+1;

                    //Get the position of "("
                    $end = strpos($file,'(');

                    //Get the string between "_" and "("
                    $varDate =substr($file,0,$end);

                    $varDate1= substr($varDate,$start);

                    $assosiativeArray = array( "id" => $idNo,"date" => $varDate1 , "ref"=> $copyNo );

                    array_push($array,$assosiativeArray);



                }


                 return view('details', array('data' => $array,'page' => $page,'text' => $text));
    }




    public function search(Request $request){

           $text =$request->searchBox;

           return redirect('/details?text='.$text);

    }










}

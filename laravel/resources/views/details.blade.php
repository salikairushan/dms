@extends('layout')
@section('content')
    <div class="body_container" >


        <div class="table_body_2">
            <div class="id_search " id="search" style="width: 700px;">
                <form style="float: left"  action="{{URL::to('/search')}}" method="post" >
                    <input class="box_search" type="text" name="searchBox" id="searchBox">
                    <input class="button_search" type="submit" value="Search" >
                </form>
            </div>


            <div class="col_1">

                    <div class="col_1_head">
                        <center> <strong> Id </strong></center>
                    </div>
                    <div class="col_2_head">
                        <center><strong>  Date </strong></center>
                    </div>
                <div class="col_3_head">
                    <center> &nbsp </center>
                </div>

                <div id="table_data" >
                   <?php



                    $total = sizeof($data);  //No of records

                    $limit = 13;              //no of records per page

                    $totalPages = ceil($total/$limit); // no of pages

                    $page= max($page,1);

                    $page= min($page,$totalPages);

                    $offset= ($page -1)* $limit;

                    if($offset < 0){
                        $offsaet =0;
                    }

                    $dataArray = array_slice($data,$offset,$limit);

                     foreach($dataArray as $filename){



                                    $varIdNo=$filename['id'];
                                    $location = glob('./sathkara piyasa/*'.$filename['date'].'('.$filename['ref'].')'. $varIdNo . '*.*');

                                           ?>
                                    <div class="row_1" id="<?php if(strlen($varIdNo) != 0){ echo $varIdNo;}else{ echo NULL;} ?>" >
                                       <div class="col_data_1">

                                           <center>

                                               <?php


                                                      if(strlen($varIdNo) != 0){
                                                          echo $varIdNo;
                                                      }
                                                      else{
                                                          echo "NULL";
                                                      }

                                                   ?>
                                                   &nbsp

                                           </center>

                                       </div>

                                        <div class="col_data_2">

                                            <center>

                                                <?php

                                                    $varDate1= $filename['date'];

                                                    if(strlen($varDate1) != 0){
                                                        echo $varDate1;
                                                    }
                                                    else{
                                                        echo "NULL";
                                                    }

                                                ?>

                                                &nbsp

                                            </center>

                                        </div>

                                        <div class="col_data_3">
                                            <?php foreach($location as $location1){ ?>
                                            <input class="button_check" value="view" type="button" name="check" onclick="viewPdf('<?php echo $location1 ?>')"  >
                                            <?php  } ?>
                                        </div>


                                     </div>

                                    <?php

                     }


                    ?>

                </div>

                <?php

                if($text == "no"){
                    $link = '/details?page=%d';

                }else{
                    $link = '/details?page=%d&text='.$text;
                }

                $pagerContainer = '<div class="c_paginate" style="width:300px;">';

                if( $totalPages != 0){
                    if($page == 1){
                        $pagerContainer .= '';

                    }
                    else
                    {
                        $pagerContainer .=sprintf( '<a href="'.$link.'" style="color: #c00"> &#171; Prev page</a>', $page-1 );

                    }

                    $pagerContainer .= '<span> page <strong>' .$page. '</strong> from '. $totalPages. '</span>';

                    if($page == $totalPages){
                        $pagerContainer .= '';

                    }
                    else
                    {
                        $pagerContainer .=sprintf( '<a href="'.$link.'" style="color: #c00"> Next page &#187; </a>', $page+1 );

                    }
                }
                $pagerContainer .= '</div>';
                echo $pagerContainer;
                ?>


            </div>




        </div>
    </div>


@stop
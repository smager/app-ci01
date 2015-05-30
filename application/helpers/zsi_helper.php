<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('get_dhtmlx_path'))
{   function get_dhtmlx_path(){
          return base_url('assets/dhtmlx36'); 
    }
}


if ( ! function_exists('getRowItems'))
{

        function getRowItems($row){
            
            $data = array();
            foreach($row as $item)
            {
                array_push($data,$item);

            }
            return $data;
        }                     

}
if ( ! function_exists('toDHTMLXData'))
{
        function toDHTMLXData($query){
            $data = array();
            $ctrl =0;
            foreach ($query->result() as $row)
            {
                $data[$ctrl]['id'] = $ctrl;                 
                $data[$ctrl]['data'] = getRowItems($row); 
                $ctrl++;
            }
            return array("rows"=> $data);
        }
}
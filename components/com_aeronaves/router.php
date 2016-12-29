<?php

class AeronavesRouter extends JComponentRouterBase{
    public function build(&$query) {
         $segments = array();
         //echo "<pre>"; print_r($query); exit();
       if (isset($query['view']))
       {
                $segments[] = $query['view'];
                unset($query['view']);
       }
       if (isset($query['id']))
       {
                $segments[] = $query['id'];
                unset($query['id']);
       }
      
       return $segments;
    }

    public function parse(&$segments) {
        $vars = array();
        
       switch($segments[0])
       {
               case 'aeronaves':
                       $vars['view'] = 'aeronaves';
                       break;
               case 'aeronave':
                       $vars['view'] = 'aeronave';
                       if(isset($segments[1])):
                        $id = explode(':', $segments[1]);
                        $vars['id'] = (int) $id[0];
                       endif;
                       break;
               
       }
       return $vars;
    }

}

